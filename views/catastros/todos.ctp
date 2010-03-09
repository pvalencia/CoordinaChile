
<fieldset>
<legend>Catastros</legend> 
<table>
<tr>
	<th>Localidad</th>
	<th>Fecha</th>
	<th>Caracterizaci&oacute;n</th>
</tr>
<?php
foreach($catastros as $key => $org){
	echo '<tr><td><a href="/catastros/ver/'.$org['Catastros']['id'].'">'; 
	echo $org['Localidad']['nombre'];
	echo "</a></td><td>";
	echo text($org['Catastros']['fecha']);
	echo "</td><td>";
	echo count($org['Catastros']['caracterizacion']);
	echo "</td></tr>";
}
?>
</table>

</fieldset>
<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
