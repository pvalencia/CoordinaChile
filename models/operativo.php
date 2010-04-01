<?php
class Operativo extends AppModel {

	var $name = 'Operativo';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Comuna' => array(
			'className' => 'Comuna',
			'foreignKey' => 'comuna_id',
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
		'Suboperativo' => array(
			'className' => 'Suboperativo',
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
			'numerico' => array(
				'rule' => 'numeric',
				'required' => 'true',
				'message' => 'Debes especificar una duración (1 día).'
			),
			'gte1' => array(
				'rule' => array('userDefined', 'Operativo', 'gt', 0),
				'message' => 'Debe ser mayor o igual a 1'
			)
		),
		'nombre' => array(
			'rule' => 'notempty',
			'required' => 'true',
			'message' => 'Debes especificar el nombre del encargado.'
		),
		'email' => array(
			'rule' => 'email',
			'required' => 'true',
			'message' => 'Debes especificar un correo electrónico válido.'
		),
		'telefono' => array(
			'rule' => 'notEmpty',
			'required' => 'true',
			'message' => 'Debes especificar el número de teléfono del encargado.'
		)
	);

	function gt($check, $params) {
		return ($check > $params);
	}

}
?>
