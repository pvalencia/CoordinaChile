<?php echo $form->create('Organizacion', array('controller' => 'organizaciones', 'action' => 'nuevo')); ?>
<fieldset>
<legend>Agregar Organización</legend>

<?php
		echo $form->input('Organizacion.nombre', array('class' => 'input-text'));
		echo $form->input('Organizacion.tipo_organizacion_id', array('class' => 'input-select', 'label' => 'Tipo de Organización'));
		echo $form->input('Organizacion.telefono', array('class' => 'input-text', 'label' => 'Teléfono'));
		echo $form->input('Organizacion.email', array('class' => 'input-text', 'label' => 'E-Mail'));
		echo $form->input('Organizacion.web', array('class' => 'input-text', 'label' => 'Página Web'));
		echo $form->input('Organizacion.nombre_contacto', array('class' => 'input-text', 'label' => 'Nombre de Contacto'));
		echo $form->input('Organizacion.telefono_contacto', array('class' => 'input-text', 'label' => 'Teléfono de Contacto'));
		echo $form->input('Organizacion.areas_trabajo', array('class' => 'input-text', 'label' => 'Áreas de Trabajo'));
		
		echo $form->submit('Enviar', array('class' => 'input-button'));
?>
	
	</fieldset>
<?php echo $form->end(); ?>
