<h1>
	Agregar operativo
</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'operativos', 'action' => 'agregar', $organizacion['Organizacion']['id']))); ?>

	<h2>
		Datos principales
	</h2>

	<?php 
		echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
		echo $form->input('Operativo.fecha_llegada', array('class' => 'input-text', 'label' => 'Fecha llegada'));
		echo $form->input('Operativo.duracion', array('class' => 'input-text', 'label' => 'Duraci&oacute;n'));
		echo $form->input('Operativo.localidad_id', array('class' => 'input-text', 'label' => 'Localidad'));
	?>

	<h2>
		Recursos
	</h2>
	
	<?php 
		foreach($areas as $key => $area):
			echo $form->input('Operativo.'.$key, array(
				'type' => 'checkbox',
				'label' => $area,
				'class' => 'input-checkbox Operativo Operativo'.$key));
		endForeach;
	?>
	
	<?php
		$area = 0;
	
		foreach($tipos as $tipo): 
			if($area != $tipo['TipoRecurso']['area_id']):
				$area = $tipo['TipoRecurso']['area_id'];
	?>
				<table class="bloque-Operativo<?php echo $area; ?> oculto">
					<tr>
						<th colspan="3"><?php echo $areas[$area]; ?></th>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Cantidad</td>
						<td>Caracter&iacute;stica</td>
					</tr>
			<?php endif; ?>
					<tr>
						<td>
						<?php 
							echo $form->input('Recurso.'.$tipo['TipoRecurso']['id'].'.tipo_recurso_id', array('value' => $tipo['TipoRecurso']['id'], 'type' => 'hidden')); 
							echo '<dfn title="'.$tipo['TipoRecurso']['descripcion'].'">'.$tipo['TipoRecurso']['nombre'].'</dfn>';
						?>
						</td>
						<td>
							<?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.cantidad', array('class' => 'recurso', 'default' => 0, 'size' => 3) ); ?>
						</td>
						<td>
						<?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.caracteristica'); ?>
						</td>
					</tr>
					<?php if(!empty($tipo['TipoRecurso']['descripcion'])) :?>
						<tr>
							<td colspan="3">
								<small>
									<?php echo $tipo['TipoRecurso']['descripcion']; ?>
								</small>
							</td>
						</tr>
					<?php endif; ?>
			<?php if($area != $tipo['TipoRecurso']['area_id']): ?>
				</table>
			<?php 
			endif;
		endForeach; 
	?>
	
	<?php echo $form->submit('Agregar', array('class' => 'input-button')); ?>
	
	<?php echo $javascript->link('perfil.js'); ?>
	
<?php echo $form->end(); ?>
