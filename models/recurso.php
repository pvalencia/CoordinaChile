<?php
class Recurso extends AppModel {

	var $name = 'Recurso';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'TipoRecurso' => array(
			'className' => 'TipoRecurso',
			'foreignKey' => 'tipo_recurso_id',
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
