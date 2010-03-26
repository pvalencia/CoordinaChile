<?php $org = $organizacion['Organizacion']; ?>

<?php
	if($organizacion['Organizacion']['id'] == $user['Organizacion']['id'] || $user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/organizaciones/editar/<?php echo $organizacion['Organizacion']['id']; ?>" title="Editar el perfil de <?php echo $org['nombre'];?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	<?php echo $org['nombre'];?>
</h1>

<?php 
if(!isset($this->params['named']['noinfo'])): ?>

<?php if($org['areas_trabajo']) :?>
	<div class="bloquegrande">
		<?php echo $vistas->text2p($org['areas_trabajo']); ?>
	</div>
<?php endif; ?>

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
		<div class="label ancho33">Correo electr&oacute;nico</div><?php echo $text->autoLink($org['email'], array('title' => 'Contactar a '.$org['nombre'])); ?>
	</div>
	<?php if($org['web']) :?>
		<div class="input text">
			<div class="label ancho33">Sitio web</div><?php echo $text->autoLink($org['web'], array('title' => 'Visitar el sitio web de '.$org['nombre'])); ?>
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
			<div class="label ancho33">Correo electr&oacute;nico</div><?php echo $text->autoLink($org['email_contacto'], array('title' => 'Contactar a '.$org['nombre_contacto'])); ?>
		</div>
	</div>
<?php endif; 
endif;
?>

<?php
$carpetas_class = array(
	0 => array(' active', ' active'),
	1 => array('', ' oculto'),
);

if(!$organizacion['Operativo'] && $organizacion['Catastro']) :
	$carpetas_class_aux = $carpetas_class[0];
	$carpetas_class[0] = $carpetas_class[1];
	$carpetas_class[1] = $carpetas_class_aux;
endif;
?>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="lengueta<?php echo $carpetas_class[0][0]; ?>" id="lenguetaoperativos">
				<a href="#" title="Operativos de <?php echo $org['nombre']; ?>">Operativos</a>
			</li>
			<li class="lengueta<?php echo $carpetas_class[1][0]; ?>" id="lenguetacatastros">
				<a href="#" title="Catastros de <?php echo $org['nombre']; ?>">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos carpeta<?php echo $carpetas_class[0][1]; ?>">
			<?php if($organizacion['Operativo']) :?>
				<div id="mapaoperativos" class="canvasmapa bloque mapachico ancho100"></div>
				<div id="listaoperativos">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho20 alignleft primero">Operativo</th>
								<th class="ancho25">Localidades</th>
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
								$localidades_suboperativos = $suboperativos[$ope['id']];
								$subops = count($localidades_suboperativos);
							?>
								<tr class="operativo<?php echo $ope['id']; ?>">
									<td class="ancho20 fila<?php echo $i; ?> primero" rowspan="<?php echo $subops;?>">
										<a href="/operativos/ver/<?php echo $ope['id']; ?>" title="Ver el detalle del Operativo <?php echo $ope['id']; ?>">
											Operativo <?php echo $ope['id']; ?>
										</a>
									</td>
									<?php foreach($localidades_suboperativos as $id => $localidad_id): ?>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$localidad_id]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$localidad_id]['lon']; ?></span>
										</span>
										<a href="/localidades/ver/<?php echo $localidad_id; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$localidad_id]['nombre']; ?>">
											<?php echo $localidades[$localidad_id]['nombre']; ?>
										</a>
									</td>
									<?php
										break;
									endforeach;
									?>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter" rowspan="<?php echo $subops;?>">
										<?php echo $time->format('d-m-Y', $ope['fecha_llegada']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter" rowspan="<?php echo $subops;?>">
										<?php echo $time->format('d-m-Y', $vistas->getFechaFin($ope['fecha_llegada'], $ope['duracion'])); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter" rowspan="<?php echo $subops;?>">
										<a href="#" id="operativo<?php echo $ope['id']; ?>" class="verpunto" title="Ver el Operativo <?php echo $ope['id']; ?> en el mapa">Ver</a>
									</td>
								</tr>
								<?php $first = true;
								foreach($localidades_suboperativos as $id => $localidad_id): 
									    if($first){ $first = false; continue;}?>
									    <tr>
										<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$localidad_id]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$localidad_id]['lon']; ?></span>
										</span>
										<a href="/localidades/ver/<?php echo $localidad_id; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$localidad_id]['nombre']; ?>">
											<?php echo $localidades[$localidad_id]['nombre']; ?>
										</a>
										</td>
										</tr>
								<?php 
								endforeach
								?>
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
						<a href="/operativos/nuevo" title="Agregar un nuevo operativo">Agregar un nuevo operativo</a>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="lenguetacatastros carpeta<?php echo $carpetas_class[1][1]; ?>">
			<?php if($organizacion['Catastro']) :?>
				<div id="mapacatastros" class="canvasmapa bloque mapachico ancho100"></div>
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
										<a href="/catastros/ver/<?php echo $cat['id']; ?>" title="Ver el detalle del Catastro <?php echo $cat['id']; ?>">
											Catastro <?php echo $cat['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$cat['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$cat['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho35 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $cat['localidad_id']; ?>" title="Ver el detalle de la localidad <?php echo $localidades[$cat['localidad_id']]['nombre']; ?>">
											<?php echo $localidades[$cat['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $cat['fecha']); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="catastro<?php echo $cat['id']; ?>" class="verpunto" title="Ver el Catastro <?php echo $cat['id']; ?> en el mapa">Ver</a>
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
						<a href="/catastros/nuevo" title="Agregar un nuevo catastro">Agregar un nuevo catastro</a>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php if($organizacion['Operativo'] || $organizacion['Catastro']) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php if($organizacion['Operativo']) : ?>
				var loc_op = <?php echo $javascript->Object($localidades); ?>;
				var params_op = {
					controlador: 'organizaciones',
					vista: 'ver',
					canvasmapa_id: 'mapaoperativos',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(loc_op, params_op);
			<?php endif; ?>
			<?php if($organizacion['Catastro']) : ?>
				var loc_cat = <?php echo $javascript->Object($localidades); ?>;
				var params_cat = {
					controlador: 'organizaciones',
					vista: 'ver',
					canvasmapa_id: 'mapacatastros',
					tipo: 'catastros',
					nombre: 'Catastro'
				};
		
				cargarMapa(loc_cat, params_cat);
			<?php endif; ?>
		});
	</script>
<?php endif; ?>

