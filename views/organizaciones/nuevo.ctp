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
			//echo $form->input('Organizacion.admin', array('class' => 'input-checkbox', 'label' => 'Administrador', 'between' => $label_iniA, 'after' => $label_finA));
		?>
	</div>
	
	<div class="bloque">
		<h2>
			Derechos y responsabilidades
		</h2>
		<p class="intro">
			La presente Declaraci&oacute;n de derechos y responsabilidades, en adelante la "Declaraci&oacute;n", tiene su origen en la necesidad de generar una norma y un estándar respecto al uso del sistema y servicio brindado por Coordina Chile. Las organizaciones o las personas, al hacer uso del servicio de Coordina Chile, muestran su absoluta conformidad con lo que a continuaci&oacute;n se declara:
		</p>
		<div class="bloqueespecial">
			<p class="intro">
				<strong>Privacidad</strong><br/>
				La Privacidad de la informaci&oacute;n es un elemento importante para Coordina Chile, por tanto, s&oacute;lo las organizaciones o personas que se hagan parte de Coordina Chile como usuarios del sistema, podr&aacute;n tener acceso directo a los datos de contacto de los encargados de cada organizaci&oacute;n, de sus encargados de operativos u otros responsables en la realizaci&oacute;n de catastros. Esta informaci&oacute;n no podr&aacute; ser utilizada para fines comerciales, o fines que se alejen del espirit&uacute; no lucrativo que promueve Coordina Chile. Cualquier organizaci&oacute;n o persona que tome parte en el sitio web de Coordina Chile adhiere a este compromiso de Privacidad.
			</p>
			<p class="intro">
				<strong>Derechos sobre uso de la información</strong><br/>
				Cada organización o persona partícipe del sitio web de Coordina Chile es y se hace responsable de los datos que ingresa al sistema, incluyendo sus datos de perfil, y aquellos que ingresa en sus operativos y catastros. Coordina Chile y los administradores del sitio se reservan el derecho de auditar, editar y/o corregir libremente cualquier dato o información que hayan sido ingresados a la plataforma, y que resultaren ser erróneos, imprecisos, o que atentaren contra la veracidad y consistencia de la información publicada. En caso de aplicarse dicha medida, Coordina Chile se compromete a notificar de los cambios, dentro de un plazo no superior a las 24 horas, a aquellas organizaciones y personas responsables del ingreso de dichos datos e informaciones. Toda organización o persona que se hace parte del sistema de Coordina Chile, acepta compartir la información de acuerdo a los términos que establece al respecto la licencia Creative Commons.
			</p>
			<p class="intro">
				<strong>Seguridad</strong><br/>
				Coordina Chile tiene como objetivo central que la información sea compartida libremente dentro del sitio. Sin embargo, y con fines de orden y seguridad de la información, los usuarios del sistema (organizaciones o personas) asumen los siguientes compromisos y obligaciones:
				<ol>
					<li>Los usuarios no podrán publicar los detalles de catastros u operativos de organizaciones que no sean propios. Esto sólo se podrá realizar bajo un acuerdo expreso y previo entre las partes involucradas.</li> 
					<li>Los usuarios no podrán ingresar información falsa o atribuirse falsa autoría.</li> 
					<li>Los usuarios sólo podrán adjuntar archivos a catastros u operativos que contengan detalles e información relativa a estos, siempre y cuando los contenidos, formatos, o cualquier elemento de dichos archivos adjuntados no transgredan las leyes locales.</li>
				</ol>
			</p>
			<p class="intro">
				<strong>Conflictos</strong><br/>
				En caso de que se presente un conflicto respecto de la autoría de un catastro u operativo, Coordina Chile escuchará a las partes involucradas y resolverá qué recursos corresponden a cada una.
			</p>
			<p class="intro">
				<strong>Membresía</strong>
				<ol>
					<li>Si al cabo de 3 meses de ingresar a Coordina Chile, una organización no ha ingresado ningún tipo de dato (0 operativos y 0 catastros), ésta será eliminada de Coordina Chile.</li> 
					<li>Coordina Chile puede revocar la membresía a una organización o persona previamente autorizada, con lo que el acceso a dicha cuenta será anulado. Coordina Chile se reserva el derecho de eliminación de los datos de las cuentas revocadas.</li>
				</ol>
			</p>
			<p class="intro">
				De no respetarse esta Declaración, Coordina Chile se reserva el derecho de anular o modificar la cuenta de la organización o persona que fuese sorprendida en este tipo de prácticas. Asimismo, Coordina Chile se reserva el derecho de modificar libremente los términos y puntos de esta Declaración, en pos de velar por el adecuado funcionamiento del sistema, la protección de la información privada de las personas, y las buenas relaciones entre las organizaciones y las personas que utilizan el servicio brindado por Coordina Chile.
			</p>
		</div>
	</div>
			
	<?php echo $form->submit('Crear organización', array('class' => 'input-button')); ?>
	
	</fieldset>
<?php echo $form->end(); ?>
