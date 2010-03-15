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
		<div class="ancho25">
		<?php
			$i = 1;
			$sectores[1]='Salud';
			$sectores[2]='Vivienda';
			$sectores[3]='Humanitaria';
			$sectores[4]='Judicial';
			foreach($sectores as $key => $area):
				echo $form->input('Catastro.'.$key, array(
					'type' => 'checkbox',
					'label' => $area,
					'class' => 'input-checkbox Catastro Catastro'.$key));
			endForeach;
		?>
		</div>
</div>
	
	<?php
		foreach($sectores as $key => $area) :
			$i = 1;
		?>
			<div class="Catastro<?php echo $key; ?> bloque oculto">
				<h3>
					<?php echo $area; ?>
				</h3>
				<table class="ancho100">
					<tr>
						<th class="ancho75 primero alignleft">&Iacute;tem</th>
						<th>
					</tr>
				
				<?php
						if($key == 1) :
					?>
							<tr>
								<td class="ancho75 fila<?php echo $i++;?> primero">
						<?php	echo "N&uacute;mero de heridos,<br /><small>, Cantidad de personas con daños f&iacute;sicos que requieren atenci&oacute;n medica.</small>";	?>
								</td>
								<td class="ancho25">
						<?php	echo $form->input('Catastro.danos_graves_fisicos', array('class' => 'text-input cantidad', 'default' => 0, 'label' => ''));		?>
								</td>
							</tr>
							<tr>
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de personas con daño sicologico<br /><small>Cantidad de personas que requieren atenci&oacute;n sicol&oacute;gica.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.danos_graves_psicologicos', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de discapacitados<br /><small>Cantidad de personas que tienen cualquier tipo de discapacidad, sea f&iacute;sica o sicol&oacute;gica.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.personas_con_discapacidad', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de enfermos Cr&oacute;nicos<br /><small>Cantidad de personas que poseen un enfermedad cr&oacute;nica que requiere atenci&oacute;n medica o uso de medicamentos de forma peri&oacute;dica.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.enfermedades_cronicas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							<tr>								
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de embarazadas<br /><small>Cantidad de Mujeres que est&aacute;n embarazadas.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.embarazadas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de menores de 2 años<br /><small>Cantidad de Menores de 2 años.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.menores', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
					<?php
						elseif($key == 2) :
					?>
							<tr>
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de viviendas destru&iacute;das<br /><small>Cantidad de viviendas que se encuentran inhabitables.</small>"; ?>
								</td>
								<td class="ancho25">
							<?php echo $form->input('Catastro.casas_destruidas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de estructuras que requieren remoci&oacute;n de escombros<br /><small>Cantidad de viviendas donde es necesario realizar un limpieza de escombros.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.casas_remocion_escombros', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de estructuras que requieren evaluación estructural<br /><small>Cantidad de estructuras donde no es posible determinar si esta en condiciones de ser utilizada y que requiere de un an&aacutelisis más profesional de la estructura.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.casas_evaluacion_estructural', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							<tr>								
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de viviendas que no poseen sistema de excretas<br /><small>Cantidad de viviendas que no poseen sistema alguno de excretas, sea alcantarillados, posos sépticos o similares.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.sistema_excretas', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
					<?php
						elseif($key == 3) :
					?>
							<tr>
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Agua<br /><small>Cantidad de familias que no tienen acceso a agua potable.</small>"; ?>
								</td>
								<td class="ancho25">
							<?php echo $form->input('Catastro.agua', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Ropa<br /><small>Cantidad de Familias que requieren de ropa.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.ropa', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Abrigo<br /><small>Cantidad de Familias que requieren frazadas, ropa para cama, etc.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.abrigo', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							<tr>								
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Albergue<br /><small>Cantidad de familias que no poseen un lugar permanente donde vivir.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.albergue', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan &uacute;tiles de Aseo Personal<br /><small>Cantidad de Familias que requieren &uacute;tiles de aseo personal.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.aseo_personal', array('class' => 'text-input cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i--;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan &uacute;tiles de Aseo General<br /><small>Cantidad de Familias que requieren &uacute;tiles de aseo general.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.aseo_general', array('class' => 'input-text cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
							<tr>								
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Combustible<br /><small>Cantidad de Familias que necesitan combustible para iluminaci&oacute;n, calefacci&oacute;n o para cocinar.</small>"; ?>
								</td>
								<td>
							<?php echo $form->input('Catastro.combustible', array('class' => 'input-text cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>
					<?php
						elseif($key == 4) :
					?>
					
							<tr>
								<td class="ancho75 fila<?php echo $i++;?> primero">
							<?php echo "N&uacute;mero de familias que necesitan Asistencia Jur&iacute;dica<br /><small>Cantidad de familias que requieren de asistencia jur&iacute;dica sobre las garant&iacute;as o seguros asociados a sus bienes y consejo sobre acciones legales posibles producto de los daños recibidos por los mismos.</small>"; ?>
								</td>
								<td class="ancho25">
							<?php echo $form->input('Catastro.asistencia_juridica', array('class' => 'input-text cantidad', 'default' => 0, 'label' => '')); ?>
								</td>
							</tr>	
							
							<?php
						endif; ?>
						</table>
					</div>
		<?php		endforeach;
					?>
<div class="bloque">

	<?php
	echo $form->submit('Crear catastro', array('class' => 'input-button'));
	?>

</div>

<?php echo $form->end(); ?>

<?php echo $javascript->link('nuevo_catastro.js') ?>
<?php echo $javascript->link('ubicacion.js'); ?>
