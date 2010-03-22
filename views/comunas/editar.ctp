<h1>
	Editar comuna de <?php echo $form->value('Comuna.nombre'); ?>
</h1>

<?php echo $form->create('Comuna', array('url' => array('controller' => 'comunas', 'action' => 'editar', $form->value('Comuna.id')))); ?>

<div class="bloque">
	<h2>
		Datos generales
	</h2>
	
	<?php
	$label_ini = '<div class="label ancho33">';
	$label_fin = '<span class="requerido">&nbsp;*</span></div>';
	$label_finA = '</div>';
	?>
	
	<div class="text input">
		<?php echo $label_ini.'Regi&oacute;n'.$label_finA.$regiones->getHtmlName($form->value('Comuna.id'), true); ?>
	</div>
	<?php 
	echo $form->input('Comuna.id');
	echo $form->input('Comuna.nombre', array('class' => 'input-text caracteristica', 'before' => $label_ini, 'between' => $label_fin)); 
	?>
</div>

<div class="bloque">
	<h2>
		Datos geogr&aacute;ficos
	</h2>
	
	<p>
		Manten presionado el bot&oacute;n del rat&oacute;n sobre el marcador de la comuna en el mapa, y luego mueve el cursor para modificar su ubicaci&oacute;n geogr&aacute;fica, o simplemente ingresa la latitud y la longitud de la comuna en los siguientes campos.
	</p>
	<?php
	echo $form->input('Comuna.lat', array('class' => 'input-text caracteristica', 'label' => 'Latitud', 'before' => $label_ini, 'between' => $label_fin));
	echo $form->input('Comuna.lon', array('class' => 'input-text caracteristica', 'label' => 'Longitud', 'before' => $label_ini, 'between' => $label_fin));
	?>
</div>

<div class="bloque">
	<div id="editarcomuna" class="canvasmapa ancho100 mapamediano"></div>
</div>

<?php
echo $form->submit('Modificar comuna', array('class' => 'input-button'));
echo $form->button('Reiniciar posición', array('id' => 'botonreiniciar', 'class' => 'input-button'));
?>

<?php echo $form->end(); ?>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<script type="text/javascript">
	$(document).ready(function() {
		var posicion = {
			lat: <?php echo $form->value('Comuna.lat'); ?>,
			lon: <?php echo $form->value('Comuna.lon'); ?>
		};
		
		var gPosicion = new google.maps.LatLng(posicion.lat, posicion.lon); 
		
		var opcionesMapa = {
		    zoom: 11,
			center: gPosicion,
		    mapTypeId: google.maps.MapTypeId.ROADMAP,
		    mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
				position: google.maps.ControlPosition.TOP_RIGHT
			}
		  };
		
		var gMapa = new google.maps.Map(document.getElementById('editarcomuna'), opcionesMapa);
		
		var gMarca = new google.maps.Marker({
			map: gMapa,
			position: gPosicion,
			title: '<?php echo $form->value('Comuna.nombre'); ?>',
			draggable: true,
			icon: '/img/mapa/editar.png'
		});
		
		$('#ComunaLat').change(function() {
			var lat = parseFloat($(this).val()); 
			if(lat != gMarca.getPosition().lat()) {
				gMarca.setPosition(new google.maps.LatLng(lat, gMarca.getPosition().lng()));
				gMapa.setCenter(gMarca.getPosition());
			}
		});
		
		$('#ComunaLon').change(function() {
			var lon = parseFloat($(this).val()); 
			if(lon != gMarca.getPosition().lng()) {
				gMarca.setPosition(new google.maps.LatLng(gMarca.getPosition().lat(), lon));
				gMapa.setCenter(gMarca.getPosition());
			}
		});
		
		google.maps.event.addListener(gMarca, 'drag', function() {
			$('#ComunaLat').val(gMarca.getPosition().lat());
			$('#ComunaLon').val(gMarca.getPosition().lng());
		});
		
		$('#botonreiniciar').click(function() {
			if(!gMarca.getPosition().equals(gPosicion)) {
				gMarca.setPosition(gPosicion);
				$('#ComunaLat').val(posicion.lat);
				$('#ComunaLon').val(posicion.lon);
			}
		
			gMapa.setCenter(gMarca.getPosition());
		});
	});
</script>