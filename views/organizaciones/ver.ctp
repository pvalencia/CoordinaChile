<?php $org = $organizacion['Organizacion']; ?>

<?php
	if($organizacion['Organizacion']['id'] == $user['Organizacion']['id'] || $user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/organizaciones/editar/<?php echo $organizacion['Organizacion']['id']; ?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	<?php echo $org['nombre'];?>
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
</div>

<?php if($auth) : ?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n del contacto
		</h2>
		
		<div class="input text"> 
			<div class="label ancho33">Nombre</div><?php echo $org['nombre_contacto']; ?>
		</div>
		<div class="input text"> 
			<div class="label ancho33">Tel&eacute;fono</div><?php echo $org['telefono_contacto']; ?>
		</div>
		<div class="input text"> 
			<div class="label ancho33">Correo electr&oacute;nico</div><a href="mailto:<?php echo $org['email_contacto']; ?>"><?php echo $org['email_contacto']; ?></a>
		</div>
	</div>
<?php endif; ?>

<?php if($org['areas_trabajo']) :?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n adicional
		</h2>
		
		<div class="input text"> 
			<div class="label ancho33">&Aacute;rea de trabajo</div><?php echo $org['areas_trabajo']; ?> 
		</div>
	</div>
<?php endif;?>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="lengueta active" id="lenguetaoperativos">
				<a href="#" title="Operativos realizados">Operativos</a>
			</li class="lengueta">
			<li id="lenguetacatastros">
				<a href="#" title="Catastros realizados">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos carpeta active">
			<?php if($organizacion['Operativo']) :?>
				<div id="mapaoperativos" class="canvasmapa bloque ancho100"></div>
				<div id="listaoperativos">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho20 alignleft primero">Operativo</th>
								<th class="ancho25">Localidad</th>
								<th class="ancho20">Inicio</th>
								<th class="ancho20">T&eacute;rmino</th>
								<th class="ancho15 ultimo">Mapa</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($organizacion['Operativo'] as $key => $ope) :
							?>
								<tr class="operativo<?php echo $ope['id']; ?>">
									<td class="ancho20 fila<?php echo $i; ?> primero">
										<a href="/operativos/ver/<?php echo $ope['id']; ?>">
											Operativo <?php echo $ope['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$ope['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$ope['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $ope['localidad_id']; ?>">
											<?php echo $localidades[$ope['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $ope['fecha_llegada']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', fechaFin($ope['fecha_llegada'], $ope['duracion'])); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="operativo<?php echo $ope['id']; ?>" class="verpunto">Ver</a>
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
				</div>
			<?php else: ?>
				<p>
					No existen operativos ingresados.
				</p>
				<?php if($user['Organizacion']['id'] == $org['id'] || $user['Organizacion']['admin']) : ?>
					<p>
						<a href="/operativos/nuevo">Agregar un nuevo operativo</a>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="lenguetacatastros carpeta oculto">
			<?php if($organizacion['Catastro']) :?>
				<div id="mapacatastros" class="canvasmapa bloque ancho100"></div>
				<div id="listacatastros">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho25 primero alignleft">Catastro</th>
								<th class="ancho35">Localidad</th>
								<th class="ancho25">Realizaci&oacute;n</th>
								<th class="ancho15 ultimo">Mapa</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($organizacion['Catastro'] as $key => $cat) :
							?>
								<tr class="catastro<?php echo $cat['id']; ?>">
									<td class="ancho25 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $cat['id']; ?>">
											Catastro <?php echo $cat['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$cat['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$cat['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho35 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $cat['localidad_id']; ?>">
											<?php echo $localidades[$cat['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $cat['fecha']); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="catastro<?php echo $cat['id']; ?>" class="verpunto">Ver</a>
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
				</div>
			<?php else : ?>
				<p>
					No existen catastros ingresados.
				</p>
				<?php if($user['Organizacion']['id'] == $org['id'] || $user['Organizacion']['admin']) : ?>
					<p>
						<a href="/catastros/nuevo">Agregar un nuevo catastro</a>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<?php echo $javascript->link('mapa.js'); ?>
<?php if($organizacion['Operativo'] || $organizacion['Catastro']) : ?>
	<script type="text/javascript">
		<?php if($organizacion['Operativo']) : ?>
			var loc_op = <?php echo $javascript->Object($localidades); ?>;
	
			cargarMapaOperativos_OrganizacionesComunas(loc_op);
		<?php endif; ?>
		
		<?php if($organizacion['Catastro']) : ?>
			var loc_cat = <?php echo $javascript->Object($localidades); ?>;
	
			cargarMapaCatastros_OrganizacionesComunas(loc_cat);
		<?php endif; ?>
	</script>
<?php endif; ?>