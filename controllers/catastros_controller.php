<?php
class CatastrosController extends AppController {
	var $name = 'Catastros' ;

	var $uses = array('Catastro', 'Localidad', 'TipoNecesidad');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('todos', 'salud', 'vivienda', 'humanitaria', 'otros');
	}

	function nuevo() {
		$this->pageTitle = 'Agregar Catastro'; //
		if(isset($this->data['Catastro'])) {
			$this->data['Catastro']['organizacion_id'] = $this->Auth->user('id');
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
		$regiones = array(13 => 'Región Metropolitana', 5 => 'Valparaíso', 6 => "O'Higgins", 7 => 'Maule', 8 => 'Bio Bio', 9 => 'Araucanía');
		$this->set(compact('regiones'));
		
		$tipos = $this->TipoNecesidad->find('all', array('order' => array('area_id')));
		$areas = $this->TipoNecesidad->Area->find('list', array('fields' => array('id', 'nombre')));
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
		$regiones_html = array(13 => 'Metropolitana', 5 =>'Valpara&iacute;so', 6 => 'O\'Higgins', 7 => 'Maule', 8 => 'B&iacute;o-B&iacute;o', 9 => 'Araucan&iacute;a');
		$region = $regiones_html[(int)($catastro['Localidad']['comuna_id']/1000)];
		$this->set(compact('catastro', 'necesidades', 'areas', 'comuna', 'region'));
	}

	function todos($area = ""){
		if($area){
			$id_area = $this->TipoNecesidad->Area->find('first', array('conditions' => array('nombre' => $area), 'fields' => 'id', 'recursive' => -1));
			if(!$id_area){
				$this->cakeError('error404');
			}
			$tipos_necesidades = $this->TipoNecesidad->find('list', array('conditions' => array('TipoNecesidad.area_id' => $id_area['Area']['id']), 'fields' => 'id'));
			$ids_catastros = $this->Catastro->Necesidad->find('list', array('conditions' => array('Necesidad.tipo_necesidad_id' => $tipos_necesidades), 'fields' => 'catastro_id'));
		
			if($ids_catastros){
				$catastros = $this->Catastro->find('all', array('conditions' => array('Catastro.id' => $ids_catastros), 'recursive' => -1 ) );
				$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id',
																   'conditions' => array('Catastro.id' => $ids_catastros), 
																   'order' => 'Catastro.localidad_id'));
			}else{
				$catastros = array();
				$localidades_con_catastros = array();
			}
		}else{
			$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id' ) );
			$catastros = $this->Catastro->find('all');
		}
		if($localidades_con_catastros)
			$localidades = $this->Catastro->Localidad->find('list', array('conditions' => array('Localidad.id' => $localidades_con_catastros),
																		   'fields' => array('Localidad.id', 'Localidad.nombre') ) );
		else
			$localidades = array();
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$this->set(compact('catastros', 'organizaciones', 'localidades'));
	
	
/*	
		//$catastros = $this->Catastro->find('all', array('order' => 'Catastro.localidad_id'));
		$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));

		if($localidades_con_catastros)
			$localidades = $this->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_catastros) ) );
		else
			$localidades = array();
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		
		$this->set(compact('localidades', 'organizaciones'));
*/
	}
	function salud(){
		$this->todos('Salud');
		$this->render('todos');
	}
	function vivienda(){
		$this->todos('Vivienda');
		$this->render('todos');
	}
	function humanitaria(){
		$this->todos('Humanitaria');
		$this->render('todos');
	}
	function otros(){
		$this->todos('Otros');
		$this->render('todos');
	}
	
}
?>
