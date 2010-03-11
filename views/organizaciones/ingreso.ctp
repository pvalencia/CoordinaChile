<?php echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'ingreso'))); ?>
<fieldset>
<legend>Ingreso de Organizaciones</legend>
<?php
	echo $form->input('Organizacion.email');
	echo $form->input('Organizacion.password');
	echo $form->submit('Ingresar');
?>
</fieldset>
<?php echo $form->end(); ?>
