
<table>
	<tr>
		<th>Localidad</th>
		<th>Operativos</th>
	</tr>
	<?php
	if(count($localidades) != 0){
		foreach($localidades as $localidad) :
			if($localidad['Operativo']) : ?>
				<tr><td rowspan="<?php echo count($localidad['Operativo']); ?>">
					<a href="/localidades/ver/<?php echo $localidad['Localidad']['id']; ?>"> 
				<?php echo $localidad['Localidad']['nombre']; ?>
				</a></td><td>
				<?php 
				$first = true;
				foreach($localidad['Operativo'] as $operativo) :
					if($first == false) : ?>
						<tr><td>
			<?php 	endif;
					$first = false;
					?>
					<a href="/operativos/ver/<?php echo $operativo['id']; ?>">
					Operativo <?php echo $organizaciones[$operativo['organizacion_id']]; ?>, <?php echo $operativo['fecha_llegada']; ?>
					</a></td></tr>
<?php			endforeach;
			endif;
		endforeach;
	}else{
		echo "";
	}
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
