<?php
class OrganizacionesController extends AppController {
	var $name = 'Organizaciones' ;

	var $uses = array('Organizacion', 'Localidad', 'TipoRecurso');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('todos');
	}

	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['Organizacion'])) {
			$this->Organizacion->create($this->data['Organizacion']);
			if($this->Organizacion->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$tipo_organizaciones = $this->Organizacion->TipoOrganizacion->find('list', array('fields' => array('id', 'nombre')));
		$this->set(compact('tipo_organizaciones'));
	}

	function otro() {
		$this->pageTitle = ''; //
		if(isset($this->data['Organizacion'])) {
			$this->Organizacion->create($this->data['Organizacion']);
			if($this->Organizacion->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$tipo_organizaciones = $this->Organizacion->TipoOrganizacion->find('list');
		$this->set(compact('tipo_organizaciones'));
	}

	function perfil($id = null) {
		if($id == null) {
			if($this->Auth->user())
				$id = $this->Auth->user('id');
		}

		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $id)));

		if($organizacion == null) {
			$this->Session->setFlash('No existe la organización');
			$this->redirect('/');
		}


		$regiones = array(13 => 'Región Metropolitana', 5 => 'Valparaíso', 6 => "O'Higgins", 7 => 'Maule', 8 => 'Bio Bio', 9 => 'Araucanía');
		$this->set(compact('regiones'));

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		$this->set(compact('organizacion', 'tipos', 'areas'));
	}

	function ver($organizacion_id){
		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $organizacion_id)));
		if($organizacion == null)
		$this->cakeError('error404');

		$localidades = $this->Localidad->find('list', array('fields' => array('id', 'nombre')));

		$this->set(compact('organizacion', 'localidades'));
	}

	function todos(){
		$organizaciones = $this->Organizacion->find('all');
		$this->set(compact('organizaciones'));
	}

	function ingreso() {
	}

	function salir() {
		$this->redirect($this->Auth->logout());
	}
}
?>
