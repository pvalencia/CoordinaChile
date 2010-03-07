<?php 
class CoordinachileSchema extends CakeSchema {
	var $name = 'Coordinachile';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}
	
	var $areas = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'length' => 255),
		'descripcion' => array('type' => 'text'),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

	var $tipo_recursos = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'length' => 100, 'default' => null, 'null' => false),
		'descripcion' => array('type' => 'text'),
		'area_id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

	var $operativos = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'fecha_llegada' => array('type' => 'date'),
		'duracion' => array('type' => 'integer'),
		'localidad_id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false),
		'organizacion_id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

	var $recursos = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'cantidad' => array('type' => 'integer', 'length' => 11, 'default' => 0),
		'caracteristica' => array('type' => 'text'),
		'tipo_recurso_id' => array('type' => 'integer', 'length' => 11),
		'operativo_id' => array('type' => 'integer', 'length' => 11),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);
	
	var $comunas = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'length' => 255),
		'lat' => array('type' => 'float'),
		'lon' => array('type' => 'float'),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

	var $localidades = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'comuna_id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false),
		'nombre' => array('type' => 'string', 'length' => 100, 'default' => null, 'null' => false),
		'lat' => array('type' => 'float'),
		'lon' => array('type' => 'float'),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);
	
	var $tipo_organizaciones = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'length' => 255),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);
	var $organizaciones = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'length' => 255, 'default' => null, 'null' => false),
		'tipo_organizacion_id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false),
		'telefono' => array('type' => 'string', 'length' => 100),
		'email' => array('type' => 'string', 'length' => 255),
		'web' => array('type' => 'string', 'length' => 255),
		'nombre_contacto' => array('type' => 'string', 'length' => 255),
		'apellido_contacto' => array('type' => 'string', 'length' => 255),
		'telefono_contacto' => array('type' => 'string', 'length' => 255),
		'areas_trabajo' => array('type' => 'text'),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

	var $catastros = array(
		'id' => array('type' => 'integer', 'length' => 11, 'default' => null, 'null' => false, 'key' => 'primary'),
		'localidad_id' => array('type' => 'integer', 'length' => 11),
		'organizacion_id' => array('type' => 'integer', 'length' => 11),
		'localidad' => array('type' => 'string', 'length' => 255),
		'nombre_contacto' => array('type' => 'string', 'length' => 255),
		'telefono_contacto' => array('type' => 'string', 'length' => 100),
		'fecha' => array('type' => 'datetime'),
		'caracterizacion' => array('type' => 'text'),

		// Asistencia médica:
		'danos_graves_fisicos' => array('type' => 'integer', 'length' => 11),
		'danos_graves_psicologicos' => array('type' => 'integer', 'length' => 11),
		'personas_con_discapacidad' => array('type' => 'integer', 'length' => 11),
		'enfermedades_cronicas' => array('type' => 'integer', 'length' => 11),
		'embarazadas' => array('type' => 'integer', 'length' => 11),
		'menores' => array('type' => 'integer', 'length' => 11),
		//Evaluación de vivienda
		'casas_destruidas' => array('type' => 'integer', 'length' => 11),
		'casas_remocion_escombros' => array('type' => 'integer', 'length' => 11),
		'casas_evaluacion_estructural' => array('type' => 'integer', 'length' => 11),
		'sistema_excretas' => array('type' => 'integer', 'length' => 11),
		//Necesidades básicas
		'agua' => array('type' => 'integer', 'length' => 11),
		'ropa' => array('type' => 'integer', 'length' => 11),
		'abrigo' => array('type' => 'integer', 'length' => 11),
		'colchoneta' => array('type' => 'integer', 'length' => 11),
		'aseo_personal' => array('type' => 'integer', 'length' => 11),
		'aseo_general' => array('type' => 'integer', 'length' => 11),
		'combustible' => array('type' => 'integer', 'length' => 11),

		'created' => array('type' => 'datetime'),
		'modified' => array('type' => 'datetime'),
	);

}
?>
