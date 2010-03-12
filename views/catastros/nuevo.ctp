<h1>
	Agregar nuevo catastro
</h1>

<?php echo $form->create('Catastro', array('controller' => 'catastros', 'action' => 'nuevo')); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	<?php
		echo $form->input('Catastro.localidad_id', array('class' => 'input-select'));
		echo $form->input('Catastro.nombre_contacto', array('class' => 'input-text', 'label' => 'Nombre de Contacto'));
		echo $form->input('Catastro.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono'));
		echo $form->input('Catastro.fecha', array('class' => 'input-select'));
		echo $form->input('Catastro.caracterizacion', array('class' => 'input-textarea', 'label' => 'Caracterizaci&oacute;n'));
	?>
</div>
<div class="bloque">
	<h2>
		Datos espec&iacute;ficos
	</h2>
	<?php
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
		echo $form->input('Catastro.aseo_personal', array('class' => 'input-text'));
		echo $form->input('Catastro.aseo_general', array('class' => 'input-text'));
		echo $form->input('Catastro.combustible', array('class' => 'input-text'));
	
		echo $form->submit('Agregar catastro', array('class' => 'input-button'));
	?>

</div>

<?php echo $form->end(); ?>
