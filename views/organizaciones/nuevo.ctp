<h1>
	Nueva organizaci&oacute;n
</h1>

<?php echo $form->create('Organizacion', array('controller' => 'organizaciones', 'action' => 'nuevo')); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<?php
			$label_ini = '<div class="label ancho33">';
			$label_fin = '<span class="requerido">&nbsp;*</span></div>';
			$label_iniA = '<div class="label ancho33 floatleft">';
			$label_finA = '</div>';
			
			echo $form->input('Organizacion.nombre', array('class' => 'input-text caracteristica', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.tipo_organizacion_id', array('class' => 'input-select', 'label' => 'Tipo de organizaci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.telefono', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.email', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.web', array('class' => 'input-text caracteristica', 'label' => 'Sitio web', 'before' => $label_ini, 'between' => $label_finA));
		?>
	</div>
	
	<div class="bloque">
		<h2>
			Datos del contacto
		</h2>
		<?php
			echo $form->input('Organizacion.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.email_contacto', array('class' => 'input-text', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
		?>
	</div>
	
	<div class="bloque">
		<h2>
			Datos adicionales
		</h2>
		<?php
			echo $form->input('Organizacion.areas_trabajo', array('class' => 'input-textarea ancho50', 'label' => '&Aacute;rea de trabajo', 'before' => $label_iniA, 'between' => $label_finA));
		?>
	</div>
	
	<div class="bloque">
		<h2>
			Datos del sistema
		</h2>
		<?php
			echo $form->input('Organizacion.password', array('class' => 'input-password', 'label' => 'Contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.admin', array('class' => 'input-checkbox', 'label' => 'Administrador', 'between' => $label_iniA, 'after' => $label_finA));
		?>
	</div>
			
	<?php echo $form->submit('Crear organización', array('class' => 'input-button')); ?>
	
	</fieldset>
<?php echo $form->end(); ?>
