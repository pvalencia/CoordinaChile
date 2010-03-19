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

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="lengueta active" id="lenguetaoperativos">
				<a href="#" title="Operativos realizados">Operativos</a>
			</li>
			<li class="lengueta" id="lenguetacatastros">
				<a href="#" title="Catastros realizados">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos carpeta active">
			<?php if($operativos) :?>
				<div id="mapaoperativos" class="canvasmapa bloque">Mapa</div>
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
							?>
								<tr class="operativo<?php echo $operativo['Operativo']['id']; ?>">
									<td class="ancho15 fila<?php echo $i; ?> primero">
										<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>">
											Operativo <?php echo $operativo['Operativo']['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$operativo['Operativo']['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$operativo['Operativo']['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $operativo['Operativo']['localidad_id']; ?>">
											<?php echo $localidades[$operativo['Operativo']['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', fechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/organizaciones/ver/<?php echo $operativo['Operativo']['organizacion_id']; ?>">
											<?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="operativo<?php echo $operativo['Operativo']['id']; ?>" class="verpunto">Ver</a>
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
		<div class="lenguetacatastros carpeta oculto">
			<?php if($catastros) :?>
				<div id="mapacatastros" class="canvasmapa bloque">Mapa</div>
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
										<a href="/catastros/ver/<?php echo $catastro['Catastro']['id']; ?>">
											Catastro <?php echo $catastro['Catastro']['id']; ?>
										</a>
										<span class="latlon oculto">
											<span class="lat"><?php echo $localidades[$catastro['Catastro']['localidad_id']]['lat']; ?></span>
											<span class="lon"><?php echo $localidades[$catastro['Catastro']['localidad_id']]['lon']; ?></span>
										</span>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $catastro['Catastro']['localidad_id']; ?>">
											<?php echo $localidades[$catastro['Catastro']['localidad_id']]['nombre']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $catastro['Catastro']['fecha']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/organizaciones/ver/<?php echo $catastro['Catastro']['organizacion_id']; ?>">
											<?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#" id="catastro<?php echo $catastro['Catastro']['id']; ?>" class="verpunto">Ver</a>
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

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<?php echo $javascript->link('mapa.js'); ?>
<?php if($operativos || $catastros) : ?>
	<script type="text/javascript">
		<?php if($operativos) : ?>
			var loc_op = <?php echo $javascript->Object($localidades); ?>;
	
			cargarMapaOperativos_OrganizacionesComunas(loc_op);
		<?php endif; ?>
		
		<?php if($catastros) : ?>
			var loc_cat = <?php echo $javascript->Object($localidades); ?>;
	
			cargarMapaCatastros_OrganizacionesComunas(loc_cat);
		<?php endif; ?>
	</script>
<?php endif; ?>