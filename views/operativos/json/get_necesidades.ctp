<?php
$text = "";
$i = 1;
foreach ($necesidades as $necesidad){
	$key = $necesidad['Necesidad']['id'];

	$label = $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['Necesidad']['cantidad'];
	if($necesidad['Necesidad']['caracteristica'])
		$label.= "<br /> &nbsp; &nbsp; &nbsp;(".$necesidad['Necesidad']['caracteristica'].")";
	
	$text.= "<tr class='fila$i'><td>";
	$text.= $form->input("Necesidad.$indice.$key.id", array('type' => 'hidden', 'value' => $key));
	$text.= $form->input("Necesidad.$indice.$key.checked", 
					array('type' => 'checkbox',
						'label' => $label,
						'id' => 'necesidad-'.$key,
						'class' => 'input-checkbox'));
	$text.="</td><td>Catastrado el ".$necesidad['Catastro']['fecha']."</td>";
	$text.="<td>".$necesidad['Necesidad']['status']."</td></tr>";
	$i = 3 - $i;
}
if($text){
	$intro ="<table class='ancho100 sortable' id='tablenecesidades$indice'>";
	$intro.= "<thead><tr><th class='ancho50'>Elemento</th><th class='ancho30'>Fecha de Catastro</th><th class='ancho20'>Estado</th></tr></thead>";
	$outro = "</table>";
	
	$text = $intro.$text.$outro;
}
echo $javascript->object($text);
?>
