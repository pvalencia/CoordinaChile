<?php
class Comuna extends AppModel {

	var $name = 'Comuna';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Localidad' => array(
			'className' => 'Localidad',
			'foreignKey' => 'comuna_id',
			'dependent' => true,
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
