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
		$localidad = $this->Localidad->find('first', array('conditions' => array('Localidad.id' => $localidad_id), 'recursive' => 1));
		
		$ids_operativos = $this->Localidad->Suboperativo->find('list', array('fields' => 'Suboperativo.operativo_id', 'conditions' => array('Suboperativo.localidad_id' => $localidad_id)));
		$operativos_temp = $this->Localidad->Suboperativo->Operativo->find('all', array('conditions' => array('Operativo.id' => $ids_operativos)));
		$catastros_temp = $this->Localidad->Catastro->find('all', array('conditions' => array('Catastro.localidad_id' => $localidad_id)));
		
		$operativos = array();
		$catastros = array();
		foreach($operativos_temp as $operativo)
			$operativos[$operativo['Operativo']['id']] = $operativo;
		foreach($catastros_temp as $catastro)
			$catastros[$catastro['Catastro']['id']] = $catastro;
		
		if($localidad == null)
			$this->cakeError('error404');
		$this->set(compact('localidad', 'operativos', 'catastros'));
	}

	function todos(){
		$localidades = $this->Localidad->find('all');
		$this->set(compact('localidades'));
	}

	function get_localidades($comuna_id = 0){
		if($comuna_id != 0)
			$localidades = $this->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.nombre'),
																'conditions' => array('Localidad.comuna_id' => $comuna_id),
																'order' => 'Localidad.nombre' ) );
		else
			$localidades = $this->Localidad->find('list', array('fields' => array('Localidad.id' => 'Localidad.nombre'), 'order' => 'Localidad.nombre' ) );

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
				$this->redirect(array('controller' => 'localidades', 'action' => 'ver', $this->data['Localidad']['id']));
			} else {
				$this->Session->setFlash('Problemas con el formulario.');
			}
		}

		$this->data = $localidad;
	}
}
?>
