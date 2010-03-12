<?php
class ComunasController extends AppController {
	var $name = 'Comunas' ;
	var $uses = array('Comuna', 'Operativo');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('ver', 'index', 'todos', 'mapa'));
	}
	
	function index(){
		todos();
		$this->render('todos');
	}

	function ver($comuna_id) {
		$localidades = $this->Comuna->Localidad->find('all', array('conditions' => array('Localidad.comuna_id' => $comuna_id), 'recursive' => 2));
		if($localidades == null)
			$this->cakeError('error404');
		$this->set(compact('localidades'));
	}

	function todos(){
		$comunas = $this->Comuna->find('all', array('recursive' => 2));
		$this->set(compact('comunas'));
	}
	
	function mapa(){
/*		$comunas = $this->Comuna->find('list', array('fields' => array('Comuna.lat', 'Comuna.lon', 'Comuna_nombre'), 
													 'conditions' => array('Localidad')));*/
		$localidades = $this->Operativo->find('list', array('fields' => array('Operativo.localidad_id')));
		$comunas_id = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.comuna_id'), 'conditions' => array('Localidad.id' => $localidades)));
		$comunas_db = $this->Comuna->find('all', array('recursive' => 1, 
													  'conditions' => array('id' => $comunas_id)
													  ));
		$comunas = array();
		foreach($comunas_db as $comuna_all){
			$comuna = $comuna_all['Comuna'];
			$nom = $comuna['nombre'];
			$comunas[$nom]['lat'] = $comuna['lat'];
			$comunas[$nom]['lon'] = $comuna['lon'];
			$comunas[$nom]['Recursos']['Salud']['Voluntarios'] = 0;
			$comunas[$nom]['Recursos']['Vivienda']['Voluntarios'] = 0;
			$comunas[$nom]['Recursos']['Vivienda']['Viviendas'] = 0;
			$comunas[$nom]['Recursos']['Humanitaria']['Voluntarios'] = 0;
			$comunas[$nom]['Recursos']['Humanitaria']['Recursos'] =  0;
			$comunas[$nom]['Recursos']['Otros']['Recursos'] = 0;
		
		
			$ids_salud = array(12, 13, 14);
			$ids_vivienda_voluntarios = array(11, 15, 16);
			$ids_vivienda_vivienda = array(20);
			$ids_humanitaria_voluntarios = array(21);
			$ids_humanitaria_recursos = array(1, 2, 3, 4, 5, 8, 9, 10, 19, 22);
			$ids_otros = array(6, 7, 17, 18, 23);
			
			$localidades = $comuna_all['Localidad'];
			foreach($localidades as $localidad){
				$recursos = $this->Operativo->Recurso->find('all', array('conditions' => array('Operativo.localidad_id' => $localidad['id'])));
				foreach($recursos as $recurso){
					$id = $recurso['Recurso']['tipo_recurso_id'];
					$cantidad = $recurso['Recurso']['cantidad'];
					if(in_array($id, $ids_salud))
						$comunas[$nom]['Recursos']['Salud']['Voluntarios'] += $cantidad;
					elseif(in_array($id, $ids_vivienda_voluntarios))
						$comunas[$nom]['Recursos']['Vivienda']['Voluntarios'] += $cantidad;
					elseif(in_array($id, $ids_vivienda_vivienda))
						$comunas[$nom]['Recursos']['Vivienda']['Viviendas']  += $cantidad;
					elseif(in_array($id, $ids_humanitaria_voluntarios))
						$comunas[$nom]['Recursos']['Humanitaria']['Voluntarios']  += $cantidad;
					elseif(in_array($id, $ids_humanitaria_recursos))
						$comunas[$nom]['Recursos']['Humanitaria']['Recursos']  += $cantidad;
					elseif(in_array($id, $ids_otros))
						$comunas[$nom]['Recursos']['Otros']['Recursos'] += $cantidad ;
				}
			}
			$comunas[$nom]['id'] = $comuna_all['Comuna']['id'];
		}
		$this->set(compact('comunas', 'comunas_db'));
	}
}
?>
