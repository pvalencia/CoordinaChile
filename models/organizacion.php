<?php
class Organizacion extends AppModel {

	var $name = 'Organizacion';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'TipoOrganizacion' => array(
			'className' => 'TipoOrganizacion',
			'foreignKey' => 'tipo_organizacion_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
			);

			var $hasMany = array(
		'Catastro' => array(
			'className' => 'Catastro',
			'foreignKey' => 'organizacion_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
			),
		'Operativo' => array(
			'className' => 'Operativo',
			'foreignKey' => 'organizacion_id',
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
		'nombre' => array(
			'rule' => array('minlength', 3),
			'required' => true,
			'message' => 'Debes ingresar un nombre válido',
		),
		'email' => array(
			'rule' => 'email',
			'required' => true,
			'message' => 'Debes ingresar un correo electrónico válido'
		),
		'telefono' => array(
			'rule' => 'notempty',
			'required' => true,
			'message' => 'Debes ingresar un teléfono válido',
		),
		'web' => array(
			'rule' => 'url',
			'allowEmpty' => true,
			'message' => 'La url no es válida'
		),
		'nombre_contacto' => array(
			'rule' => array('minlength', 3),
			'required' => true,
			'message' => 'Debes ingresar un nombre de contacto válido'
		),
		'email_contacto' => array(
			'rule' => 'email',
			'required' => true,
			'message' => 'Debes ingresar un correo electrónico válido'
		),
	);

}
?>
