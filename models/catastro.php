<?php
class Catastro extends AppModel {

	var $name = 'Catastro';
	var $validate = array(
		'danos_graves_fisicos' => array('numeric'),
		'danos_graves_psicologicos' => array('numeric'),
		'personas_con_discapacidad' => array('numeric'),
		'enfermedades_cronicas' => array('numeric'),
		'embarazadas' => array('numeric'),
		'menores' => array('numeric'),
		'casas_destruidas' => array('numeric'),
		'casas_remocion_escombros' => array('numeric'),
		'casas_evaluacion_estructural' => array('numeric'),
		'sistema_excretas' => array('numeric'),
		'agua' => array('numeric'),
		'ropa' => array('numeric'),
		'abrigo' => array('numeric'),
		'colchoneta' => array('numeric'),
		'aseo_personal' => array('numeric'),
		'aseo_general' => array('numeric'),
		'combustible' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Localidad' => array(
			'className' => 'Localidad',
			'foreignKey' => 'localidad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Organizacion' => array(
			'className' => 'Organizacion',
			'foreignKey' => 'organizacion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>
