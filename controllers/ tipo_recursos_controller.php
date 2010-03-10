<?php
class TipoRecursosController extends AppController {

	var $name = 'TipoRecursos';


	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['TipoRecurso'])) {
			$this->TipoRecurso->create($this->data['TipoRecurso']);
			if($this->TipoRecurso->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		//$tipo_organizaciones = $this->Organizacion->TipoOrganizacion->find('list');
		//$this->set(compact('tipo_organizaciones'));
	}


	function perfil() {
		$id = 1; // XXX sólo para desarrollo, tomar id de usuario!

		$organizacion = $this->Organizacion->find('first', array('Organizacion.id' => $id));
		$this->set(compact('organizacion'));
	}

}
?>
