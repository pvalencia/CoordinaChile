
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
foreach($localidades as $key => $loc){ ?>
	<tr><td><a href="/localidades/ver/<?php echo $loc['Localidad']['id']?>">; 
	<?php echo $loc['Localidad']['nombre']; ?>
	</a></td><td>
	<?php echo text($loc['Comuna']['nombre']); ?>
	</td><td>
	<?php echo count($loc['Catastro']); ?>
	</td><td>
	<?php echo count($loc['Operativo']); ?>
	</td></tr>
<?php
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
