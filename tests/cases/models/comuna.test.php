<?php 
/* SVN FILE: $Id$ */
/* Comuna Test cases generated on: 2010-03-07 15:03:00 : 1267985460*/
App::import('Model', 'Comuna');

class ComunaTestCase extends CakeTestCase {
	var $Comuna = null;
	var $fixtures = array('app.comuna', 'app.catastro', 'app.operativo');

	function startTest() {
		$this->Comuna =& ClassRegistry::init('Comuna');
	}

	function testComunaInstance() {
		$this->assertTrue(is_a($this->Comuna, 'Comuna'));
	}

	function testComunaFind() {
		$this->Comuna->recursive = -1;
		$results = $this->Comuna->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Comuna' => array(
			'id'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'latitud'  => 'Lorem ipsum dolor sit amet',
			'longitud'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2010-03-07 15:11:00',
			'modified'  => '2010-03-07 15:11:00'
		));
		$this->assertEqual($results, $expected);
	}
}
?>