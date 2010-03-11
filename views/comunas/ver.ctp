
<?php $com = $comuna['Comuna']; ?>


<h1> <?php echo $com['nombre']; ?> </h1>

<dl>

<dt>Latitud</dt>
<dd> <?php echo text($com['lat']); ?> </dd> 

<dt>Longitud</dt>
<dd> <?php echo text($com['lon']); ?> </dd> 

</dl>

<?php if($comuna['Catastro']){ ?>
	<h3>Catastros Realizados</h3>
	<table>
	<?php
	foreach($comuna['Catastro'] as $key => $cat){ ?>
		<tr><td><a href="/catastros/ver/<?php echo $cat['id']?>"> 
		echo $cat['Organizacion']['nombre']; ?>
		</a></td><td>
		<?php echo $cat['fecha']; ?>
		</td></tr>
<?php
	}
?>
	</table>
<?php }else{  ?>
	<h4>No posee catastros ingresados.</h4>
<?php  } ?>

<?php if($comuna['Operativo']){ ?>
<h4>Operativos Realizados</h4>

<table>
<?php
foreach($comuna['Operativo'] as $key => $ope){ ?>
	<tr><td><a href="/operativo/ver/<?php echo $ope['id']; ?>">
	<?php echo $ope['Organizacion']['nombre']; ?>
	</a></td><td>
	<?php 
	echo $ope['fecha_llegada'];
	if($ope['duracion'])
		echo ", ".$ope['duracion']." d&iacute;as";
	?>
	</td></tr>;
<?php
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
