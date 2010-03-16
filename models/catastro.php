<?php
class Catastro extends AppModel {

	var $name = 'Catastro';
	var $validate = array(
		'localidad_id' => array('numeric'),
		'nombre_contacto' => array(
			'novacio' => array(
				'rule' => 'notempty',
				'required' => true,
				'message' => 'Debes especificar el nombre del contacto.'
			),
		),
		'email_contacto' => array(
			'email' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Debes especificar un correo electrónico válido.',
			),
		),
		'telefono_contacto' => array(
			'telefono' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Debes especificar un número de teléfono de contacto válido.',
			),
		),
		'danos_graves_fisicos' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'danos_graves_psicologicos' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'personas_con_discapacidad' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'enfermedades_cronicas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'embarazadas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'menores' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'casas_destruidas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'casas_remocion_escombros' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'casas_evaluacion_estructural' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'sistema_excretas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'agua' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'ropa' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'abrigo' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'albergue' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'aseo_personal' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'aseo_general' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		),
		'combustible' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un número.'
		)
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
