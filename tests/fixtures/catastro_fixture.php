<?php 
/* SVN FILE: $Id$ */
/* Catastro Fixture generated on: 2010-03-07 15:03:33 : 1267985373*/

class CatastroFixture extends CakeTestFixture {
	var $name = 'Catastro';
	var $table = 'catastros';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'comuna_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'organizacion_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'localidad' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'nombre_contacto' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'telefono_contacto' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'fecha' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'caracterizacion' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'danos_graves_fisicos' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'danos_graves_psicologicos' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'personas_con_discapacidad' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'enfermedades_cronicas' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'embarazadas' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'menores' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'casas_destruidas' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'casas_remocion_escombros' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'casas_evaluacion_estructural' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'sistema_excretas' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'agua' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'ropa' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'abrigo' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'colchoneta' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'aseo_personal' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'aseo_general' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'combustible' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'comuna_id'  => 1,
		'organizacion_id'  => 1,
		'localidad'  => 'Lorem ipsum dolor sit amet',
		'nombre_contacto'  => 'Lorem ipsum dolor sit amet',
		'telefono_contacto'  => 'Lorem ipsum dolor sit amet',
		'fecha'  => '2010-03-07 15:09:33',
		'caracterizacion'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'danos_graves_fisicos'  => 1,
		'danos_graves_psicologicos'  => 1,
		'personas_con_discapacidad'  => 1,
		'enfermedades_cronicas'  => 1,
		'embarazadas'  => 1,
		'menores'  => 1,
		'casas_destruidas'  => 1,
		'casas_remocion_escombros'  => 1,
		'casas_evaluacion_estructural'  => 1,
		'sistema_excretas'  => 1,
		'agua'  => 1,
		'ropa'  => 1,
		'abrigo'  => 1,
		'colchoneta'  => 1,
		'aseo_personal'  => 1,
		'aseo_general'  => 1,
		'combustible'  => 1,
		'created'  => '2010-03-07 15:09:33',
		'modified'  => '2010-03-07 15:09:33'
	));
}
?>