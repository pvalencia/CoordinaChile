<div id="iniciosesion" class="widget">
	<?php ?>
	<h2>Inicio de sesi&oacute;n</h2>
		<?php
		echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'ingreso')));
		echo $form->input('Organizacion.email', array('label' => 'Correo electr&oacute;nico', 'class' => 'input-text'));
		echo $form->input('Organizacion.password', array('label' => 'Contrase&ntilde;a', 'class' => 'input-text'));
		echo $form->submit('Ingresar', array('class' => 'input-button'));
		echo $form->end();
		?>
	<div class="clear"></div>
</div>
