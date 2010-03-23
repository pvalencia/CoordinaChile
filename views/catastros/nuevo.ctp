<h1>
	Nuevo catastro
</h1>

<div class="bloquegrande">
	<p class="intro">
		A continuaci&oacute;n se presentan los campos para la generaci&oacute;n de un nuevo catastro sobre alguna localidad. Recuerda que los campos con <span class="requerido">*</span> son obligatorios de llenar.
	</p>
</div>

<?php echo $form->create('Catastro', array('action' => 'nuevo', 'type' => 'file')); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	<p class="intro">
		Ingresa los datos b&aacute;sicos del catastro. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera.
	</p>
	<?php
		$label_ini = '<div class="label ancho33">';
		$label_fin = '<span class="requerido">&nbsp;*</span></div>';

		if(!$user['Organizacion']['admin'])
			echo $form->input('Catastro.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
		else
			echo $form->input('Catastro.organizacion_id', array('class' => 'input-select', 'label' => 'Organizaci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.regiones', array('class' => 'input-select regiones', 'div' => 'input select selectregiones', 'selected' => 13, 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones->getRegiones(), 'label' => 'Regi&oacute;n'));
		echo $form->input('Catastro.comunas', array('class' => 'input-select comunas', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array(), 'label' => 'Comuna'));
		echo $form->input('Catastro.localidad_id', array('class' => 'input-select localidades', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array()));
		echo $form->input('Catastro.fecha', array('class' => 'input-select', 'label' => 'Fecha de realizaci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>
<div class="bloque">
	<h2>
		Datos del contacto
	</h2>
	<p class="intro">
		Ingresa los datos de aquella persona que recopil&oacute; y entreg&oacute; la informaci&oacute;n de este catastro. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
	</p>
	<?php
		echo $form->input('Catastro.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.email_contacto', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>
<div class="bloque">
	<h2>
		Datos adicionales
	</h2>
	<p class="intro">
		Si lo deseas, puedes dar una descripci&oacute;n general y cualitativa de la localidad catastrada, y adem&aacute;s, tambi&eacute;n puedes adjuntar un archivo con m&aacute;s detalles al respecto. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
	</p>
	<?php
		$label_ini = '<div class="label ancho33 floatleft">';
		$label_fin = '</div>';
		
		echo $form->input('Catastro.caracterizacion', array('class' => 'input-textarea ancho50', 'label' => 'Descripci&oacute;n general', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.submittedfile', array('class' => 'input-file caracteristica', 'label' => 'Adjuntar archivo', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'file'));
	?>
</div>

<div class="bloque">
		<h2>
			Datos espec&iacute;ficos <span class="requerido">*</span>
		</h2>
		<p class="intro">
			Marca el o las &aacute;reas que aborda el catastro, y en el formulario que se desplegar&aacute; a continuaci&oacute;n, llena los campos que estimes pertinentes. <strong>Debes marcar al menos un &aacute;rea</strong>. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
		</p>
		<div>
		<?php
			foreach($areas as $key => $area):
				if($key == 4) :
					$area .= ' <small><em>(asistencia jur&iacute;dica)</em></small>';
				endif;
				echo $form->input('Catastro.'.$key, array(
					'type' => 'checkbox',
					'label' => $area,
					'id' => 'showit'.$key,
					'class' => 'input-checkbox showit'));
			endForeach;
		?>
		</div>
</div>
	
<?php
	foreach($areas as $key => $area) :
?>
	<div class="toshow showit<?php echo $key; ?> bloque oculto">
		<h3>
			<?php echo $area; ?>
		</h3>
		<table class="ancho100">
			<tr>
				<th class="ancho50 primero alignleft">&Iacute;tem</th>
				<th class="ancho15 ultimo">Cantidad</th>
				<th class="ancho35 ultimo">Caracter&iacute;stica</th>
			</tr>
		<?php
		$i = 1;
		foreach($tipos as $tipo) :
			if($key == $tipo['TipoNecesidad']['area_id']) :
		?>
			<tr>
				<td class="ancho50 fila<?php echo $i;?> primero">
					<?php 
					echo $form->input('Necesidad.'.$tipo['TipoNecesidad']['id'].'.tipo_necesidad_id', array('value' => $tipo['TipoNecesidad']['id'], 'type' => 'hidden')); 
					echo $tipo['TipoNecesidad']['nombre']; 
					?>
					<br/>
					<small>
						<?php echo $tipo['TipoNecesidad']['descripcion']; ?>
					</small>
				</td>
				<td class="ancho15 fila<?php echo $i;?> ultimo aligncenter">
					<?php echo $form->input('Necesidad.'.$tipo['TipoNecesidad']['id'].'.cantidad', array('class' => 'text-input cantidad', 'default' => 0, 'label' => ''));		?>
				</td>
				<td class="ancho35 fila<?php echo $i;?> ultimo">
					<?php echo $form->text('Necesidad.'.$tipo['TipoNecesidad']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25)); ?>
				</td>
			</tr>
		<?php
			$i = 3 - $i;		//cambiar entre i=2 e i=1.
			endif;
		endforeach;
		?>
		</table>
	</div>
<?php
endforeach;
?>

<?php echo $form->submit('Crear catastro', array('class' => 'input-button')); ?>

<?php echo $form->end(); ?>

<?php echo $javascript->link('formulario.js'); ?>
