<?php
class ComunasController extends AppController {
	var $name = 'Comunas' ;
	var $uses = array('Comuna', 'Operativo', 'Catastro');

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
		$comunas = $this->Comuna->find('list', array('fields' => array('Comuna.id', 'Comuna.nombre') ) );
		$localidades_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.localidad_id' ) );
		if(count($localidades_con_operativos) != 0)
			$localidades_operativos = $this->Operativo->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_operativos) ) );
		else
			$localidades_operativos = array();
		$localidades_con_operativos = array();
		$operativos = array();
		foreach($localidades_operativos as $localidad) {
			if(!array_key_exists($localidad['Comuna']['id'], $operativos))
				$operativos[$localidad['Comuna']['id']] = 0;
			$operativos[$localidad['Comuna']['id']] += count($localidad['Operativo']);
			
		}
		$localidades_operativos = array();
		
		$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));
		if(count($localidades_con_catastros) != 0)
			$localidades_catastros = $this->Operativo->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_catastros) ) );
		else 
			$localidades_catastros = array();
		$localidades_con_catastros = array();
		
		$catastros = array();
		foreach($localidades_catastros as $localidad) {
			$catastros[$localidad['Comuna']['id']] += count($localidad['Catastro']);
		}
		$localidades_catastros = array();
		$this->set(compact('comunas', 'operativos', 'catastros'));
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
	
	function get_comunas($region_id = 0){
		if($region_id != 0)
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Comuna.id BETWEEN ? AND ?' => array($region_id*1000, ($region_id*1000 + 999)) ) ) );
		else
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre')) );
		
		$this->set(compact('comunas'));
	}
}
?>
