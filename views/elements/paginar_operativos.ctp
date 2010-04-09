<?php $paginator->options(
	array('update'=>'paginar_operativos',
		'indicator' => 'loading'));
	echo $paginator->options(array('url' => $this->passedArgs));
?>
<?php if(count($operativos) != 0) :?>
<table id="listaoperativos<?php echo $tipo;?>" class="ancho100">
	<thead>
	<tr>
		<th class="ancho20 primero alignleft"><?php echo $paginator->sort('Operativo', 'id'); ?></th>
		<th class="ancho20"><?php echo $paginator->sort('Comuna', 'Comuna.nombre'); ?></th>
		<th class="ancho20"><?php echo $paginator->sort('Inicio', 'fecha_llegada'); ?></th>
		<th class="ancho20">T&eacute;rmino</th>
		<th class="ancho20 ultimo"><?php echo $paginator->sort('Organización', 'Organizacion.nombre'); ?></th>
	</tr>
	</thead>
	<?php
	$i = 1;
	foreach($operativos as $operativo) :
	
	?>
		<tr class = "fila<?php echo $i; ?>">
			<td class="ancho20 primero">
				<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['Operativo']['id']; ?>">Operativo <?php echo $operativo['Operativo']['id']; ?></a>
			</td>
			<td class="ancho20 aligncenter">
				<a href="/comunas/ver/<?php echo $operativo['Operativo']['comuna_id']; ?>" title="Ver el detalle de la comuna de <?php echo $comunas[$operativo['Operativo']['comuna_id']]; ?>"><?php echo $comunas[$operativo['Operativo']['comuna_id']]; ?></a>
			</td>
			<td class="ancho20 aligncenter">
				<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
			</td>
			<td class="ancho20 aligncenter">
				<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
			</td>
			<td class="ancho20 ultimo aligncenter">
				<?php $oid = $operativo['Operativo']['organizacion_id']; ?>
				<a href="/organizaciones/ver/<?php echo $oid; ?>" title="Ver el perfil de <?php echo $organizaciones[$oid]; ?>"><?php echo $organizaciones[$oid]; ?></a>
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

<?php else: ?>
	<p>
		No existen operativos <?php echo $tipo; ?>.
	</p>
<?php endif; ?>
