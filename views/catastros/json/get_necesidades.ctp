<?php
$text = "";
foreach ($necesidades as $necesidad){
	$key = $necesidad['Necesidad']['id'];
	$text.= $form->input('Necesidad.'.$key.'.id', array('value' => $key, 'type' => 'hidden'));
	$text.= $form->input('Operativo.necesidades.'.$key, 
					array('type' => 'checkbox',
					'label' => $necesidad['Necesidad']['cantidad']." ".$necesidad['TipoNecesidad']['nombre'],
					'id' => 'showit-nec'.$key,
					'class' => 'input-checkbox showit'));
}
echo $javascript->object($text);
?>
