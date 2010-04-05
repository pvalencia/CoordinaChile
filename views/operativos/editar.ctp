<h1>
	Editar Operativo <?php echo $operativo['Operativo']['id']; ?>
</h1>

<?php echo $form->create('Operativo', array('url' => array('controller' => 'operativos', 'action' => 'editar', $operativo['Organizacion']['id']))); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	<?php
		$label_ini = '<div class="label ancho33">';
		$label_fin = '<span class="requerido">&nbsp;*</span></div>';
		echo $form->input('Operativo.id');
		if($admin == 0)
			echo $form->input('Operativo.organizacion_id', array('type' => 'hidden', 'value' => $operativo['Organizacion']['id'], 'before' => $label_ini, 'between' => $label_fin));
		else
			echo $form->input('Operativo.organizacion_id', array('type' => 'hidden'));
		echo $form->input('Operativo.fecha_llegada', array('class' => 'input-text', 'label' => 'Fecha de inicio', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Operativo.duracion', array('class' => 'input-text cantidad', 'default' => 0, 'label' => 'Duraci&oacute;n (d&iacute;as)', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>

<div class="bloque">
	<h2>
		Datos del encargado general
	</h2>
	<?php
		echo $form->input('Operativo.nombre', array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Operativo.telefono', array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Operativo.email', array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin));
		echo $form->input('Operativo.contactos_distintos', array('type' => 'checkbox', 'label' => 'Definir encargados espec&iacute;ficos para cada localidad', 'before' => $label_ini.'&nbsp;</div>', 'id' => 'contactosdistintos', 'class' => 'input-checkbox showit checkbox-contacto', 'checked' => $contactos_distintos));
	?>
</div>

<div class="bloque">
	<h2>
		Datos geogr&aacute;ficos
	</h2>
	<?php
		echo $form->input('Operativo.regiones', array('class' => 'input-select regiones editar', 'div' => 'input select selectregiones', 'selected' => $regiones->getRegionId($operativo['Comuna']['id']), 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $regiones->getRegiones(), 'label' => 'Regi&oacute;n'));
		echo $form->input('Operativo.comuna_id', array('class' => 'input-select comunas editar', 'div' => 'input select selectcomunas', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $comunas, 'label' => 'Comuna', 'selected' => $operativo['Comuna']['id']));
	?>
</div>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
		<?php 
		$count = 0;
		foreach($operativo['Suboperativo'] as $suboperativo): ?>
			<li class="lengueta <?php echo ($count == 0?'active':'');?>" id="lengueta<?php echo $count;?>">
				<a href="#" title="<?php echo $localidades[$suboperativo['localidad_id']];?>"><?php echo $localidades[$suboperativo['localidad_id']];?></a>
			</li>
		<?php 
		++$count;
		endforeach; ?>
			<li class="lengueta <?php if(count($localidades) <= 1) echo 'oculto'; ?>" id="lengueta<?php echo $count;?>">
				<a href="#" title="Agregar una nueva localidad" class="agregar localidad">Agregar localidad</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>

	<div id="carpeta" class="bloque">
<?php 
	$count = 0;
	foreach($operativo['Suboperativo'] as $suboperativo): 
		$recursos = $todosrecursos[$suboperativo['id']];
		?>	
		<div id="carpeta<?php echo $count;?>" class="lengueta<?php echo $count; ?> carpeta <?php echo ($count == 0?'active':'oculto');?>">
		<?php	echo $form->input("Suboperativo.$count.id", array('value' => $suboperativo['id'], 'type' => 'hidden')); ?>
			<div class="bloque">
				<h3>
					Datos generales
				</h3>
			<?php echo $form->input("Suboperativo.$count.localidad_id", array('class' => 'input-select localidades editar', 'div' => 'input select selectlocalidades', 'before' => $label_ini, 'between' => $label_fin, 'type' => 'select', 'options' => $localidades, 'selected' => $suboperativo['localidad_id'])); ?>
			</div>
			<div class="bloque toshow contactosdistintos <?php if(!$contactos_distintos) echo 'oculto';?>">
				<h3>
					Datos del encargado
				</h3>
				<?php
					$label_fin = '</div>';
					echo $form->input("Suboperativo.$count.nombre", array('class' => 'input-text caracteristica', 'label' => 'Nombre', 'before' => $label_ini, 'between' => $label_fin, 'value' => $suboperativo['nombre']));
					echo $form->input("Suboperativo.$count.telefono", array('class' => 'input-text', 'label' => 'Tel&eacute;fono', 'before' => $label_ini, 'between' => $label_fin, 'value' => $suboperativo['telefono']));
					echo $form->input("Suboperativo.$count.email", array('class' => 'input-text caracteristica', 'label' => 'Correo electr&oacute;nico', 'before' => $label_ini, 'between' => $label_fin, 'value' => $suboperativo['email']));
				?>
			</div>
		
		<div class="bloque">
			<h3>
				Datos espec&iacute;ficos
			</h3>
			<?php
				$i = 1;
				$checked = array();
				foreach($areas as $key => $area):
					$checked[$key] = false;
					foreach($tipos as $tipo) :
						if($key == $tipo['TipoRecurso']['area_id']) :
							if(isset($recursos[$tipo['TipoRecurso']['id']]) && ($recursos[$tipo['TipoRecurso']['id']]['cantidad'] > 0)) :
								$checked[$key] = true;
								break;
							endif;
						endif;
					endforeach;

					echo $form->input('Suboperativo.'.$key, array(
						'type' => 'checkbox',
						'label' => $area,
						'checked' => $checked[$key],
						'id' => 'showit'.$key,
						'class' => 'input-checkbox showit',
						'div' => array('style' => 'display:inline; margin-right:40px; white-space:nowrap;')  ));
					echo " ";
					$i++;
				endforeach;
			?>
			<div class="clear"></div>
		</div>
	<?php
		$area = 0;
	
		foreach($areas as $key => $area) :
		?>
			<div class="toshow showit<?php echo $key; ?> bloque <?php if(!$checked[$key]) echo 'oculto'; ?>">
				<h3>
					<?php echo $area; ?>
				</h3>
			
				<table class="ancho100">
					<tr>
						<th class="ancho50 primero alignleft">&Iacute;tem</th>
						<th class="ancho15">Cantidad</th>
						<th class="ancho35 ultimo">Caracter&iacute;stica</th>
					</tr>
					<?php
					$i = 1;
					
					foreach($tipos as $tipo) :
						$cantidad = isset($recursos[$tipo['TipoRecurso']['id']]) ? $recursos[$tipo['TipoRecurso']['id']]['cantidad'] : 0;
						$caracteristica = isset($recursos[$tipo['TipoRecurso']['id']]) ? $recursos[$tipo['TipoRecurso']['id']]['caracteristica'] : '';

						if($key == $tipo['TipoRecurso']['area_id']) :
					?>
							<tr>
								<td class="ancho50 fila<?php echo $i;?> primero">
								<?php
									if(isset($recursos[$tipo['TipoRecurso']['id']]))
										echo $form->input('Recurso.'.$count.'.'.$tipo['TipoRecurso']['id'].'.id', array('value' => $recursos[$tipo['TipoRecurso']['id']]['id'], 'type' => 'hidden'));

									echo $form->input('Recurso.'.$count.'.'.$tipo['TipoRecurso']['id'].'.tipo_recurso_id', array('value' => $tipo['TipoRecurso']['id'], 'type' => 'hidden')); 

									echo $tipo['TipoRecurso']['nombre'];
								?>
								<?php if(!empty($tipo['TipoRecurso']['descripcion'])) :?>
									<br/>
									<small>
										<?php echo $tipo['TipoRecurso']['descripcion']; ?>
									</small>
								<?php endif; ?>
								</td>
								<td class="ancho15 fila<?php echo $i;?> aligncenter">
									<?php echo $form->text('Recurso.'.$count.'.'.$tipo['TipoRecurso']['id'].'.cantidad', array('class' => 'cantidad recurso input-text', 'default' => 0, 'size' => 5, 'value' => $cantidad) ); ?>
								</td>
								<td class="ancho35 fila<?php echo $i;?> ultimo">
									<?php echo $form->text('Recurso.'.$count.'.'.$tipo['TipoRecurso']['id'].'.caracteristica', array('class' => 'caracteristica input-text', 'size' => 25, 'value' => $caracteristica)); ?>
								</td>
							</tr>
							<?php
							if($i == 1)
								$i = 2;
							else
								$i = 1;
						endif;
					endforeach;
					?>
			
				</table>
			</div>
			<div class="oculto necesidades intro" id="necesidades-intro<?php echo $count; ?>">
				<br />
				<h3>
					Necesidades a cubrir
				</h3>
				<div id="necesidades<?php echo $count; ?>" class="necesidades suboperativo_<?php echo $suboperativo['id']; ?>" >
				</div>
			</div>
		<?php 
		endforeach; ?>
		</div>
<?php	
	++$count;
	endforeach; ?>
	</div>
</div>
	<?php echo $form->submit('Modificar operativo', array('class' => 'input-button')); ?>
	
<?php echo $form->end(); ?>

<?php echo $javascript->link('necesidades.js'); ?>
<?php echo $javascript->link('formulario.js'); ?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
<?php foreach($necesidades as $subop => $necesidadSubop): ?>
	$('.suboperativo_<?php echo $subop; ?>').live('change', function(){ 	//seleccionar necesidades del suboperativo
	<?php foreach($necesidadSubop as $necesidad): ?>
		$('#necesidad-<?php echo $necesidad ?>').attr('checked', true); 
	<?php endforeach; ?>
	});
<?php endforeach; ?>
});
</script>
