
<h1>
	Necesidades sin resolver
</h1>

<div class="bloquegrande">
	<p class="intro">
		Revisa las necesidades catastradas en cada comuna y localidad, y que aún no han sido resueltas por ningún operativo ingresado en el sitio.
	</p>
</div>

<?php
$carpetas_class = array(
	0 => array(' active', ' active'),
	1 => array('', ' oculto'),
);

/*
if(!$comunas['activos'] && ($comunas['programados'] || $comunas['realizados'])) :
	$carpetas_class_aux = $carpetas_class[0];
	$carpetas_class[0] = $carpetas_class[1];
	
	if($comunas['programados'])
		$carpetas_class[1] = $carpetas_class_aux;
	if($comunas['realizados'])
		$carpetas_class[2] = $carpetas_class_aux;
endif;*/
?>

<div id="carpetas">
	<div id="lenguetas">
		<ul class="menu">
		<?php $j = 0;
			foreach($necesidades as $lugar => $necesidades_lugar): ?>
			<li class="lengueta<?php echo $carpetas_class[$j++][0]; ?>" id="lengueta<?php echo $lugar;?>">
				<a href="#" title="Necesidades por <?php echo $lugar; ?>">Necesidades por <?php echo $lugar; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="carpeta">
	<?php $j = 0;
		foreach($necesidades as $lugar => $necesidades_lugar): ?>
		<div class="lengueta<?php echo $lugar;?> carpeta<?php echo $carpetas_class[$j++][1]; ?>">
			<?php if($necesidades_lugar) :?>
				<div id="mapanecesidades<?php echo $lugar;?>" class="canvasmapa mapagrande ancho100"></div>
			<?php else: ?>
				<p>
					No existen necesidades sin resolver en ninguna <?php echo $lugar;?>.
				</p>
			<?php endif; ?>
		</div>
		<?php endforeach; ?> 
	</div>
</div>

<?php if($necesidades['comuna'] || $necesidades['localidad']) : ?>
	<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
	<?php echo $javascript->link('mapa.js'); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			<?php foreach($necesidades as $lugar => $necesidades_lugar): ?>
				<?php if($necesidades_lugar) :?>
					var necesidades_<?php echo $lugar;?> = <?php echo $javascript->Object($necesidades_lugar); ?>;
					var params_<?php echo $lugar;?> = {
						controlador: 'comunas',
						vista: 'mapa_necesidades',
						canvasmapa_id: 'mapanecesidades<?php echo $lugar;?>',
						tipo: 'necesidades',
						nombre: 'Necesidad'
					};
		
					cargarMapa(necesidades_<?php echo $lugar;?>, params_<?php echo $lugar;?>);
				<?php endif; ?>
			<?php endforeach; ?>
		});
	</script>
<?php endif; ?>
