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
			'message' => 'Debe ingresar un nombre válido',
		),
		'email' => array(
			'rule' => 'email',
			'required' => true,
			'message' => 'Debe ingresar un e-mail válido'
		),
		'telefono' => array(
			'rule' => 'phone',
			'required' => true,
			'message' => 'Debe ingresar un teléfono válido',
		),
		'web' => array(
			'rule' => 'url',
			'allowEmpty' => true,
			'message' => 'La url no es válida'
		),
		'nombre_contacto' => array(
			'rule' => array('minlength', 3),
			'required' => true,
			'message' => 'Debe ingresar un nombre de contacto válido'
		),
	);

}
?>
