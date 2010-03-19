<?php echo $form->create('TipoNecesidad', array('url' => array('controller' => 'configuraciones', 'action' => 'editar_necesidad'))); ?>
<fieldset>
<legend>Editar necesidad</legend>
<?php 
	echo $form->input('TipoNecesidad.id');
	echo $form->input('TipoNecesidad.nombre');
	echo $form->input('TipoNecesidad.descripcion');
	echo $form->input('TipoNecesidad.codigo');
	echo $form->input('TipoNecesidad.area_id');
	echo $form->submit('Guardar');
?>
</fieldset>
<?php echo $form->end(); ?>
