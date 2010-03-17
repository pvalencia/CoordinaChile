<?php $cat = $catastro['Catastro']; ?>

<h1>
	Catastro <?php echo $catastro['Catastro']['id']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div>
	</div>
	<div class="input text">
		<div class="label ancho33">Comuna</div>
	</div>
	<div class="input text">
		<div class="label ancho33">Localidad</div><a href="/localidades/ver/<?php echo $catastro['Localidad']['id']?>"><?php echo $catastro['Localidad']['nombre']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Fecha de realizaci&oacute;n</div><?php echo $time->format('d-m-Y', $cat['fecha']); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Organizaci&oacute;n</div><a href="/organizaciones/ver/<?php echo $catastro['Organizacion']['id']?>"><?php echo $catastro['Organizacion']['nombre']; ?></a>
	</div>
</div>	

<div class="bloque">
	<h2>
		Informaci&oacute;n del contacto
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Nombre del contacto</div><?php echo $cat['nombre_contacto']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Correo electr&oacute;nico del contacto</div><a href="mailto:<?php echo $cat['email_contacto']; ?>"><?php echo $cat['email_contacto']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Tel&eacute;fono del contacto</div><?php echo $cat['telefono_contacto']; ?>
	</div>
</div>
<?php if($cat['caracterizacion']) : ?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n adicional
		</h2>
		
		<div class="input text">
			<div class="label ancho33">Descripci&oacute;n general</div><?php echo $cat['caracterizacion']; ?>
		</div>
	</div>
<?php endif; ?>

<div class="bloque">
	<h2>
		Informaci&oacute;n espec&iacute;fica
	</h2>
</div>

<?php
	$sectores = array('Salud', 'Vivienda', 'Humanitaria', 'Judicial');
	
	foreach($sectores as $key => $area) :
?>
		<div class="bloque">
			<h3>
				<?php echo $area; ?>
			</h3>
			
			<table class="ancho100">
				<tr>
					<th class="ancho75 primero alignleft">&Iacute;tem</th>
					<th class="ancho25 ultimo">Cantidad</th>
				</tr>
				<?php
				if($key == 0) :
				?>
					<?php if($cat['danos_graves_fisicos']) :?>
						<tr>
							<td class="ancho75 primero fila1">
								N&uacute;mero de heridos
							</td>
							<td class="ancho25 ultimo fila1 aligncenter">
								<?php echo num($cat['danos_graves_fisicos']); ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if($cat['danos_graves_psicologicos']) :?>
						<tr>
							<td class="ancho75 primero fila2">
								N&uacute;mero de personas con da&ntilde;o sicol&oacute;gico
							</td>
							<td class="ancho25 ultimo fila2 aligncenter">
								<?php echo num($cat['danos_graves_psicologicos']); ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if($cat['personas_con_discapacidad']) :?>
						<tr>
							<td class="ancho75 primero fila1">
								N&uacute;mero de discapacitados
							</td>
							<td class="ancho25 ultimo fila1 aligncenter">
								<?php echo num($cat['personas_con_discapacidad']); ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if($cat['enfermedades_cronicas']) :?>
						<tr>
							<td class="ancho75 primero fila2">
								N&uacute;mero de enfermos cr&oacute;nicos
							</td>
							<td class="ancho25 ultimo fila2 aligncenter">
								<?php echo num($cat['enfermedades_cronicas']); ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if($cat['embarazadas']) :?>
						<tr>
							<td class="ancho75 primero fila1">
								N&uacute;mero de embarazadas
							</td>
							<td class="ancho25 ultimo fila1 aligncenter">
								<?php echo num($cat['embarazadas']); ?>
							</td>
						</tr>
					<?php endif; ?>
					<?php if($cat['menores']) :?>
						<tr>
							<td class="ancho75 primero fila2">
								N&uacute;mero de menores de 2 a&ntilde;os
							</td>
							<td class="ancho25 ultimo fila2 aligncenter">
								<?php echo num($cat['menores']); ?>
							</td>
						</tr>
					<?php endif; ?>
				<?php
				elseif($key == 1) :
				?>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de viviendas destru&iacute;das
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['casas_destruidas']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila2">
							N&uacute;mero de estructuras que requieren remoci&oacute;n de escombros
						</td>
						<td class="ancho25 ultimo fila2 aligncenter">
							<?php echo num($cat['casas_remocion_escombros']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de estructuras que requieren evaluación estructural
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['casas_evaluacion_estructural']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila2">
							N&uacute;mero de viviendas que no poseen sistema de excretas
						</td>
						<td class="ancho25 ultimo fila2 aligncenter">
							<?php echo num($cat['sistema_excretas']); ?>
						</td>
					</tr>
				<?php
				elseif($key == 2) :
				?>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de familias que necesitan agua
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['agua']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila2">
							N&uacute;mero de familias que necesitan ropa
						</td>
						<td class="ancho25 ultimo fila2 aligncenter">
							<?php echo num($cat['ropa']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de familias que necesitan abrigo
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['abrigo']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila2">
							N&uacute;mero de familias que necesitan albergue
						</td>
						<td class="ancho25 ultimo fila2 aligncenter">
							<?php echo num($cat['albergue']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de familias que necesitan &uacute;tiles de aseo personal
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['aseo_personal']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila2">
							N&uacute;mero de familias que necesitan &uacute;tiles de aseo general
						</td>
						<td class="ancho25 ultimo fila2 aligncenter">
							<?php echo num($cat['aseo_general']); ?>
						</td>
					</tr>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de familias que necesitan combustible
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['combustible']); ?>
						</td>
					</tr>
				<?php
				elseif($key == 3) :
				?>
					<tr>
						<td class="ancho75 primero fila1">
							N&uacute;mero de familias que necesitan asistencia jur&iacute;dica
						</td>
						<td class="ancho25 ultimo fila1 aligncenter">
							<?php echo num($cat['asistencia_juridica']); ?>
						</td>
					</tr>
				<?php
				endif;
				?>
			</table>
		</div>
<?php
	endforeach;
?>