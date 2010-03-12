<script>
</script>

<?php echo $form->create('Operativo', array('controller' => 'operativos', 'action' => 'resultados')); ?>
	<fieldset>
		<legend>
			B&uacute;squeda de Operativos
		</legend>
	
	<?php
		echo $form->input('regiones', array('class' => 'input-select', 'type' => 'select', 'options' => $regiones, 'class' => 'regiones'));
		echo $form->input('comunas', array('class' => 'input-select', 'type' => 'select', 'options' => $comunas, 'class' => 'comunas'));
		echo $form->input('localidades', array('class' => 'input-select', 'type' => 'select', 'options' => $localidades, 'class' => 'localidades'));

		echo $form->input('filtrar', array('type' => 'checkbox', 'label' => 'Filtrar por d&iacute;a', 'class' => 'filtrar'));
	?>
	<div class='fecha' style="display:none">
  <?php echo $form->input('fecha', array('type' => 'date')); ?>
	</div>
  <?php
		echo $form->submit('Buscar', array('class' => 'input-button'));
	?>
	
	</fieldset>
<?php echo $form->end(); ?>

<?php echo $javascript->link('prototype.js'); 
   echo $javascript->link('busqueda.js'); ?>
