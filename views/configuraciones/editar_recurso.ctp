<?php echo $form->create('TipoRecurso', array('url' => array('controller' => 'configuraciones', 'action' => 'editar_recurso'))); ?>
<fieldset>
<legend>Editar recurso</legend>
<?php 
	echo $form->input('TipoRecurso.id');
	echo $form->input('TipoRecurso.nombre');
	echo $form->input('TipoRecurso.descripcion');
	echo $form->input('TipoRecurso.codigo');
	echo $form->input('TipoRecurso.area_id');
	echo $form->submit('Guardar');
?>
</fieldset>
<?php echo $form->end(); ?>
