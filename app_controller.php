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
	
	function separarOperativos($parameters = null){
		$conditions = array();
		$recursive = 1;
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
}
?>
