<?php
class AreasController extends AppController {
	var $name = 'Areas' ;

	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['Area'])) {
			$this->Area->create($this->data['Area']);
			if($this->Area->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$lista_Areas = $this->Area->find('list');
		$this->set(compact('lista_Areas'));
	}


	function perfil() {
		$id = 1; // XXX sólo para desarrollo, tomar id de usuario!

		$organizacion = $this->Organizacion->find('first', array('Organizacion.id' => $id));
		$this->set(compact('organizacion'));
	}

}
?>
