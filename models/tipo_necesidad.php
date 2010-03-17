<?php
class TipoNecesidad extends AppModel {

	var $name = 'TipoNecesidad';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
			);

	var $hasMany = array(
		'Necesidad' => array(
			'className' => 'Necesidad',
			'foreignKey' => 'tipo_necesidad_id',
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
