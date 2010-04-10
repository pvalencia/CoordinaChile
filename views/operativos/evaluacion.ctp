<h1>
	Evaluar operativos
</h1>

<div class="bloquegrande">
	<p class="intro">
		Elija un operativo para evaluar el trabajo realizado y actualizar las necesidades por localidad. 
	</p>
</div>
<?php if(count($operativos) != 0) :?>
<table id="listaoperativos" class="ancho100">
	<thead>
	<tr>
		<th class="ancho20 primero alignleft">Operativo</th>
		<th class="ancho20">Localidades</th>
		<th class="ancho20">Inicio</th>
		<th class="ancho20">T&eacute;rmino</th>
		<th class="ancho20 ultimo">Necesidades asociadas</th>
	</tr>
	</thead>
	<?php
	$i = 1;
	foreach($operativos as $operativo) :
	
	?>
		<tr class = "fila<?php echo $i; ?>">
			<td class="ancho20 primero">
				<a href="/operativos/evaluar/<?php echo $operativo['Operativo']['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['Operativo']['id']; ?>">Operativo <?php echo $operativo['Operativo']['id']; ?></a>
			</td>
			<td class="ancho20"><?php $sep = ""; 
				foreach($operativo['Suboperativo'] as $subop):
					echo $sep.$localidades[$subop['localidad_id']]; 
					$sep = ", ";
				endforeach;
		?> </td>
			<td class="ancho20 aligncenter">
				<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
			</td>
			<td class="ancho20 aligncenter">
				<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
			</td>
			<td class="ancho20 ultimo aligncenter">
				<?php 
				$tiene_necesidades = isset($necesidades[$operativo['Operativo']['id']]);
				echo $form->input("necesidadesop".$operativo['Operativo']['id'], 
									array('type' => 'checkbox', 'label' => false, 'id' => "necesidadesop".$operativo['Operativo']['id'], 'checked' => $tiene_necesidades, 'disabled' => true));  ?>
			</td>
		</tr>
<?php
		$i = 3 - $i;
	endforeach;
	?>
</table>

<?php else: ?>
	<p>
		No existen operativos realizados sin evaluar.
	</p>
<?php endif; ?>


<?php echo $javascript->link('formulario.js'); ?>
