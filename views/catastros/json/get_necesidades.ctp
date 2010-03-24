<?php
$text = "";
foreach ($necesidades as $necesidad){
	$key = $necesidad['Necesidad']['id'];

	$label = $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['Necesidad']['cantidad'];
	if($necesidad['Necesidad']['caracteristica'])
		$label.= "(".$necesidad['Necesidad']['caracteristica'].")";
	
	$text.= $form->input("Operativo.$indice.necesita.".$key."", 
					array('type' => 'checkbox',
						'label' => $label,
						'id' => 'necesidad-'.$key,
						'class' => 'input-checkbox'));
}
echo $javascript->object($text);
?>
