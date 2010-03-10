<?php
/* SVN FILE: $Id$ */
/* Area Fixture generated on: 2010-03-07 15:03:59 : 1267985339*/

class AreaFixture extends CakeTestFixture {
	var $name = 'Area';
	var $table = 'areas';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type'=>'string', 'null' => true, 'default' => NULL),
		'descripcion' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'nombre'  => 'Lorem ipsum dolor sit amet',
		'descripcion'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'created'  => '2010-03-07 15:08:59',
		'modified'  => '2010-03-07 15:08:59'
		));
}
?>