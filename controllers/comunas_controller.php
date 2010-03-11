<?php
class ComunasController extends AppController {
	var $name = 'Comunas' ;

	function index(){
		todos();
		$this->render('todos');
	}

	function ver($comuna_id) {
		$comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $comuna_id), 'recursive' => 2));
		if($comuna == null)
			$this->cakeError('error404');
		$this->set(compact('comuna'));
	}

	function todos(){
		$comunas = $this->Comuna->find('all', array('recursive' => 2));
		$this->set(compact('comunas'));
	}

}
?>
