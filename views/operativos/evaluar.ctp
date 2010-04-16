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


<?php echo $form->create('Operativo', array('url' => array('action' => 'evaluar', $operativo['Operativo']['id'])) ); ?>

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
	foreach($operativo['Suboperativo'] as $suboperativo): 
		$localidad_id = $suboperativo['localidad_id'];
			/*DATOS POSIBLE NUEVO CATASTRO*/
		echo $form->input("Catastro.$l.localidad_id", array('type' => 'hidden', 'value' => $localidad_id));
		$time_fin =  strtotime($operativo['Operativo']['fecha_llegada'])+(($operativo['Operativo']['duracion']-1)*24*60*60);
		echo $form->input("Catastro.$l.fecha.month", array('type' => 'hidden', 'value' => date('m', $time_fin)));
		echo $form->input("Catastro.$l.fecha.day", array('type' => 'hidden', 'value' => date('d', $time_fin)));
		echo $form->input("Catastro.$l.fecha.year", array('type' => 'hidden', 'value' => date('Y', $time_fin)));
		
		if(isset($suboperativo['nombre']) && $suboperativo['nombre'] && $suboperativo['telefono'] && $suboperativo['email']){
			echo $form->input("Catastro.$l.nombre_contacto", array('type' => 'hidden', 'value' => $suboperativo['nombre']));
			echo $form->input("Catastro.$l.telefono_contacto", array('type' => 'hidden', 'value' => $suboperativo['telefono']));
			echo $form->input("Catastro.$l.email_contacto", array('type' => 'hidden', 'value' => $suboperativo['email']));
		}else{
			echo $form->input("Catastro.$l.nombre_contacto", array('type' => 'hidden', 'value' => $operativo['Operativo']['nombre']));
			echo $form->input("Catastro.$l.telefono_contacto", array('type' => 'hidden', 'value' => $operativo['Operativo']['telefono']));
			echo $form->input("Catastro.$l.email_contacto", array('type' => 'hidden', 'value' => $operativo['Operativo']['email']));
		}
			/*****************************/
		echo $form->input("Suboperativo.$l.id", array('value' => $suboperativo['id'], 'type' => 'hidden'));

		?>
		<div class="lengueta<?php echo $l;?> carpeta <?php echo ($l==0?'active':'oculto');?>">
		<?php 
		if(array_key_exists('Necesidad', $suboperativo) && count($suboperativo['Necesidad']) > 0): ?>
			<div class="bloque">
				<h3>
					Necesidades que se busc&oacute; cubrir
				</h3>
			</div>
		
			<div class="bloque">
			<table class="ancho100 sortable tablenecesidades<?php echo $localidad_id; ?>1">
				<tr>
					<th class="ancho10 primero aligncenter">&Aacute;rea</th>
					<th class="ancho30">&Iacute;tem</th>
					<th class="ancho10">Cantidad</th>
					<th class="ancho20">Estado</th>
					<th class="ancho10 ultimo">Remanente</th>
					<th class="ancho20 ultimo">Caracter&iacute;sticas pendientes</th>
				</tr>
				<?php 
				$i = 1;
				foreach($suboperativo['Necesidad'] as $necesidad): 			//Necesidades del suboperativo
					$necesidad_id = $necesidad['id'];
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
							<?php echo $form->input("Asignadas.$l.$necesidad_id.status", array('type' => 'select', 'class' => 'input-select necesidad asignada', 'label' => false, 'options' => $options)); ?>
						</td>
						<td class="aligncenter">
							<?php echo $form->input("Asignadas.$l.$necesidad_id.cantidad", array('class' => 'text-input necesidad asignada remanente ', 'label' => '', 'default' => '0')); ?>
						</td>
						<td class="ultimo">
							<?php echo $form->input("Asignadas.$l.$necesidad_id.caracteristica", array('class' => 'input-text asignada', 'label' => false)); ?>
						</td>
					</tr>
			<?php	$i = 3 - $i;
			endforeach; ?>
			</table>
			</div>
	<?php endif;
		if(array_key_exists('Necesidad', $localidades[$localidad_id])): ?>
			<div class="bloque">
				<h3>
					Otras necesidades no resueltas de la localidad
					<?php echo $form->input("Suboperativo.$l.existentes_checkbox", array('type' => 'checkbox', 'class' => 'input-checkbox showit', 'id' => 'bloque-existentes'.$localidad_id, 'label' => false, 'div' => false))?>
				</h3>
		
				<div class="bloque bloque-existentes<?php echo $localidad_id; ?> oculto toshow">
				<table class="ancho100 sortable" id="tablenecesidades<?php echo $localidad_id; ?>2">
				<thead>
					<tr>
						<th class="ancho10 primero aligncenter">&Aacute;rea</th>
						<th class='ancho50'>Elemento</th>
						<th class='ancho20'>Estado</th>
						<th class='ancho10'>Remanente</th>
						<th class="ancho10 ultimo">Caracter&iacute;sticas pendientes</th>
					</tr>
				</thead>
				<?php $i = 1;
				foreach($localidades[$localidad_id]['Necesidad'] as $necesidad): 		//necesidades de la localidad
					$necesidad_id = $necesidad['id'];
					$label = $necesidad['TipoNecesidad']['nombre'].": ".$necesidad['cantidad'];
					if($necesidad['caracteristica'])
						$label.= "<br /> &nbsp; &nbsp; &nbsp;(".$necesidad['caracteristica'].")"; ?>

					<tr class="fila<?php echo $i;?>">
						<td class="primero aligncenter"><?php echo $areas[$necesidad['TipoNecesidad']['area_id']]?></td>
						<td>
					<?php 
						echo $form->input("Existentes.$l.$necesidad_id.id", array('type' => 'hidden', 'value' => $necesidad_id));
						echo $form->input("Existentes.$l.$necesidad_id.checked", 
									array('type' => 'checkbox', 'label' => $label, 'id' => 'necesidad-'.$necesidad_id, 'class' => 'input-checkbox necesidad existente')); 
					?>
						</td>
						<td class="aligncenter">
							<?php echo $form->input("Existentes.$l.$necesidad_id.status", array('type' => 'select', 'class' => 'input-select necesidad existente', 'label' => false, 'options' => $options, 'selected' => 'PENDIENTE')); ?>
						</td>
						<td class="aligncenter">
							<?php echo $form->input("Existentes.$l.$necesidad_id.cantidad", array('class' => 'input-text remanente necesidad existente', 'label' => false, 'default' => $necesidad['cantidad'])); ?>
						</td>
						<td class="ultimo">
							<?php echo $form->input("Existentes.$l.$necesidad_id.caracteristica", array('class' => 'input-text existente', 'label' => false)); ?>
						</td>
					</tr>
					<?php $i = 3 - $i; ?>
				<?php endforeach; ?>
				</table>
				</div>
			</div>
	<?php endif; ?>
		
			<div class="bloque">
				<h3>
					Agregar necesidades pendientes descubiertas tras el operativo
					<?php echo $form->input("Suboperativo.$l.nuevas_checkbox", array('type' => 'checkbox', 'class' => 'input-checkbox showit', 'id' => 'bloque-nuevas'.$localidad_id, 'label' => false, 'div' => false))?>
				</h3>
		
				<div class="bloque bloque-nuevas<?php echo $localidad_id;?> toshow oculto">
				<?php
					foreach($areas as $area_id => $area):
						echo $form->input("Nuevas.$l.$area_id", array(
							'type' => 'checkbox',
							'label' => $area,
							'id' => 'showitnuevas'.$l.'-'.$area_id,
							'class' => 'input-checkbox showit',
							'div' => array('style' => 'display:inline; margin-right:40px; white-space:nowrap;')  ));
						echo " ";
					endforeach;
				?>
				</div>
			</div>
	
			<?php
			foreach($areas as $area_id => $area) :
			?>
				<div class="toshow showitnuevas<?php echo $l.'-'.$area_id; ?> bloque oculto">
					<h3>
						<?php echo $area; ?>
					</h3>
					<table class="ancho100">
						<tr>
							<th class="ancho50 primero alignleft">&Iacute;tem</th>
							<th class="ancho15 ultimo">Cantidad</th>
							<th class="ancho35 ultimo">Caracter&iacute;stica</th>
						</tr>
					<?php
					$i = 1;
					foreach($tipos as $tipo) :
						if($area_id == $tipo['TipoNecesidad']['area_id'] ) :
					?>
						<tr>
							<td class="ancho50 fila<?php echo $i;?> primero">
								<?php 
								echo $form->input("Nuevas.$l.".$tipo['TipoNecesidad']['id'].'.tipo_necesidad_id', array('value' => $tipo['TipoNecesidad']['id'], 'type' => 'hidden')); 
								echo $tipo['TipoNecesidad']['nombre']; 
								?>
								<br/>
								<small>
									<?php echo $tipo['TipoNecesidad']['descripcion']; ?>
								</small>
							</td>
							<td class="ancho15 fila<?php echo $i;?> ultimo aligncenter">
								<?php echo $form->input("Nuevas.$l.".$tipo['TipoNecesidad']['id'].'.cantidad', array('class' => 'text-input cantidad', 'default' => 0, 'label' => ''));		?>
							</td>
							<td class="ancho35 fila<?php echo $i;?> ultimo">
								<?php echo $form->text("Nuevas.$l.".$tipo['TipoNecesidad']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25)); ?>
							</td>
						</tr>
					<?php
						$i = 3 - $i;		//cambiar entre i=2 e i=1.
						endif;
					endforeach;
					?>
					</table>
				</div>
			<?php
			endforeach;	?>
			</div>
	<?php
		$l++;
	endforeach;
	?>
	</div>	

</div>

<?php echo $form->submit('Enviar evaluación', array('class' => 'input-button')); ?>

<?php echo $form->end(); ?>
<?php echo $javascript->link('formulario.js'); ?>
