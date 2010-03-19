<h1>
	Nuevo catastro
</h1>

<?php echo $form->create('Catastro', array('action' => 'nuevo', 'type' => 'file')); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
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
	<?php
		echo $form->input('Catastro.nombre_contacto', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.email_contacto', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.telefono_contacto', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>
<div class="bloque">
	<h2>
		Datos adicionales
	</h2>
	<?php
		$label_ini = '<div class="label ancho33 floatleft">';
		$label_fin = '</div>';
		
		echo $form->input('Catastro.caracterizacion', array('class' => 'input-textarea ancho50', 'label' => 'Descripci&oacute;n general', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Catastro.submittedfile', array('class' => 'file-chooser', 'label' => 'Adjuntar Archivo', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'file'));
	?>
</div>

<div class="bloque">
		<h2>
			Datos espec&iacute;ficos
		</h2>
		<div class="ancho25">
		<?php
			foreach($areas as $key => $area):
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

<?php echo $javascript->link('ubicacion.js'); ?>
