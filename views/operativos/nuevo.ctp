<h1>
	Nuevo operativo
</h1>

<?php echo $form->create('Operativo', array('url' => array('controller' => 'operativos', 'action' => 'nuevo', $organizacion['Organizacion']['id']))); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<?php
			$label_ini = '<div class="label ancho33">';
			$label_fin = '<span class="requerido">&nbsp;*</span></div>';
			
			if($admin == 0)
				echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id'], 'before' => $label_ini, 'between' => $label_fin));
			else
				echo $form->input('Operativo.organizacion_id', array('before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.regiones', array('class' => 'input-select regiones', 'div' => 'input select selectregiones', 'selected' => 13, 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones, 'label' => 'Regi&oacute;n'));
			echo $form->input('Operativo.comunas', array('class' => 'input-select comunas', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array(), 'label' => 'Comuna'));
			echo $form->input('Operativo.localidad_id', array('class' => 'input-select localidades', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array()));
			echo $form->input('Operativo.fecha_llegada', array('class' => 'input-text', 'label' => 'Fecha de inicio', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.duracion', array('class' => 'input-text cantidad', 'default' => 1, 'label' => 'Duraci&oacute;n (d&iacute;as)', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.nombre', array('class' => 'input-text caracteristica', 'label' => 'Nombre del encargado', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.email', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico del encargado', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.telefono', array('class' => 'input-text', 'label' => 'Tel&eacute;fono del encargado', 'before' => $label_ini, 'between' => $label_fin));
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
					<div class="ancho25">
				<?php
				endif;
					echo $form->input('Operativo.'.$key, array(
						'type' => 'checkbox',
						'label' => $area,
						'id' => 'showit'.$key,
						'class' => 'input-checkbox showit'));
				if($i == count($areas)) :
					$i = 1;
				?>
					</div>
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
			<div class="toshow showit<?php echo $key; ?> bloque oculto">
				<h3>
					<?php echo $area; ?>
				</h3>
				<table class="ancho100">
					<tr>
						<th class="ancho50 primero alignleft">&Iacute;tem</th>
						<th class="ancho15">Cantidad</th>
						<th class="ancho35 ultimo">Caracter&iacute;stica</th>
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
									<?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.cantidad', array('class' => 'cantidad input-text', 'default' => 0, 'size' => 5) ); ?>
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
	
	<?php echo $form->submit('Crear operativo', array('class' => 'input-button')); ?>
	
<?php echo $form->end(); ?>

<?php
echo $javascript->link('visualizacion.js');
echo $javascript->link('ubicacion.js');
?>
