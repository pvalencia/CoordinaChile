<?php 
/* SVN FILE: $Id$ */
/* Recurso Test cases generated on: 2010-03-07 15:03:44 : 1267985684*/
App::import('Model', 'Recurso');

class RecursoTestCase extends CakeTestCase {
	var $Recurso = null;
	var $fixtures = array('app.recurso', 'app.tipo_recurso', 'app.operativo');

	function startTest() {
		$this->Recurso =& ClassRegistry::init('Recurso');
	}

	function testRecursoInstance() {
		$this->assertTrue(is_a($this->Recurso, 'Recurso'));
	}

	function testRecursoFind() {
		$this->Recurso->recursive = -1;
		$results = $this->Recurso->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Recurso' => array(
			'id'  => 1,
			'cantidad'  => 1,
			'caracteristica'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'tipo_recurso_id'  => 1,
			'comuna_id'  => 1,
			'operativo_id'  => 1,
			'created'  => '2010-03-07 15:14:43',
			'modified'  => '2010-03-07 15:14:43'
		));
		$this->assertEqual($results, $expected);
	}
}
?>