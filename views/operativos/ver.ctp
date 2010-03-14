<h1>
	<?php echo "Operativo ".$operativo['Organizacion']['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>

	<div class="input text">
		<div class="label ancho33">Localidad</div><?php echo $operativo['Localidad']['nombre']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Fecha de llegada</div><?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Duración (d&iacute;as)</div><?php echo $operativo['Operativo']['duracion']; ?>
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
				<th class="ancho15">Cantidad</td>
				<th class="ancho35 ultimo">Caracter&iacute;stica</td>
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
