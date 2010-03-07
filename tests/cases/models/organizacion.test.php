<?php 
/* SVN FILE: $Id$ */
/* Organizacion Test cases generated on: 2010-03-07 15:03:33 : 1267985553*/
App::import('Model', 'Organizacion');

class OrganizacionTestCase extends CakeTestCase {
	var $Organizacion = null;
	var $fixtures = array('app.organizacion', 'app.tipo_organizacion', 'app.catastro', 'app.operativo');

	function startTest() {
		$this->Organizacion =& ClassRegistry::init('Organizacion');
	}

	function testOrganizacionInstance() {
		$this->assertTrue(is_a($this->Organizacion, 'Organizacion'));
	}

	function testOrganizacionFind() {
		$this->Organizacion->recursive = -1;
		$results = $this->Organizacion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Organizacion' => array(
			'id'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'tipo_organizacion_id'  => 1,
			'telefono'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'web'  => 'Lorem ipsum dolor sit amet',
			'nombre_contacto'  => 'Lorem ipsum dolor sit amet',
			'apellido_contacto'  => 'Lorem ipsum dolor sit amet',
			'telefono_contacto'  => 'Lorem ipsum dolor sit amet',
			'areas_trabajo'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created'  => '2010-03-07 15:12:33',
			'modified'  => '2010-03-07 15:12:33'
		));
		$this->assertEqual($results, $expected);
	}
}
?>