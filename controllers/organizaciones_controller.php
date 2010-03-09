<?php
class OrganizacionesController extends AppController {
	var $name = 'Organizaciones' ;

	var $uses = array('Organizacion', 'Localidad', 'TipoRecurso');

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
	function perfil() {
		$id = 1; // XXX sólo para desarrollo, tomar id de usuario!

		$organizacion = $this->Organizacion->find('first', array('Organizacion.id' => $id));
		$localidades = $this->Localidad->find('list', array('fields' =>  array('id', 'nombre')));

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		$this->set(compact('organizacion', 'localidades', 'tipos', 'areas'));
	}
	
	function ver($organizacion_id){
		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $organizacion_id)));
		if($organizacion == null)
			$this->cakeError('error404');
		//debug($organizacion);
		
		$this->set(compact('organizacion'));
	}
	
	function todos(){
		$organizaciones = $this->Organizacion->find('all');
		//debug($organizaciones);
		$this->set(compact('organizaciones'));
	}
}
?>
