<?php if($full): ?>
	<div id="map_canvas" style="width: 100%; height: 100%;"></div>
<?php else: ?>
	<h1>
		Operativos
	</h1>
	<div id="map_canvas" style="width:100%; height:550px"></div>
<?php endif; ?>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<?php echo $javascript->link('mapa.js'); ?>
<script type="text/javascript">
	function initialize() {
 		var comunas = new Array(<?php echo count($comunas); ?>);
		<?php
		foreach ($comunas as $key => $comuna) { ?>
		 	var comuna = new Array();
		 	comuna['nombre'] = "<?php echo $key; ?>";
		 	comuna['id'] = <?php echo $comuna['id']; ?>;
		 	comuna['lat'] = <?php echo $comuna['lat']; ?>;
		 	comuna['lon'] = <?php echo $comuna['lon']; ?>;
		<?php
			foreach($comuna['Recursos'] as $area => $cantidad){ ?>
			comuna['<?php echo $area;?>'] = <?php echo num($cantidad); ?>;
	<?php	} ?>
			comunas.push(comuna);
<?php 	} ?>
	 	initializeMapOperativos('map_canvas', comunas);
	}
	
initialize();

	function cargarMapa() {
		var parametros = {
			mapa: {
				zoom: 7,
				center: new google.maps.LatLng(-35.5,-72),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControl : true,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
					position: google.maps.ControlPosition.TOP_LEFT
				},
				navigationControl: true
			}
			
		}
	}
</script>
