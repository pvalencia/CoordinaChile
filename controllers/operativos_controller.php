<?php
class OperativosController extends AppController {
	var $name = 'Operativos';
	var $helpers = array('Regiones');

	var $uses = array('Operativo', 'TipoRecurso', 'Recurso', 'Comuna', 'Necesidad');

	function isAuthorized() {	
		if($this->Auth->user('admin'))
			return true;
		switch($this->params['action']) {
			case 'editar': 
			case 'nuevo':
				if(!isset($this->params['params'][0]) || $this->params['params'][0] == $this->Auth->user('id'))
					return true;
				return false;
			default:
				return true;
		}
	}

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index', 'todos', 'salud', 'vivienda', 'humanitaria', 'otros', 'ver');
	}

	function index($area = '') {
		if($area){
			$id_area = $this->TipoRecurso->Area->find('first', array(
														'conditions' => array('nombre' => $area), 
														'fields' => 'id', 
														'recursive' => -1));
			if(!$id_area){
				$this->cakeError('error404');
			}
			$tipos_recursos = $this->TipoRecurso->find('list', array(
														'conditions' => array('TipoRecurso.area_id' => $id_area['Area']['id']), 
														'fields' => 'id'));

			$ids_operativos = $this->Operativo->Recurso->find('list', array(
														'conditions' => array('Recurso.tipo_recurso_id' => $tipos_recursos), 
														'fields' => array('Recurso.tipo_recurso_id', 'Recurso.Operativo_id')) );

			if($ids_operativos){
				$operativos = $this->Operativo->find('all', array(
															'conditions' => array('Operativo.id' => $ids_operativos), 
															'recursive' => -1, 
															'order' => array('fecha_llegada' => 'DESC')) );
				$localidades_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.localidad_id',
														   'conditions' => array('Operativo.id' => $ids_operativos)));
			}else{
				$operativos = array();
				$localidades_con_operativos = null;
			}
		}else{
			$localidades_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.localidad_id' ) );
			$operativos = $this->Operativo->find('all', array('order' => array('fecha_llegada' => 'DESC')));
		}
		
		if($localidades_con_operativos) {
			$localidades = $this->Operativo->Localidad->find('list', array('conditions' => array('Localidad.id' => $localidades_con_operativos),
																		   'fields' => array('Localidad.id', 'Localidad.nombre') ) );
		}else {
			$localidades = array();
		}

		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('operativos', 'organizaciones', 'localidades', 'area'));	
	}

	/*
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
				$this->redirect(array('controller' => 'operativos', 'action' => 'nuevo'));
			}
		} else {
			$this->redirect('/');
		}
	}*/
	
	function nuevo($id = null) {
		if($id == null) {
			if($this->Auth->user())
				$id = $this->Auth->user('id');
		}else{
			if(!$this->Auth->user() && $id != $this->Auth->user('id')){
				$this->Session->setFlash('No puede ver esta p&aacute;gina');
				$this->redirect('/');
			}
		}
		if(isset($this->data['Operativo'])) {
			$errores = array();
			for($i=0;isset($this->data['Operativo'][$i]);++$i){
				$operativo = $this->data['Operativo'][$i];
				$operativo['organizacion_id'] = $id;
				$this->Operativo->create($operativo);
				if($this->Operativo->save()) {
					$operativo_id = $this->Operativo->id;
					foreach($this->data['Recurso'][$i] as $tipo_recurso_id => $recurso) {
						if(!empty($recurso['cantidad']) && $recurso['cantidad'] > 0) {
							$recurso['operativo_id'] = $operativo_id;
							$recurso['tipo_recurso_id'] = $tipo_recurso_id;
							$this->Operativo->Recurso->save($recurso) ;
							$this->Operativo->Recurso->id = null;
						}
					}
					/*
					foreach($this->data['Necesidad'][$i] as $necesidad) {
						$id = $necesidad['id'];
						if( $this->data['Operativo'][$i]['necesidades'][$id]['checked'] == 1 ) {
							$necesidad['operativo_id'] = $id;
							$this->Necesidad->save($necesidad);
							$this->Necesidad->id = null;
						}
					}*/
				}
				$errores[] = $i;
			} //Mandar a página para ver uno de los operativos creados
			if($i == 1)
				$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $operativo_id));
			else
				$this->redirect(array('controller' => 'organizaciones', 'action' => 'ver', $id));
		}// si no, vuelve invalidado a la vista nuevo

		$admin = $this->Auth->user('admin');

		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' =>  array('id', 'nombre')));
		$organizacion = $this->Operativo->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $id)));

		if($organizacion == null) {
			$this->Session->setFlash('No existe la organizaci&oacute;n');
			$this->redirect('/');
		}

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		
		$this->set(compact('organizacion', 'tipos', 'areas', 'admin', 'organizaciones'));
	}

	function ver($id = null) {
		$operativo = $this->Operativo->find('first', array('conditions' => array('Operativo.id' => $id)));
		$comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $operativo['Localidad']['comuna_id']), 'recursive' => -1));
		if($operativo == null) {
			$this->redirect('/operativos/');
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

		$this->set(compact('operativo', 'recursos', 'areas', 'comuna'));

	}
	
	function busqueda(){
		$comunas[0] = 'Todas';
		$comunas =  array(0 => 'Todas') + $this->Comuna->find('list', array('fields' => array('id', 'nombre')) ) ;
		$localidades = array(0 => 'Todas') + $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id','Localidad.nombre') ) )  ;
//		debug($localidades);
		$this->set(compact('comunas', 'localidades'));
	}
	
	function resultados(){
		$data = $this->data['Operativo'];
		$region_id = $data['regiones'];
		$comuna_id = $data['comunas'];
		$localidad_id = $data['localidades'];
		if($data['filtrar'] != 0)
			$fecha = $data['fecha'];
		$localidad = false;
		$region = false;
		if($localidad_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.localidad_id' => $localidad_id)));
			$all_localidad = $this->Comuna->Localidad->find('first', array('conditions' => array('Localidad.id' => $localidad_id)));
			$nombre = $all_localidad['Localidad']['nombre']." (localidad)";
			$localidad = true;
		}else if($comuna_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Localidad.comuna_id' => $comuna_id), 'order' => 'Operativo.localidad_id')) ;
			$all_comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $comuna_id)));
			$nombre = "Comuna de ".$all_comuna['Comuna']['nombre'];
		}else if($region_id != 0){
			$operativos = $this->Operativo->find('all', array('conditions' => array('Localidad.comuna_id BETWEEN ? AND ?' => array($region_id*1000, $region_id*1000 + 999 ) ),
																	 'order' => array('Operativo.localidad_id', 'Localidad.comuna_id')) );
			$region = $region_id;
			$nombre = "";
		}else{
			$operativos = $this->Operativo->find('all', array('order' => array('Operativo.localidad_id', 'Localidad.comuna_id')));
			$nombre = "Todos los Operativos";
		}
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('Area.id','Area.nombre')) );
		$recursos = $this ->TipoRecurso->find('list', array('fields' => array('TipoRecurso.id', 'TipoRecurso.codigo', 'TipoRecurso.area_id')));
		$this->set(compact('operativos', 'nombre', 'areas', 'recursos', 'localidad', 'region'));
		$this->render('index');
	}

	function todos($area = ""){
		$this->index($area);
	}
	
	function mios(){
		$id = $this->Auth->user('id');
		$ids_operativos = $this->Operativo->find('list', array('conditions' => array('Operativo.organizacion_id' => $id),
															   'fields' => array('Operativo.id')));
		if($ids_operativos){
			$localidades_con_operativos = $this->Operativo->find('list', array('fields' => array('Operativo.localidad_id'),
																			   'conditions' => array('Operativo.id' => $ids_operativos) ) );
   			$localidades = $this->Operativo->Localidad->find('list', array('conditions' => array('Localidad.id' => $localidades_con_operativos),
																		   'fields' => array('Localidad.id', 'Localidad.nombre') ) );
			$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.id' => $ids_operativos), 'recursive' => -1 ));
			
		}else{
			$localidades = array();
			$operativos = array();
		}
		$organizaciones = $this->Operativo->Organizacion->find('list',  array('fields' => array('Organizacion.id', 'Organizacion.nombre'),
																			  'conditions' => array('Organizacion.id' => $id) ));
		$area = $organizaciones[$id];
		$this->set(compact('operativos', 'organizaciones', 'localidades', 'area'));
		$this->render('index');
	}
	
	function salud(){
		$this->index('Salud');
		$this->render('index');
	}
	function vivienda(){
		$this->index('Vivienda');
		$this->render('index');
	}
	function humanitaria(){
		$this->index('Humanitaria');
		$this->render('index');
	}
	function otros(){
		$this->index('Otros');
		$this->render('index');
	}
	
	function editar($id = NULL) {

		if(isset($this->data['Operativo'])) {
			if($this->Operativo->save($this->data['Operativo'])) {
				foreach($this->data['Recurso'] as $recurso) {
					if(isset($recurso['cantidad']) && $recurso['cantidad'] > 0) {
						$recurso['operativo_id'] = $this->Operativo->id;
						$this->Operativo->Recurso->save($recurso);
					} elseif(isset($recurso['id'])) {
						$this->Operativo->Recurso->id = $recurso['id'];
						$this->Operativo->Recurso->del();
					}

					$this->Operativo->Recurso->id = NULL;
				}
				$this->Session->setFlash('Guardado con éxito.');
				$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $this->Operativo->id));
			} else {
				$this->Session->setFlash('Problemas al guardar');
			}

		}


		$admin = $this->Auth->user('admin');

		$operativo = $this->Operativo->find('first', array('conditions' => array('Operativo.id' => $id)));
		
		if($operativo == null) {
			$this->redirect(array('controller' => 'operativos', 'action' => 'index'));
		}

		$recursos = array();
		foreach($operativo['Recurso'] as $recurso) {
			$recursos[$recurso['tipo_recurso_id']] = $recurso;
		}

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		$this->data['Operativo'] = $operativo['Operativo'];
		$this->set(compact('admin', 'areas', 'tipos'));
		$this->set(compact('operativo', 'recursos'));
	}
	
}
?>
