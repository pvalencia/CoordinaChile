<?php
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {
	var $helpers = array('Html', 'Form', 'Time', 'Javascript', 'Text', 'Vistas');

	var $components = array('Auth', 'RequestHandler');
	
	function beforeFilter() {

		$this->Auth->authorize = 'controller' ;

		$this->Auth->userModel = 'Organizacion' ;

		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);

		$this->Auth->loginAction = array('controller' => 'organizaciones', 'action' => 'ingreso');
		$this->Auth->loginRedirect = array('controller' => 'organizaciones', 'action' => 'ver', $this->Auth->user('id'));
		$this->Auth->logoutRedirect = '/';

		$this->Auth->loginError = 'El correo electr&oacute;nico o la contrase&ntilde;a estan incorrectas.';
		$this->Auth->authError = 'No tienes autorizaci&oacute;n para ingresar a esta secci&oacute;n.';

		$auth = $this->Auth->user() != null;
		
		$user = $this->Auth->user();
		
		$this->set(compact('auth', 'user'));
		
		$this->RequestHandler->setContent('json', 'text/x-json');
		/*
		if(Configure::read())
			$this->Auth->allow('*');
		*/
		$this->Auth->allow('display');
	}
	
	function beforeRender() {
		if($this->RequestHandler->responseType() == 'json')
			Configure::write('debug', 0);
	}

	function isAuthorized() {
		return true ;
	}
	
	function separarOperativos($parameters = null){	//entrega sólo los ids de los operativos
		if(!$parameters){
			$parameters = array();
		}
		$parameters['fields'] = array('Operativo.id', 'Operativo.duracion', 'Operativo.fecha_llegada');
		
		$operativos = $this->Operativo->find('list', $parameters);
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
					$time_fin = strtotime($fecha_llegada)+(($duracion-1)*24*60*60)-1;
					if($now >= $time_inicio && $now <= $time_fin){
						$operativos_activos[] = $key;
					}elseif($now < $time_inicio){
						$operativos_programados[] = $key;
					}elseif($now > $time_fin){
						$operativos_realizados[] = $key;
					}
			}
		}
		
		$returnable = array();
		$returnable['activos'] = $operativos_activos;
		$returnable['programados'] = $operativos_programados;
		$returnable['realizados'] =  $operativos_realizados;
		return $returnable;
	}
	
	function separarOperativosGetInfo($parameters = null){	//entrega toda la info de los operativos.
		
		if($parameters == null)
			$operativos = $this->Operativo->find('all');
		else
			$operativos = $this->Operativo->find('all', $parameters);
		$operativos_activos = array();
		$operativos_programados = array();
		$operativos_realizados = array();
		$now = time();

		foreach($operativos as $operativo){
			$id = $operativo['Operativo']['id'];
			$time_inicio = strtotime($operativo['Operativo']['fecha_llegada']);
			$duracion = $operativo['Operativo']['duracion'];
			if($duracion==""){
				$duracion = 1;
			}
			$time_fin = $time_inicio+(($duracion-1)*24*60*60)-1;
			
			if($now >= $time_inicio && $now <= $time_fin){
				$operativos_activos[$id] = $operativo;
			}elseif($now < $time_inicio){
				$operativos_programados[$id] = $operativo;
			}elseif($now > $time_fin){
				$operativos_realizados[$id] = $operativo;
			}
		}
		uasort($operativos_activos, 'cmp_fecha');
		uasort($operativos_programados, 'cmp_fecha');
		uasort($operativos_realizados, 'cmp_fecha');
		
		$returnable = array();
		$returnable['activos'] = $operativos_activos;
		$returnable['programados'] = $operativos_programados;
		$returnable['realizados'] =  $operativos_realizados;
		return $returnable;
	}
}
	
	function cmp_fecha($operativo_a, $operativo_b) {
		$a = strtotime($operativo_a['Operativo']['fecha_llegada']);
		$b = strtotime($operativo_b['Operativo']['fecha_llegada']);
		if ( $a == $b ) {
		    return 0;
		}
		return ($a < $b) ? 1 : -1;
	}
?>
