<h1>
	Catastros <?php if($area){ echo 'de '.$area; } ?>
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa los catastros<?php if($area){ echo ' de '.$area; } ?> que las organizaciones estan realizando en estos momentos, as&iacute; como tambi&eacute;n los que ya han realizado, y los que pretenden concretar en el futuro. Haz clic en el nombre del catastro para ver su detalle. Tambi&eacute;n puedes revisar la situaci&oacute;n particular de cada localidad haciendo clic en su nombre.
	</p>
</div>

<?php if($catastros) : ?>
	<table id="listacatastros" class="ancho100">
		<tr>
			<th class="ancho25 primero alignleft">Catastro</th>
			<th class="ancho25">Localidad</th>
			<th class="ancho25">Realizaci&oacute;n</th>
			<th class="ancho25 ultimo">Organizaci&oacute;n</th>
		</tr>
		<?php
		$i = 1;
		
	//	foreach($localidades as $localidad) :
			foreach($catastros as $catastro) :
		?>
				<tr>
					<td class="ancho25 fila<?php echo $i; ?> primero">
						<a href="/catastros/ver/<?php echo $catastro['Catastro']['id']; ?>" title="Ver el detalle del Catastro <?php echo $catastro['Catastro']['id']; ?>">Catastro <?php echo $catastro['Catastro']['id']; ?></a>
					</td>
					<td class="ancho25 fila<?php echo $i; ?> aligncenter">
						<a href="/localidades/ver/<?php echo $catastro['Catastro']['localidad_id']; ?>" title="Ver el detalle de la localidad de <?php echo $localidades[$catastro['Catastro']['localidad_id']]; ?>"><?php echo $localidades[$catastro['Catastro']['localidad_id']]; ?></a>
					</td>
					<td class="ancho25 fila<?php echo $i; ?> aligncenter">
						<?php echo $time->format('d-m-Y', $catastro['Catastro']['fecha']); ?>
					</td>
					<td class="ancho25 fila<?php echo $i; ?> ultimo aligncenter">
						<a href="/organizaciones/ver/<?php echo $catastro['Catastro']['organizacion_id']; ?>" title="Ver el perfil de <?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?>"><?php echo $organizaciones[$catastro['Catastro']['organizacion_id']]; ?></a>
					</td>
				</tr>
		<?php
				if($i == 1)
					$i = 2;
				else
					$i = 1;
			endforeach;
	//	endforeach;
		?>
	</table>
<?php else : ?>
	<p>
		No existen catastros<?php if($area){ echo ' de '.$area; } ?> ingresados.
	</p>
	<?php if($auth) : ?>
		<p>
			<a href="/catastros/nuevo" title="Agregar un nuevo catastro">Agregar un nuevo catastro</a>
		</p>
	<?php endif; ?>
<?php endif; ?>