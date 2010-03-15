<h1>
	Catastros
</h1>

<table id="listacatastros" class="ancho100">
	<tr>
		<th class="ancho25 primero alignleft valigntop">Localidad</th>
		<th class="ancho25">Catastro</th>
		<th class="ancho25">Fecha</th>
		<th class="ancho25">Organizaci&oacute;n</th>
	</tr>
	<?php
	$i = 1;
	$j = 1;
	
	foreach($localidades as $localidad) :
		$class_fila = '';
		if($j == 1)
			$class_fila = ' primero';
		elseif($j == count($localidades))
			$class_fila = ' ultimo';
	?>
		<tr>
			<td class="ancho25<?php echo $class_fila; ?> fila<?php echo $i; ?>" rowspan="<?php echo count($localidad['Catastro']); ?>">
				<a href="/localidades/ver/<?php echo $localidad['Localidad']['id']; ?>"><?php echo $localidad['Localidad']['nombre']; ?></a>
			</td>
			<td class="ancho25<?php echo $class_fila; ?> fila<?php echo $i; ?> aligncenter">
				<?php
				$k = 1;
				
				foreach($localidad['Catastro'] as $catastro) :
				?>
					<a href="/catastros/ver/<?php echo $catastro['id']; ?>">Catastro <?php echo $k; ?></a><br/>
				<?php
					$k++;
				endforeach;
				?>
			</td>
			<td class="ancho25<?php echo $class_fila; ?> fila<?php echo $i; ?> aligncenter">
				<?php
				foreach($localidad['Catastro'] as $catastro) :
					echo $time->format('d-m-Y', $catastro['fecha']).'<br/>';
				endforeach;
				?>
			</td>
			<td class="ancho25<?php echo $class_fila; ?> fila<?php echo $i; ?> aligncenter">
				<a href="/organizaciones/ver/<?php echo $catastro['organizacion_id']; ?>"><?php echo $organizaciones[$catastro['organizacion_id']]; ?></a>
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

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
