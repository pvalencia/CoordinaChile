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

		$this->Auth->loginError = 'Contrase&ntilde;a incorrecta.';
		$this->Auth->authError = 'No tiene autorizaci&oacute;n para ingresar a esta secci&oacute;n.';

		$auth = $this->Auth->user() != null;
		
		$user = $this->Auth->user();
		
		$this->set(compact('auth', 'user'));

	}

	function isAuthorized() {
		return true ;
	}
}
?>
