<h1>
	Organizaciones
</h1>

<div class="bloquegrande">
	<p class="intro">
		Conoce a las organizaciones que utilizan las herramientas de Coordina Chile. Haz clic en sus nombres para ver sus perfiles, as&iacute; como tambi&eacute;n lo que han realizado, lo que pretenden realizar en el futuro, y lo que estan actualmente desarrollando en las distintas zonas del pa&iacute;s.
	</p>
</div>

<table id="listaorganizaciones" class="ancho100 sortable">
	<thead>
	<tr>
		<th class="ancho25 primero alignleft">Organizaci&oacute;n</th>
		<th class="ancho25 unsortable">Contacto</th>
		<th class="ancho25">Operativos</th>
		<th class="ancho25 ultimo">Catastros</th>
	</tr>
	</thead>
	<?php
	$i = 1;
	foreach($organizaciones as $key => $org) :
	?>
		<tr class="fila<?php echo $i; ?>">
			<td class="ancho25 fila primero">
				<a href="/organizaciones/ver/<?php echo $org['Organizacion']['id']; ?>" title="Ver el perfil de <?php echo $org['Organizacion']['nombre']; ?>"> 
					<?php echo $org['Organizacion']['nombre']; ?>
				</a>
			</td>
			<td class="ancho25 fila">
				<?php echo $org['Organizacion']['nombre_contacto']; ?>
			</td>
			<td class="ancho25 aligncenter fila">
				<?php echo count($org['Operativo']); ?>
			</td>
			<td class="ancho25 aligncenter fila ultimo">
				<?php echo count($org['Catastro']); ?>
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
<?php echo $javascript->link('sortable.js'); ?>
