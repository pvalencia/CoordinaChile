
<table>
	<tr>
		<th>Localidad</th>
		<th>Operativos</th>
	</tr>
	<?php
	foreach($localidades as $localidad) :
	
	/*
		echo '<tr><td><a href="/operativos/ver/'.$org['Operativo']['id'].'">'; 
		echo $org['Localidad']['nombre'];
		echo "</a></td><td>";
		echo text($org['Organizacion']['nombre']);
		echo "</td><td>";
		echo $org['Operativo']['fecha_llegada'];
		echo "</td></tr>";*/		
		
		if($localidad['Operativo']) :
			echo '<tr><td rowspace="'.count($localidad['Operativo']).'"><a href="/localidades/ver/'.$localidad['Localidad']['id'].'">'; 
			echo $localidad['Localidad']['nombre'].'</a></td><td>';
			$first = true;
			foreach($localidad['Operativo'] as $operativo) :
				if($first == false) :
					echo "<tr><td>";
					$first = false;
				endif;
				echo '<a href="/operativo/ver/'.$operativo['id'].'">Operativo ';
				echo $organizaciones[$operativo['organizacion_id']];
				echo ', ';
				echo $operativo['fecha_llegada'];
				echo '</a></td></tr>';
			endforeach;
		endif;
	endforeach;
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
