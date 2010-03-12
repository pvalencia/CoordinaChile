<script>
</script>

<?php echo $form->create('Operativo', array('controller' => 'operativos', 'action' => 'resultados')); ?>
	<fieldset>
		<legend>
			B&uacute;squeda de Operativos
		</legend>
	
	<?php
		echo $form->input('regiones', array('class' => 'input-select', 'type' => 'select', 'options' => $regiones));
		echo $form->input('comunas', array('class' => 'input-select', 'type' => 'select'));
		echo $form->input('localidades', array('class' => 'input-select', 'type' => 'select'));
		echo $form->input('fecha', array('type' => 'date'));
		
		echo $form->submit('Buscar', array('class' => 'input-button'));
	?>
	
	</fieldset>
<?php echo $form->end(); ?>
