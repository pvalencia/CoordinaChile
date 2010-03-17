<h1>
	Operativos <?php if($area){ echo "&Aacute;rea ".$area; } ?>
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
	
//	foreach($localidades as $localidad) :
		foreach($operativos as $operativo) :
	?>
			<tr>
				<td class="ancho20 fila<?php echo $i; ?> primero">
					<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>">Operativo <?php echo $operativo['Operativo']['id']; ?></a>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<a href="/localidades/ver/<?php echo $operativo['Operativo']['localidad_id']; ?>"><?php echo $localidades[$operativo['Operativo']['localidad_id']]; ?></a>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> aligncenter">
					<?php echo $time->format('d-m-Y', fechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
				</td>
				<td class="ancho20 fila<?php echo $i; ?> ultimo aligncenter">
					<a href="/organizaciones/ver/<?php echo $operativo['Operativo']['organizacion_id']; ?>"><?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?></a>
				</td>
			</tr>
			
	<?php
			if($i == 1)
				$i = 2;
			else
				$i = 1;
		endforeach;
	//endforeach;
	?>
</table>
