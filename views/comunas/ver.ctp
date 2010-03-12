

<h1> <?php echo $localidades[0]['Comuna']['nombre']; ?> </h1>

<dl>

<dt>Latitud</dt>
<dd> <?php echo text($localidades[0]['Comuna']['lat']); ?> </dd> 

<dt>Longitud</dt>
<dd> <?php echo text($localidades[0]['Comuna']['lon']); ?> </dd> 

</dl>
	<h3>Catastros Realizados</h3>
	<table>
<?php
$count_cat = 0;
foreach($localidades as $localidad)
	foreach($localidad['Catastro'] as $key => $cat){ 
		++$count_cat; ?>
		<tr><td><a href="/catastros/ver/<?php echo $cat['id']?>"> 
<?php		echo $localidad['Localidad']['nombre'].", ".$cat['Organizacion']['nombre']; ?>
		</a></td><td>
		<?php echo $cat['fecha']; ?>
		</td></tr>
<?php
	}
	if($count_cat == 0) ?>
		<tr><td colspan="2"> Ning&uacute;n Catastro </td></tr>
	<?php 
?>
	</table>

<h3>Operativos Realizados</h3>
<table>
<?php
$count_ope = 0;
foreach($localidades as $localidad){
	foreach($localidad['Operativo'] as $key => $ope){ 
		++$count_ope; ?>
		<tr><td><a href="/operativos/ver/<?php echo $ope['id']; ?>">
		<?php echo $localidad['Localidad']['nombre'].", ".$ope['Organizacion']['nombre']; ?>
		</a></td><td>
		<?php 
		echo $ope['fecha_llegada'];
		if($ope['duracion'])
			echo ", ".$ope['duracion']." d&iacute;as";
		?>
		</td></tr>
<?php
	}
}
if($count_ope == 0) { ?>
	<tr><td colspan="2"> Ning&uacute;n Operativo </td></tr>
<?php }
?>
</table>
<?php /*}else{  ?>
	<h4>No posee operativos ingresados.</h4>
<?php  } 
*/

function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
