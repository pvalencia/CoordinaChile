<?php
class CatastrosController extends AppController {
	var $name = 'Catastros' ;

	var $uses = array('Catastro', 'Localidad', 'TipoRecurso');

	function nuevo() {
		$this->pageTitle = 'Agregar Catastro'; //
		if(isset($this->data['Catastro'])) {
			$this->Catastro->create($this->data['Catastro']);
			if($this->Catastro->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$localidades = $this->Catastro->Localidad->find('list', array('fields' => array('id', 'nombre')));
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('id', 'nombre')));
		$this->set(compact('localidades'));
		$this->set(compact('organizaciones'));
	}

	function ver($catastro_id){
		$catastro = $this->Catastro->find('first', array('conditions' => array('Catastro.id' => $catastro_id)));
		if($catastro == null)
			$this->cakeError('error404');

		$this->set(compact('catastro'));
	}

	function todos(){
		//$catastros = $this->Catastro->find('all', array('order' => 'Catastro.localidad_id'));
		$localidades = $this->Localidad->find('all');
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));

		$this->set(compact('localidades', 'organizaciones'));
	}
}
?>
