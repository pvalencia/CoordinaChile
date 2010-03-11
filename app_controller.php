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

		$this->Auth->loginError = 'Contraseña incorrecta.';
		$this->Auth->authError = 'No tiene autorización para ingresar a esta sección.';

		$this->RequestHandler->setContent('json', 'text/x-json');
	}

	function isAuthorized() {
		return true ;
	}
}
?>
