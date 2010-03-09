
<fieldset>
<legend>Operativos</legend> 
<table>
<tr>
	<th>Localidad</th>
	<th>Organizaci&oacute;n</th>
	<th>Fecha Llegada</th>
</tr>
<?php
foreach($operativos as $key => $org){
	echo '<tr><td><a href="/operativos/ver/'.$org['Operativos']['id'].'">'; 
	echo $org['Localidades']['nombre'];
	echo "</a></td><td>";
	echo text($org['Organizaciones']['nombre']);
	echo "</td><td>";
	echo count($org['Operativos']['fecha_llegada']);
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
