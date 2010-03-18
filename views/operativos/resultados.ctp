<h1>
<?php echo ($region?$regiones->getHtmlName($nombre):$nombre); ?>
</h1>
<table>
	<tr>
		<th>&nbsp;</th>
<?php	foreach($areas as $area_key => $area){ ?>
			<th colspan ="<?php echo count($recursos[$area_key]); ?>" class="area<?php echo $area_key; ?>">
			<?php echo $area; ?>
			</th>
<?php	} ?>
	</tr>
	<tr>
		<th>Operativos</th>
<?php	foreach($recursos as $area_key => $recursos_area):
			foreach($recursos_area as $tipo_recurso): ?>
				<th class="area<?php echo $area_key;?>">
				<?php echo $tipo_recurso; ?>
				</th>
	<?php	endforeach; 
		endforeach; ?>
	</tr>
	<?php
	$i = 2;
	foreach($operativos as $operativo) : 
		$i = 3 - $i;		//cambiar entre i=2 e i=1
		?>
		<tr class='fila<?php echo $i; ?>'><td><a href="/organizaciones/ver/<?php echo $operativo['Organizacion']['id'];?>"> 
		<?php echo $operativo['Organizacion']['nombre'];
		if(!$localidad){
			echo ", ".$operativo['Localidad']['nombre'];
		}
		if($operativo['Operativo']['fecha_llegada'])
			echo ", ".$operativo['Operativo']['fecha_llegada'];
			if($operativo['Operativo']['duracion']){
				echo ", ".$operativo['Operativo']['duracion']." d&iacute;a";
				if($operativo['Operativo']['duracion'] != 1)
					echo "s";
			}
		?>
		</a></td>
		<?php 
		$hash = array();
		foreach($operativo['Recurso'] as $recurso) : 
			$hash[$recurso['tipo_recurso_id']] = $recurso['cantidad'];
		endforeach;
		
		foreach($recursos as $area_key => $recursos_area):
			foreach($recursos_area as $key_recurso => $tipo_recurso): ?>
				<td class="area<?php echo $area_key;?> ">
					<? 
						if(array_key_exists($key_recurso, $hash))
							echo $hash[$key_recurso];
						else echo "0"; ?>
				</td>
			<?php endforeach;?>
		<?php endforeach;?>
		</tr> 
	<?php endforeach;
	?>
	
</table>

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
