
<?php $org = $organizacion['Organizacion']; ?>

<h1>
	<?php echo $org['nombre']; ?>
</h1>

<ul id="listaorganizacion">
	<li>Tipo Organizaci&oacute;n: <?php echo text($organizacion['TipoOrganizacion']['nombre']); ?></li>
	<li>Tel&eacute;fono: <?php echo text($org['telefono']); ?></li> 
	<li>E-mail: <?php echo text($org['email']); ?></li> 
	<li>P&aacute;gina Web: <?php echo text($org['web']); ?></li> 
	<li>Nombre Contacto: <?php echo text($org['nombre_contacto']); ?></li> 
	<li>Apellido Contacto: <?php echo text($org['apellido_contacto']); ?></li> 
	<li>Tel&eacute;fono Contacto: <?php echo text($org['telefono_contacto']); ?></li> 
	<li>&Aacute;reas de Trabajo: <?php echo text($org['areas_trabajo']); ?></li> 
</ul>

<?php if($organizacion['Catastro']) : ?>
	<h2>Catastros Realizados</h2>
	
	<table id="listacatastros" class="ancho50">
		<tr>
			<th class="ancho50 columna columna1 primero">Fecha</th>
			<th class="ancho50 columna columna2 ultimo">Localidad</th>
		</tr>
		<?php
		$i = 1;
		foreach($organizacion['Catastro'] as $key => $cat) :
		?>
			<tr>
				<td class="ancho50 fila fila<?php echo $i; ?> columna columna1 primero">
					<?php echo $cat['fecha']; ?>
				</td>
				<td class="ancho50 fila fila<?php echo $i; ?> columna columna2 ultimo">
					<a href="/catastros/ver/<?php echo $cat['id']; ?>">
						<?php echo $localidades[$cat['localidad_id']]; ?>
					</a>
				</td>
			</tr>
		<?php
			if($i == 1)
				$i = 2;
			else
				$i = 1;
		endforeach;
		?>
	</table>
<?php endif; ?>

<?php if($organizacion['Operativo']) :?>
	<h2>Operativos realizados</h2>

	<table id="listaoperativos" class="ancho50">
		<tr>
			<th class="ancho33 columna columna1 primero">Fecha</th>
			<th class="ancho33 columna columna2">Localidad</th>
			<th class="ancho33 columna columna3 ultimo">Duraci&oacute;n (d&iacute;as)</th>
		</tr>
		<?php
		$i = 1;
		foreach($organizacion['Operativo'] as $key => $ope) :
		?>
			<tr>
				<td class="ancho33 fila fila<?php echo $i; ?> columna columna1 primero aligncenter">
					<?php echo $ope['fecha_llegada']; ?>
				</td>
				<td class="ancho33 fila fila<?php echo $i; ?> columna columna2 aligncenter">
					<a href="/catastros/ver/<?php echo $ope['id']; ?>">
						<?php echo $localidades[$ope['localidad_id']]; ?>
					</a>
				</td>
				<td class="ancho33 fila fila<?php echo $i; ?> columna columna3 ultimo">
					<?php echo $ope['duracion']; ?>
				</td>
			</tr>
		<?php
			if($i == 1)
				$i = 2;
			else
				$i = 1;
		endforeach;
		?>
	</table>
<?php endif; ?>

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
