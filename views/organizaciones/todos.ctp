
<h1>Organizaciones</h1> 
<table>
<tr>
	<th>Nombre</th>
	<th>Nombre de Contacto</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($organizaciones as $key => $org){ ?>
	<tr><td><a href="/organizaciones/ver/<?php echo $org['Organizacion']['id'];?>"> 
	<?php echo $org['Organizacion']['nombre']; ?>
	</a></td><td>
	<?php echo text($org['Organizacion']['nombre_contacto']); ?>
	</td><td>
	<?php echo count($org['Catastro']); ?>
	</td><td>
	<?php echo count($org['Operativo']); ?>
	</td></tr>
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
