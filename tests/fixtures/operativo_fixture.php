<?php
/* SVN FILE: $Id$ */
/* Operativo Fixture generated on: 2010-03-07 15:03:29 : 1267985489*/

class OperativoFixture extends CakeTestFixture {
	var $name = 'Operativo';
	var $table = 'operativos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'fecha_llegada' => array('type'=>'date', 'null' => true, 'default' => NULL),
		'duracion' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'comuna_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
		'organizacion_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'fecha_llegada'  => '2010-03-07',
		'duracion'  => 1,
		'comuna_id'  => 1,
		'organizacion_id'  => 1,
		'created'  => '2010-03-07 15:11:29',
		'modified'  => '2010-03-07 15:11:29'
		));
}
?>