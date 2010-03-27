<?php $cat = $catastro['Catastro']; ?>

<?php
	if($catastro['Organizacion']['id'] == $user['Organizacion']['id'] || $user['Organizacion']['admin']) :
?>
	<ul class="menu floatright">
		<li>
			<a href="/catastros/editar/<?php echo $catastro['Catastro']['id']; ?>" title="Editar los datos del Catastro <?php echo $catastro['Catastro']['id']; ?>">Editar</a>
		</li>
	</ul>
<?php
	endif; 
?>

<h1>
	Catastro <?php echo $catastro['Catastro']['id']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<div class="label ancho33">Regi&oacute;n</div><?php echo $regiones->getHtmlName($catastro['Localidad']['comuna_id'], true) ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Comuna</div><a href="/comunas/ver/<?php echo $catastro['Localidad']['comuna_id']?>" title="Ver el detalle de la comuna de <?php echo $comuna['Comuna']['nombre'] ?>"><?php echo $comuna['Comuna']['nombre'] ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Localidad</div><a href="/localidades/ver/<?php echo $catastro['Localidad']['id']?>" title="Ver el detalle de la localidad de <?php echo $catastro['Localidad']['nombre']; ?>"><?php echo $catastro['Localidad']['nombre']; ?></a>
	</div>
	<div class="input text">
		<div class="label ancho33">Fecha de realizaci&oacute;n</div><?php echo $time->format('d-m-Y', $cat['fecha']); ?>
	</div>
	<div class="input text">
		<div class="label ancho33">Organizaci&oacute;n</div><a href="/organizaciones/ver/<?php echo $catastro['Organizacion']['id']?>" title="Ver el perfil de <?php echo $catastro['Organizacion']['nombre']; ?>"><?php echo $catastro['Organizacion']['nombre']; ?></a>
	</div>
</div>	

<?php if($auth) : ?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n del contacto
		</h2>
		
		<div class="input text">
			<div class="label ancho33">Nombre</div><?php echo $cat['nombre_contacto']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Tel&eacute;fono</div><?php echo $cat['telefono_contacto']; ?>
		</div>
		<div class="input text">
			<div class="label ancho33">Correo electr&oacute;nico</div><?php echo $text->autoLink($cat['email_contacto'], array('title' => 'Contactar a '.$cat['nombre_contacto'])); ?>
		</div>
	</div>
<?php endif; ?>

<?php if($cat['caracterizacion'] || $cat['file']) : ?>
	<div class="bloque">
		<h2>
			Informaci&oacute;n adicional
		</h2>
		
		<?php if($cat['caracterizacion']){ ?>
		<div class="input text">
			<div class="label ancho33 floatleft">Descripci&oacute;n general</div>
			<div class="floatleft ancho66"><?php echo $vistas->text2p($cat['caracterizacion']); ?></div>
			<div class="clear"></div>
		</div>
		<?php } ?>
		<?php if($cat['file']){ ?>
		<div class="input text">
			<div class="label ancho33">Archivo adjunto</div><?php 
					$nombre = substr($cat['file'], 0, strrpos($cat['file'], '-'));
					$id = substr($cat['file'], strrpos($cat['file'], '-') + 1);
					echo $html->link($nombre, array('controller' => 'catastros', 
											   'action' => 'bajar_archivo',
											   $id, $nombre ), array('class' => $vistas->getClassExtensionArchivo($nombre), 'title' => 'Descargar '.$nombre)); ?>
		</div>
<?php } ?>
	</div>
<?php endif; ?>

<?php
	foreach($necesidades as $area => $necs) :
		if(count($necs) <= 0)
			continue;
?>
		<div class="bloque">
			<h3>
				<?php echo $areas[$area]; ?>
			</h3>
			
			<table class="ancho100">
				<tr>
					<th class="ancho50 primero alignleft">&Iacute;tem</th>
					<th class="ancho15 ultimo">Cantidad</th>
					<th class="ancho35 ultimo">Caracter&iacute;stica</th>
				</tr>
				<?php
				$i = 1;
				
				foreach($necs as $nec):
				?>
				<tr>
						<td class="ancho50 primero fila<?php echo $i;?>">
							<?php echo $nec['TipoNecesidad']['nombre'];?>
						</td>
						<td class="ancho15 ultimo fila<?php echo $i; ?> aligncenter">
							<?php echo $nec['Necesidad']['cantidad']; ?>
						</td>
						<td class="ancho35 ultimo fila<?php echo $i; ?>">
							<?php echo $nec['Necesidad']['caracteristica']; ?>
						</td>
					</tr>
				<?php
					$i = 3 - $i;
				endforeach;
				?>
			</table>
		</div>
	<ul class="menu floatright">
		<li>
			<a href="/operativos/nuevo/catastro:<?php echo $catastro['Catastro']['id']; ?>" title="Crear un operativo a partir de este catastro">Crear un operativo a partir de este catastro</a>
		</li>
	</ul>
<?php
	endforeach;
?>

