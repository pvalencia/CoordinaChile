<?php
	if($operativo['Organizacion']['id'] == $user['Organizacion']['id'] || $user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/operativos/editar/<?php echo $operativo['Operativo']['id']; ?>" title="Editar los datos del Operativo <?php echo $operativo['Operativo']['id']; ?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	Operativo <?php echo $operativo['Operativo']['id']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>

	<div class="input text">
			<div class="label ancho33">Regi&oacute;n</div><?php echo $regiones->getHtmlName($comuna['Comuna']['id'], true); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Comuna</div><a href="/comunas/ver/<?php echo $comuna['Comuna']['id']?>" title="Ver el detalle de la comuna de <?php echo $comuna['Comuna']['nombre'] ?>"><?php echo $comuna['Comuna']['nombre']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Localidad</div><a href="/localidades/ver/<?php echo $operativo['Localidad']['id']; ?>" title="Ver el detalle de la localidad de <?php echo $operativo['Localidad']['nombre']; ?>"><?php echo $operativo['Localidad']['nombre']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Fecha de inicio</div><?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
	</div>
	<div class="input text">
		<?php
		if($operativo['Operativo']['duracion'] > 1)
			$dias_texto = $operativo['Operativo']['duracion'].' d&iacute;as';
		else
			$dias_texto = $operativo['Operativo']['duracion'].' d&iacute;a';
		?>
		<div class="label ancho33">Fecha de t&eacute;rmino</div><?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?> (<?php echo $dias_texto; ?>)
	</div>
	<div class="input text">
		<div class="label ancho33">Organizaci&oacute;n</div><a href="/organizaciones/ver/<?php echo $operativo['Organizacion']['id']; ?>" title="Ver el perfil de <?php echo $operativo['Organizacion']['nombre']; ?>"><?php echo $operativo['Organizacion']['nombre']; ?></a>
	</div>
</div>

<?php if($auth) : ?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n del encargado
		</h2>
		
		<div class="input text">
			<div class="label ancho33">Nombre</div><?php echo $operativo['Operativo']['nombre']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Tel&eacute;fono</div><?php echo $operativo['Operativo']['telefono']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Correo electr&oacute;nico</div><?php echo $text->autoLink($operativo['Operativo']['email'], array('title' => 'Contactar a '.$operativo['Operativo']['nombre'])); ?>
		</div>
	</div>
	
	<div class="bloque">
		<h2>
			Informaci&oacute;n espec&iacute;fica
		</h2>
	</div>
	
	<?php 
	foreach($recursos as $area => $recs): 
		if(count($recs) <= 0)
			continue;
		?>
		<div class="bloque">
			<h3>
				<?php echo $areas[$area]; ?>
			</h3>
	
			<table class="ancho100">
				<tr>
					<th class="ancho50 primero alignleft">&Iacute;tem</th>
					<th class="ancho15">Cantidad</th>
					<th class="ancho35 ultimo">Caracter&iacute;stica</th>
				</tr>
				<?php
				$i = 1;
				
				foreach($recs as $rec):
				?>
					<tr>
						<td class="ancho50 primero fila<?php echo $i; ?>">
							<?php echo $rec['TipoRecurso']['nombre']; ?>
						</td>
						<td class="ancho15 fila<?php echo $i; ?> aligncenter">
							<?php echo $rec['Recurso']['cantidad']; ?>
						</td>
						<td class="ancho35 ultimo fila<?php echo $i; ?>">
							<?php echo $rec['Recurso']['caracteristica']; ?>
						</td>
					</tr>
				<?php
					if($i == 1)
						$i = 2;
					else
						$i = 1;
				endForeach;
				?>
			</table>
		</div>
	<?php endForeach; ?>
<?php endif; ?>
