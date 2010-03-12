
<?php $org = $organizacion['Organizacion']; ?>

<h1>
	<?php echo $org['nombre']; ?>
</h1>

<div class="bloque">
	<h2>
		Informaci&oacute;n general
	</h2>
	
	<div class="input text">
		<label>Tipo organizaci&oacute;n</label><?php echo $organizacion['TipoOrganizacion']['nombre']; ?>
	</div>
	<div class="input text">
		<label>Tel&eacute;fono</label><?php echo $org['telefono']; ?>
	</div>
	<div class="input text">
		<label>E-mail</label><a href="mailto:<?php echo $org['email']; ?>"><?php echo $org['email']; ?></a>
	</div>
	<div class="input text">
		<label>Sitio web</label><a href="<?php echo href($org['web']); ?>"><?php echo $org['web']; ?></a>
	</div>
	<div class="input text"> 
		<label>Nombre del contacto</label><?php echo $org['nombre_contacto'].'&nbsp;'.$org['apellido_contacto']; ?>
	</div>
	<div class="input text"> 
		<label>Tel&eacute;fono de contacto</label><?php echo $org['telefono_contacto']; ?>
	</div>
	<div class="input text"> 
		<label>&Aacute;reas de trabajo</label><?php echo $org['areas_trabajo']; ?> 
	</div>
</div>

<?php if($organizacion['Catastro']) : ?>
	<div class="bloque">
		<h2>
			Catastros Realizados
		</h2>
		
		<table id="listacatastros" class="ancho50">
			<tr>
				<th class="ancho50 columna columna1 primero">Fecha</th>
				<th class="ancho50 columna columna2 ultimo">Localidad</th>
			</tr>
			<?php
			$i = 1;
			foreach($organizacion['Catastro'] as $key => $cat) :
			?>
				<tr>
					<td class="ancho50 fila fila<?php echo $i; ?> columna columna1 primero">
						<?php echo $cat['fecha']; ?>
					</td>
					<td class="ancho50 fila fila<?php echo $i; ?> columna columna2 ultimo">
						<a href="/catastros/ver/<?php echo $cat['id']; ?>">
							<?php echo $localidades[$cat['localidad_id']]; ?>
						</a>
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
<?php endif; ?>

<?php if($organizacion['Operativo']) :?>
	<div class="bloque">
		<h2>
			Operativos realizados
		</h2>
	
		<table class="ancho50">
			<tr>
				<th class="ancho33 columna columna1 primero">Fecha</th>
				<th class="ancho33 columna columna2">Localidad</th>
				<th class="ancho33 columna columna3 ultimo">Duraci&oacute;n (d&iacute;as)</th>
			</tr>
			<?php
			$i = 1;
			foreach($organizacion['Operativo'] as $key => $ope) :
			?>
				<tr>
					<td class="ancho33 fila fila<?php echo $i; ?> columna columna1 primero aligncenter">
						<?php echo $ope['fecha_llegada']; ?>
					</td>
					<td class="ancho33 fila fila<?php echo $i; ?> columna columna2 aligncenter">
						<a href="/operativos/ver/<?php echo $ope['id']; ?>">
							<?php echo $localidades[$ope['localidad_id']]; ?>
						</a>
					</td>
					<td class="ancho33 fila fila<?php echo $i; ?> columna columna3 ultimo">
						<?php echo $ope['duracion']; ?>
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
<?php endif; ?>
