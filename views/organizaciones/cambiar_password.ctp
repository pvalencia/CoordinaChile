<?php echo $form->create('Organizacion', array('controller' => 'organizaciones', 'action' => 'cambiar_password')); ?>
<fieldset>
	<legend>Cambiar password</legend>
	<?php
	echo $form->input('Organizacion.password_actual', array('type' => 'password'));
	echo $form->input('Organizacion.password', array('type' => 'password'));
	echo $form->input('Organizacion.confirmar_password', array('type' => 'password'));
	?>
</fieldset>

<?php echo $form->submit('Cambiar'); ?>
<?php echo $form->end(); ?>
