
<table>
<tr>
	<th>Localidad</th>
	<th>Catastros</th>
</tr>
<?php
$last = "";
foreach($localidades as $localidad){
	if($localidad['Catastro']){
		echo '<tr><td rowspace="'.$localidad.'"><a href="/localidades/ver/'.$localidad['Localidad']['id'].'">'; 
		echo $localidad['Localidad']['nombre'].'</a></td><td>';
		$first = true;
		foreach($localidad['Catastro'] as $catastro){
			if($first == false){
				echo "<tr><td>";
				$first = false;
			}
			echo '<a href="/catastros/ver/'.$catastro['id'].'">Catastro ';
			echo $organizaciones[$catastro['organizacion_id']];
			echo ', ';
			echo $catastro['fecha'];
			echo '</a></td></tr>';
		}
	}
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
