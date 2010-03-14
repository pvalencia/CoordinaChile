
<?php $org = $organizacion['Organizacion']; ?>

<h1>
	<?php echo $org['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Tipo de organizaci&oacute;n</div><?php echo $organizacion['TipoOrganizacion']['nombre']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Tel&eacute;fono</div><?php echo $org['telefono']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Correo electr&oacute;nico</div><a href="mailto:<?php echo $org['email']; ?>"><?php echo $org['email']; ?></a>
	</div>
	<?php if($org['web']) :?>
		<div class="input text">
			<div class="label ancho33">Sitio web</div><a href="<?php echo href($org['web']); ?>"><?php echo $org['web']; ?></a>
		</div>
	<?php endif; ?>
	<div class="input text"> 
		<div class="label ancho33">Nombre del contacto</div><?php echo $org['nombre_contacto']; ?>
	</div>
	<div class="input text"> 
		<div class="label ancho33">Tel&eacute;fono de contacto</div><?php echo $org['telefono_contacto']; ?>
	</div>
	<?php if($org['areas_trabajo']) :?>
		<div class="input text"> 
			<div class="label ancho33">&Aacute;rea de trabajo</div><?php echo $org['areas_trabajo']; ?> 
		</div>
	<?php endif;?>
</div>

<?php if($organizacion['Operativo'] || $organizacion['Catastro']) :?>
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<?php if($organizacion['Operativo']) :?>
					<li class="active" id="lenguetaoperativos">
						<a href="#" title="Operativos realizados">Operativos</a>
					</li>
				<?php endif; ?>
				<?php if($organizacion['Catastro']) :
					$class_activo = '';
					if(!$organizacion['Operativo'])
						$class_activo = 'active';
				?>
					<li class="<?php echo $class_activo; ?>" id="lenguetacatastros">
						<a href="#" title="Catastros realizados">Catastros</a>
					</li>
				<?php endif; ?>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
			<?php if($organizacion['Operativo']) :?>
				<div class="lenguetaoperativos">
					<div id="listaoperativos" class="ancho50 floatleft bloque">
						<table class="ancho100">
							<tr>
								<th class="ancho33 alignleft primero">Localidad</th>
								<th class="ancho33">Fecha</th>
								<th class="ancho33 ultimo">Duraci&oacute;n (d&iacute;as)</th>
							</tr>
							<?php
							$i = 1;
							foreach($organizacion['Operativo'] as $key => $ope) :
							?>
								<tr>
									<td class="ancho33 fila<?php echo $i; ?> alignleft primero">
										<a href="/operativos/ver/<?php echo $ope['id']; ?>">
											<?php echo $localidades[$ope['localidad_id']]; ?>
										</a>
									</td>
									<td class="ancho33 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $ope['fecha_llegada']); ?>
									</td>
									<td class="ancho33 fila<?php echo $i; ?> ultimo aligncenter">
										<?php echo $ope['duracion']; ?>
									</td>
								</tr>
							<?php
								if($i == 1)
									$i = 2;
								else
									$i = 1;
							endforeach;
							?>
						</table>
					</div>
					<div id="mapaoperativos" class="canvasmapa floatleft">Mapa</div>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
			<?php if($organizacion['Catastro']) :
				$class_oculto = ' oculto';
				if(!$organizacion['Operativo'])
					$class_oculto = '';
			?>
				<div class="lenguetacatastros<?php echo $class_oculto; ?>">
					<div id="listacatastros" class="ancho50 floatleft bloque">
						<table class="ancho100">
							<tr>
								<th class="ancho50 primero alignleft">Localidad</th>
								<th class="ancho50 ultimo">Fecha</th>
							</tr>
							<?php
							$i = 1;
							foreach($organizacion['Catastro'] as $key => $cat) :
							?>
								<tr>
									<td class="ancho50 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $cat['id']; ?>">
											<?php echo $localidades[$cat['localidad_id']]; ?>
										</a>
									</td>
									<td class="ancho50 fila<?php echo $i; ?> ultimo aligncenter">
										<?php echo $time->format('d-m-Y', $cat['fecha']); ?>
									</td>
								</tr>
							<?php
								if($i == 1)
									$i = 2;
								else
									$i = 1;
							endforeach;
							?>
						</table>
					</div>
					<div id="mapaoperativos" class="canvasmapa floatleft">Mapa</div>
					<div class="clear"></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	
	<?php echo $javascript->link('tabs.js'); ?>
<?php endif; ?>
