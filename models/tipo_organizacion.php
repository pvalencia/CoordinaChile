<?php
class TipoOrganizacion extends AppModel {

	var $name = 'TipoOrganizacion';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Organizacion' => array(
			'className' => 'Organizacion',
			'foreignKey' => 'tipo_organizacion_id',
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