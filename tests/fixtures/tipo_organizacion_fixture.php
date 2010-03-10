<?php
/* SVN FILE: $Id$ */
/* TipoOrganizacion Fixture generated on: 2010-03-07 15:03:24 : 1267985724*/

class TipoOrganizacionFixture extends CakeTestFixture {
	var $name = 'TipoOrganizacion';
	var $table = 'tipo_organizaciones';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'nombre'  => 'Lorem ipsum dolor sit amet',
		'created'  => '2010-03-07 15:15:24',
		'modified'  => '2010-03-07 15:15:24'
		));
}
?>