<?php $loc = $localidad['Localidad']; ?>

<h1>
	<?php echo $loc['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div><?php echo $regiones->getHtmlName($localidad['Comuna']['id'], true); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Comuna</div><a href="/comunas/ver/<?php echo $localidad['Comuna']['id']; ?>"><?php echo $localidad['Comuna']['nombre']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Latitud</div><?php echo $loc['lat']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Longitud</div><?php echo $loc['lon']; ?>
	</div>

	<img src="http://maps.google.com/staticmap?center=<?php echo $loc['lat']; ?>,<?php echo $loc['lon']; ?>&zoom=14&size=512x200&markers=<?php echo $loc['lat']; ?>,<?php echo $loc['lon']; ?>,red&sensor=false&key=ABQIAAAAEbJVDLJQrWbQECox1QNqKBQlFJ7uMGmw31pn-fRymyxAeVKaWBS3180QHAhYGdBEW75YUlsUILZrEg" />

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
			<?php if($localidad['Operativo']) :?>
				<div id="mapaoperativos" class="canvasmapa bloque">Mapa</div>
				<div id="listaoperativos">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho25 alignleft primero">Operativo</th>
								<th class="ancho20">Inicio</th>
								<th class="ancho20">T&eacute;rmino</th>
								<th class="ancho20">Organizaci&oacute;n</th>
								<th class="ancho15 ultimo">Mapa</th>
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
										<a href="/operativos/ver/<?php echo $operativo['id']; ?>">
											Operativo <?php echo $operativo['id']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $operativo['fecha_llegada']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', fechaFin($operativo['fecha_llegada'], $operativo['duracion'])); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/organizaciones/ver/<?php echo $operativo['Organizacion']['id']; ?>">
											<?php echo $operativo['Organizacion']['nombre']; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#">Ver</a>
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
			<?php if($localidad['Catastro']) :?>
				<div id="mapacatastros" class="canvasmapa bloque">Mapa</div>
				<div id="listacatastros">
					<div class="encabezadotabla">
						<table class="ancho100 sinborde">
							<tr>
								<th class="ancho25 primero alignleft">Catastro</th>
								<th class="ancho25">Realizaci&oacute;n</th>
								<th class="ancho35">Organizaci&oacute;n</th>
								<th class="ancho15 ultimo">Mapa</th>
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
									<td class="ancho25 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $catastro['id']; ?>">
											Catastro <?php echo $catastro['id']; ?>
										</a>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $catastro['fecha']); ?>
									</td>
									<td class="ancho35 fila<?php echo $i; ?> aligncenter">
										<a href="/organizaciones/ver/<?php echo $catastro['Organizacion']['id']; ?>">
											<?php echo $catastro['Organizacion']['nombre']; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> ultimo aligncenter">
										<a href="#">Ver</a>
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

<?php echo $javascript->link('visualizacion.js'); ?>
