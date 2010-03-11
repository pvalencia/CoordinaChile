<?php
class OperativosController extends AppController {
	var $name = 'Operativos';

	var $uses = array('Operativo', 'TipoRecurso', 'Recurso', 'Comuna');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('todos', 'salud', 'vivienda', 'humanitaria');
	}

	function agregar($organizacion_id) {
		if(isset($this->data['Operativo'])) {
			$this->Operativo->create($this->data['Operativo']);
			if($this->Operativo->save()) {
				$id = $this->Operativo->id;
				foreach($this->data['Recurso'] as $recurso) {
					if(!empty($recurso['cantidad']) && $recurso['cantidad'] > 0) {
						$recurso['operativo_id'] = $id;
						$this->Operativo->Recurso->save($recurso) ;
						$this->Operativo->Recurso->id = null;
					}
				}
				$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $id));
			} else {
				$this->redirect(array('controller' => 'organizaciones', 'action' => 'perfil', $organizacion_id));
			}
		} else {
			$this->redirect('/');
		}
	}

	function ver($id = null) {
		$operativo = $this->Operativo->find('first', array('conditions' => array('Operativo.id' => $id)));
		if($operativo == null) {
			$this->redirect('/');
		}

		$tipo_recursos = $this->TipoRecurso->find('list', array('fields' => array('id', 'nombre')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		$recursos = array();
		foreach($areas as $k => $nombre) {
			$ids = $this->Recurso->TipoRecurso->find('list',
			array('conditions' => array('TipoRecurso.area_id' => $k), 'fields' => array('TipoRecurso.id', 'TipoRecurso.id'))
			);
			$ids[] = -1;
			$recursos[$k] = $this->Operativo->Recurso->find('all', array('conditions' => array('Recurso.tipo_recurso_id' => $ids, 'Recurso.operativo_id' => $id)));
		}

		$this->set(compact('operativo', 'recursos', 'areas'));
	}
	
	function busqueda(){
		$regiones = array(5 => 'Valparaíso', 13 => 'Metropolitana', 6 => 'O\'Higgins', 7 => 'Maule', 8 => 'Bio-Bio', 9 => 'Araucanía');
/*		$all_comunas = $this->Comuna->find('all');
		$comunas = array();


		$localidades = array();
		foreach($all_comunas as $comuna){
			$id = $comuna['Comuna']['id'];
			$comunas[$id] = $comuna['Comuna']['nombre'];
			
			$loc = array();
			foreach($comuna['Localidad'] as $localidad){
				$loc[$localidad['id']] = $localidad['nombre'];
			}
			
			$localidades[$id] = $loc;
		}
		debug($localidades);*/
		$this->set(compact('regiones'));
	}
	
	function get_comunas($region_id){
		$comunas = $this->Comuna->find('list', array('condition' => array('Comuna.id BETWEEN ? AND ?' => array($region_id*1000, ($region_id*1000 + 999)) ) ) );
		$this->set(compact('comunas'));
	}
	
	function get_localidades($comuna_id){
		$localidades = $this->Comuna->Localidad->find('list', array('condition' => array('Localidad.comuna_id' => $comuna_id) ) );
		$this->set(compact('localidades'));
	}
	
	function resultado(){
		
	}

	function todos($area = ""){
		$localidades = $this->Operativo->Localidad->find('all');
		if($area){
			$id_area = $this->TipoRecurso->Area->find('first', array('conditions' => array('nombre' => $area), 'fields' => 'id'));
			$tipos_recursos = $this->TipoRecurso->find('list', array('conditions' => array('TipoRecurso.area_id' => $id_area['Area']['id']), 'fields' => 'id'));

			$ids_operativos = $this->Recurso->find('list', array('conditions' => array('Recurso.tipo_recurso_id' => $tipos_recursos), 'fields' => array('Recurso.tipo_recurso_id', 'Recurso.Operativo_id')) );

			if($ids_operativos)
				$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.id' => $ids_operativos), 'order' => 'Operativo.localidad_id'));
			else
				$operativos = array();
		}else{
			$operativos = $this->Operativo->find('all');
		}
		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('localidades', 'organizaciones', 'operativos', 'area'));
	}
	
	function salud(){
		$this->todos('salud');
		$this->render('todos');
	}
	function vivienda(){
		$this->todos('vivienda');
		$this->render('todos');
	}
	function humanitaria(){
		$this->todos('humanitaria');
		$this->render('todos');
	}
	function otros(){
		$this->todos('otros');
		$this->render('todos');
	}
	
}
?>
