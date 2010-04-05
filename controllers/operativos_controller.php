<?php
class OperativosController extends AppController {
	var $name = 'Operativos';
	var $helpers = array('Regiones', 'Ajax', 'Paginator');

	var $uses = array('Operativo', 'TipoRecurso', 'Comuna', 'Necesidad');
	var $paginate = array(
        'limit' => 20,
        'order' => array(
            'Operativo.fecha_llegada' => 'desc'
        )
    );

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

	function getConditions($tipo = 'activos', $organizacion_id){
		$conditions = array();
		switch($tipo){
			case 'activos': $conditions = array("julianday(Operativo.fecha_llegada) + Operativo.duracion > strftime('%J','now')", 
														 array("Operativo.fecha_llegada <" => date('Y-m-d')) );
				break;
			case 'programados': $conditions = array('Operativo.fecha_llegada >' => date('Y-m-d'));
				break;
			case 'realizados' : $conditions = array("julianday(Operativo.fecha_llegada) + Operativo.duracion < strftime('%J','now')");
				break;
		}
		if ($organizacion_id != null)
			$conditions = $conditions + array('Operativo.organizacion_id' => $organizacion_id);
			
		return $conditions;
	}
	
	function getTipo(){
		if(isset($this->params['named']['tipo']))
			return $this->params['named']['tipo'];
		else
			return 'activos';
	}
	function getOrganizacionId(){
		if(isset($this->params['named']['oid']))
			return $this->params['named']['oid'];
		else
			return null;
	}
	
	function index($area = '') {
		$hastipo = isset($this->params['named']['tipo']);
		$tipo = $this->getTipo();
		$oid = $this->getOrganizacionId();

		if($hastipo){	//Si eligió un tipo de operativos
			$conditions = $this->getConditions($tipo, $oid);
		}else{	//Si es la primera vista del index, seleccionar el tipo donde haya operativos
			$tipos = array(0 => 'activos', 1 => 'programados', 2 => 'realizados');
			$ids_operativos = array();
			$i = 0;
			for($i = 0; $i < 3; ++$i){
				$tipo = $tipos[$i];
				$ids_operativos = $this->Operativo->find('list', array('conditions' => $this->getConditions($tipo, $oid), 'fields' => 'Operativo.id'));
				if(count($ids_operativos) != 0)
					break;
			}
			if($i == 3){	//si no había operativos
				$conditions = array('1 = 2');
				$tipo = 'activos';
			}else
				$conditions = array('Operativo.id' => $ids_operativos);
		}
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
				$operativos = $this->paginate('Operativo', array(array('Operativo.id' => $ids_todos), $conditions) );
				$comunas_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.comuna_id',
														   'conditions' => array('Operativo.id' => $ids_todos)));
			}else{
				$operativos = array();
				$comunas_con_operativos = null;
			}
		}else{
			$comunas_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.comuna_id', 'conditions' => $conditions ) );

			$operativos = $this->paginate('Operativo', $conditions);
		}
		
		if($comunas_con_operativos) {
			$comunas = $this->Operativo->Comuna->find('list', array('conditions' => array('Comuna.id' => $comunas_con_operativos),
																		   'fields' => array('Comuna.id', 'Comuna.nombre') ) );
		}else {
			$comunas = array();
		}

		$organizaciones = $this->Operativo->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('operativos', 'organizaciones', 'comunas', 'area', 'tipo', 'oid'));	
		
		if($this->RequestHandler->isAjax()) {
			Configure::write("debug", 0);
			$this->render('/elements/paginar_operativos');
		}
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
			$this->Operativo->set($this->data);
			if($this->Operativo->validates()){
				$errores = array();
				foreach($this->data['Suboperativo'] as $key => $suboperativo){
					$this->Operativo->Suboperativo->set($suboperativo);
					if($this->Operativo->Suboperativo->data['Suboperativo']['localidad_id'] == 0)
						$errores[] = $key;
				}
				if(count($errores) == 0){
					if($this->Operativo->save()) {
						$operativo_id = $this->Operativo->id;
						foreach($this->data['Suboperativo'] as $key => $suboperativo) {
							$suboperativo['operativo_id'] = $operativo_id;
							$this->Operativo->Suboperativo->create($suboperativo);
							$this->Operativo->Suboperativo->save();
							$suboperativo_id = $this->Operativo->Suboperativo->id;
							foreach($this->data['Recurso'][$key] as $tipo_recurso_id => $recurso) {
								if(!empty($recurso['cantidad']) && $recurso['cantidad'] > 0) {
									$recurso['suboperativo_id'] = $suboperativo_id;
									$recurso['tipo_recurso_id'] = $tipo_recurso_id;
									$this->Operativo->Suboperativo->Recurso->save($recurso) ;
									$this->Operativo->Suboperativo->Recurso->id = null;
								}
							}
							if(array_key_exists($key, $this->data['Necesidad'])){
								foreach($this->data['Necesidad'][$key] as $key => $necesidad) {
									if($necesidad['checked']){
										$necesidad['suboperativo_id'] = $suboperativo_id;
										$necesidad['status'] = 'ASIGNADO';
										$this->Necesidad->save($necesidad);
										$this->Necesidad->id = null;
									}
								}
							}
						}
						$this->setFlash('Guardado con éxito.');
						$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $operativo_id));
					}
				}
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
		if(isset($this->params['named']['subop']))
			$subop = $this->params['named']['subop'];
		else 
			$subop = null;
		$necesidades =  $this->Necesidad->find('all', array('conditions' => array('Catastro.localidad_id' => $localidad_id, 'OR' => array(array('Necesidad.suboperativo_id' => null), array('Necesidad.suboperativo_id' => $subop)))));
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
		foreach($areas as $area_id => $area_nombre) {
			$recursos[$area_id] = array();
		}
		foreach($operativo['Suboperativo'] as $key => $suboperativo){
			$recursos_temp = $this->TipoRecurso->Recurso->find('all', array('conditions' => array('Suboperativo.id' => $suboperativo['id'])));
			$recursos = array();
			foreach($recursos_temp as $recurso){
				unset($recurso['Suboperativo']);		//evita info re-redundante enviada a la vista

				$area_id = $recurso['TipoRecurso']['area_id'];
				$recursos[$area_id][] = $recurso;
			}
			ksort($recursos);

			$operativo['Suboperativo'][$key]['Recurso'] = $recursos;
		}
