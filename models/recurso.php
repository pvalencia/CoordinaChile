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
		'Operativo' => array(
			'className' => 'Operativo',
			'foreignKey' => 'operativo_id',
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
