
<h1>Comunas</h1>

<?php 
	$regiones_html = array(5 =>'de Valpara&iacute;so', 
					 13 => 'Metropolitana', 
					  6 => 'de O\'Higgins', 
					  7 => 'del Maule', 
					  8 => 'del B&iacute;o B&iacute;o', 
					  9 => 'de la Araucan&iacute;a');
	$regiones = array(5 =>'de Valparaíso', 
					 13 => 'Metropolitana', 
					  6 => 'de O\'Higgins', 
					  7 => 'del Maule', 
					  8 => 'del Bío Bío', 
					  9 => 'de la Araucanía');
	$r = 4;	
	$first = true;
	echo $form->create('Comuna', array('action' => '/'));
	echo $form->input('regiones', array('type' => 'select', 'options' => $regiones, 'label' => 'Regi&oacute;n', 'class' => 'select-region'));
	
	echo $form->end();
	echo "<br />";

foreach($comunas as $key => $comuna){
	$this_r = (int)($key/1000);
	if($this_r != $r){
		$r = $this_r;
		if(!$first){ ?>
			</table>
			</div>
<?php
		}
		$first = false;
?>
	<div class="regiones region<?php echo $r?>">
	<h2>Regi&oacute;n <?php echo $regiones_html[$r];?></h2>
		<table>
		<tr>
			<th>Nombre</th>
			<th>N&uacute;mero de Catastros</th>
			<th>N&uacute;mero de Operativos</th>
		</tr>
<?php 
	}	?>
	<tr><td><a href="/comunas/ver/<?php echo $key; ?>">
	<?php echo $comuna; ?>
	</a></td>
	<td><?php if(array_key_exists($key, $operativos)){
				 echo $operativos[$key];
			}else echo "0"; ?></td>
	<td><?php if(array_key_exists($key, $catastros)){
				 echo $catastros[$key]; 
			}else echo "0"; ?></td></tr>
<?php
}
?>
</table>
</div>

<?php 
	echo $javascript->link("filter_region.js"); 
?>
