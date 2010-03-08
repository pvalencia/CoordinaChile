<?php
class TipoOrganizacionesController extends AppController {

	var $name = 'TipoOrganizaciones';

	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['TipoOrganizacion'])) {
			$this->TipoOrganizacion->create($this->data['TipoOrganizacion']);
			if($this->TipoOrganizacion->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		//$lista_TipoOrganizaciones = $this->TipoOrganizacion->find('list');
		//$this->set(compact('lista_TipoOrganizaciones'));
	}


	function perfil() {
		$id = 1; // XXX sólo para desarrollo, tomar id de usuario!

		$organizacion = $this->Organizacion->find('first', array('Organizacion.id' => $id));
		$this->set(compact('organizacion'));
	}

}
?>
