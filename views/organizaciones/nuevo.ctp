<?php echo $form->create('Organizacion', array('controller' => 'organizaciones', 'action' => 'nuevo')); ?>
<fieldset>
<legend>Agregar Organización</legend>

<?php
	echo $form->input('Organizacion.nombre', array('class' => ''));
	echo $form->input('Organizacion.tipo_organizacion_id', array('class' => '', 'label' => 'Tipo de Organización'));
	echo $form->input('Organizacion.telefono', array('class' => '', 'label' => 'Teléfono'));
	echo $form->input('Organizacion.email', array('class' => '', 'label' => 'E-Mail'));
	echo $form->input('Organizacion.web', array('class' => '', 'label' => 'Página Web'));
	echo $form->input('Organizacion.nombre_contacto', array('class' => '', 'label' => 'Nombre de Contacto'));
	echo $form->input('Organizacion.telefono_contacto', array('class' => '', 'label' => 'Teléfono de Contacto'));
	echo $form->input('Organizacion.areas_trabajo', array('class' => '', 'label' => 'Áreas de Trabajo'));
	
	echo $form->submit('Enviar');
?>

</fieldset>
<?php echo $form->end(); ?>
