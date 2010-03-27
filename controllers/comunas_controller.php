<?php
class ComunasController extends AppController {
	var $name = 'Comunas' ;
	var $helpers = array('Regiones');
	var $uses = array('Comuna', 'Operativo', 'Catastro');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow(array('ver', 'index', 'todos', 'mapa'));
	}
	
	function index(){
		$comunas = $this->Comuna->find('list', array('fields' => array('Comuna.id', 'Comuna.nombre')) );
		$localidades_con_operativos = $this->Operativo->Suboperativo->find('list', array('fields' => 'Suboperativo.localidad_id' ) );
		if(count($localidades_con_operativos) != 0)
			$localidades_operativos = $this->Comuna->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_operativos), 'order' => array('Comuna.nombre' => 'ASC', 'Localidad.nombre' => 'ASC') ) );
		else
			$localidades_operativos = array();
		$localidades_con_operativos = array();
		$operativos = array();
		foreach($localidades_operativos as $localidad) {
			if(!array_key_exists($localidad['Comuna']['id'], $operativos))
				$operativos[$localidad['Comuna']['id']] = 0;
			$operativos[$localidad['Comuna']['id']] += count($localidad['Suboperativo']);
			
		}
		$localidades_operativos = array();
		
		$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));
		if(count($localidades_con_catastros) != 0)
			$localidades_catastros = $this->Comuna->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_catastros), 'order' => array('Localidad.nombre' => 'ASC') ) );
		else 
			$localidades_catastros = array();
		$localidades_con_catastros = array();
		
		$catastros = array();
		foreach($localidades_catastros as $localidad) {
			if(!array_key_exists($localidad['Comuna']['id'], $catastros))
				$catastros[$localidad['Comuna']['id']] = 0;
			$catastros[$localidad['Comuna']['id']] += count($localidad['Catastro']);
		}

		$this->set(compact('comunas', 'operativos', 'catastros'));
	}

	function ver($comuna_id) {
		$comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $comuna_id),
													'recursive' => 0) );
		if($comuna == null)
			$this->cakeError('error404');
		$localidades = $this->Comuna->Localidad->find('list', array('conditions' => array('Localidad.comuna_id' => $comuna_id),
																	'fields' => array('Localidad.id')) );
																	
		$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.comuna_id' => $comuna_id), 
														   'order' => array('Operativo.fecha_llegada' => 'DESC') ) );
		$catastros = $this->Catastro->find('all', array('conditions' => array('Catastro.localidad_id' => $localidades), 
														 'order' => array('Catastro.fecha' => 'DESC'),
														 'recursive' => -1 ) );
		$organizaciones = $this->Catastro->Organizacion->find('list', array('fields' => array('Organizacion.id', 'Organizacion.nombre')));
		$localidades_db = $this->Comuna->Localidad->find('all', array('conditions' => array('Localidad.comuna_id' => $comuna_id)) );
		foreach($localidades_db as $localidad_db){
			$localidad = array();
			$localidad['id'] = $localidad_db['Localidad']['id'];
			$localidad['nombre'] = $localidad_db['Localidad']['nombre'];
			$localidad['lat'] = $localidad_db['Localidad']['lat'];
			$localidad['lon'] = $localidad_db['Localidad']['lon'];
			$ids_catastros = array();
			foreach($localidad_db['Catastro'] as $catastro){
				$ids_catastros[] = $catastro['id'];
			}
			$localidad['catastros'] = $ids_catastros;
			$ids_operativos = array();
			foreach($localidad_db['Suboperativo'] as $suboperativo){
				$ids_operativos[] = $suboperativo['operativo_id'];
			}
			$localidad['operativos'] = $ids_operativos;
			
			$localidades[$localidad['id']] = $localidad;
		}

		$this->set(compact('comuna', 'catastros', 'operativos', 'localidades', 'organizaciones'));
	}

	function todos(){
		$this->index();
		$this->render('index');
	}
	
	function mapa($full = false){
		
		$operativos = $this->separarOperativos();
		$operativos_activos = $operativos['activos'];
		$operativos_programados = $operativos['programados'];
		$operativos_realizados = $operativos['realizados'];
		
		$localidades = false;
		$todos_operativos = array_merge($operativos_activos, $operativos_programados, $operativos_realizados);
		if(count($todos_operativos) > 0){
			$comunas_ids = $this->Operativo->find('list', array('fields' => array('Operativo.comuna_id'), 
															'conditions' => array('Operativo.id' => array_values($todos_operativos))));
		}
		if($comunas_ids){
			$comunas_por_localidad = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.comuna_id'), 'conditions' => array('Localidad.comuna_id' => $comunas_ids)));
			$comunas_db = $this->Comuna->find('all', array('recursive' => 1, 
														   'conditions' => array('id' => $comunas_ids)
											 ));
			$comunasactivos = $this->get_info_comunas($comunas_db, $operativos_activos, $comunas_por_localidad);
			$comunasprogramados = $this->get_info_comunas($comunas_db, $operativos_programados, $comunas_por_localidad);
			$comunasrealizados = $this->get_info_comunas($comunas_db, $operativos_realizados, $comunas_por_localidad);
		}else{
			$comunasactivos = array();
			$comunasprogramados = array();
			$comunasrealizados = array();
		}
		if($full)
			$this->layout = 'completa';
		$this->set(compact('comunasactivos', 'comunasprogramados', 'comunasrealizados', 'full'));
	}
	
	function get_info_comunas($comunas_db, $ids_operativos, $comunas_por_localidad){
		if(count($ids_operativos) == 0) 
			return array();
		$comunas = array();
		$recursos = $this->Operativo->Suboperativo->Recurso->find('all', array('conditions' => array('Suboperativo.operativo_id' => $ids_operativos)));
		$tipo = array(1 => 'salud', 2 => 'vivienda', 3 => 'humanitaria', 4 => 'otros');
		foreach($recursos as $recurso){
			$comuna_id = $comunas_por_localidad[$recurso['Suboperativo']['localidad_id']];
			if(array_key_exists($comuna_id, $comunas) == false){
				foreach($comunas_db as $comuna_all){
					if($comuna_all['Comuna']['id'] == $comuna_id){
						$comuna = $comuna_all['Comuna'];
						$nom = $comuna['nombre'];
						$comuna_id = $comuna['id'];
						$comunas[$comuna_id] = array();
						$comunas[$comuna_id]['id'] = $comuna_id;
						$comunas[$comuna_id]['nombre'] = $nom;
						$comunas[$comuna_id]['lat'] = $comuna['lat'];
						$comunas[$comuna_id]['lon'] = $comuna['lon'];
						$comunas[$comuna_id]['Recursos']['salud_vol'] = 0;
						$comunas[$comuna_id]['Recursos']['vivienda_vol'] = 0;
						$comunas[$comuna_id]['Recursos']['vivienda_rec'] = 0;
						$comunas[$comuna_id]['Recursos']['humanitaria_vol'] = 0;
						$comunas[$comuna_id]['Recursos']['humanitaria_rec'] = 0;
						$comunas[$comuna_id]['Recursos']['otros_rec'] = 0;
						break;
					}
				}
			}

			$id = $recurso['Recurso']['tipo_recurso_id'];
			$area_id = $recurso['TipoRecurso']['area_id'];
			
			$cantidad = $recurso['Recurso']['cantidad'];
			
			if($recurso['TipoRecurso']['unidad'] == 'Personas')
				$que = "vol";
			else
				$que = "rec";

			$elemento = $tipo[$area_id]."_".$que;
			$comunas[$comuna_id]['Recursos'][$elemento] += $cantidad;
		}
		
		return $comunas;
	}
	
	
	function get_comunas($region_id = 0){
		if($region_id != 0)
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre'), 'conditions' => array('Comuna.id BETWEEN ? AND ?' => array($region_id*1000, ($region_id*1000 + 999)) ), 'order' => array('Comuna.nombre' => 'ASC') ) );
		else
			$comunas = $this->Comuna->find('list', array('fields' => array('id', 'nombre'), 'order' => array('Comuna.nombre' => 'ASC')) );
		
		$this->set(compact('comunas'));
	}

	function editar($id = null) {
		$comuna = $this->Comuna->find('first', array('conditions' => array('Comuna.id' => $id)));

		if($comuna == null) {
			$this->Session->setFlash('No existe la comuna');
			$this->redirect('/');
		}

		if(isset($this->data['Comuna'])) {
			if($this->Comuna->save($this->data['Comuna'])) {
				$this->redirect(array('controller' => 'comunas', 'action' => 'ver', $this->data['Comuna']['id']));
			} else {
				$this->Session->setFlash('Problemas con el formulario.');
			}
		}

		$this->data = $comuna;
	}
}
?>
