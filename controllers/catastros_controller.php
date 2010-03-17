<?php
class CatastrosController extends AppController {
	var $name = 'Catastros' ;

	var $uses = array('Catastro', 'Localidad', 'TipoRecurso');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('todos', 'ver');
	}

	function nuevo() {
		$this->pageTitle = 'Agregar Catastro'; //
		if(isset($this->data['Catastro'])) {
			$this->data['Catastro']['organizacion_id'] = $this->Auth->user('id');
			$this->Catastro->create($this->data['Catastro']);
			if($this->Catastro->save()) {
				// Mandar a página para ver catastro creado
				$this->redirect('/catastros/ver/'.$this->Catastro->id);
			} // si no, vuelve invalidado a la vista nuevo
		}
		if($this->Auth->user() == null)
			$this->redirect('/');
		$admin = $this->Auth->user('admin');

		$organizacion = $this->Catastro->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $this->Auth->user('id'))));
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$regiones = array(13 => 'Región Metropolitana', 5 => 'Valparaíso', 6 => "O'Higgins", 7 => 'Maule', 8 => 'Bio Bio', 9 => 'Araucanía');
		$this->set(compact('regiones'));
		$this->set(compact('organizacion', 'organizaciones', 'admin'));
	}

	function ver($catastro_id){
		$catastro = $this->Catastro->find('first', array('conditions' => array('Catastro.id' => $catastro_id)));
		if($catastro == null)
			$this->cakeError('error404');

		$this->set(compact('catastro'));
	}

	function todos(){
		//$catastros = $this->Catastro->find('all', array('order' => 'Catastro.localidad_id'));
		$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));

		if($localidades_con_catastros)
			$localidades = $this->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_catastros) ) );
		else
			$localidades = array();
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		
		$this->set(compact('localidades', 'organizaciones'));
	}
}
?>