//		debug($operativo);
		
		$localidades_suboperativos = $this->Operativo->Suboperativo->find('list', array('fields' => 'Suboperativo.localidad_id', 'conditions' => array('Suboperativo.operativo_id' => $id)));
		$localidades = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.nombre'), 'conditions' => array('Localidad.id' => $localidades_suboperativos)));
		
/*		if($tiene_necesidades)
			$tipo_necesidades = $this->Necesidad->TipoNecesidad->find('list', array('fields' => array('id', 'nombre')));
		else */
			$tipo_necesidades = array();

		$this->set(compact('operativo', 'areas', 'comuna', 'localidades'));
		$this->set('tipo_necesidades', $tipo_necesidades);

	}
	
	function todos($area = ""){
		$this->redirect(array('action' => 'index', $area));
	}
	
	function organizacion($id = null){
		if($id == null) 
			$id = $this->Auth->user('id');
		
		$this->redirect(array('action' => 'index', 'oid' => $id));
	}
	function mios(){
		$this->organizacion(null);
	}
	
	function salud(){
		$this->index('Salud');
		if(!$this->RequestHandler->isAjax()) 
			$this->render('index');
	}
	function vivienda(){
		$this->index('Vivienda');
		if(!$this->RequestHandler->isAjax()) 
			$this->render('index');
	}
	function humanitaria(){
		$this->index('Humanitaria');
		if(!$this->RequestHandler->isAjax())
			$this->render('index');
	}
	function otros(){
		$this->index('Otros');
		if(!$this->RequestHandler->isAjax()) 
			$this->render('index');
	}
	
	function editar($id = NULL) {

		if(isset($this->data['Operativo'])) {
			$this->Operativo->set($this->data);
			if($this->Operativo->validates()){
				$errores = array();
				foreach($this->data['Suboperativo'] as $key => $suboperativo){
					if($this->Operativo->Suboperativo->data['Suboperativo']['localidad_id'] == 0)
						$errores[] = $key;
				}
				if(count($errores) == 0){
					if($this->Operativo->save()) {
						$operativo_id = $this->Operativo->id;
						
						foreach($this->data['Suboperativo'] as $key => $suboperativo) {
							$suboperativo['operativo_id'] = $operativo_id;
							$this->Operativo->Suboperativo->save($suboperativo);
							$suboperativo_id = $this->Operativo->Suboperativo->id;
							foreach($this->data['Recurso'][$key] as $tipo_recurso_id => $recurso) {
								if(!empty($recurso['cantidad']) && $recurso['cantidad'] > 0) {
									$recurso['suboperativo_id'] = $suboperativo_id;
									$recurso['tipo_recurso_id'] = $tipo_recurso_id;
									$this->Operativo->Suboperativo->Recurso->save($recurso) ;
									$this->Operativo->Suboperativo->Recurso->id = null;
								}elseif(isset($recurso['id'])){	//Si cantidad es cero, pero recurso existía antes, se debe borrar.
									$this->Operativo->Suboperativo->Recurso->delete($recurso['id']);
								}
							}
							if(array_key_exists($key, $this->data['Necesidad'])){
								foreach($this->data['Necesidad'][$key] as $key => $necesidad) {
									if($necesidad['checked']){
										$necesidad['suboperativo_id'] = $suboperativo_id;
										$necesidad['status'] = 'ASIGNADO';
										$this->Necesidad->save($necesidad);
										$this->Necesidad->id = null;
									}elseif(isset($necesidad['id'])){	//si necesidad estaba asignada, dejar pendiente
										$necesidad['status'] = 'PENDIENTE';
										$this->Necesidad->save($necesidad);
										$this->Necesidad->id = null;
									}
								}
							}
						}
						$this->Session->setFlash('Guardado con éxito.');
						$this->redirect(array('controller' => 'operativos', 'action' => 'ver', $this->Operativo->id));
					} else {
						$this->Session->setFlash('Problemas al guardar');
					}
				}
			}
		}


		$admin = $this->Auth->user('admin');

		$operativo = $this->Operativo->find('first', array('conditions' => array('Operativo.id' => $id)));
		
		if($operativo == null) {
			$this->redirect(array('controller' => 'operativos', 'action' => 'index'));
		}
		
		$recursos_db = $this->TipoRecurso->Recurso->find('all', array('conditions' => array('Suboperativo.operativo_id' => $id )));

		$todosrecursos = array();
		foreach($recursos_db as $recurso) {
			$suboperativo_id = $recurso['Suboperativo']['id'];
			if(!isset($todosrecursos[$suboperativo_id])){
				$todosrecursos[$suboperativo_id] = array();
			}
			$todosrecursos[$suboperativo_id][$recurso['TipoRecurso']['id']] = $recurso['Recurso'];
		}
		
		$region_id = (int)($operativo['Comuna']['id']/1000);
		$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('id BETWEEN ? AND ?' => array($region_id*1000, $region_id*1000 + 999) )));
		$localidades = $this->Comuna->Localidad->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Localidad.comuna_id' => $operativo['Comuna']['id'])));

		$tipos = $this->TipoRecurso->find('all', array('order' => array('area_id')));
		$areas = $this->TipoRecurso->Area->find('list', array('fields' => array('id', 'nombre')));
		
		$contactos_distintos = false;
		$i = 0;
		$necesidades = array();
		foreach($operativo['Suboperativo'] as $subop){
			if($subop['nombre'] or $subop['email'] or $subop['telefono']){
				$contactos_distintos = true;
			}
			$necesidades[$subop['id']] = $this->Necesidad->find('list', array('fields' => 'id', 'conditions' => array('Necesidad.suboperativo_id' => $subop['id'])));
		}
		
		$temp = $operativo['Suboperativo'][0];
		$operativo['Suboperativo'][0] = $operativo['Suboperativo'][1];
		$operativo['Suboperativo'][1] = $temp;
		$this->data['Operativo'] = $operativo['Operativo'];
		$this->set(compact('admin', 'areas', 'tipos', 'comunas', 'localidades'));
		$this->set(compact('operativo', 'todosrecursos', 'necesidades'));
		$this->set(compact('contactos_distintos'), false);
	}
	
}
?>
