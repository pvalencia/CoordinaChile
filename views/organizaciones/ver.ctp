
<?php $org = $organizacion['Organizacion']; ?>

<h1><?php echo $org['nombre']; ?></h1>
<dl>

<dt>Tipo Organizaci&oacute;n</dt>
<dd><?php echo text($organizacion['TipoOrganizacion']['nombre']); ?></dd>

<dt>Tel&eacute;fono</dt>
<dd><?php echo text($org['telefono']); ?></dd> 

<dt>E-mail</dt>
<dd><?php echo text($org['email']); ?></dd> 

<dt>P&aacute;gina Web</dt>
<dd><?php echo text($org['web']); ?></dd> 

<dt>Nombre Contacto</dt>
<dd><?php echo text($org['nombre_contacto']); ?></dd> 

<dt>Apellido Contacto</dt>
<dd> <?php echo text($org['apellido_contacto']); ?> </dd> 

<dt>Tel&eacute;fono Contacto</dt>
<dd> <?php echo text($org['telefono_contacto']); ?> </dd> 

<dt>&Aacute;reas de Trabajo</dt>
<dd> <?php echo text($org['areas_trabajo']); ?> </dd> 

</dl>

<?php if($organizacion['Catastro']){ ?>
<h2>Catastros Realizados</h2>
<table>
<?php
foreach($organizacion['Catastro'] as $key => $cat){
	echo '<tr><td><a href="/catastros/ver/'.$cat['id'].'">'; 
	echo $localidades[$cat['localidad_id']];
	echo "</a></td><td>";
	echo $cat['fecha'];
	echo '</td></tr>';
}
?>
</table>
<?php } ?>

<?php if($organizacion['Operativo']){ ?>
<h2>Operativos Realizados</h2>

<table>
<?php
foreach($organizacion['Operativo'] as $key => $ope){ ?>
	<tr><td><a href="/operativos/ver/<?php echo $ope['id']?>">
	<?php echo $ope['fecha_llegada'];
	if($ope['duracion'])
		echo ', '.$ope['duracion'].' d&iacute;as.'; ?>
	</a></td><td>
	<?php echo $localidades[$ope['localidad_id']]; ?>
	</td></tr>
<?php
}
?>
</table>
<?php } ?>

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
