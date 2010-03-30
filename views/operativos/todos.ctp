<h1>
	Operativos <?php if($area){ echo 'de '.$area; } ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa los operativos<?php if($area){ echo ' de '.$area; } ?> que las organizaciones estan realizando en estos momentos, as&iacute; como tambi&eacute;n los que ya han realizado, y los que pretenden concretar en el futuro. Haz clic en el nombre del operativo para ver su detalle. Tambi&eacute;n puedes revisar la situaci&oacute;n particular de cada localidad haciendo clic en su nombre.
	</p>
</div>

<?php if($operativos) : ?>
	<table id="listaoperativos" class="ancho100 sortable">
		<thead>
		<tr>
			<th class="ancho20 primero alignleft">Operativo</th>
			<th class="ancho20">Localidad</th>
			<th class="ancho20">Inicio</th>
			<th class="ancho20">T&eacute;rmino</th>
			<th class="ancho20 ultimo">Organizaci&oacute;n</th>
		</tr>
		</thead>
		<?php
		$i = 1;
		
	//	foreach($localidades as $localidad) :
			foreach($operativos as $operativo) :
		?>
				<tr class="fila<?php echo $i; ?>">
					<td class="ancho20 primero">
						<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['Operativo']['id']; ?>">Operativo <?php echo $operativo['Operativo']['id']; ?></a>
					</td>
					<td class="ancho20 aligncenter">
						<a href="/localidades/ver/<?php echo $operativo['Operativo']['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$operativo['Operativo']['localidad_id']]; ?>"><?php echo $localidades[$operativo['Operativo']['localidad_id']]; ?></a>
					</td>
					<td class="ancho20 aligncenter">
						<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
					</td>
					<td class="ancho20 aligncenter">
						<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
					</td>
					<td class="ancho20 ultimo aligncenter">
						<a href="/organizaciones/ver/<?php echo $operativo['Operativo']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?>"><?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?></a>
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
<?php else : ?>
	<p>
		No existen operativos<?php if($area){ echo ' de '.$area; } ?> ingresados.
	</p>
	<?php if($auth) : ?>
		<p>
			<a href="/operativos/nuevo" title="Agregar un nuevo operativo">Agregar un nuevo operativo</a>
		</p>
	<?php endif; ?>
<?php endif; ?>
<?php echo $javascript->link('sortable.js'); ?>
