<h1>
	Catastros
</h1>

<table id="listacatastros" class="ancho100">
	<tr>
		<th class="ancho25 primero alignleft">Catastro</th>
		<th class="ancho25">Localidad</th>
		<th class="ancho25">Realizaci&oacute;n</th>
		<th class="ancho25 ultimo">Organizaci&oacute;n</th>
	</tr>
	<?php
	$i = 1;
	
	foreach($localidades as $localidad) :
		foreach($localidad['Catastro'] as $catastro) :
	?>
			<tr>
				<td class="ancho25 fila<?php echo $i; ?> primero">
					<a href="/catastros/ver/<?php echo $catastro['id']; ?>">Catastro <?php echo $catastro['id']; ?></a>
				</td>
				<td class="ancho25 fila<?php echo $i; ?> aligncenter">
					<a href="/localidades/ver/<?php echo $localidad['Localidad']['id']; ?>"><?php echo $localidad['Localidad']['nombre']; ?></a>
				</td>
				<td class="ancho25 fila<?php echo $i; ?> aligncenter">
					<?php echo $time->format('d-m-Y', $catastro['fecha']); ?>
				</td>
				<td class="ancho25 fila<?php echo $i; ?> ultimo aligncenter">
					<a href="/organizaciones/ver/<?php echo $catastro['organizacion_id']; ?>"><?php echo $organizaciones[$catastro['organizacion_id']]; ?></a>
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