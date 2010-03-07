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

}
?>