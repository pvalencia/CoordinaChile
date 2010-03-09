
<fieldset>
<legend>Organizaciones</legend> 
<table>
<tr>
	<th>Nombre</th>
	<th>Nombre de Contacto</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($organizaciones as $key => $org){
	echo '<tr><td><a href="/organizaciones/ver/'.$org['Organizacion']['id'].'">'; 
	echo $org['Organizacion']['nombre'];
	echo "</a></td><td>";
	echo text($org['Organizacion']['nombre_contacto']);
	echo "</td><td>";
	echo count($org['Catastro']);
	echo "</td><td>";
	echo count($org['Operativo']);
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
