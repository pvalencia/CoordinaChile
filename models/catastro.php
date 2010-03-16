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
				'message' => 'Debes especificar un correo electr&oacute;nico v&aacute;lido.',
			),
		),
		'telefono_contacto' => array(
			'telefono' => array(
				'rule' => 'alphaNumeric',
				'required' => true,
				'message' => 'Debes especificar un n&uacute;mero de tel&eacute;fono de contacto v&aacute;lido.',
			),
		),
		'danos_graves_fisicos' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'danos_graves_psicologicos' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'personas_con_discapacidad' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'enfermedades_cronicas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'embarazadas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'menores' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'casas_destruidas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'casas_remocion_escombros' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'casas_evaluacion_estructural' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'sistema_excretas' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'agua' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'ropa' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'abrigo' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'albergue' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'aseo_personal' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'aseo_general' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
		),
		'combustible' => array(
			'rule' => 'numeric',
			'allowEmpty' => true,
			'message' => 'Debes escribir un n&uacute;mero.'
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
