<?php
/* SVN FILE: $Id$ */
/* Organizacion Fixture generated on: 2010-03-07 15:03:33 : 1267985553*/

class OrganizacionFixture extends CakeTestFixture {
	var $name = 'Organizacion';
	var $table = 'organizaciones';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type'=>'string', 'null' => false, 'default' => NULL),
		'tipo_organizacion_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
		'telefono' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'email' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'web' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'nombre_contacto' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'apellido_contacto' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'telefono_contacto' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'areas_trabajo' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
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
}
?>