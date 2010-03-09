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

	function ver($localidad_id) {
		$localidad = $this->Localidad->find('first', array('conditions' => array('Localidad.id' => $localidad_id)));
		if($localidad == null)
			$this->cakeError('error404');
		debug($localidad);
		$this->set(compact('localidad'));
	}
	
	function todos(){
		$localidades = $this->Localidad->find('all');
		$this->set(compact('localidades'));
	}

}
?>
