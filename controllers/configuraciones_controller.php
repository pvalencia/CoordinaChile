<?php
class ConfiguracionesController extends AppController {
	var $name = 'Configuraciones';
	var $uses = array('TipoNecesidad', 'TipoRecurso');
	
	function isAuthorized() {
		if($this->Auth->user('admin'))
			return true;
		return false;
	}

	function index() {
	}

	function necesidades() {
		$necesidades = $this->TipoNecesidad->find('all');
		$this->set(compact('necesidades'));
	}

	function recursos() {
		$recursos = $this->TipoRecurso->find('all');
		$this->set(compact('recursos'));
	}

	function editar_necesidad($id = null) {
		$necesidad = $this->TipoNecesidad->find('first', array('conditions' => array('TipoNecesidad.id' => $id)));
		if($necesidad == null)
			$this->redirect(array('controller' => 'configuraciones', 'action' => 'recursos'));
		if(isset($this->data['TipoNecesidad'])) {
			if($this->TipoNecesidad->save($this->data['TipoNecesidad']))
				$this->redirect(array('controller' => 'configuraciones', 'action' => 'necesidades'));
			else 
				$this->Session->setFlash('Problemas en el formulario');
		}

		$areas = $this->TipoNecesidad->Area->find('list', array('fields' => array('id', 'nombre'), 'recursive' => -1));
		$this->data = $necesidad;
		$this->set(compact('areas'));
	}

	function editar_recurso($id = null) {
		$recurso = $this->TipoRecurso->find('first', array('conditions' => array('TipoRecurso.id' => $id)));
		if($recurso == null)
			$this->redirect(array('controller' => 'configuraciones', 'action' => 'recursos'));
		if(isset($this->data['TipoRecurso'])) {
			if($this->TipoRecurso->save($this->data['TipoRecurso']))
				$this->redirect(array('controller' => 'configuraciones', 'action' => 'recursos'));
			else 
				$this->Session->setFlash('Problemas en el formulario');
		}

		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre'), 'recursive' => -1));
		$this->data = $recurso;
		$this->set(compact('areas'));
	}

}
?>
