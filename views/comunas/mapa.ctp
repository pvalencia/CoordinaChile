<?php if($full): ?>
	<div id="map_canvas" class="canvasmapa ancho100 mapacompleto"></div>
<?php else: ?>
	<h1>
		Operativos
	</h1>
	
	<div class="bloquegrande">
		<p class="intro">
			Revisa los operativos por comunas que las distintas organizaciones que utilizan Coordina Chile han realizado, tienen programados realizar, o que en estos momentos estan llevando a cabo. Haz clic en los marcadores <span class="icono operativo">Operativos</span> para ver un resumen general de las cantidades de recursos y voluntarios que se han llevado y participado en cada comuna. 
		</p>
	</div>
	
	<?php
	$carpetas_class = array(
		0 => array(' active', ' active'),
		1 => array('', ' oculto'),
		2 => array('', ' oculto')
	);
	
	if(!$comunas['activos'] && ($comunas['programados'] || $comunas['realizados'])) :
		$carpetas_class_aux = $carpetas_class[0];
		$carpetas_class[0] = $carpetas_class[1];
		
		if($comunas['programados'])
			$carpetas_class[1] = $carpetas_class_aux;
		if($comunas['realizados'])
			$carpetas_class[2] = $carpetas_class_aux;
	endif;
	?>
	
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta<?php echo $carpetas_class[0][0]; ?>" id="lenguetaactivos">
					<a href="#" title="Operativos que se estan realizando en estos momentos">Activos</a>
				</li>
				<li class="lengueta<?php echo $carpetas_class[1][0]; ?>" id="lenguetaprogramados">
					<a href="#" title="Operativos que se han agendado para realizarse en el futuro">Agendados</a>
				</li>
				<li class="lengueta<?php echo $carpetas_class[2][0]; ?>" id="lenguetarealizados">
					<a href="#" title="Operativos que ya se han realizado y concluido">Realizados</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
		<?php $j = 0;
			foreach($comunas as $tipo => $comunas_tipo): ?>
			<div class="lengueta<?php echo $tipo;?> carpeta<?php echo $carpetas_class[$j++][1]; ?>">
				<?php if($comunas_tipo) :?>
					<div id="mapaoperativos<?php echo $tipo;?>" class="canvasmapa mapagrande ancho100"></div>
				<?php else: ?>
					<p>
						No existen operativos <?php echo $tipo;?>.
					</p>
				<?php endif; ?>
			</div>
			<?php endforeach; ?> 
		</div>
	</div>
<?php endif; ?>

<?php if($comunas['activos'] || $comunas['programados'] || $comunas['realizados']) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php foreach($comunas as $tipo => $comunas_tipo): ?>
				<?php if($comunas_tipo) :?>
					var comunas_<?php echo $tipo;?> = <?php echo $javascript->Object($comunas_tipo); ?>;
					var params_<?php echo $tipo;?> = {
						controlador: 'comunas',
						vista: 'mapa',
						canvasmapa_id: 'mapaoperativos<?php echo $tipo;?>',
						tipo: 'operativos',
						nombre: 'Operativo'
					};
		
					cargarMapa(comunas_<?php echo $tipo;?>, params_<?php echo $tipo;?>);
				<?php endif; ?>
			<?php endforeach; ?>
		});
	</script>
<?php endif; ?>
