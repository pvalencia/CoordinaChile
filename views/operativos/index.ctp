<h1>
	Operativos <?php if($area){ echo 'de '.$area; } ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa los operativos<?php if($area){ echo ' de '.$area; } ?> que se est&aacute;n realizando en estos momentos, as&iacute; como tambi&eacute;n los que ya se han realizado, y los que se pretenden concretar en el futuro. Haz clic en el nombre del operativo para ver su detalle. Tambi&eacute;n puedes revisar la situaci&oacute;n particular de cada localidad haciendo clic en su nombre.
	</p>
</div>
<?php
$carpetas_class = array(
	0 => array(' active', ' active'),
	1 => array('', ' oculto'),
	2 => array('', ' oculto')
);

	if(!$operativos['activos'] && ($operativos['programados'] || $operativos['realizados'])) :
		$carpetas_class_aux = $carpetas_class[0];
		$carpetas_class[0] = $carpetas_class[1];
		
		if($operativos['programados'])
			$carpetas_class[1] = $carpetas_class_aux;
		if($operativos['realizados'])
			$carpetas_class[2] = $carpetas_class_aux;
	endif;
?>
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta<?php echo $carpetas_class[0][0]; ?>" id="lenguetaactivos">
					<a href="#" title="Operativos que se estan realizando en estos momentos">Activos</a>
				</li>
				<li class="lengueta<?php echo $carpetas_class[1][0]; ?>" id="lenguetaprogramados">
					<a href="#" title="Operativos que se han agendado para realizarse en el futuro">Agendados</a>
				</li>
				<li class="lengueta<?php echo $carpetas_class[2][0]; ?>" id="lenguetarealizados">
					<a href="#" title="Operativos que ya se han realizado y concluido">Realizados</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
			<?php 
			$j = 0;
			foreach($operativos as $key => $operativos_modo):
			?>
			<div class="lengueta<?php echo $key; ?> carpeta<?php echo $carpetas_class[$j++][1]; ?>">
				<?php if(count($operativos_modo) != 0) :?>
					<table id="listaoperativos<?php echo $key;?>" class="ancho100 sortable">
						<thead>
						<tr>
							<th class="ancho20 primero alignleft">Operativo</th>
							<th class="ancho20">Comuna</th>
							<th class="ancho20">Inicio</th>
							<th class="ancho20">T&eacute;rmino</th>
							<th class="ancho20 ultimo">Organizaci&oacute;n</th>
						</tr>
						</thead>
						<?php
						$i = 1;
						foreach($operativos_modo as $operativo) :
						
						?>
							<tr class = "fila<?php echo $i; ?>">
								<td class="ancho20 primero">
									<a href="/operativos/ver/<?php echo $operativo['Operativo']['id']; ?>" title="Ver el detalle del Operativo <?php echo $operativo['Operativo']['id']; ?>">Operativo <?php echo $operativo['Operativo']['id']; ?></a>
								</td>
								<td class="ancho20 aligncenter">
									<a href="/comunas/ver/<?php echo $operativo['Operativo']['comuna_id']; ?>" title="Ver el detalle de la comuna de <?php echo $comunas[$operativo['Operativo']['comuna_id']]; ?>"><?php echo $comunas[$operativo['Operativo']['comuna_id']]; ?></a>
								</td>
								<td class="ancho20 aligncenter">
									<?php echo $time->format('d-m-Y', $operativo['Operativo']['fecha_llegada']); ?>
								</td>
								<td class="ancho20 aligncenter">
									<?php echo $time->format('d-m-Y', $vistas->getFechaFin($operativo['Operativo']['fecha_llegada'], $operativo['Operativo']['duracion'])); ?>
								</td>
								<td class="ancho20 ultimo aligncenter">
									<a href="/organizaciones/ver/<?php echo $operativo['Operativo']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?>"><?php echo $organizaciones[$operativo['Operativo']['organizacion_id']]; ?></a>
								</td>
							</tr>
					<?php
							$i = 3 - $i;
						endforeach;
						?>
					</table>
				<?php else: ?>
					<p>
						No existen operativos <?php echo $key; ?>.
					</p>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php if($operativos) : ?>
	
<?php else : ?>
	<p>
		No existen operativos<?php if($area){ echo ' de '.$area; } ?> ingresados.
	</p>
	<?php if($auth) : ?>
		<p>
			<a href="/operativos/nuevo" title="Agregar un nuevo operativo">Agregar un nuevo operativo</a>
		</p>
	<?php endif; ?>
<?php endif; 

echo $javascript->link('sortable.js');
?>
