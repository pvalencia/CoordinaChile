<?php
/* SVN FILE: $Id$ */
/* TipoOrganizacion Test cases generated on: 2010-03-07 15:03:24 : 1267985724*/
App::import('Model', 'TipoOrganizacion');

class TipoOrganizacionTestCase extends CakeTestCase {
	var $TipoOrganizacion = null;
	var $fixtures = array('app.tipo_organizacion', 'app.organizacion');

	function startTest() {
		$this->TipoOrganizacion =& ClassRegistry::init('TipoOrganizacion');
	}

	function testTipoOrganizacionInstance() {
		$this->assertTrue(is_a($this->TipoOrganizacion, 'TipoOrganizacion'));
	}

	function testTipoOrganizacionFind() {
		$this->TipoOrganizacion->recursive = -1;
		$results = $this->TipoOrganizacion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('TipoOrganizacion' => array(
			'id'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-03-07 15:15:24',
			'modified'  => '2010-03-07 15:15:24'
			));
			$this->assertEqual($results, $expected);
	}
}
?>