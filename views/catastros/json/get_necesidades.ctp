<?php
$text = "";
foreach ($necesidades as $necesidad){
	$key = $necesidad['Necesidad']['id'];

	$label = $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['Necesidad']['cantidad'];
	if($necesidad['Necesidad']['caracteristica'])
		$label.= " (".$necesidad['Necesidad']['caracteristica'].")";
	$label2 = "Catastrado el ".$necesidad['Catastro']['fecha'];
	
	$text.= "<tr><td>";
	$text.= $form->input("Necesidad.$indice.$key.id", array('type' => 'hidden', 'value' => $key));
	$text.= $form->input("Necesidad.$indice.$key.checked", 
					array('type' => 'checkbox',
						'label' => $label,
						'id' => 'necesidad-'.$key,
						'class' => 'input-checkbox'));
	$text.="</td><td>$label2</td></tr>";
}
if($text)
	$text ="<table>$text</table>";
echo $javascript->object($text);
?>
