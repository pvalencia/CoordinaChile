
<?php $loc = $localidad['Localidad']; ?>


<h1> <?php echo $loc['nombre']; ?> </h1>

<dl>

<dt>Comuna</dt>
<dd> <?php echo text($localidad['Comuna']['nombre']); ?> </dd>

<dt>Latitud</dt>
<dd> <?php echo text($loc['lat']); ?> </dd> 

<dt>Longitud</dt>
<dd> <?php echo text($loc['lon']); ?> </dd> 

</dl>

<?php if($localidad['Catastro']){ ?>
	<h3>Catastros Realizados</h3>
	<table>
<?php
foreach($localidad['Catastro'] as $key => $cat){
	echo '<tr><td><a href="/catastros/ver/'.$cat['id'].'">'; 
	echo $cat['Organizacion']['nombre'];
	echo "</a></td><td>";
	echo $cat['fecha'];
	echo '</td></tr>';
}
?>
</table>
<?php }else{  ?>
	<h3>No posee catastros ingresados.</h3>
<?php  } ?>

<?php if($localidad['Operativo']){ ?>
<h3>Operativos Realizados</h3>

<table>
<?php
foreach($localidad['Operativo'] as $key => $ope){
	echo '<tr><td><a href="/operativo/ver/'.$ope['id'].'">'; 
	echo $ope['Organizacion']['nombre'];
	echo "</a></td><td>";
	echo $ope['fecha_llegada'];
	if($ope['duracion'])
		echo ", ".$ope['duracion']."d&iacute;as";
	echo '</td></tr>';
}
?>
</table>
<?php }else{  ?>
	<h4>No posee operativos ingresados.</h4>
<?php  } 


function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
