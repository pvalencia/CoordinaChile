<h1>
	Operativos
</h1>

<table id="listaoperativos" class="ancho100">
	<tr>
		<th class="ancho20 primero alignleft">Operativo</th>
		<th class="ancho20">Localidad</th>
		<th class="ancho20">Inicio</th>
		<th class="ancho20">T&eacute;rmino</th>
		<th class="ancho20 ultimo">Organizaci&oacute;n</th>
	</tr>
	<?php
	$i = 1;
	
	foreach($localidades as $localidad) :
		foreach($localidad['Operativo'] as $operativo) :
	?>
			<tr>
				<td class="ancho20 fila<?php echo $i; ?> primero">
					<a href="/operativos/ver/<?php echo $operativo['id']; ?>">Operativo <?php echo $operativo['id']; ?></a>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<a href="/localidades/ver/<?php echo $localidad['Localidad']['id']; ?>"><?php echo $localidad['Localidad']['nombre']; ?></a>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<?php echo $time->format('d-m-Y', $operativo['fecha_llegada']); ?>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<?php echo $time->format('d-m-Y', fechaFin($operativo['fecha_llegada'], $operativo['duracion'])); ?>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> ultimo aligncenter">
					<a href="/organizaciones/ver/<?php echo $operativo['organizacion_id']; ?>"><?php echo $organizaciones[$operativo['organizacion_id']]; ?></a>
				</td>
			</tr>
			
	<?php
			if($i == 1)
				$i = 2;
			else
				$i = 1;
		endforeach;
	endforeach;
	?>
</table>
