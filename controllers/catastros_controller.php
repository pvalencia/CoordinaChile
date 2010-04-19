<?php
class CatastrosController extends AppController {
	var $name = 'Catastros' ;

	var $helpers = array('Regiones');
	var $uses = array('Catastro', 'Localidad', 'TipoNecesidad');
	var $paginate = array(
        'limit' => 20,
        'order' => array(
            'Catastro.fecha' => 'desc'
        )
    );

	function isAuthorize() {
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

		$this->Auth->allow('todos', 'salud', 'vivienda', 'humanitaria', 'otros', 'ver');
	}

	function index($area = '') {
		if($area){
			$id_area = $this->TipoNecesidad->Area->find('first', array('conditions' => array('nombre' => $area), 'fields' => 'id', 'recursive' => -1));
			if(!$id_area){
				$this->cakeError('error404');
			}
			$tipos_necesidades = $this->TipoNecesidad->find('list', array('conditions' => array('TipoNecesidad.area_id' => $id_area['Area']['id']), 'fields' => 'id'));
			$ids_catastros = $this->Catastro->Necesidad->find('list', array('conditions' => array('Necesidad.tipo_necesidad_id' => $tipos_necesidades), 'fields' => 'catastro_id'));
		
			if($ids_catastros){
				$catastros = $this->paginate('Catastro', array('Catastro.id' => $ids_catastros));
				$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id',
																   'conditions' => array('Catastro.id' => $ids_catastros), 
																   'order' => 'Catastro.localidad_id'));
			}else{
				$catastros = array();
				$localidades_con_catastros = array();
			}
		}else{
			$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id' ) );
			$catastros = $this->paginate('Catastro');
		}
		if($localidades_con_catastros)
			$localidades = $this->Catastro->Localidad->find('list', array('conditions' => array('Localidad.id' => $localidades_con_catastros),
																		   'fields' => array('Localidad.id', 'Localidad.nombre') ) );
		else
			$localidades = array();
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('catastros', 'organizaciones', 'localidades', 'area'));

		if($this->RequestHandler->isAjax()) {
			Configure::write("debug", 0);
			$this->render('/elements/paginar_catastros');
		}
	}

	function nuevo() {
		$this->pageTitle = 'Agregar Catastro'; //
		if(isset($this->data['Catastro'])) {
			if(!isset($this->data['Catastro']['organizacion_id']) || !$this->Auth->user('admin'))
				$this->data['Catastro']['organizacion_id'] = $this->Auth->user('id');

			if($this->data['Catastro']['submittedfile']['name']){
				$nombre_archivo = $this->data['Catastro']['submittedfile']['name']."-".time();
				if (move_uploaded_file($this->data['Catastro']['submittedfile']['tmp_name'], ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS."files".DS.$nombre_archivo)){ 
					$this->data['Catastro']['file'] = $nombre_archivo;
				}
			}
			$this->Catastro->create($this->data['Catastro']);
			if($this->Catastro->save()) {
				$id = $this->Catastro->id;
				foreach($this->data['Necesidad'] as $necesidad) {
					if(!empty($necesidad['cantidad']) && $necesidad['cantidad'] > 0) {
						$necesidad['catastro_id'] = $id;
						$this->Catastro->Necesidad->save($necesidad) ;
						$this->Catastro->Necesidad->id = null;
					}
				}
				// Mandar a página para ver catastro creado
				$this->redirect('/catastros/ver/'.$this->Catastro->id);
			} // si no, vuelve invalidado a la vista nuevo
		}
		if($this->Auth->user() == null)
			$this->redirect('/');
		$admin = $this->Auth->user('admin');

		$organizacion = $this->Catastro->Organizacion->find('first', array('conditions' => array('Organizacion.id' => $this->Auth->user('id'))));
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));

		$tipos = $this->TipoNecesidad->find('all', array('order' => array('area_id')));
		
		$areas_con_necesidades = $this->TipoNecesidad->find('list', array('fields' => 'area_id'));
		$areas = $this->TipoNecesidad->Area->find('list', array('fields' => array('Area.id', 'Area.nombre'), 'conditions' => array('Area.id' => $areas_con_necesidades), 'order' => 'Area.id'));
		
		$this->set(compact('organizacion', 'organizaciones', 'admin', 'tipos', 'areas'));
	}

	function ver($id){
		$catastro = $this->Catastro->find('first', array('conditions' => array('Catastro.id' => $id)));
		$comuna = $this->Localidad->Comuna->find('first', array('conditions' => array('Comuna.id' => $catastro['Localidad']['comuna_id']), 'recursive' => -1));
		if($catastro == null)
			$this->cakeError('error404');

		$tipo_necesidades = $this->TipoNecesidad->find('list', array('fields' => array('id', 'nombre')));
		$areas = $this->TipoNecesidad->Area->find('list', array('fields' => array('id', 'nombre')));
		$necesidades = array();
		foreach($areas as $k => $nombre) {
			$ids = $this->TipoNecesidad->find('list', array('conditions' => array('TipoNecesidad.area_id' => $k), 
																'fields' => array('TipoNecesidad.id', 'TipoNecesidad.id')) );
			$ids[] = -1;
			$necesidades[$k] = $this->Catastro->Necesidad->find('all', array('conditions' => array('Necesidad.tipo_necesidad_id' => $ids, 'Necesidad.catastro_id' => $id)));
		}
		$this->set(compact('catastro', 'necesidades', 'areas', 'comuna'));
	}

	function todos($area = ""){
		$this->index($area);
		$this->render('index');
	}
	
	function mios(){
		$id = $this->Auth->user('id');
		$ids_catastros = $this->Catastro->find('list', array('conditions' => array('Catastro.organizacion_id' => $id),
															 'fields' => array('Catastro.id')));
		if($ids_catastros){
			$localidades_con_catastros = $this->Catastro->find('list', array('fields' => array('Catastro.localidad_id'),
																			 'conditions' => array('Catastro.id' => $ids_catastros) ) );
   			$localidades = $this->Catastro->Localidad->find('list', array('conditions' => array('Localidad.id' => $localidades_con_catastros),
																		   'fields' => array('Localidad.id', 'Localidad.nombre') ) );
			$catastros = $this->paginate('Catastro',array('Catastro.id' => $ids_catastros));
			
		}else{
			$localidades = array();
			$catastros = array();
		}
		$organizaciones = $this->Catastro->Organizacion->find('list',  array('fields' => array('Organizacion.id', 'Organizacion.nombre'),
																			 'conditions' => array('Organizacion.id' => $id) ));
		$area = $organizaciones[$id];
		$this->set(compact('catastros', 'organizaciones', 'localidades', 'area'));
		if($this->RequestHandler->isAjax()) {
			Configure::write("debug", 0);
			$this->render('/elements/paginar_catastros');
		}else
			$this->render('index');
	}
	
	function salud(){
		$this->index('Salud');
		$this->render('index');
	}
	function vivienda(){
		$this->index('Desarrollo Urbano');
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
	
	function bajar_archivo($id, $nombre){
		$filename = $nombre."-".$id;
		$bin = file_get_contents("files/".$filename);
		$this->set(compact('bin', 'filename'));
		$this->layout = 'file';
		Configure::write("debug", 0);
	}
	
	function editar($id = NULL) {
		if(isset($this->data['Catastro'])) {
			if($this->data['Catastro']['submittedfile']['name']){
				$nombre_archivo = $this->data['Catastro']['submittedfile']['name']."-".time();
				if (move_uploaded_file($this->data['Catastro']['submittedfile']['tmp_name'], ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS."files".DS.$nombre_archivo)){ 
					if($this->data['Catastro']['file'])
						unlink(ROOT.DS.APP_DIR.DS.WEBROOT_DIR.DS."files".DS.$this->data['Catastro']['file']);
					$this->data['Catastro']['file'] = $nombre_archivo;
				}
			}
			if($this->Catastro->save($this->data['Catastro'])) {
				foreach($this->data['Necesidad'] as $necesidad) {
					if(isset($necesidad['cantidad']) && $necesidad['cantidad'] > 0) {
						$necesidad['catastro_id'] = $this->Catastro->id;
						$this->Catastro->Necesidad->save($necesidad);
					} elseif(isset($necesidad['id'])) {
						$this->Catastro->Necesidad->id = $necesidad['id'];
						$this->Catastro->Necesidad->del();
					}

					$this->Catastro->Necesidad->id = NULL;
				}
				$this->Session->setFlash('Guardado con éxito.');
				$this->redirect(array('controller' => 'catastros', 'action' => 'ver', $this->Catastro->id));
			} else {
				$this->Session->setFlash('Problemas al guardar');
			}
		}

		$admin = $this->Auth->user('admin');

		$catastro = $this->Catastro->find('first', array('conditions' => array('Catastro.id' => $id)));
		
		if($catastro == null) {
			$this->redirect(array('controller' => 'catastros', 'action' => 'index'));
		}

		$necesidades = array();
		foreach($catastro['Necesidad'] as $necesidad) {
			$necesidades[$necesidad['tipo_necesidad_id']] = $necesidad;
		}
		$region_id = (int)($catastro['Localidad']['comuna_id']/1000);
		$comunas = $this->Localidad->Comuna->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('id BETWEEN ? AND ?' => array($region_id*1000, $region_id*1000 + 999) )));
		$localidades = $this->Localidad->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Localidad.comuna_id' => $catastro['Localidad']['comuna_id'])));
		$tipos = $this->TipoNecesidad->find('all', array('order' => array('area_id')));
		$areas = $this->TipoNecesidad->Area->find('list', array('fields' => array('id', 'nombre')));
		$this->data['Catastro'] = $catastro['Catastro'];
		$this->set(compact('admin', 'areas', 'tipos'));
		$this->set(compact('catastro', 'necesidades', 'comunas', 'localidades'));
	}
}
?>
