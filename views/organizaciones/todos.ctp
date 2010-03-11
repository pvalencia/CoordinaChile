
<h1>Organizaciones</h1>

<table id="listaorganizaciones" class="ancho100">
	<tr>
		<th class="ancho25 columna columna1 primero">Organizaci&oacute;n</th>
		<th class="ancho25 columna columna2">Contacto</th>
		<th class="ancho25 columna columna3">Catastros</th>
		<th class="ancho25 columna columna4 ultimo">Operativos</th>
	</tr>
	<?php
	$i = 1;
	foreach($organizaciones as $key => $org) :
	?>
		<tr>
			<td class="ancho25 fila fila<?php echo $i; ?> columna columna1 primero">
				<a href="/organizaciones/ver/<?php echo $org['Organizacion']['id']; ?>"> 
					<?php echo $org['Organizacion']['nombre']; ?>
				</a>
			</td>
			<td class="ancho25 fila fila<?php echo $i; ?> columna columna2">
				<?php echo text($org['Organizacion']['nombre_contacto']); ?>
			</td>
			<td class="ancho25 aligncenter fila fila<?php echo $i; ?> columna columna3">
				<?php echo count($org['Catastro']); ?>
			</td>
			<td class="ancho25 aligncenter fila fila<?php echo $i; ?> columna columna4 ultimo">
				<?php echo count($org['Operativo']); ?>
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
<?php 
function text($text){
	if($text)
		return $text;
	else
		return "-";
}
?>
