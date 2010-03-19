<h1>Tipos de Necesidades</h1>
<table>
<?php foreach($necesidades as $necesidad): ?>
<tr>
	<td><?php echo $necesidad['TipoNecesidad']['codigo']; ?></td>
	<td><?php echo $necesidad['TipoNecesidad']['nombre']; ?></td>
	<td><?php echo $necesidad['TipoNecesidad']['descripcion']; ?></td>
	<td><?php echo $html->link('editar', array('controller' => 'configuraciones', 'action' => 'editar_necesidad', $necesidad['TipoNecesidad']['id'])); ?></td>
</tr>

<?php endForeach; ?>
</table>
