<?php
class ComunasController extends AppController {
	var $name = 'Comunas' ;

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
	}


}
?>
