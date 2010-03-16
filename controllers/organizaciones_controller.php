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

	function ver($organizacion_id = null){
		if($organizacion_id == null) {
			if($this->Auth->user())
				$organizacion_id = $this->Auth->user('id');
		}
		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $organizacion_id), 'recursive' => 3));
		if($organizacion == null)
		$this->cakeError('error404');

		$localidades_con_catastros = $this->Localidad->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));
		$localidades_con_operativos = $this->Localidad->Operativo->find('list', array('fields' => 'Operativo.localidad_id' ) );
		$localidades_con_algo = array_merge($localidades_con_catastros, $localidades_con_operativos);
		
		$conditions = array();
		$localidades = array();
		if(count($localidades_con_catastros) != 0 && count($localidades_con_operativos) != 0){
			$conditions = array('or' => array( array('Localidad.id' => $localidades_con_catastros),
											   array('Localidad.id' => $localidades_con_operativos) ));
		}elseif(count($localidades_con_catastros) != 0){
			$conditions = array('Localidad.id' => $localidades_con_catastros);
		}elseif(count($localidades_con_operativos != 0)){
			$conditions = array('Localidad.id' => $localidades_con_operativos);
		}
		
		if(count($conditions) != 0){
			$localidades = $this->Localidad->find('list', array('fields' => array('id', 'nombre'), 
																'conditions' => $conditions )   );
		}
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
