<h1>
	<?php echo "Operativo ".$operativo['Organizacion']['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>

	<div class="input text">
		<label>Localidad</label><?php echo $operativo['Localidad']['nombre']; ?>
	</div>
	<div class="input text">
		<label>Fecha de llegada</label><?php echo $time->format($operativo['Operativo']['fecha_llegada'], 'd/m/Y'); ?>
	</div>
	<div class="input text">
		<label>Duración (d&iacute;as)</label><?php echo $operativo['Operativo']['duracion']; ?>
	</div>
</div>

<h2>Recursos</h2>
<table>
<?php 
foreach($recursos as $area => $recs): 
	if(count($recs) <= 0)
		continue;
	?>
	<tbody>
	<tr>
		<td><u><b><?php echo $areas[$area]; ?></b></u></td><th>&nbsp;</th><th>&nbsp;</th>
	</tr>
	<tr>
		<th>Tipo Recurso</th>
		<th>Cantidad</th>
		<th>Caracter&iacute;stica</th>
	</tr>
	<?php foreach($recs as $rec): ?>
	<tr>
		<td><?php echo $rec['TipoRecurso']['nombre']; ?></td>
		<td><?php echo $rec['Recurso']['cantidad']; ?></td>
		<td><?php echo $rec['Recurso']['caracteristica']; ?></td>
	</tr>
	<?php endForeach; ?>
	</tbody>
<?php endForeach; ?>
</table>
