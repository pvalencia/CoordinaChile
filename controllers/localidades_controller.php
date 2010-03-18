<?php
class LocalidadesController extends AppController {
	var $name = 'Localidades' ;
	var $helpers = array('Regiones');

	function isAuthorized() {
		if($this->Auth->user('admin'))
			return true;

		switch($this->params['action']) {
			case 'nuevo':
			case 'editar':
				return false;
			default:
				return true;
		}
	}

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('todos', 'index', 'nuevo', 'ver', 'get_localidades');
	}

	function index(){
		$this->todos();
		$this->render('todos');
	}

	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['Localidad'])) {
			$this->Localidad->create($this->data['Localidad']);
			if($this->Localidad->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$lista_localidades = $this->Localidad->find('list');
		$this->set(compact('lista_localidades'));
	}

	function ver($localidad_id) {
		$localidad = $this->Localidad->find('first', array('conditions' => array('Localidad.id' => $localidad_id), 'recursive' => 2));
		if($localidad == null)
			$this->cakeError('error404');
		$this->set(compact('localidad', 'organizaciones'));
	}

	function todos(){
		$localidades = $this->Localidad->find('all');
		$this->set(compact('localidades'));
	}

	function get_localidades($comuna_id = 0){
		if($comuna_id != 0)
			$localidades = $this->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.nombre'),
																		'conditions' => array('Localidad.comuna_id' => $comuna_id) ) );
		else
			$localidades = $this->Localidad->find('list', array('fields' => array('Localidad.id' => 'Localidad.nombre') ) );

		$this->set(compact('localidades'));
	}

	function editar($id = null) {
		$localidad = $this->Localidad->find('first', array('conditions' => array('Localidad.id' => $id)));

		if($localidad == null) {
			$this->Session->setFlash('No existe la localidad');
			$this->redirect('/');
		}

		if(isset($this->data['Localidad'])) {
			if($this->Localidad->save($this->data['Localidad'])) {
				$this->redirect(array('controller' => 'localidades', 'action' => 'ver', $this->Localidad->id));
			} else {
				$this->Session->setFlash('Problemas con el formulario.');
			}
		}

		$this->data = $localidad;
	}
}
?>
