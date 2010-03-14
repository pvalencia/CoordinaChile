<?php
class Operativo extends AppModel {

	var $name = 'Operativo';

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

	var $hasMany = array(
		'Recurso' => array(
			'className' => 'Recurso',
			'foreignKey' => 'operativo_id',
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
		'duracion' => array(
			'rule' => 'numeric'
		),
		);

}
?>
