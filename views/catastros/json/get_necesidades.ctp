<?php
$text = "";
foreach ($necesidades as $necesidad){
	$key = $necesidad['Necesidad']['id'];
	$text.= $form->input('Operativo.necesidades.'.$key.'.id', array('value' => $key, 'type' => 'hidden'));
	$text.= $form->input('Operativo.necesidades.'.$key.'.checked', 
					array('type' => 'checkbox',
					'label' => $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['Necesidad']['cantidad'],
					'id' => 'showit-nec'.$key,
					'class' => 'input-checkbox showit'));
}
echo $javascript->object($text);
?>
