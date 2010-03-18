
<h1>Comunas</h1>

<div class="bloque">
	<?php
	$label_ini = '<div class="label ancho25">';
	$label_fin = '</div>';
	
	echo $form->create('Regiones');
	echo $form->input('regiones', array('type' => 'select', 'options' => $regiones->getRegiones(), 'label' => 'Regi&oacute;n', 'class' => 'input-select regiones showit', 'selected' => 13, 'before' => $label_ini, 'between' => $label_fin));
	echo $form->end();
	?>
</div>

<?php
$r = 0;
$first = true;

foreach($comunas as $key => $comuna) :
	$this_r = $regiones->getRegionId($key);
	if($this_r != $r) :
		$r = $this_r;
		if(!$first) :
?>
				</table>
			</div>
<?php
		endif;
		$first = false;
		
		$class_oculto = ' active';
		if($r != 13)
			$class_oculto = ' oculto';
?>
		<div class="toshow showit<?php echo $r.$class_oculto; ?>">
			<h2>
				<?php echo $regiones->getHtmlName($r); ?>
			</h2>
			
			<table id="listacomunas" class="ancho100">
				<tr>
					<th class="ancho50 alignleft primero">Comuna</th>
					<th class="ancho25">Operativos</th>
					<th class="ancho25 ultimo">Catastros</th>
				</tr>
<?php
		$i = 1;
	endif;
?>
	<tr>
		<td class="ancho50 fila<?php echo $i; ?> primero">
			<a href="/comunas/ver/<?php echo $key; ?>"><?php echo $comuna; ?></a>
		</td>
		<td class="ancho25 fila<?php echo $i; ?> aligncenter">
			<?php
			if(array_key_exists($key, $operativos)) 
				 echo $operativos[$key];
			else
				echo '0';
			?>
		</td>
		<td class="ancho25 fila<?php echo $i; ?> aligncenter">
			<?php
			if(array_key_exists($key, $catastros))
				 echo $catastros[$key];
			else
				echo '0';
			?>
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
</div>

<?php 
	echo $javascript->link("visualizacion.js"); 
?>
