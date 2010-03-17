<?php
class Catastro extends AppModel {

	var $name = 'Catastro';
	
	var $hasMany = array(
		'Necesidad' => array(
			'className' => 'Necesidad',
			'foreignKey' => 'catastro_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			)
			);
	
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
