
<h1>Comunas</h1> 
<table>
<tr>
	<th>Nombre</th>
	<th>N&uacute;mero de Catastros</th>
	<th>N&uacute;mero de Operativos</th>
</tr>
<?php
foreach($comunas as $key => $comuna){?>
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

<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
