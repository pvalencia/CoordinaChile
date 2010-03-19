<?php echo $form->create('Comuna', array('url' => array('controller' => 'comunas', 'action' => 'editar', $form->value('Comuna.id')))); ?>

<fieldset>
<legend>Editar <?php echo $form->value('Comuna.nombre'); ?> de la comuna de <?php echo $form->value('Comuna.nombre'); ?></legend>

<?php 
	echo $form->input('Comuna.nombre'); 
	echo $form->input('Comuna.lat', array('type' => 'hidden'));
	echo $form->input('Comuna.lon', array('type' => 'hidden'));
	echo $form->submit('Guardar');
?>
	
</fieldset>

<?php echo $form->end(); ?>

<div id="mapa" style="width: 600px; height: 300px;"></div>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<script type="text/javascript">
var ll = new google.maps.LatLng(<?php echo $form->value('Comuna.lat'); ?>,<?php echo $form->value('Comuna.lon'); ?>);
var myOptions = {
    zoom: 11,
	center: ll,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
var map = new google.maps.Map(document.getElementById("mapa"), myOptions);

var marker = new google.maps.Marker({
	map: map,
	position: ll,
	Title: '<?php echo $form->value('Comuna.nombre'); ?>',
	draggable: true
});

google.maps.event.addListener(marker, 'dragend', function() {
	$('#ComunaLat').val(marker.getPosition().lat());
	$('#ComunaLon').val(marker.getPosition().lng());
});
</script>


