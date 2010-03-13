

<h1> <?php echo $comuna['Comuna']['nombre']; ?> </h1>

<dl>

<dt>Latitud</dt>
<dd> <?php echo text($comuna['Comuna']['lat']); ?> </dd> 

<dt>Longitud</dt>
<dd> <?php echo text($comuna['Comuna']['lon']); ?> </dd> 

</dl>
	<h3>Catastros Realizados</h3>
	<table>
<?php
$count_cat = 0;
foreach($catastros as $catastro){
		$cat = $catastro['Catastro'];
		++$count_cat; ?>
		<tr><td><a href="/catastros/ver/<?php echo $cat['id']?>"> 
<?php	echo $catastro['Localidad']['nombre'].", ".$catastro['Organizacion']['nombre']; ?>
		</a></td><td>
<?php	echo $cat['fecha']; ?>
		</td></tr>
<?php
}
if($count_cat == 0){ ?>
	<tr><td colspan="2"> Ning&uacute;n Catastro </td></tr>
<?php 
}
?>
	</table>

<h3>Operativos Realizados</h3>
<table>
<?php
$count_ope = 0;
foreach($operativos as $operativo){
		$ope = $operativo['Operativo'];
		++$count_ope; ?>
		<tr><td><a href="/operativos/ver/<?php echo $ope['id']; ?>">
		<?php echo $operativo['Localidad']['nombre'].", ".$operativo['Organizacion']['nombre']; ?>
		</a></td><td>
		<?php 
		echo $ope['fecha_llegada'];
		if($ope['duracion'])
			echo ", ".$ope['duracion']." d&iacute;as";
		?>
		</td></tr>
<?php
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
