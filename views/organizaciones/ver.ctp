
<fieldset>
<legend>Organizaci&oacute;n</legend> 
<dl>
<?php $org = $organizacion['Organizacion']; ?>

<dt>Nombre</dt>
<dd> <?php echo $org['nombre']; ?> </dd>

<dt>Tipo Organizaci&oacute;n</dt>
<dd> <?php echo text($organizacion['TipoOrganizacion']['nombre']); ?> </dd>

<dt>Tel&eacute;fono</dt>
<dd> <?php echo text($org['telefono']); ?> </dd> 

<dt>E-mail</dt>
<dd> <?php echo text($org['email']); ?> </dd> 

<dt>P&aacute;gina Web</dt>
<dd> <?php echo text($org['web']); ?> </dd> 

<dt>Nombre Contacto</dt>
<dd> <?php echo text($org['nombre_contacto']); ?> </dd> 

<dt>Apellido Contacto</dt>
<dd> <?php echo text($org['apellido_contacto']); ?> </dd> 

<dt>Tel&eacute;fono Contacto</dt>
<dd> <?php echo text($org['telefono_contacto']); ?> </dd> 

<dt>&Aacute;reas de Trabajo</dt>
<dd> <?php echo text($org['areas_trabajo']); ?> </dd> 

</dl>

<?php if($organizacion['Catastro']){ ?>
<h3>Catastros Realizados</h3>
<table>
<?php
foreach($organizacion['Catastro'] as $key => $cat){
	echo '<tr><td><a href="/catastros/ver/"'.$cat['id'].'>'; 
	echo $cat['localidad'];
	echo "</a></td><td>";
	echo $cat['fecha'];
	echo '</td></tr>';
}
?>
</table>
<?php } ?>

<?php if($organizacion['Operativo']){ ?>
<h3>Operativos Realizados</h3>

<table>
<?php
foreach($organizacion['Operativo'] as $key => $ope){
	echo '<tr><td><a href="/operativo/ver/"'.$ope['id'].'>'; 
	echo $ope['fecha_llegada'];
	echo "</a></td><td>";
	echo $ope['duracion'];
	echo '</td></tr>';
}
?>
</table>
<?php } ?>


</fieldset>
<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
