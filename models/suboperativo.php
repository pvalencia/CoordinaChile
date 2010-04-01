<?php
class Suboperativo extends AppModel {

	var $name = 'Suboperativo';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Localidad' => array(
			'className' => 'Localidad',
			'foreignKey' => 'localidad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Operativo' => array(
			'className' => 'Operativo',
			'foreignKey' => 'operativo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
			);

	var $hasMany = array(
		'Recurso' => array(
			'className' => 'Recurso',
			'foreignKey' => 'suboperativo_id',
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
		'Necesidad' => array(
			'className' => 'Necesidad',
			'foreignKey' => 'suboperativo_id',
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
		);

}
?>
