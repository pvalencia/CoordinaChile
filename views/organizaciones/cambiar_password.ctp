<h1>
	Cambiar contrase&ntilde;a <?php echo $user['Organizacion']['nombre']; ?>
</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'cambiar_password'))); ?>
<div class="bloque">
	<?php
	$label_ini = '<div class="label ancho33">';
	$label_fin = '<span class="requerido">&nbsp;*</span></div>';
	
	echo $form->input('Organizacion.password_actual', array('class' => 'input-password', 'type' => 'password', 'label' => 'Contrase&ntilde;a actual', 'before' => $label_ini, 'between' => $label_fin));
	echo $form->input('Organizacion.password', array('class' => 'input-password', 'type' => 'password', 'label' => 'Nueva contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
	echo $form->input('Organizacion.confirmar_password', array('class' => 'input-password', 'type' => 'password', 'label' => 'Confirmar nueva contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>

<?php echo $form->submit('Cambiar contraseña', array('class' => 'input-button')); ?>
<?php echo $form->end(); ?>
