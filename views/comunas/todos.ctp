
<h1>Comunas</h1> 
<table>
<tr>
	<th>Nombre</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($comunas as $key => $comuna){
	echo '<tr><td><a href="/comunas/ver/'.$comuna['Comuna']['id'].'">'; 
	echo $comuna['Comuna']['nombre'];
	echo "</a></td>";
	
	$sum_catastros = 0;
	$sum_operativos = 0;
	foreach($comuna['Localidad'] as $localidad){
		$sum_catastros += count($localidad['Catastro']);
		$sum_operativos += count($localidad['Operativo']);
	}
	
	echo "<td>$sum_catastros</td>";
	echo "<td>$sum_operativos</td></tr>";
}
?>
</table>

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
