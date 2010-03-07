<?php 
/* SVN FILE: $Id$ */
/* TipoRecurso Fixture generated on: 2010-03-07 15:03:53 : 1267985753*/

class TipoRecursoFixture extends CakeTestFixture {
	var $name = 'TipoRecurso';
	var $table = 'tipo_recursos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'descripcion' => array('type'=>'text', 'null' => true, 'default' => NULL),
		'area_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 11),
		'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $records = array(array(
		'id'  => 1,
		'nombre'  => 'Lorem ipsum dolor sit amet',
		'descripcion'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
		'area_id'  => 1,
		'created'  => '2010-03-07 15:15:53',
		'modified'  => '2010-03-07 15:15:53'
	));
}
?>