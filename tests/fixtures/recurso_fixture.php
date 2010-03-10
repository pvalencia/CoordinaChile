<?php
/* SVN FILE: $Id$ */
/* Recurso Fixture generated on: 2010-03-07 15:03:43 : 1267985683*/

class RecursoFixture extends CakeTestFixture {
	var $name = 'Recurso';
	var $table = 'recursos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'cantidad' => array('type'=>'integer', 'null' => true, 'default' => '0', 'length' => 11),
		'caracteristica' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'tipo_recurso_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'comuna_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'operativo_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 11),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'cantidad'  => 1,
		'caracteristica'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'tipo_recurso_id'  => 1,
		'comuna_id'  => 1,
		'operativo_id'  => 1,
		'created'  => '2010-03-07 15:14:43',
		'modified'  => '2010-03-07 15:14:43'
		));
}
?>