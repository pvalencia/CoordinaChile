<h1>
	Modificar contrase&ntilde;a de <?php echo $user['Organizacion']['nombre']; ?>
</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'cambiar_password'))); ?>
<div class="bloque">
	<p class="intro">
		Cambia y actualiza la contrase&ntilde;a de tu organizaci&oacute;n. Por cuestiones de seguridad, te recomendamos que ingreses una contrase&ntilde;a con 8 o m&aacute;s car&aacute;rteres que sean n&uacute;meros y combinaciones de letras may&uacute;sculas y min&uacute;sculas. Recuerda que los campos con <span class="requerido">*</span> son obligatorios de llenar.
	</p>
	<?php
	$label_ini = '<div class="label ancho33">';
	$label_fin = '<span class="requerido">&nbsp;*</span></div>';
	
	echo $form->input('Organizacion.password_actual', array('class' => 'input-password', 'type' => 'password', 'label' => 'Contrase&ntilde;a actual', 'before' => $label_ini, 'between' => $label_fin));
	echo $form->input('Organizacion.password', array('class' => 'input-password', 'type' => 'password', 'label' => 'Nueva contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
	echo $form->input('Organizacion.confirmar_password', array('class' => 'input-password', 'type' => 'password', 'label' => 'Confirmar nueva contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>

<?php echo $form->submit('Modificar contraseña', array('class' => 'input-button')); ?>
<?php echo $form->end(); ?>
