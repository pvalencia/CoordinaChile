<h1><?php echo $operativo['Organizacion']['nombre']; ?></h1>

<dl>
	<dt>Nombre de Localidad</dt>
		<dd><?php echo $operativo['Localidad']['nombre']; ?></dd>
	<dt>Fecha de Llegada</dt>
		<dd><?php echo $time->format($operativo['Operativo']['fecha_llegada'], 'd/m/Y'); ?></dd>
	<dt>Duración (días)</dt>
		<dd><?php echo $operativo['Operativo']['duracion']; ?> días</dd>
</dl>

<h2>Recursos</h2>
<table>
<?php 
foreach($recursos as $area => $recs): 
	if(count($recs) <= 0)
		continue;
?>
<tbody>
<tr>
	<th colspan="3"><?php echo $areas[$area]; ?></th>
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
