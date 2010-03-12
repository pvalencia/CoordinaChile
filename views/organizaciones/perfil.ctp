<h1>
	Agregar nuevo operativo
</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'operativos', 'action' => 'agregar', $organizacion['Organizacion']['id']))); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<?php 
			echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
			echo $form->input('Operativo.fecha_llegada', array('class' => 'input-text', 'label' => 'Fecha llegada'));
			echo $form->input('Operativo.duracion', array('class' => 'input-text', 'label' => 'Duraci&oacute;n'));
			echo $form->input('Operativo.localidad_id', array('class' => 'input-text', 'label' => 'Localidad'));
		?>
	</div>

	<div class="bloque">
		<h2>
			Datos espec&iacute;ficos
		</h2>
		<?php
			$i = 1;
			 
			foreach($areas as $key => $area):
				if($i == 1):
		?>
					<span class="ancho25">
				<?php
				endif;
					echo $form->input('Operativo.'.$key, array(
						'type' => 'checkbox',
						'label' => $area,
						'class' => 'input-checkbox Operativo Operativo'.$key));
				if($i == 5) :
					$i = 1;
				?>
					</span>
				<?php
				else:
					$i++;
				endif;
			endForeach;
		?>
	</div>
	
	<?php
		$area = 0;
	
		foreach($areas as $key => $area) :
		?>
			<div class="Operativo<?php echo $key; ?> bloque oculto">
				<h3>
					<?php echo $area; ?>
				</h3>
			
				<table class="ancho100">
					<tr>
						<th class="ancho50 primero alignleft">&Iacute;tem</th>
						<th class="ancho15">Cantidad</td>
						<th class="ancho35 ultimo">Caracter&iacute;stica</td>
					</tr>
					<?php
					$i = 1;
					
					foreach($tipos as $tipo) :
						if($key == $tipo['TipoRecurso']['area_id']) :
					?>
							<tr>
								<td class="ancho50 fila<?php echo $i;?> primero">
								<?php 
									echo $form->input('Recurso.'.$tipo['TipoRecurso']['id'].'.tipo_recurso_id', array('value' => $tipo['TipoRecurso']['id'], 'type' => 'hidden')); 
									echo $tipo['TipoRecurso']['nombre'];
								?>
								<?php if(!empty($tipo['TipoRecurso']['descripcion'])) :?>
									<br/>
									<small>
										<?php echo $tipo['TipoRecurso']['descripcion']; ?>
									</small>
								<?php endif; ?>
								</td>
								<td class="ancho15 fila<?php echo $i;?> aligncenter">
									<?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.cantidad', array('class' => 'cantidad recurso input-text', 'default' => 0, 'size' => 5) ); ?>
								</td>
								<td class="ancho35 fila<?php echo $i;?> ultimo">
									<?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25)); ?>
								</td>
							</tr>
							<?php
							if($i == 1)
								$i = 2;
							else
								$i = 1;
						endif;
					endforeach;
					?>
			
				</table>
			</div>
		<?php 
		endforeach; 
	?>
	
	<?php echo $form->submit('Agregar operativo', array('class' => 'input-button')); ?>
	
	<?php echo $javascript->link('perfil.js'); ?>
	
<?php echo $form->end(); ?>
