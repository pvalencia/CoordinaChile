<h1>
	Nuevo operativo
</h1>

<div class="bloquegrande">
	<p class="intro">
		A continuaci&oacute;n se presentan los campos para la generaci&oacute;n de un nuevo operativo de tu organizaci&oacute;n en alguna localidad. Recuerda que los campos con <span class="requerido">*</span> son obligatorios de llenar.
	</p>
</div>

<?php echo $form->create('Operativo', array('url' => array('controller' => 'operativos', 'action' => 'nuevo', $organizacion['Organizacion']['id']))); ?>

	<div class="bloque">
		<h2>
			Datos generales
		</h2>
		<p class="intro">
			Ingresa los datos b&aacute;sicos del operativo. Esta informaci&oacute;n podr&aacute; ser le&iacute;da por cualquiera.
		</p>
		<?php
			$label_ini = '<div class="label ancho33">';
			$label_fin = '<span class="requerido">&nbsp;*</span></div>';
			
			if(!$user['Organizacion']['admin'])
				echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id'], 'before' => $label_ini, 'between' => $label_fin));
			else
				echo $form->input('Operativo.organizacion_id', array('class' => 'input-select', 'label' => 'Organizaci&oacute;n', 'before' => $label_ini, 'between' => $label_fin));
			echo $form->input('Operativo.regiones', array('class' => 'input-select regiones', 'div' => 'input select selectregiones', 'selected' => 13, 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones->getRegiones(), 'label' => 'Regi&oacute;n'));
			echo $form->input('Operativo.comunas', array('class' => 'input-select comunas', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array(), 'label' => 'Comuna'));
		?>
	</div>
	
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta active" id="lengueta0">
					<a href="#" title="Datos de la localidad">Datos de la localidad</a>
				</li>
				<li class="lengueta" id="lengueta1">
					<a href="#" title="Agregar una nueva localidad" class="agregar localidad">Agregar localidad</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta" class="bloque">
			<div class="lengueta0 carpeta active">
				<div class="bloque">
					<h3>
						Datos generales
					</h3>
					<?php
						echo $form->input('Operativo.0.localidad_id', array('class' => 'input-select localidades', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => array()));
						echo $form->input('Operativo.0.fecha_llegada', array('class' => 'input-select fecha', 'label' => 'Fecha de inicio', 'before' => $label_ini, 'between' => $label_fin));
						echo $form->input('Operativo.0.duracion', array('class' => 'input-text cantidad', 'default' => 1, 'label' => 'Duraci&oacute;n (d&iacute;as)', 'before' => $label_ini, 'between' => $label_fin));
					?>
				</div>
				<div class="bloque">
					<h3>
						Datos del encargado
					</h3>
					<p class="intro">
						Ingresa los datos de aquella persona que ser&aacute; la responsable en terreno de la realizaci&oacute;n del operativo. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
					</p>
					<?php
						echo $form->input('Operativo.0.nombre', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
						echo $form->input('Operativo.0.telefono', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
						echo $form->input('Operativo.0.email', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
					?>
				</div>
				<div>
					<h3>
						Datos espec&iacute;ficos <span class="requerido">*</span>
					</h3>
					<p class="intro">
						Marca el o las &aacute;reas en las cuales se desenvolver&aacute; el operativo, y en el formulario que se desplegar&aacute; a continuaci&oacute;n, llena los campos que estimes pertinentes. <strong>Debes marcar al menos un &aacute;rea</strong>. Esta informaci&oacute;n s&oacute;lo podr&aacute; ser le&iacute;da por aquellas organizaciones y administradores que hayan iniciado su sesi&oacute;n.
					</p>
					<div>
					<?php
						foreach($areas as $key => $area):
							if($key == 4) :
								$area .= ' <small><em>(transporte, herramientras de construcci&oacute;n, etc.)</em></small>';
							endif;
							echo $form->input('Operativo.0.'.$key, array(
								'type' => 'checkbox',
								'label' => $area,
								'id' => 'showit0-'.$key,
								'class' => 'input-checkbox showit'));
						endForeach;
					?>
					</div>
					<?php
					$area = 0;
				
					foreach($areas as $key => $area) :
					?>
						<div class="toshow showit0-<?php echo $key; ?> bloque oculto">
							<h4>
								<?php echo $area; ?>
							</h4>
							<table class="ancho100">
								<tr>
									<th class="ancho50 primero alignleft">&Iacute;tem</th>
									<th class="ancho15">Cantidad</th>
									<th class="ancho35 ultimo">Caracter&iacute;stica</th>
								</tr>
								<?php
								$i = 1;
								
								foreach($tipos as $tipo) :
									if($key == $tipo['TipoRecurso']['area_id']) :
								?>
										<tr>
											<td class="ancho50 fila<?php echo $i;?> primero">
											<?php 
												echo $form->input('Recurso.0.'.$tipo['TipoRecurso']['id'].'.tipo_recurso_id', array('value' => $tipo['TipoRecurso']['id'], 'type' => 'hidden')); 
												echo $tipo['TipoRecurso']['nombre'];
											?>
											<?php if(!empty($tipo['TipoRecurso']['descripcion'])) :?>
												<br/>
												<small>
													<?php echo $tipo['TipoRecurso']['descripcion']; ?>
												</small>
											<?php endif; ?>
											</td>
											<td class="ancho15 fila<?php echo $i;?> aligncenter">
												<?php echo $form->text('Recurso.0.'.$tipo['TipoRecurso']['id'].'.cantidad', array('class' => 'cantidad input-text', 'default' => 0, 'size' => 5) ); ?>
											</td>
											<td class="ancho35 fila<?php echo $i;?> ultimo">
												<?php echo $form->text('Recurso.0.'.$tipo['TipoRecurso']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25)); ?>
											</td>
										</tr>
										<?php
										if($i == 1)
											$i = 2;
										else
											$i = 1;
									endif;
								endforeach;
								?>
							</table>
						</div>
					<?php 
					endforeach; 
					?>
				</div>
				<div class="oculto" id="necesidades-intro">
					<br />
					<h3>
						Necesidades a cubrir
					</h3>
					<p class="intro">
						Marca los elementos presentes actualmente en la localidad de los que pretende preocuparse el Operativo.
					</p>
				</div>
				<div id="necesidades">
				</div>
			</div>
		</div>
	</div>
	<?php echo $form->submit('Crear operativo', array('class' => 'input-button')); ?>
	
<?php echo $form->end(); ?>

<?php echo $javascript->link('necesidades.js'); ?>
<?php echo $javascript->link('formulario.js'); ?>

