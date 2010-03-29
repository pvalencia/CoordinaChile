<?php
class OperativosController extends AppController {
	var $name = 'Operativos';
	var $helpers = array('Regiones');

	var $uses = array('Operativo', 'TipoRecurso', 'Comuna', 'Necesidad');

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

			$ids_suboperativos = $this->TipoRecurso->Recurso->find('list', array('conditions' => array('Recurso.tipo_recurso_id' => $tipos_recursos), 
																				 'fields' => array('Recurso.suboperativo_id')) );
			$ids_todos = $this->Operativo->Suboperativo->find('list', array('conditions' => array('Suboperativo.id' => $ids_suboperativos), 
																 'fields' => array('Suboperativo.operativo_id')));
			if($ids_todos){
				$parameters = array('conditions' => array('Operativo.id' => $ids_todos),
									'order' => array('fecha_llegada' => 'DESC'));
				$operativos_ids = $this->separarOperativos($parameters);
				$comunas_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.comuna_id',
														   'conditions' => array('Operativo.id' => $ids_todos)));
			}else{
				$operativos = array();
				$comunas_con_operativos = null;
			}
		}else{
			$comunas_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.comuna_id' ) );
			$operativos_ids = $this->separarOperativos(); 
		}
		
		if($comunas_con_operativos) {
			$comunas = $this->Operativo->Comuna->find('list', array('conditions' => array('Comuna.id' => $comunas_con_operativos),
																		   'fields' => array('Comuna.id', 'Comuna.nombre') ) );
		}else {
			$comunas = array();
		}
		$operativos = array();
		foreach($operativos_ids as $key => $operativos_modo){
			if($operativos_modo)
				$operativos[$key] = $this->Operativo->find('all', array('conditions' => array('Operativo.id' => $operativos_modo)));
			else
				$operativos[$key] = array();
		}

		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('operativos', 'organizaciones', 'comunas', 'area'));	
	}
	
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
					
					foreach($this->data['Necesidad'][$i] as $key => $necesidad) {
							if($necesidad['checked']){
								$necesidad['operativo_id'] = $operativo_id;
								$necesidad['status'] = 'ASIGNADO';
								$this->Necesidad->save($necesidad);
								$this->Necesidad->id = null;
							}
					}
				}else{
					$errores[] = $i;
				}
			} //Mandar a página para ver uno de los operativos creados
			if(count($errores) == 0){
				if($i == 1)
					$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $operativo_id));
				else
					$this->redirect(array('controller' => 'organizaciones', 'action' => 'ver', $id, 'noinfo' => 1));
			}else{
				//TODO: volver sólo con las localidades donde hay problemas--
			}
		}// si no, vuelve invalidado a la vista nuevo

		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' =>  array('id', 'nombre')));
		$organizacion = $this->Operativo->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $id)));

		if($organizacion == null) {
			$this->Session->setFlash('No existe la organizaci&oacute;n');
			$this->redirect('/');
		}

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		
		$catastro = null;
		if(isset($this->params['named']['catastro'])){
			$catastro_id = $this->params['named']['catastro'];
			$catastro_db = $this->Necesidad->Catastro->find('first', array('conditions' => array('Catastro.id' => $catastro_id)));
			$info_comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $catastro_db['Localidad']['comuna_id']), 'recursive' => -1));
			$localidades = $this->Comuna->Localidad->find('list', array('conditions' => array('Localidad.comuna_id' => $catastro_db['Localidad']['comuna_id']), 'fields' => array('Localidad.id', 'Localidad.nombre')));
			$info_comuna['Comuna']['localidades'] = array(0 => 'Selecciona una localidad') + $localidades;
			$catastro = array();
			$catastro['Localidad'] = $catastro_db['Localidad'];
			$catastro['Necesidad'] = $catastro_db['Necesidad'];
			$catastro['Comuna'] = $info_comuna['Comuna'];
			
		}
		$this->set(compact('organizacion', 'tipos', 'areas', 'organizaciones', 'catastro'));
	}
	
	function get_necesidades($localidad_id, $indice){
		$necesidades =  $this->Necesidad->find('all', array('conditions' => array('Catastro.localidad_id' => $localidad_id, 'Necesidad.operativo_id' => null)));
		$this->set(compact('necesidades', 'indice'));
	}
	

	function ver($id = null) {
		$operativo = $this->Operativo->find('first', array('conditions' => array('Operativo.id' => $id)));
		if($operativo == null) {
			$this->redirect('/operativos/');
		}
		$comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $operativo['Comuna']['id']), 'recursive' => -1));
		$tipo_recursos = $this->TipoRecurso->find('list', array('fields' => array('id', 'nombre')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		$recursos = array();
		foreach($areas as $k => $nombre) {
			$recursos[$k] = $this->TipoRecurso->Recurso->find('all', array('conditions' => array('TipoRecurso.area_id' => $k, 'Suboperativo.operativo_id' => $id)));
		}
		
		$localidades_suboperativos = $this->Operativo->Suboperativo->find('list', array('fields' => 'Suboperativo.localidad_id', 'conditions' => array('Suboperativo.operativo_id' => $id)));
		$localidades = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.nombre'), 'conditions' => array('Localidad.id' => $localidades_suboperativos)));
		
		if($operativo['Necesidad'])
			$tipo_necesidades = $this->Necesidad->TipoNecesidad->find('list', array('fields' => array('id', 'nombre')));
		else
			$tipo_necesidades = array();

		$this->set(compact('operativo', 'recursos', 'areas', 'comuna', 'localidades'));
		$this->set('tipo_necesidades', $tipo_necesidades);

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
	
	function organizacion($id = null){
		if($id == null) 
			$id = $this->Auth->user('id');

		$operativos_ids = $this->separarOperativos(array('conditions' => array('Operativo.organizacion_id' => $id)));
		if($operativos_ids){
			$comunas_con_operativos = $this->Operativo->find('list', array('fields' => array('Operativo.comuna_id'),
																			'conditions' => array('Operativo.organizacion_id' => $id) ) );
   			$comunas = $this->Operativo->Comuna->find('list', array('conditions' => array('Comuna.id' => $comunas_con_operativos),
																		   'fields' => array('Comuna.id', 'Comuna.nombre') ) );

			$operativos = array();
			foreach($operativos_ids as $key => $operativos_modo){
				if($operativos_modo)
					$operativos[$key] = $this->Operativo->find('all', array('conditions' => array('Operativo.id' => $operativos_modo)));
				else
					$operativos[$key] = array();
			}
		}else{
			$comunas = array();
			$operativos = array('activos' => array(), 'programados' => array(), 'realizados' => array(), );
		}
		$organizaciones = $this->Operativo->Organizacion->find('list',  array('fields' => array('Organizacion.id', 'Organizacion.nombre'),
																			  'conditions' => array('Organizacion.id' => $id) ));
		
		$area = $organizaciones[$id];
		$this->set(compact('operativos', 'organizaciones', 'area', 'comunas'));
		$this->render('index');
	}
	function mios(){
		$this->organizacion();
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
