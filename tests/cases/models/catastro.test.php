<?php
/* SVN FILE: $Id$ */
/* Catastro Test cases generated on: 2010-03-08 16:38:49 : 1268077129*/
App::import('Model', 'Catastro');

class CatastroTestCase extends CakeTestCase {
	var $Catastro = null;
	var $fixtures = array('app.catastro', 'app.localidad', 'app.organizacion');

	function startTest() {
		$this->Catastro =& ClassRegistry::init('Catastro');
	}

	function testCatastroInstance() {
		$this->assertTrue(is_a($this->Catastro, 'Catastro'));
	}

	function testCatastroFind() {
		$this->Catastro->recursive = -1;
		$results = $this->Catastro->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Catastro' => array(
			'id' => 1,
			'localidad_id' => 1,
			'organizacion_id' => 1,
			'localidad' => 'Lorem ipsum dolor sit amet',
			'nombre_contacto' => 'Lorem ipsum dolor sit amet',
			'telefono_contacto' => 'Lorem ipsum dolor sit amet',
			'fecha' => '2010-03-08 16:38:46',
			'caracterizacion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'danos_graves_fisicos' => 1,
			'danos_graves_psicologicos' => 1,
			'personas_con_discapacidad' => 1,
			'enfermedades_cronicas' => 1,
			'embarazadas' => 1,
			'menores' => 1,
			'casas_destruidas' => 1,
			'casas_remocion_escombros' => 1,
			'casas_evaluacion_estructural' => 1,
			'sistema_excretas' => 1,
			'agua' => 1,
			'ropa' => 1,
			'abrigo' => 1,
			'colchoneta' => 1,
			'aseo_personal' => 1,
			'aseo_general' => 1,
			'combustible' => 1,
			'created' => '2010-03-08 16:38:46',
			'modified' => '2010-03-08 16:38:46'
			));
			$this->assertEqual($results, $expected);
	}
}
?>