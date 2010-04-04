<h1>
	Editar Catastro <?php echo $catastro['Catastro']['id']; ?>
</h1>

<?php echo $form->create('Catastro', array('url' => array('controller' => 'catastros', 'action' => 'editar', $catastro['Organizacion']['id']), 'type' => 'file')); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<?php
			$label_ini = '<div class="label ancho33">';
			$label_fin = '<span class="requerido">&nbsp;*</span></div>';
			echo $form->input('Catastro.id');
			if($admin == 0)
				echo $form->input('Catastro.organizacion_id', array('type' => 'hidden', 'value' => $catastro['Organizacion']['id'], 'before' => $label_ini, 'between' => $label_fin));
			else
				echo $form->input('Catastro.organizacion_id', array('type' => 'hidden'));
			echo $form->input('Catastro.regiones', array('class' => 'input-select regiones editar', 'div' => 'input select selectregiones', 'selected' => $regiones->getRegionId($catastro['Localidad']['comuna_id']), 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones->getRegiones(), 'label' => 'Regi&oacute;n'));
			echo $form->input('Catastro.comuna_id', array('class' => 'input-select comunas editar', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $comunas, 'label' => 'Comuna'));
			echo $form->input('Catastro.localidad_id', array('class' => 'input-select localidades editar', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $localidades));
			echo $form->input('Catastro.fecha', array('class' => 'input-text', 'label' => 'Fecha', 'before' => $label_ini, 'between' => $label_fin));
		?>
	</div>
	<div class="bloque">
		<h2>
			Datos del encargado
		</h2>
		<?php
			echo $form->input('Catastro.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Catastro.email_contacto', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Catastro.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
		?>
	</div>
	<div class="bloque">
	<h2>
		Datos adicionales
	</h2>
	<?php
		$label_ini = '<div class="label ancho33 floatleft">';
		$label_fin = '</div>';
		
		echo $form->input('Catastro.caracterizacion', array('class' => 'input-textarea ancho66', 'label' => 'Descripci&oacute;n general', 'before' => $label_ini, 'between' => $label_fin));
		?>
		<?php 
		$texto_archivo = "Adjuntar archivo";
		if($catastro['Catastro']['file']): ?>
		<div class="input text">
			<div class="label ancho33">Archivo adjunto</div><?php 
				$cat_file = $catastro['Catastro']['file'];
				$nombre = substr($cat_file, 0, strrpos($cat_file, '-'));
				$id = substr($cat_file, strrpos($cat_file, '-') + 1);
				echo $html->link($nombre, array('controller' => 'catastros', 
										   'action' => 'bajar_archivo',
										   $id, $nombre ), array('class' => $vistas->getClassExtensionArchivo($nombre)));
				echo $form->input('Catastro.file', array('type' => 'hidden')); ?>
		</div>
	<?php $text_archivo = "Cambiar archivo";
		endif; 
		echo $form->input('Catastro.submittedfile', array('class' => 'input-file caracteristica', 'label' => $texto_archivo, 'before' => $label_ini, 'between' => $label_fin, 'type' => 'file')); ?>		

	</div>
	<div class="bloque">
		<h2>
			Datos espec&iacute;ficos
		</h2>
		<?php
			$i = 1;
			$checked = array();
			foreach($areas as $key => $area):
				$checked[$key] = false;
				foreach($tipos as $tipo) :
					if($key == $tipo['TipoNecesidad']['area_id']) :
						if(isset($necesidades[$tipo['TipoNecesidad']['id']]) && ($necesidades[$tipo['TipoNecesidad']['id']]['cantidad'] > 0)) :
							$checked[$key] = true;
							break;
						endif;
					endif;
				endforeach;

				echo $form->input('Catastro.'.$key, array(
					'type' => 'checkbox',
					'label' => $area,
					'checked' => $checked[$key],
					'id' => 'showit'.$key,
					'class' => 'input-checkbox showit',
					'div' => array('style' => 'display:inline; margin-right:40px; white-space:nowrap;')  ));
				echo " ";
				$i++;
			endForeach;
		?>
		<div class="clear"></div>
	</div>
	
	<?php
		$area = 0;
	
		foreach($areas as $key => $area) :
		?>
			<div class="toshow showit<?php echo $key; ?> bloque <?php if(!$checked[$key]) echo 'oculto'; ?>">
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
						$cantidad = isset($necesidades[$tipo['TipoNecesidad']['id']]) ? $necesidades[$tipo['TipoNecesidad']['id']]['cantidad'] : 0;
						$caracteristica = isset($necesidades[$tipo['TipoNecesidad']['id']]) ? $necesidades[$tipo['TipoNecesidad']['id']]['caracteristica'] : '';

						if($key == $tipo['TipoNecesidad']['area_id']) :
					?>
							<tr>
								<td class="ancho50 fila<?php echo $i;?> primero">
								<?php
									echo isset($necesidades[$tipo['TipoNecesidad']['id']]) ? $form->input('Necesidad.'.$tipo['TipoNecesidad']['id'].'.id', array('value' => $necesidades[$tipo['TipoNecesidad']['id']]['id'], 'type' => 'hidden')) : '' ;

									echo $form->input('Necesidad.'.$tipo['TipoNecesidad']['id'].'.tipo_necesidad_id', array('value' => $tipo['TipoNecesidad']['id'], 'type' => 'hidden')); 

									echo $tipo['TipoNecesidad']['nombre'];
								?>
								<?php if(!empty($tipo['TipoNecesidad']['descripcion'])) :?>
									<br/>
									<small>
										<?php echo $tipo['TipoNecesidad']['descripcion']; ?>
									</small>
								<?php endif; ?>
								</td>
								<td class="ancho15 fila<?php echo $i;?> aligncenter">
									<?php echo $form->text('Necesidad.'.$tipo['TipoNecesidad']['id'].'.cantidad', array('class' => 'cantidad necesidad input-text', 'default' => 0, 'size' => 5, 'value' => $cantidad) ); ?>
								</td>
								<td class="ancho35 fila<?php echo $i;?> ultimo">
									<?php echo $form->text('Necesidad.'.$tipo['TipoNecesidad']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25, 'value' => $caracteristica)); ?>
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
	
	<?php echo $form->submit('Modificar catastro', array('class' => 'input-button')); ?>
	
<?php echo $form->end(); ?>

<?php
echo $javascript->link('formulario.js');
?>
