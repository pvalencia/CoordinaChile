<h1>
	Editar <?php echo $form->value('Organizacion.nombre'); ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Cambia y actualiza los datos de tu organizaci&oacute;n. Recuerda que los campos con <span class="requerido">*</span> son obligatorios de llenar.
	</p>
</div>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'organizaciones', 'action' => 'editar'))); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	<p class="intro">
		Cambia aqu&iacute; los datos b&aacute;sicos de tu organizaci&oacute;n. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera.
	</p>
	<?php
		$label_ini = '<div class="label ancho33">';
		$label_fin = '<span class="requerido">&nbsp;*</span></div>';
		$label_iniA = '<div class="label ancho33 floatleft">';
		$label_finA = '</div>';
		
		echo $form->input('Organizacion.id'); 
		echo $form->input('Organizacion.nombre', array('class' => 'input-text caracteristica', 'before' => $label_ini, 'between' => $label_fin));
		if(!$user['Organizacion']['admin']) :
			echo $form->input('Organizacion.tipo_organizacion_id', array('type' => 'hidden'));
		else :
			echo $form->input('Organizacion.tipo_organizacion_id', array('class' => 'input-select', 'label' => 'Tipo de organizaci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
		endif;
		echo $form->input('Organizacion.telefono', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Organizacion.email', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Organizacion.web', array('class' => 'input-text caracteristica', 'label' => 'Sitio web', 'before' => $label_ini, 'between' => $label_finA));
	?>
	<div class="input text">
		<?php echo $label_ini.'Contrase&ntilde;a'.$label_finA; ?><a href="/organizaciones/cambiar_password">Modificar contrase&ntilde;a</a>
	</div>
</div>

<div class="bloque">
	<h2>
		Datos del contacto
	</h2>
	<p class="intro">
		Modifica aqu&iacute; los datos de aquella persona que es el contacto, vocero o relacionador p&uacute;blico de tu organizaci&oacute;n. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
	</p>
	<?php
		echo $form->input('Organizacion.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Organizacion.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Organizacion.email_contacto', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>

<div class="bloque">
	<h2>
		Datos descriptivos
	</h2>
	<p class="intro">
		Edita lo que realiza tu organizaci&oacute;n. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera.
	</p>
	<p class="intro">
		Trata de ser conciso y motivador con lo que escribas. Como ayuda puedes preguntarte: <strong>&iquest;Qu&eacute; realiza mi organizaci&oacute;n?</strong> y <strong>&iquest;Qu&eacute; es lo que m&aacute;s podr&iacute;a motivar a las personas a particiar en ella?</strong>.
	</p>
	<?php
		echo $form->input('Organizacion.areas_trabajo', array('class' => 'input-textarea ancho66', 'label' => 'Descripci&oacute;n', 'before' => $label_iniA, 'between' => $label_fin));
	?>
</div>

<?php if($user['Organizacion']['admin']) : ?>
	<div class="bloque">
			<h2>
				Datos del sistema
			</h2>
			<?php
				echo $form->input('Organizacion.admin', array('class' => 'input-checkbox', 'label' => 'Administrador', 'between' => $label_iniA, 'after' => $label_finA));
			?>
	</div>
<?php endif; ?>

<?php echo $form->submit('Modificar organización', array('class' => 'input-button')); ?>

<?php echo $form->end(); ?>
