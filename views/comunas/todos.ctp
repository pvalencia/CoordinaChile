
<h1>Comunas</h1> 
<table>
<tr>
	<th>Nombre</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($comunas as $key => $comuna){?>
	<tr><td><a href="/comunas/ver/<?php echo $comuna['Comuna']['id']?>">
	<?php echo $comuna['Comuna']['nombre']; ?>
	</a></td>
	
	<?php 
	$sum_catastros = 0;
	$sum_operativos = 0;
	foreach($comuna['Localidad'] as $localidad){
		$sum_catastros += count($localidad['Catastro']);
		$sum_operativos += count($localidad['Operativo']);
	}
	?>
	<td><?php echo $sum_catastros ?></td>
	<td><?php echo $sum_operativos ?></td></tr>
<?php
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
