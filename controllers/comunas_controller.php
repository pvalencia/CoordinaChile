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
		todos();
		$this->render('todos');
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
					$time_fin = mktime(0, 0, 0, date('m', $time_inicio), date('d', $time_inicio)+$duracion, date('Y', $time_inicio));
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
		if(count($operativos_activos) > 0){
			$localidades = $this->Operativo->find('list', array('fields' => array('Operativo.localidad_id'), 'conditions' => array('Operativo.id' => $operativos_activos)));
		}
		
		if($localidades){
			$comunas_id = $this->Comuna->Localidad->find('list', array('fields' => array('Localidad.comuna_id'), 'conditions' => array('Localidad.id' => $localidades)));
			$comunas_db = $this->Comuna->find('all', array('recursive' => 1, 
														   'conditions' => array('id' => $comunas_id)
											 ));
			$comunasactivos = $this->get_info_comunas($comunas_db, $operativos_activos);
			$comunasprogramados = $this->get_info_comunas($comunas_db, $operativos_programados);
			$comunasrealizados = $this->get_info_comunas($comunas_db, $operativos_realizados);
		}else{
			$comunasactivos = array();
			$comunasprogramados = array();
			$comunasrealizados = array();
		}
		if($full)
			$this->layout = 'completa';
		$this->set(compact('comunasactivos', 'comunasprogramados', 'comunasrealizados', 'full'));
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
	
	function get_info_comunas($comunas_db, $ids_operativos){
		if(count($ids_operativos) == 0) 
			return array();
		$comunas = array();
		foreach($comunas_db as $comuna_all){
				$comuna = $comuna_all['Comuna'];
				$nom = $comuna['nombre'];
				$comunas[$nom]['lat'] = $comuna['lat'];
				$comunas[$nom]['lon'] = $comuna['lon'];
				$comunas[$nom]['Recursos']['salud_vol'] = 0;
				$comunas[$nom]['Recursos']['vivienda_vol'] = 0;
				$comunas[$nom]['Recursos']['vivienda_viv'] = 0;
				$comunas[$nom]['Recursos']['humanitaria_vol'] = 0;
				$comunas[$nom]['Recursos']['humanitaria_rec'] = 0;
				$comunas[$nom]['Recursos']['otros_rec'] = 0;
		
		
				$ids_salud = array(12, 13, 14);
				$ids_vivienda_voluntarios = array(11, 15, 16);
				$ids_vivienda_vivienda = array(20);
				$ids_humanitaria_voluntarios = array(21);
				$ids_humanitaria_recursos = array(1, 2, 3, 4, 5, 8, 9, 10, 19, 22);
				$ids_otros = array(6, 7, 17, 18, 23);
			
				$localidades = $comuna_all['Localidad'];
				foreach($localidades as $localidad){
					$recursos = $this->Operativo->Recurso->find('all', array('conditions' => array('Operativo.localidad_id' => $localidad['id'], 
																								   'Operativo.id' => $ids_operativos)));
					foreach($recursos as $recurso){
						$id = $recurso['Recurso']['tipo_recurso_id'];
						$cantidad = $recurso['Recurso']['cantidad'];
						if(in_array($id, $ids_salud))
							$comunas[$nom]['Recursos']['salud_vol'] += $cantidad;
						elseif(in_array($id, $ids_vivienda_voluntarios))
							$comunas[$nom]['Recursos']['vivienda_vol'] += $cantidad;
						elseif(in_array($id, $ids_vivienda_vivienda))
							$comunas[$nom]['Recursos']['vivienda_viv']  += $cantidad;
						elseif(in_array($id, $ids_humanitaria_voluntarios))
							$comunas[$nom]['Recursos']['humanitaria_vol']  += $cantidad;
						elseif(in_array($id, $ids_humanitaria_recursos))
							$comunas[$nom]['Recursos']['humanitaria_rec']  += $cantidad;
						elseif(in_array($id, $ids_otros))
							$comunas[$nom]['Recursos']['humanitaria_rec'] += $cantidad;
							
						/*if(in_array($id, $ids_salud))
							$comunas[$nom]['Recursos']['Salud']['Voluntarios'] += $cantidad;
						elseif(in_array($id, $ids_vivienda_voluntarios))
							$comunas[$nom]['Recursos']['Vivienda']['Voluntarios'] += $cantidad;
						elseif(in_array($id, $ids_vivienda_vivienda))
							$comunas[$nom]['Recursos']['Vivienda']['Viviendas']  += $cantidad;
						elseif(in_array($id, $ids_humanitaria_voluntarios))
							$comunas[$nom]['Recursos']['Humanitaria']['Voluntarios']  += $cantidad;
						elseif(in_array($id, $ids_humanitaria_recursos))
							$comunas[$nom]['Recursos']['Humanitaria']['Recursos']  += $cantidad;
						elseif(in_array($id, $ids_otros))
							$comunas[$nom]['Recursos']['Otros']['Recursos'] += $cantidad;*/
					}
				}
				$comunas[$nom]['id'] = $comuna_all['Comuna']['id'];
			}
			return $comunas;
	}
}
?>
