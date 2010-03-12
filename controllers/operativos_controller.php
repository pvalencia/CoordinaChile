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
		$regiones = array(0 => 'Todas', 5 => 'Valparaíso', 13 => 'Metropolitana', 6 => 'O\'Higgins', 7 => 'Maule', 8 => 'Bio-Bio', 9 => 'Araucanía');
		$comunas[0] = 'Todas';
		$comunas = array_merge( array(0 => 'Todas'), $this->Comuna->find('list', array('fields' => array('id', 'nombre')) ) );
		$localidades = array_merge(array(0 => 'Todas'), $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id','Localidad.nombre') ) ) );
		$this->set(compact('regiones', 'comunas', 'localidades'));
	}
	
	function get_comunas($region_id = 0){
		if($region_id != 0)
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Comuna.id BETWEEN ? AND ?' => array($region_id*1000, ($region_id*1000 + 999)) ) ) );
		else
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre')) );
		$comunas =  array_merge(array(0 => 'Todas'), $comunas);
		$this->set(compact('comunas'));
	}
	
	function get_localidades($comuna_id = 0){
		if($comuna_id != 0)
			$localidades = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id' => 'Localidad.nombre'),
																		'conditions' => array('Localidad.comuna_id' => $comuna_id) ) );
		else
			$localidades = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id' => 'Localidad.nombre') ) );
		$localidades =  array_merge(array(0 => 'Todas'), $localidades);
		$this->set(compact('localidades'));
	}
	
	function resultados(){
		$data = $this->data['Operativo'];
		$region_id = $data['regiones'];
		$comuna_id = $data['comunas'];
		$localidad_id = $data['localidades'];
		if($data['filtrar'] != 0)
			$fecha = $data['fecha'];

		if($localidad_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.localidad_id' => $localidad_id)));
			$all_localidad = $this->Comuna->Localidad->find('first', array('conditions' => array('Localidad.id' => $localidad_id)));
			$nombre = $all_localidad['Localidad']['nombre']." (localidad)";
		}else if($comuna_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Localidad.comuna_id' => $comuna_id), 'order' => 'Operativo.localidad_id')) ;
			$all_comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $comuna_id)));
			$nombre = "Comuna de ".$all_comuna['Comuna']['nombre'];
		}else if($region_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Localidad.comuna_id BETWEEN ? AND ?' => array($region_id*1000, $region_id*1000 + 999 ) ),
																	 'order' => array('Operativo.localidad_id', 'Localidad.comuna_id')) );
			$all_regiones = array(5 => 'Región de Valparaíso', 13 => 'Región Metropolitana', 6 => 'Región de O\'Higgins', 7 => 'Región del Maule', 8 => 'Región del Bio-Bio', 9 => 'Región de la Araucanía');
			$nombre = $all_regiones[$region_id];
		}else{
			$operativos = $this->Operativo->find('all', array('order' => array('Operativo.localidad_id', 'Localidad.comuna_id')));
			$nombre = "Todos los Operativos";
		}
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('Area.id','Area.nombre')) );
		$recursos = $this ->TipoRecurso->find('list', array('fields' => array('TipoRecurso.id', 'TipoRecurso.codigo', 'TipoRecurso.area_id')));
		$this->set(compact('operativos', 'nombre', 'areas', 'recursos'));
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
