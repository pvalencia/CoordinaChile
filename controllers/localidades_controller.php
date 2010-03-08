<?php
class LocalidadesController extends AppController {
	var $name = 'Localidades' ;

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


	function perfil() {
		$id = 1; // XXX sólo para desarrollo, tomar id de usuario!

		$organizacion = $this->Organizacion->find('first', array('Organizacion.id' => $id));
		$this->set(compact('organizacion'));
	}

}
?>
