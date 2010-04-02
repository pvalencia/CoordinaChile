<?php $paginator->options(
	array('update'=>'paginar_catastros',
		'indicator' => 'loading'));
?>
<table id="listacatastros" class="ancho100">
		<thead>
		<tr>
			<th class="ancho25 primero alignleft"><?php echo $paginator->sort('Catastro', 'id'); ?></th>
			<th class="ancho25"><?php echo $paginator->sort('Localidad', 'Localidad.nombre'); ?></th>
			<th class="ancho25"><?php echo $paginator->sort('Realización', 'fecha'); ?></th>
			<th class="ancho25 ultimo"><?php echo $paginator->sort('Organizacion', 'Organizacion.nombre'); ?></th>
		</tr>
		</thead>
		<?php
		$i = 1;
		
		foreach($catastros as $catastro) :		?>
			<tr class="fila<?php echo $i; ?>">
				<td class="ancho25 primero">
					<a href="/catastros/ver/<?php echo $catastro['Catastro']['id']; ?>" title="Ver el detalle del Catastro <?php echo $catastro['Catastro']['id']; ?>">Catastro <?php echo $catastro['Catastro']['id']; ?></a>
				</td>
				<td class="ancho25 aligncenter">
					<a href="/localidades/ver/<?php echo $catastro['Catastro']['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$catastro['Catastro']['localidad_id']]; ?>"><?php echo $localidades[$catastro['Catastro']['localidad_id']]; ?></a>
				</td>
				<td class="ancho25 aligncenter">
					<?php echo $time->format('d-m-Y', $catastro['Catastro']['fecha']); ?>
				</td>
				<td class="ancho25 ultimo aligncenter">
					<a href="/organizaciones/ver/<?php echo $catastro['Catastro']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?>"><?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?></a>
				</td>
			</tr>
		<?php
			$i = 3 - $i;
		endforeach;
		?>
	</table>
		<?php
			//echo $paginator->first('« Comienzo ', null, null, array());
			echo $paginator->prev(' « Anterior ', null, null, array());
			echo $paginator->counter(array('format' => '%page% de %pages%'));
			echo $paginator->next(' Siguiente » ', null, null, array());
			//echo $paginator->last(' Fin »', null, null, array());
		?> 
