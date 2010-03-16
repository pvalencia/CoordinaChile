
<h1>Organizaciones</h1>

<table id="listaorganizaciones" class="ancho100">
	<tr>
		<th class="ancho25 primero alignleft">Organizaci&oacute;n</th>
		<th class="ancho25">Contacto</th>
		<th class="ancho25">Operativos</th>
		<th class="ancho25 ultimo">Catastros</th>
	</tr>
	<?php
	$i = 1;
	foreach($organizaciones as $key => $org) :
	?>
		<tr>
			<td class="ancho25 fila fila<?php echo $i; ?> primero">
				<a href="/organizaciones/ver/<?php echo $org['Organizacion']['id']; ?>"> 
					<?php echo $org['Organizacion']['nombre']; ?>
				</a>
			</td>
			<td class="ancho25 fila fila<?php echo $i; ?>">
				<?php echo $org['Organizacion']['nombre_contacto']; ?>
			</td>
			<td class="ancho25 aligncenter fila fila<?php echo $i; ?> ultimo">
				<?php echo count($org['Operativo']); ?>
			</td>
			<td class="ancho25 aligncenter fila fila<?php echo $i; ?>">
				<?php echo count($org['Catastro']); ?>
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
