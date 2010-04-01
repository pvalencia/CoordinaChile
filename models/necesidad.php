<?php
class Necesidad extends AppModel {

	var $name = 'Necesidad';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'TipoNecesidad' => array(
			'className' => 'TipoNecesidad',
			'foreignKey' => 'tipo_necesidad_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Suboperativo' => array(
			'className' => 'Suboperativo',
			'foreignKey' => 'suboperativo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			),
		'Catastro' => array(
			'className' => 'Catastro',
			'foreignKey' => 'catastro_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
			)
			);
	
	var $validate = array(
		'cantidad' => array(
			'numerico' => array(
				'rule' => 'numeric',
				'message' => 'Debe ser un número'
			)
		)
	);

}
?>
