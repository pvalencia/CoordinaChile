<h1>Organización</h1>

<?php echo $form->create('Organizacion', array('url' => array('controller' => 'operativos', 'action' => 'agregar', $organizacion['Organizacion']['id']))); ?>

<fieldset>
<legend>Agregar Operativo</legend>

<?php 
	echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $organizacion['Organizacion']['id']));
	echo $form->input('Operativo.fecha_llegada', array('class' => ''));
	echo $form->input('Operativo.duracion', array('class' => '', 'label' => 'Duración'));
	echo $form->input('Operativo.localidad_id', array('class' => '', 'label' => 'Localidad'));
?>

<?php 
/*
	echo $form->input('Operativo.salud', array('type' => 'checkbox', 'label' => 'Ayuda en salud'));
	echo $form->input('Operativo.vivienda', array('type' => 'checkbox', 'label' => 'Ayuda en vivienda'));
	echo $form->input('Operativo.humanitaria', array('type' => 'checkbox', 'label' => 'Ayuda humanitaria'));
*/
?>


</fieldset>

<fieldset>
<legend>Recursos</legend>
<table>
<?php
$area = 0;
foreach($tipos as $tipo): 
if($area != $tipo['TipoRecurso']['area_id']):
	$area = $tipo['TipoRecurso']['area_id'];
?>
<tbody id="area_<?php echo $area; ?>">
<tr class="area_<?php echo $area; ?>">
	<th colspan="3"><?php echo $areas[$area]; ?></th>
</tr>
<?php endif; ?>
	<tr class="area_<?php echo $area; ?>">
		<td>
		<?php 
			echo $tipo['TipoRecurso']['nombre']; 
		?>
		</td>
		<td><?php echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.cantidad' ); ?></td>
		<td>
		<?php 
			echo $form->input('Recurso.'.$tipo['TipoRecurso']['id'].'.tipo_recurso_id', array('value' => $tipo['TipoRecurso']['id'], 'type' => 'hidden')); 
			echo $form->text('Recurso.'.$tipo['TipoRecurso']['id'].'.caracteristica');
		?>
		</td>
	</tr>
<?php if($area != $tipo['TipoRecurso']['area_id']): ?>
</tbody>
<?php 
endif;
endForeach; 
?>
</table>

<?php echo $form->submit('guardar'); ?>
</fieldset>


<?php echo $form->end(); ?>
