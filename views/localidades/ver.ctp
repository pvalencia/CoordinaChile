<?php $loc = $localidad['Localidad']; ?>

<?php
	if($user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/localidades/editar/<?php echo $localidad['Localidad']['id']; ?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	Localidad de <?php echo $loc['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div><?php echo $regiones->getHtmlName($localidad['Comuna']['id'], true); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Comuna</div><a href="/comunas/ver/<?php echo $localidad['Comuna']['id']; ?>" title="Ver el detalle de la comuna de <?php echo $localidad['Comuna']['nombre']; ?>"><?php echo $localidad['Comuna']['nombre']; ?></a>
	</div>
	<?php if($user['Organizacion']['admin']) : ?>
		<div class="input text">
			<div class="label ancho33">Latitud</div><?php echo $loc['lat']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Longitud</div><?php echo $loc['lon']; ?>
		</div>
	<?php endif; ?>
</div>

<?php
$carpetas_class = array(
	0 => array(' active', ' active'),
	1 => array('', ' oculto'),
);

if(!$localidad['Operativo'] && $localidad['Catastro']) :
	$carpetas_class_aux = $carpetas_class[0];
	$carpetas_class[0] = $carpetas_class[1];
	$carpetas_class[1] = $carpetas_class_aux;
endif;
?>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="lengueta<?php echo $carpetas_class[0][0]; ?>" id="lenguetaoperativos">
				<a href="#" title="Operativos en la localidad de <?php echo $loc['nombre']; ?>">Operativos</a>
				
			</li>
			<li class="lengueta<?php echo $carpetas_class[1][0]; ?>" id="lenguetacatastros">
				<a href="#" title="Catastros de la localidad de <?php echo $loc['nombre']; ?>">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos carpeta<?php echo $carpetas_class[0][1]; ?>">
			<?php if($localidad['Operativo']) :?>
				<div id="mapaoperativos" class="canvasmapa bloque ancho100 mapachico"></div>
				<div id="listaoperativos">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho25 alignleft primero">Operativo</th>
								<th class="ancho25">Inicio</th>
								<th class="ancho25">T&eacute;rmino</th>
								<th class="ancho25 ultimo">Organizaci&oacute;n</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($localidad['Operativo'] as $operativo) :
							?>
								<tr>
									<td class="ancho25 fila<?php echo $i; ?> primero">
										<a href="/operativos/ver/<?php echo $operativo['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['id']; ?>">
											Operativo <?php echo $operativo['id']; ?>
										</a>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $operativo['fecha_llegada']); ?>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['fecha_llegada'], $operativo['duracion'])); ?>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> ultimo aligncenter" title="Ver el perfil de <?php echo $operativo['Organizacion']['nombre']; ?>">
										<a href="/organizaciones/ver/<?php echo $operativo['Organizacion']['id']; ?>">
											<?php echo $operativo['Organizacion']['nombre']; ?>
										</a>
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
			<?php endif; ?>
		</div>
		<div class="lenguetacatastros carpeta<?php echo $carpetas_class[1][1]; ?>">
			<?php if($localidad['Catastro']) :?>
				<div id="mapacatastros" class="canvasmapa bloque ancho100 mapachico"></div>
				<div id="listacatastros">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho33 primero alignleft">Catastro</th>
								<th class="ancho33">Realizaci&oacute;n</th>
								<th class="ancho33 ultimo">Organizaci&oacute;n</th>
							</tr>
						</table>
					</div>
					<div class="contenidotabla">
						<table class="ancho100 sinborde">
							<?php
							$i = 1;
							foreach($localidad['Catastro'] as $catastro) :
							?>
								<tr>
									<td class="ancho33 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $catastro['id']; ?>" title="Ver el detalle del Catastro <?php echo $catastro['id']; ?>">
											Catastro <?php echo $catastro['id']; ?>
										</a>
									</td>
									<td class="ancho33 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $catastro['fecha']); ?>
									</td>
									<td class="ancho33 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="/organizaciones/ver/<?php echo $catastro['Organizacion']['id']; ?>" title="Ver el perfil de <?php echo $catastro['Organizacion']['nombre']; ?>">
											<?php echo $catastro['Organizacion']['nombre']; ?>
										</a>
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

<?php if($localidad['Operativo'] || $localidad['Catastro']) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php if($localidad['Operativo']) : ?>
				var loc_op = <?php echo $javascript->Object($localidad['Operativo']); ?>;
				var params_op = {
					controlador: 'localidades',
					vista: 'ver',
					canvasmapa_id: 'mapaoperativos',
					tipo: 'operativos',
					nombre: 'Operativo'
				};
		
				cargarMapa(loc_op, params_op);
			<?php endif; ?>
			<?php if($localidad['Catastro']) : ?>
				var loc_cat = <?php echo $javascript->Object($localidad['Catastro']); ?>;
				var params_cat = {
					controlador: 'localidades',
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