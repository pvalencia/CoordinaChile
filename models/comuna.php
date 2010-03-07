<?php
class Comuna extends AppModel {

	var $name = 'Comuna';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Catastro' => array(
			'className' => 'Catastro',
			'foreignKey' => 'comuna_id',
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
			'foreignKey' => 'comuna_id',
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