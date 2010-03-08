<?php echo $form->create('Catastro', array('controller' => 'catastros', 'action' => 'nuevo')); ?>
<fieldset>
<legend>Agregar Catastro</legend>

<?php
	echo $form->input('Catastro.localidad_id', array('class' => ''));
	echo $form->input('Catastro.organizacion_id', array('class' => '', 'label' => 'Organizacion'));
	echo $form->input('Catastro.nombre_contacto', array('class' => '', 'label' => 'Nombre de Contacto'));
	echo $form->input('Catastro.telefono_contacto', array('class' => '', 'label' => 'Tel&eacute;fono'));
	echo $form->input('Catastro.fecha', array('class' => ''));
	echo $form->input('Catastro.caracterizacion', array('class' => '', 'label' => 'Caracterizaci&oacute;n'));
	echo $form->input('Catastro.danos_graves_fisicos', array('class' => '', 'label' => 'Da&ntilde;os Graves Físicos'));
	echo $form->input('Catastro.danos_graves_psicologicos', array('class' => '', 'label' => 'Da&ntilde;os Graves Psicol&oacute;gicos'));
	echo $form->input('Catastro.personas_con_discapacidad', array('class' => ''));
	echo $form->input('Catastro.enfermedades_cronicas', array('class' => '', 'label' => 'Enfermedades Cr&oacute;nicas'));
	echo $form->input('Catastro.embarazadas', array('class' => ''));
	echo $form->input('Catastro.menores', array('class' => ''));
	echo $form->input('Catastro.casas_destruidas', array('class' => ''));
	echo $form->input('Catastro.casas_remocion_escombros', array('class' => '', 'label' => 'Casas para Remoci&oacute;n de Escombros'));
	echo $form->input('Catastro.casas_evaluacion_estructural', array('class' => '', 'label' => 'Casas para Evaluaci&oacute;n Estructural'));
	echo $form->input('Catastro.sistema_excretas', array('class' => ''));
	echo $form->input('Catastro.agua', array('class' => ''));
	echo $form->input('Catastro.ropa', array('class' => ''));
	echo $form->input('Catastro.abrigo', array('class' => ''));
	echo $form->input('Catastro.colchoneta', array('class' => ''));
	echo $form->input('Catastro.aseo_personal', array('class' => ''));
	echo $form->input('Catastro.aseo_general', array('class' => ''));
	echo $form->input('Catastro.combustible', array('class' => ''));

	echo $form->submit('Enviar');
?>

</fieldset>
<?php echo $form->end(); ?>
