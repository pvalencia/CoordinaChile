<h1>Tipos de Recursos</h1>
<table>
<?php foreach($recursos as $recurso): ?>
<tr>
	<td><?php echo $recurso['TipoRecurso']['codigo']; ?></td>
	<td><?php echo $recurso['TipoRecurso']['nombre']; ?></td>
	<td><?php echo $recurso['TipoRecurso']['descripcion']; ?></td>
	<td><?php echo $html->link('editar', array('controller' => 'configuraciones', 'action' => 'editar_recurso', $recurso['TipoRecurso']['id'])); ?></td>
</tr>

<?php endForeach; ?>
</table>
