
<h1>Operativos <?php echo $area ?> </h1>
<table>
<tr>
	<th>Localidad</th>
	<th>Operativos</th>
</tr>
<?php
$last = "";
foreach($operativos as $operativo){
	
	if($last != $operativo['Localidad']['id']){
		$last = $operativo['Localidad']['id'];

		echo '<tr><td><a href="/localidades/ver/'.$last.'">'; 
		echo $localidades[$last].'</a></td><td>';
	}else{
		echo "<tr><td>&nbsp;</td><td>";
	}

	echo '<a href="/operativos/ver/'.$operativo['Operativo']['id'].'">Operativo ';
	echo $organizaciones[$operativo['Operativo']['organizacion_id']];
	echo ', ';
	echo $operativo['Operativo']['fecha_llegada'];
	echo '</a></td></tr>';

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
