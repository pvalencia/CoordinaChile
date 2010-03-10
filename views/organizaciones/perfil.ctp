<h1>
	<?php echo $html->link($organizacion['Organizacion']['nombre'], array('controller' => 'organizaciones', 'action' => 'ver', $organizacion['Organizacion']['id'])); ?>
</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'operativos', 'action' => 'agregar', $organizacion['Organizacion']['id']))); ?>

	<fieldset>
		<legend>
			Agregar Operativo
		</legend>

		<?php 
			echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
			echo $form->input('Operativo.fecha_llegada', array('class' => ''));
			echo $form->input('Operativo.duracion', array('class' => '', 'label' => 'Duración'));
			echo $form->input('Operativo.localidad_id', array('class' => '', 'label' => 'Localidad'));
		?>

		<?php 
			foreach($areas as $key => $area):
				echo $form->input('Operativo.'.$key, array(
					'type' => 'checkbox',
					'label' => $area,
					'class' => 'input-checkbox Operativo Operativo'.$key));
			endForeach;
		?>
	
	</fieldset>

	<fieldset>
		<legend>
			Recursos
		</legend>
	
		<table>
		<?php
			$area = 0;
		
			foreach($tipos as $tipo): 
				if($area != $tipo['TipoRecurso']['area_id']):
					$area = $tipo['TipoRecurso']['area_id'];
		?>
					<tbody class="bloque-Operativo<?php echo $area; ?>" style="display: none;">
						<tr>
							<th colspan="3"><?php echo $areas[$area]; ?></th>
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
				<?php if($area != $tipo['TipoRecurso']['area_id']): ?>
					</tbody>
				<?php 
				endif;
			endForeach; 
		?>
		</table>
	</fieldset>
	
	<?php echo $form->submit('guardar'); ?>
	
	<?php echo $javascript->link('perfil.js'); ?>
	
<?php echo $form->end(); ?>
