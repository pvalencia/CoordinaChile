<h1>
	Nuevo catastro
</h1>

<?php echo $form->create('Catastro', array('action' => 'nuevo')); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	<?php
		$label_ini = '<div class="label ancho33">';
		$label_fin = '<span class="requerido">&nbsp;*</span></div>';

		if($admin == 0)
			echo $form->input('Catastro.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
		else
			echo $form->input('Catastro.organizacion_id', array('before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.regiones', array('class' => 'input-select regiones', 'div' => 'input select selectregiones', 'selected' => 13, 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones, 'label' => 'Regi&oacute;n'));
		echo $form->input('Catastro.comunas', array('class' => 'input-select comunas', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array(), 'label' => 'Comuna'));
		echo $form->input('Catastro.localidad_id', array('class' => 'input-select localidades', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array()));
		echo $form->input('Catastro.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre del contacto', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.email_contacto', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico del contacto', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono del contacto', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.fecha', array('class' => 'input-select', 'before' => $label_ini, 'between' => $label_fin));
		
		$label_ini = '<div class="label ancho33 floatleft">';
		$label_fin = '</div>';
		
		echo $form->input('Catastro.caracterizacion', array('class' => 'input-textarea ancho50', 'label' => 'Descripci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>
<div class="bloque">
	<h2>
		Datos espec&iacute;ficos
	</h2>
	<?php
		echo $form->input('Catastro.danos_graves_fisicos', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Da&ntilde;os físicos graves', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.danos_graves_psicologicos', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Da&ntilde;os osicol&oacute;gicos graves', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.personas_con_discapacidad', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Personas con discapacidad', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.enfermedades_cronicas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Enfermedades cr&oacute;nicas', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.embarazadas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Embarazadas', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.menores', array('class' => 'text-input cantidad', 'default' => 0, 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.casas_destruidas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Casas destruidas', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.casas_remocion_escombros', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Casas para remoci&oacute;n de escombros', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.casas_evaluacion_estructural', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Casas para evaluaci&oacute;n estructural', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.sistema_excretas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Sistema extretas', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.agua', array('class' => 'text-input cantidad', 'default' => 0, 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.ropa', array('class' => 'text-input cantidad', 'default' => 0, 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.abrigo', array('class' => 'text-input cantidad', 'default' => 0, 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.colchoneta', array('class' => 'text-input cantidad', 'default' => 0, 'label' => 'Colchonetas', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.aseo_personal', array('class' => 'input-text cantidad', 'default' => 0, 'label' => 'Aseo personal', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.aseo_general', array('class' => 'input-text cantidad', 'default' => 0, 'label' => 'Aseo general', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.combustible', array('class' => 'input-text cantidad', 'default' => 0, 'before' => $label_ini, 'between' => $label_fin));
	
		echo $form->submit('Crear catastro', array('class' => 'input-button'));
	?>

</div>

<?php echo $form->end(); ?>

<?php echo $javascript->link('nuevo_catastro.js') ?>
<?php echo $javascript->link('ubicacion.js'); ?>
