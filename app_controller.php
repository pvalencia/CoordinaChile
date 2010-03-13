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
	var $helpers = array('Html', 'Form', 'Time', 'Javascript');

	var $components = array('Auth', 'RequestHandler');
	
	function beforeFilter() {

		$this->Auth->authorize = 'controller' ;

		$this->Auth->userModel = 'Organizacion' ;

		$this->Auth->fields = array(
			'username' => 'email',
			'password' => 'password'
		);

		$this->Auth->loginAction = array('controller' => 'organizaciones', 'action' => 'ingreso');
		$this->Auth->loginRedirect = array('controller' => 'organizaciones', 'action' => 'perfil');
		$this->Auth->logoutRedirect = '/';

		$this->Auth->loginError = 'El correo electr&oacute;nico o la contrase&ntilde;a estan incorrectas.';
		$this->Auth->authError = 'No tienes autorizaci&oacute;n para ingresar a esta secci&oacute;n.';

		$auth = $this->Auth->user() != null;
		
		$user = $this->Auth->user();
		
		$this->set(compact('auth', 'user'));
		
		$this->RequestHandler->setContent('json', 'text/x-json');

	}
	
	function beforeRender() {
		if($this->RequestHandler->responseType() == 'json')
			Configure::write('debug', 0);
	}

	function isAuthorized() {
		return true ;
	}
}
?>
