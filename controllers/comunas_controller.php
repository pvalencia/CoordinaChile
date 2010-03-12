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
			$comunas[$nom]['Salud']['Voluntarios'] = 0;
			$comunas[$nom]['Vivienda']['Voluntarios'] = 0;
			$comunas[$nom]['Vivienda']['Viviendas'] = 0;
			$comunas[$nom]['Humanitaria']['Voluntarios'] = 0;
			$comunas[$nom]['Humanitaria']['Recursos'] =  0;
			$comunas[$nom]['Otros']['Recursos'] = 0;
			$comunas[$nom]['id'] = 0;
			
		}
		$this->set(compact('comunas', 'comunas_db'));
	}
}
?>
