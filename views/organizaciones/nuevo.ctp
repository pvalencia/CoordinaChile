<h1>
	Nueva organizaci&oacute;n
</h1>

<div class="bloquegrande">
	<p class="intro">
		A continuaci&oacute;n se presentan los campos para el registro de tu organizaci&oacute;n en <strong>Coordina Chile</strong>. Aquellos campos que posean un <span class="requerido">*</span> son obligatorios de llenar.
	</p>
	<p class="intro">
		<strong>Coordina Chile</strong> no solo desea ayudarte en la gesti&oacute;n y la administraci&oacute;n interna de tu organizaci&oacute;n, sino tambi&eacute;n desea que se potencie, crezca, consolide y mejore su aporte para con la sociedad.
	</p>
</div>

<?php echo $form->create('Organizacion', array('controller' => 'organizaciones', 'action' => 'nuevo')); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<p class="intro">
			Ingresa los datos b&aacute;sicos de tu organizaci&oacute;n. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera.
		</p>
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
		<p class="intro">
			Ingresa los datos de aquella persona que es el contacto, vocero o relacionador p&uacute;blico de tu organizaci&oacute;n. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
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
			Describe lo que realiza tu organizaci&oacute;n. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera. 
		</p>
		<p class="intro">
			Trata de ser conciso y motivador con lo que escribas. Como ayuda puedes preguntarte: <strong>&iquest;Qu&eacute; realiza mi organizaci&oacute;n?</strong> y <strong>&iquest;Qu&eacute; es lo que m&aacute;s podr&iacute;a motivar a las personas a particiar en ella?</strong>.
		</p>
		<?php
			echo $form->input('Organizacion.areas_trabajo', array('class' => 'input-textarea ancho66', 'label' => 'Descripci&oacute;n', 'before' => $label_iniA, 'between' => $label_fin));
		?>
	</div>
	
	<div class="bloque">
		<h2>
			Datos del sistema
		</h2>
		<p class="intro">
			Ingresa la contrase&ntilde;a con la cual tu organizaci&oacute;n podr&aacute; iniciar su sesi&oacute;n una vez que se encuentre registrada en <strong>Coordina Chile</strong>. Por cuestiones de seguridad, te recomendamos que ingreses una contrase&ntilde;a con 8 o m&aacute;s car&aacute;rteres que sean n&uacute;meros y combinaciones de letras may&uacute;sculas y min&uacute;sculas.
		</p>
		<?php
			echo $form->input('Organizacion.password', array('class' => 'input-password', 'label' => 'Contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.confirmar_password', array('class' => 'input-password', 'type' => 'password', 'label' => 'Confirmar contrase&ntilde;a', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Organizacion.admin', array('class' => 'input-checkbox', 'label' => 'Administrador', 'between' => $label_iniA, 'after' => $label_finA));
		?>
	</div>
			
	<?php echo $form->submit('Crear organización', array('class' => 'input-button')); ?>
	
	</fieldset>
<?php echo $form->end(); ?>
