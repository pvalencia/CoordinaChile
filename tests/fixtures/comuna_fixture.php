<?php
/* SVN FILE: $Id$ */
/* Comuna Fixture generated on: 2010-03-07 15:03:00 : 1267985460*/

class ComunaFixture extends CakeTestFixture {
	var $name = 'Comuna';
	var $table = 'comunas';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'latitud' => array('type'=>'float', 'null' => true, 'default' => NULL),
		'longitud' => array('type'=>'float', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'nombre'  => 'Lorem ipsum dolor sit amet',
		'latitud'  => 'Lorem ipsum dolor sit amet',
		'longitud'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2010-03-07 15:11:00',
		'modified'  => '2010-03-07 15:11:00'
		));
}
?>