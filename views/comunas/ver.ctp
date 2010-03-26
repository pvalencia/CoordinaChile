<?php
	if($user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/comunas/editar/<?php echo $comuna['Comuna']['id']; ?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	Comuna de <?php echo $comuna['Comuna']['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div><?php echo $regiones->getHtmlName($comuna['Comuna']['id'], true); ?>
	</div>
	<?php if($user['Organizacion']['admin']) : ?>
		<div class="input text">
			<div class="label ancho33">Latitud</div><?php echo $comuna['Comuna']['lat']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Longitud</div><?php echo $comuna['Comuna']['lon']; ?>
		</div>
	<?php endif; ?>
</div>

<?php
$carpetas_class = array(
	0 => array(' active', ' active'),
	1 => array('', ' oculto'),
);

if(!$operativos && $catastros) :
	$carpetas_class_aux = $carpetas_class[0];
	$carpetas_class[0] = $carpetas_class[1];
	$carpetas_class[1] = $carpetas_class_aux;
endif;
?>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="lengueta<?php echo $carpetas_class[0][0]; ?>" id="lenguetaoperativos">
				<a href="#" title="Operativos en la comuna de <?php echo $comuna['Comuna']['nombre']; ?>">Operativos</a>
			</li>
			<li class="lengueta<?php echo $carpetas_class[1][0]; ?>" id="lenguetacatastros">
				<a href="#" title="Catastros de la comuna de <?php echo $comuna['Comuna']['nombre']; ?>">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos carpeta<?php echo $carpetas_class[0][1]; ?>">
			<?php if($operativos) :?>
				<div id="mapaoperativos" class="canvasmapa bloque ancho100 mapachico"></div>
				<div id="listaoperativos">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho15 alignleft primero">Operativo</th>
								<th class="ancho20">Localidad</th>
								<th class="ancho15">Inicio</th>
								<th class="ancho15">T&eacute;rmino</th>
								<th class="ancho20">Organizaci&oacute;n</th>
								<th class="ancho15 ultimo">Mapa</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($operativos as $operativo) :
								$suboperativos = $operativo['Suboperativo'];
								$subops = count($suboperativos);
							?>
								<tr class="operativo<?php echo $operativo['Operativo']['id']; ?>">
									<td class="ancho15 fila<?php echo $i; ?> primero" rowspan="<?php echo $subops;?>">
										<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['Operativo']['id']; ?>">
											Operativo <?php echo $operativo['Operativo']['id']; ?>
										</a>
									</td>
									
									<?php foreach($suboperativos as $suboperativo): ?>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$suboperativo['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$suboperativo['localidad_id']]['lon']; ?></span>
										</span>
										<a href="/localidades/ver/<?php echo $suboperativo['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$suboperativo['localidad_id']]['nombre']; ?>">
											<?php echo $localidades[$suboperativo['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<?php break;
									endforeach ?>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter" rowspan="<?php echo $subops;?>">
										<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter" rowspan="<?php echo $subops;?>">
										<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter" rowspan="<?php echo $subops;?>">
										<a href="/organizaciones/ver/<?php echo $operativo['Operativo']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?>">
											<?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter" rowspan="<?php echo $subops;?>">
										<a href="#" id="operativo<?php echo $operativo['Operativo']['id']; ?>" class="verpunto" title="Ver el Operativo <?php echo $operativo['Operativo']['id']; ?> en el mapa">Ver</a>
									</td>
								</tr>
							<?php $first = true;
							foreach($suboperativos as $suboperativo):  if($first){$first = false; continue;}?>
									<tr>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$operativo['Operativo']['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$operativo['Operativo']['localidad_id']]['lon']; ?></span>
										</span>
										<a href="/localidades/ver/<?php echo $suboperativo['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$suboperativo['localidad_id']]['nombre']; ?>">
											<?php echo $localidades[$suboperativo['localidad_id']]['nombre']; ?>
										</a>
									</td>
									</tr>
							<?php 
								endforeach ?>
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
			<?php endif; ?>
		</div>
		<div class="lenguetacatastros carpeta<?php echo $carpetas_class[1][1]; ?>">
			<?php if($catastros) :?>
				<div id="mapacatastros" class="canvasmapa bloque ancho100 mapachico"></div>
				<div id="listacatastros">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho20 primero alignleft">Catastro</th>
								<th class="ancho25">Localidad</th>
								<th class="ancho20">Realizaci&oacute;n</th>
								<th class="ancho20">Organizaci&oacute;n</th>
								<th class="ancho15 ultimo">Mapa</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($catastros as $catastro) :
							?>
								<tr class="catastro<?php echo $catastro['Catastro']['id']; ?>">
									<td class="ancho20 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $catastro['Catastro']['id']; ?>" title="Ver el detalle del Catastro <?php echo $catastro['Catastro']['id']; ?>">
											Catastro <?php echo $catastro['Catastro']['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$catastro['Catastro']['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$catastro['Catastro']['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $catastro['Catastro']['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$catastro['Catastro']['localidad_id']]['nombre']; ?>">
											<?php echo $localidades[$catastro['Catastro']['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $catastro['Catastro']['fecha']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/organizaciones/ver/<?php echo $catastro['Catastro']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?>">
											<?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="catastro<?php echo $catastro['Catastro']['id']; ?>" class="verpunto" title="Ver el Catastro <?php echo $catastro['Catastro']['id']; ?> en el mapa">Ver</a>
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
			<?php endif; ?>
		</div>
	</div>
</div>

<?php if($operativos || $catastros) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php if($operativos) : ?>
				var loc_op = <?php echo $javascript->Object($localidades); ?>;
				var params_op = {
					controlador: 'comunas',
					vista: 'ver',
					canvasmapa_id: 'mapaoperativos',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(loc_op, params_op);
			<?php endif; ?>
			<?php if($catastros) : ?>
				var loc_cat = <?php echo $javascript->Object($localidades); ?>;
				var params_cat = {
					controlador: 'comunas',
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
