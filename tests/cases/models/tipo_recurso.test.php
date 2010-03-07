<?php 
/* SVN FILE: $Id$ */
/* TipoRecurso Test cases generated on: 2010-03-07 15:03:57 : 1267985757*/
App::import('Model', 'TipoRecurso');

class TipoRecursoTestCase extends CakeTestCase {
	var $TipoRecurso = null;
	var $fixtures = array('app.tipo_recurso', 'app.area', 'app.recurso');

	function startTest() {
		$this->TipoRecurso =& ClassRegistry::init('TipoRecurso');
	}

	function testTipoRecursoInstance() {
		$this->assertTrue(is_a($this->TipoRecurso, 'TipoRecurso'));
	}

	function testTipoRecursoFind() {
		$this->TipoRecurso->recursive = -1;
		$results = $this->TipoRecurso->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('TipoRecurso' => array(
			'id'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'descripcion'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'area_id'  => 1,
			'created'  => '2010-03-07 15:15:53',
			'modified'  => '2010-03-07 15:15:53'
		));
		$this->assertEqual($results, $expected);
	}
}
?>