<?php 
/* SVN FILE: $Id$ */
/* Operativo Test cases generated on: 2010-03-07 15:03:29 : 1267985489*/
App::import('Model', 'Operativo');

class OperativoTestCase extends CakeTestCase {
	var $Operativo = null;
	var $fixtures = array('app.operativo', 'app.comuna', 'app.organizacion', 'app.recurso');

	function startTest() {
		$this->Operativo =& ClassRegistry::init('Operativo');
	}

	function testOperativoInstance() {
		$this->assertTrue(is_a($this->Operativo, 'Operativo'));
	}

	function testOperativoFind() {
		$this->Operativo->recursive = -1;
		$results = $this->Operativo->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Operativo' => array(
			'id'  => 1,
			'fecha_llegada'  => '2010-03-07',
			'duracion'  => 1,
			'comuna_id'  => 1,
			'organizacion_id'  => 1,
			'created'  => '2010-03-07 15:11:29',
			'modified'  => '2010-03-07 15:11:29'
		));
		$this->assertEqual($results, $expected);
	}
}
?>