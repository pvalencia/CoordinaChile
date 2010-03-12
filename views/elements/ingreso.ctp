<div id="iniciosesion" class="widget">
	<?php if(!$auth) : ?>
		<h2>Inicio de sesi&oacute;n</h2>
			<?php
			echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'ingreso')));
			echo $form->input('Organizacion.email', array('label' => 'Correo electr&oacute;nico', 'class' => 'input-text'));
			echo $form->input('Organizacion.password', array('label' => 'Contrase&ntilde;a', 'class' => 'input-text'));
			echo $form->submit('Ingresar', array('class' => 'input-button'));
			echo $form->end();
			?>
		<div class="clear"></div>
	<?php else :?>
		<h2>Bienvenid@ <span class="rojo"><?php echo $user['Organizacion']['nombre']; ?></span></h2>
		<ul>
			<li>
				<a href="/organizaciones/ver/<?php echo $user['Organizacion']['id']; ?>" title="Mi organización">Mi organizaci&oacute;n</a>
			</li>
			<li>
				<a href="/catastros/nuevo" title="Agregar nuevo catastro">Agregar nuevo catastro</a>
			</li>
			<li>
				<a href="#" title="Modificar datos catastros">Modificar datos catastros</a>
			</li>
			<li>
				<a href="/organizaciones/perfil/<?php echo $user['Organizacion']['id']; ?>" title="Agregar nuevo operativo">Agregar nuevo operativo</a>
			</li>
			<li>
				<a href="#" title="Modificar datos operativos">Modificar datos operativo</a>
			</li>
			<li>
				<a href="/organizaciones/salir" title="Cerrar sesión">Cerrar sesi&oacute;n</a>
			</li>
		</ul>
	<?php endif;?>
</div>
