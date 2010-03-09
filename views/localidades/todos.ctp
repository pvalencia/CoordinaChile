
<fieldset>
<legend>Localidades</legend> 
<table>
<tr>
	<th>Nombre</th>
	<th>Comuna</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($localidades as $key => $loc){
	echo '<tr><td><a href="/localidades/ver/'.$loc['Localidad']['id'].'">'; 
	echo $loc['Localidad']['nombre'];
	echo "</a></td><td>";
	echo text($loc['Comuna']['nombre']);
	echo "</td><td>";
	echo count($loc['Catastro']);
	echo "</td><td>";
	echo count($loc['Operativo']);
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
