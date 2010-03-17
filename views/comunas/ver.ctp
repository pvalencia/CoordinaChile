

<h1> <?php echo $comuna['Comuna']['nombre']; ?> </h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div>
	</div>
	<div class="input text">
		<div class="label ancho33">Latitud</div><?php echo $comuna['Comuna']['lat']; ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Longitud</div><?php echo $comuna['Comuna']['lon']; ?>
	</div>
</div>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
			<li class="active" id="lenguetaoperativos">
				<a href="#" title="Operativos realizados">Operativos</a>
			</li>
			<li id="lenguetacatastros">
				<a href="#" title="Catastros realizados">Catastros</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
		<div class="lenguetaoperativos">
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
								<tr>
									<td class="ancho15 fila<?php echo $i; ?> primero">
										<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>">
											Operativo <?php echo $operativo['Operativo']['id']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $operativo['Localidad']['id']; ?>">
											<?php echo $operativo['Localidad']['nombre']; ?>
										</a>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
									</td>
									<td class="ancho15 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', fechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
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
		<div class="lenguetacatastros oculto">
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
								<tr>
									<td class="ancho20 fila<?php echo $i; ?> primero">
										<a href="/catastros/ver/<?php echo $catastro['Catastro']['id']; ?>">
											Catastro <?php echo $catastro['Catastro']['id']; ?>
										</a>
									</td>
									<td class="ancho25 fila<?php echo $i; ?> aligncenter">
										<a href="/localidades/ver/<?php echo $catastro['Localidad']['id']; ?>">
											<?php echo $catastro['Localidad']['nombre']; ?>
										</a>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
										<?php echo $time->format('d-m-Y', $catastro['Catastro']['fecha']); ?>
									</td>
									<td class="ancho20 fila<?php echo $i; ?> aligncenter">
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