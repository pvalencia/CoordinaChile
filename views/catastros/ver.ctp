
<h1> Catastro </h1>

<?php $cat = $catastro['Catastro']; ?>

<dl>

<dt>Localidad</dt>
<dd><a href="/localidades/ver/<?php echo $catastro['Localidad']['id']?>">
	<?php echo $catastro['Localidad']['nombre']?>
	</a>
</dd>

<dt>Organizaci&oacute;n</dt>
<dd><a href="/organizaciones/ver/<?php echo $catastro['Organizacion']['id']?>">
	<?php echo $catastro['Organizacion']['nombre']?>
	</a>
</dd>

<dt>Nombre Contacto</dt>
<dd> <?php echo text($cat['nombre_contacto']); ?> </dd> 

<dt>Tel&eacute;fono Contacto</dt>
<dd> <?php echo text($cat['telefono_contacto']); ?> </dd> 

<dt>Fecha</dt>
<dd> <?php echo text($cat['fecha']); ?> </dd> 

<dt>Caracterizaci&oacute;n</dt>
<dd> <?php echo text($cat['caracterizacion']); ?> </dd> 

<dt>Da&ntilde;os Graves F&iacute;sicos</dt>
<dd> <?php echo num($cat['danos_graves_fisicos']); ?> </dd> 

<dt>Da&ntilde;os Graves Psicol&oacute;gicos</dt>
<dd> <?php echo num($cat['danos_graves_psicologicos']); ?> </dd> 

<dt>Personas Con Discapacidad</dt>
<dd> <?php echo num($cat['personas_con_discapacidad']); ?> </dd> 

<dt>Enfermedades Cr&oacute;nicas</dt>
<dd> <?php echo num($cat['enfermedades_cronicas']); ?> </dd> 

<dt>Embarazadas</dt>
<dd> <?php echo num($cat['embarazadas']); ?> </dd> 

<dt>Menores</dt>
<dd> <?php echo num($cat['menores']); ?> </dd> 

<dt>Casas Destruidas</dt>
<dd> <?php echo num($cat['casas_destruidas']); ?> </dd> 

<dt>Casas Para Remoci&oacute;n de Escombros</dt>
<dd> <?php echo num($cat['casas_remocion_escombros']); ?> </dd> 

<dt>Casas Para Evaluaci&oacute;n Estructural</dt>
<dd> <?php echo num($cat['casas_evaluacion_estructural']); ?> </dd> 

<dt>Sistema Excretas</dt>
<dd> <?php echo num($cat['sistema_excretas']); ?> </dd> 

<dt>Agua</dt>
<dd> <?php echo num($cat['agua']); ?> </dd> 

<dt>Ropa</dt>
<dd> <?php echo num($cat['ropa']); ?> </dd> 

<dt>Abrigo</dt>
<dd> <?php echo num($cat['abrigo']); ?> </dd> 

<dt>Colchoneta</dt>
<dd> <?php echo num($cat['colchoneta']); ?> </dd> 

<dt>Aseo Personal</dt>
<dd> <?php echo num($cat['aseo_personal']); ?> </dd> 

<dt>Aseo General</dt>
<dd> <?php echo num($cat['aseo_general']); ?> </dd> 

<dt>Combustible</dt>
<dd> <?php echo num($cat['combustible']); ?> </dd> 

</dl>


<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}

function num($text){
	if($text)
		return $text;
	else
		return "0";
}
?>
