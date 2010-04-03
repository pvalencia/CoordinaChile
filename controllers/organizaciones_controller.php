<?php
class OrganizacionesController extends AppController {
	var $name = 'Organizaciones' ;

	var $uses = array('Organizacion', 'Localidad', 'TipoRecurso', 'Suboperativo');

	function isAuthorized() {
		if($this->Auth->user('admin'))
			return true;
		switch($this->params['action']) {
			case 'nuevo':
				return false;
			case 'editar':
				if(isset($this->params['pass']) && isset($this->params['pass'][0]) && $this->params['pass'][0] != $this->Auth->user('id'))
					return false;
				return true;
			case 'index':
			case 'ver':
			case 'todos':
			case 'salir':
			default: 
				return true;
		}
		return true;
	}

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('nuevo', 'index', 'todos', 'ver');
	}

	function index($area = '') {
		$organizaciones = $this->Organizacion->find('all');
		$this->set(compact('organizaciones'));
	}

	function cambiar_password() {
		$id = $this->Auth->user('id');
		if(isset($this->data['Organizacion']['password'])) {
			$password = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $id), 'recursive' => -1, 'fields' => array('Organizacion.password')));
			$pass_act = $this->Auth->password($this->data['Organizacion']['password_actual']);
			if($pass_act == $password['Organizacion']['password'] && $this->data['Organizacion']['password'] == $this->data['Organizacion']['confirmar_password']) {
				$this->Organizacion->id = $id;
				$this->Organizacion->saveField('password', $this->Auth->password($this->data['Organizacion']['password']));
				$this->redirect(array('controller' => 'organizaciones', 'action' => 'editar', $id));
			}
			else{
				$this->Session->setFlash('Tu contrase&ntilde;a es incorrecta o no est&aacute; bien verficada.');
			}
		}
	}

	function nuevo() {
		$this->pageTitle = ''; //
		if(isset($this->data['Organizacion'])) {
			$this->Organizacion->create($this->data['Organizacion']);
			if($this->Organizacion->save()) {
				// Mandar a página para agregar recursos
				$this->redirect('/');
			} // si no, vuelve invalidado a la vista nuevo
		}
		$tipo_organizaciones = $this->Organizacion->TipoOrganizacion->find('list', array('fields' => array('id', 'nombre')));
		$this->set(compact('tipo_organizaciones'), false);
	}

	function editar($id = null) {
		if($id == null)
			$id = $this->Auth->user('id');

		if(isset($this->data['Organizacion'])) {
			if($this->Organizacion->save($this->data['Organizacion'])) {
				$this->redirect(array('controller' => 'organizaciones', 'action' => 'ver', $this->Organizacion->id));
			}
			$this->Session->setFlash('Problemas con el formulario.');
		}

		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $id)));
		$tipo_organizaciones = $this->Organizacion->TipoOrganizacion->find('list', array('fields' => array('id', 'nombre')) );
		$this->data = $organizacion;
		unset($this->data['Organizacion']['password']);
		$this->set(compact('tipo_organizaciones', 'organizacion'));
	}

	function ver($organizacion_id = null){
		if($organizacion_id == null) {
			if($this->Auth->user())
				$organizacion_id = $this->Auth->user('id');
		}
		$organizacion = $this->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $organizacion_id), 'recursive' => 1));
		if($organizacion == null)
			$this->cakeError('error404');

		$localidades_con_catastros = $this->Localidad->Catastro->find('list', array('fields' => 'Catastro.localidad_id', 'conditions' => array('Catastro.organizacion_id' => $organizacion_id)));

		$operativos_organizacion = $this->Organizacion->Operativo->find('list', array('fields' => 'Operativo.id', 'conditions' => array('Operativo.organizacion_id' => $organizacion_id)));
		
		if(count($operativos_organizacion) != 0)
			$localidades_con_operativos = $this->Suboperativo->find('list', array('fields' => array('Suboperativo.localidad_id'), 
																				  'conditions' => array('Suboperativo.operativo_id' => $operativos_organizacion)));
		else 
			$localidades_con_operativos = array();
		
		$conditions = array();
		$localidades = array();
		$operativos = array();
		if(count($localidades_con_catastros) != 0 && count($localidades_con_operativos) != 0){
			$conditions = array('or' => array( array('Localidad.id' => $localidades_con_catastros),
											   array('Localidad.id' => $localidades_con_operativos) ));
		}elseif(count($localidades_con_catastros) != 0){
			$conditions = array('Localidad.id' => $localidades_con_catastros);
		}elseif(count($localidades_con_operativos) != 0){
			$conditions = array('Localidad.id' => $localidades_con_operativos);
		}
		
		if(count($conditions) != 0){
				$this->Localidad->bindModel(array('hasMany' => array(
					'Catastro' => array(
						'className' => 'Catastro',
						'foreignKey' => 'localidad_id',
						'dependent' => false,
						'conditions' => array('Catastro.organizacion_id' => $organizacion_id),
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
						),
					'Suboperativo' => array(
						'className' => 'Suboperativo',
						'foreignKey' => 'localidad_id',
						'dependent' => false,
						'conditions' => array('Suboperativo.operativo_id' => $operativos_organizacion),
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
						)
					)));
			$localidades_db = $this->Localidad->find('all', array('conditions' => $conditions ) );
			foreach($localidades_db as $localidad_db){
				$localidad = array();
				$localidad['id'] = $localidad_db['Localidad']['id'];
				$localidad['nombre'] = $localidad_db['Localidad']['nombre'];
				$localidad['lat'] = $localidad_db['Localidad']['lat'];
				$localidad['lon'] = $localidad_db['Localidad']['lon'];
				$catastros = array();
				foreach($localidad_db['Catastro'] as $catastro){
					$catastros[] = $catastro['id'];
				}
				$localidad['catastros'] = $catastros;
				
				$operativos = array();
				foreach($localidad_db['Suboperativo'] as $suboperativo){
					$operativos[] = $suboperativo['operativo_id'];
				}
				$localidad['operativos'] = $operativos;
				
				$localidades[$localidad['id']] = $localidad;
			}
			
			$suboperativos = $this->Suboperativo->find('list', array('conditions' => array('Suboperativo.operativo_id' => $operativos_organizacion), 
																	 'fields' => array('Suboperativo.id', 'Suboperativo.localidad_id', 'Suboperativo.operativo_id')) );
		}
		$this->set(compact('organizacion', 'localidades', 'suboperativos'));
	}

	function todos(){
		$this->redirect(array('controller' => 'organizaciones', 'action' => 'index'));
	}

	function ingreso() {
	}

	function salir() {
		$this->redirect($this->Auth->logout());
	}
}
?>
