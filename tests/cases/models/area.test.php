<?php 
/* SVN FILE: $Id$ */
/* Area Test cases generated on: 2010-03-07 15:03:59 : 1267985339*/
App::import('Model', 'Area');

class AreaTestCase extends CakeTestCase {
	var $Area = null;
	var $fixtures = array('app.area', 'app.tipo_recurso');

	function startTest() {
		$this->Area =& ClassRegistry::init('Area');
	}

	function testAreaInstance() {
		$this->assertTrue(is_a($this->Area, 'Area'));
	}

	function testAreaFind() {
		$this->Area->recursive = -1;
		$results = $this->Area->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Area' => array(
			'id'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'descripcion'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created'  => '2010-03-07 15:08:59',
			'modified'  => '2010-03-07 15:08:59'
		));
		$this->assertEqual($results, $expected);
	}
}
?>