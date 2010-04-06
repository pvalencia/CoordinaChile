<h1>
	Evaluaci&oacute;n del operativo <?php echo $operativo['Operativo']['id'];?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Ingresa al sistema los resultados logrados por el operativo, para actualizar la informaci&oacute;n de las localidades visitadas. 
	</p>
	<div class="intro">
	Indica para cada necesidad si su estado posterior al operativo es 
		<ul>
		<li><strong>RESUELTO</strong>: El problema fue abordado en su totalidad y ya no necesita preocupaci&oacute;n. </li>
		<li><strong>INCOMPLETO</strong>: El problema fue abordado, pero a&uacute;n existe un 'remanente' menor o igual al que encontraron.</li>
		<li><strong>PENDIENTE</strong>: El problema no se pudo abordar o bien se debe seguir cubriendo en su totalidad en operativos futuros.</li>
		</ul>
	</div>
	<h2>
		Informaci&oacute;n general
	</h2>
	<div class="input text">
		<div class="label ancho33">Fecha de inicio</div><?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
	</div>
	<div class="input text">
		<?php
		if($operativo['Operativo']['duracion'] > 1)
			$dias_texto = $operativo['Operativo']['duracion'].' d&iacute;as';
		else
			$dias_texto = $operativo['Operativo']['duracion'].' d&iacute;a';
		?>
		<div class="label ancho33">Fecha de t&eacute;rmino</div><?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?> (<?php echo $dias_texto; ?>)
	</div>
</div>


<?php echo $form->create('Evaluacion', array('controller' => 'operativos', 'action' => 'evaluacion')); ?>

<!-- BEGIN CARPETAS -->
<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
		<?php	$l = 0;
			foreach($operativo['Suboperativo'] as $suboperativo): 
				$localidad_id = $suboperativo['localidad_id'];
			?>
			<li class="lengueta<?php if($l==0) echo ' active';?>" id="lengueta<?php echo $l; ?>">
				<a href="#" title="<?php echo $localidades[$localidad_id]['nombre'];?>"><?php echo $localidades[$localidad_id]['nombre'];?></a>
			</li>
		<?php ++$l; 
			endforeach; ?>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta" class="bloque">
<?php $l = 0; 
	$options = array('RESUELTO' => 'RESUELTO', 'INCOMPLETO' => 'INCOMPLETO', 'PENDIENTE' => 'PENDIENTE');
	foreach($operativo['Suboperativo'] as $suboperativo): ?>
		<div class="lengueta<?php echo $l;?> carpeta <?php echo ($l==0?'active':'oculto');?>">
		<?php 
		if(array_key_exists('Necesidad', $suboperativo) && count($suboperativo['Necesidad']) > 0): ?>
			<div class="bloque">
				<h3>
					Necesidades que se busc&oacute; cubrir
				</h3>
			</div>
		
			<div class="bloque">
			<table class="ancho100">
				<tr>
					<th class="ancho15 primero aligncenter">&Aacute;rea</th>
					<th class="ancho25">&Iacute;tem</th>
					<th class="ancho15">Cantidad</th>
					<th class="ancho25">Estado</th>
					<th class="ancho20 ultimo">Remanente</th>
				</tr>
				<?php 
				$i = 1;
				foreach($suboperativo['Necesidad'] as $necesidad): 	
					$id = $necesidad['id'];
					?>
					<tr class="fila<?php echo $i;?>">
						<td class="primero aligncenter">
							<?php echo $areas[$necesidad['TipoNecesidad']['area_id']]; ?>
						</td>
						<td>
							<?php echo $necesidad['TipoNecesidad']['nombre']; ?>
						</td>
						<td class="aligncenter">
							<?php echo $necesidad['cantidad']; ?>
						</td>
						<td class="aligncenter">
							<?php echo $form->input("Evaluacion.previas.$id.status", array('type' => 'select', 'class' => 'input-select necesidad previa', 'label' => false, 'options' => $options)); ?>
						</td>
						<td class="ultimo aligncenter">
							<?php echo $form->input("Evaluacion.previas.$id.remanente", array('type' => 'text', 'class' => 'input-text necesidad nueva', 'label' => false, 'value' => '0')); ?>
						</td>
					</tr>
			<?php	$i = 3 - $i;
			endforeach; ?>
			</table>
			</div>
	<?php endif;
		if(array_key_exists('Necesidad', $localidades[$suboperativo['localidad_id']])): ?>
			<div class="bloque">
				<h3>
					Otras necesidades no resueltas de la localidad
				</h3>
		
				<div class="bloque">
				<table class='ancho100 sortable' id='tablenecesidades<?php echo $suboperativo['localidad_id']; ?>'>
				<thead>
					<tr>
						<th class='ancho15 primero aligncenter'>&Aacute;rea</th>
						<th class='ancho40'>Elemento</th>
						<th class='ancho25'>Estado</th>
						<th class='ancho20 ultimo'>Remanente</th>
					</tr>
				</thead>
				<?php $i = 1;
				foreach($localidades[$suboperativo['localidad_id']]['Necesidad'] as $necesidad): 
					$key = $necesidad['id'];
					$label = $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['cantidad'];
					if($necesidad['caracteristica'])
						$label.= "<br /> &nbsp; &nbsp; &nbsp;(".$necesidad['caracteristica'].")"; ?>

					<tr class="fila<?php echo $i;?>">
						<td class="primero aligncenter"><?php echo $areas[$necesidad['TipoNecesidad']['area_id']]?></td>
						<td>
					<?php 
						echo $form->input("Evaluacion.nuevas.$id.id", array('type' => 'hidden', 'value' => $key));
						echo $form->input("Evaluacion.nuevas.$id.checked", 
									array('type' => 'checkbox', 'label' => $label, 'id' => 'necesidad-'.$id, 'class' => 'input-checkbox necesidad nueva')); 
					?>
						</td>
						<td class="aligncenter">
							<?php echo $form->input("Evaluacion.previas.$id.estado", array('type' => 'select', 'class' => 'input-select necesidad nueva', 'label' => false, 'options' => $options, 'selected' => 'PENDIENTE')); ?>
						</td>
						<td class="ultimo aligncenter">
							<?php echo $form->input("Evaluacion.previas.$id.remanente", array('type' => 'text', 'class' => 'input-text necesidad nueva', 'label' => false, 'value' => $necesidad['cantidad'])); ?>
						</td>
					</tr>
					<?php $i = 3 - $i; ?>
				<?php endforeach; ?>
				</table>
				</div>
			</div>
	<?php endif; ?>
		
		</div>
	<?php
		$l++;
	endforeach;
	?>
	</div>	

</div>
<?php echo $javascript->link('formulario.js'); ?>
