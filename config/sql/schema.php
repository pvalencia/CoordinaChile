<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-03-23 14:03:14 : 1269363614*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $areas = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'descripcion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $catastros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'localidad_id' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 11),
		'organizacion_id' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 11),
		'localidad' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'nombre_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'telefono_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'email_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'fecha' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'caracterizacion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'file' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $comunas = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'provincia' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'region' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'lat' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'lon' => array('type' => 'float', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $localidades = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'comuna_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'lat' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'lon' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $necesidades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'cantidad' => array('type' => 'text', 'null' => true, 'default' => '0', 'length' => 11),
		'caracteristica' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'tipo_necesidad_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'catastro_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'operativo_id' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 11),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $operativos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'email' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'telefono' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'fecha_llegada' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'duracion' => array('type' => 'text', 'null' => true, 'default' => '1', 'length' => 11),
		'localidad_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'organizacion_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $organizaciones = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL),
		'tipo_organizacion_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'web' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'nombre_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'telefono_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'email_contacto' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'areas_trabajo' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'admin' => array('type' => 'text', 'null' => true, 'default' => '0', 'length' => 1),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $recursos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'cantidad' => array('type' => 'text', 'null' => true, 'default' => '0', 'length' => 11),
		'caracteristica' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'tipo_recurso_id' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 11),
		'operativo_id' => array('type' => 'text', 'null' => true, 'default' => NULL, 'length' => 11),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $tipo_necesidades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'descripcion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'codigo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 5),
		'area_id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'length' => 11),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array()
	);
	var $tipo_organizaciones = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tipo_recursos = array(
		'id' => array('type' => 'text', 'null' => false, 'default' => NULL, 'key' => 'primary', 'length' => 11),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'descripcion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'codigo' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 5),
		'area_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
		'unidad' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100 ),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
}
?>
