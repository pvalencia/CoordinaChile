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
		$localidades_con_operativos = $this->Operativo->find('list', array('fields' => 'Operativo.localidad_id' ) );
		if(count($localidades_con_operativos) != 0)
			$localidades_operativos = $this->Operativo->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_operativos), 'order' => array('Comuna.nombre' => 'ASC', 'Localidad.nombre' => 'ASC') ) );
		else
			$localidades_operativos = array();
		$localidades_con_operativos = array();
		$operativos = array();
		foreach($localidades_operativos as $localidad) {
			if(!array_key_exists($localidad['Comuna']['id'], $operativos))
				$operativos[$localidad['Comuna']['id']] = 0;
			$operativos[$localidad['Comuna']['id']] += count($localidad['Operativo']);
			
		}
		$localidades_operativos = array();
		
		$localidades_con_catastros = $this->Catastro->find('list', array('fields' => 'Catastro.localidad_id'));
		if(count($localidades_con_catastros) != 0)
			$localidades_catastros = $this->Operativo->Localidad->find('all', array('conditions' => array('Localidad.id' => $localidades_con_catastros), 'order' => array('Localidad.nombre' => 'ASC') ) );
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
																	
		$operativos = $this->Operativo->find('all', array('conditions' => array('Operativo.localidad_id' => $localidades), 
														   'order' => array('Operativo.fecha_llegada' => 'DESC'),
														   'recursive' => -1 ) );
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
			foreach($localidad_db['Operativo'] as $operativo){
				$ids_operativos[] = $operativo['id'];
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
/*		$comunas = $this->Comuna->find('list', array('fields' => array('Comuna.lat', 'Comuna.lon', 'Comuna_nombre'), 
													 'conditions' => array('Localidad')));*/
		/*$localidades = $this->Operativo->find('list', 
											array('fields' => array('Operativo.localidad_id'),
												  'conditions' => array("julianday(Operativo.fecha_llegada) + Operativo.duracion > julianday(date('now'))" )
												 )); */
		$operativos = $this->Operativo->find('list', array('fields' => array('Operativo.id', 'Operativo.duracion', 'Operativo.fecha_llegada')));

		$operativos_activos = array();
		$operativos_programados = array();
		$operativos_realizados = array();
		$now = time();

		foreach($operativos as $fecha_llegada => $list_operativo){
			$time_inicio = strtotime($fecha_llegada);
			foreach($list_operativo as $key => $duracion){
					if($duracion==""){
						$duracion = 1;
					}
					//$time_fin = mktime(0, 0, 0, date('m', $time_inicio), date('d', $time_inicio)+$duracion, date('Y', $time_inicio));
					$time_fin =  strtotime($fecha_llegada)+(($duracion-1)*24*60*60);
					if($now >= $time_inicio && $now <= $time_fin){
						$operativos_activos[] = $key;
					}elseif($now < $time_inicio){
						$operativos_programados[] = $key;
					}elseif($now > $time_fin){
						$operativos_realizados[] = $key;
					}
			}
		}
		$localidades = false;
		$todos_operativos = array_merge($operativos_activos, $operativos_programados, $operativos_realizados);
		if(count($todos_operativos) > 0){
			$localidades = $this->Operativo->find('list', array('fields' => array('Operativo.localidad_id'), 
																'conditions' => array('Operativo.id' => array_values($todos_operativos))));
		}
		if($localidades){
			$comunas_id = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.id', 'Localidad.comuna_id'), 'conditions' => array('Localidad.id' => $localidades)));
			$comunas_db = $this->Comuna->find('all', array('recursive' => 1, 
														   'conditions' => array('id' => array_values($comunas_id))
											 ));
			$comunasactivos = $this->get_info_comunas($comunas_db, $operativos_activos, $comunas_id);
			$comunasprogramados = $this->get_info_comunas($comunas_db, $operativos_programados, $comunas_id);
			$comunasrealizados = $this->get_info_comunas($comunas_db, $operativos_realizados, $comunas_id);
		}else{
			$comunasactivos = array();
			$comunasprogramados = array();
			$comunasrealizados = array();
		}
		if($full)
			$this->layout = 'completa';
		$this->set(compact('comunasactivos', 'comunasprogramados', 'comunasrealizados', 'full'));
	}
	
	function get_info_comunas($comunas_db, $ids_operativos, $comunas_id){
		if(count($ids_operativos) == 0) 
			return array();
		$comunas = array();
		$recursos = $this->Operativo->Recurso->find('all', array('conditions' => array('Operativo.id' => $ids_operativos)));

		foreach($recursos as $recurso){
			$comuna_id = $comunas_id[$recurso['Operativo']['localidad_id']];
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
			
			switch($area_id){
				case 1: 
					$comunas[$comuna_id]['Recursos']["salud_$que"] += $cantidad;
					break;
				case 2:
					$comunas[$comuna_id]['Recursos']["vivienda_$que"] += $cantidad;
					break;
				case 3:
					$comunas[$comuna_id]['Recursos']["humanitaria_$que"] += $cantidad;
					break;
				case 4:
					$comunas[$comuna_id]['Recursos']["otros_$que"] += $cantidad;
					break;
			}
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
