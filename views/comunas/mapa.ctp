<h1>
	Operativos
</h1>
<div id="map_canvas" style="width:100%; height:550px"></div>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<script type="text/javascript">
	function initialize() {
 		var map;
		var myOptions = {
			zoom: 8,
			navigationControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		map.setCenter(new google.maps.LatLng(-35.5,-72), 7);
		var image = "pala.png";
		
	<?php
		$i = 0;
		foreach ($comunas as $key => $comuna) {
			++$i;
			$content = '<div class="bloque"><h4>'.$key.'</h4>';
			$content .= '<table class="burbuja ancho100 noborder">';
			$j = 2;
			foreach($comuna['Recursos'] as $area => $tipos){
				$content.= '<tr><td class="fila'.$j.'">'.$area.'</td>';
				$content.=	'<td class="fila'.$j.'">';
				foreach($tipos as $tipo => $cantidad){
						$content.= $tipo.' '.$cantidad.'<br/>';
				}
				if($j == 1)
					$j = 2;
				else
					$j = 1;
			}
			$content.= '</table></div>';
			$content.= '<div class="alignright"><a href="/comunas/ver/'.$comuna['id'].'">Ver detalle</a></div>';
			//$content = '<div id="content">' . '<div id="siteNotice">' . '</div>' . '<h3 id="firstHeading" class="firstHeading">' . $key .'</h3>' . '</div>' . '</div>';
			//$orgkey = array_keys($comuna["$key"]);
			//foreach ($orgkey as $org) {
			//if ($org == "FECH") {
			//	$k = 1;
			//}; 
			//if ($k == 1) {
			//	$k = 0;
			//	$content = $content . '<a title="Federacion de Estudiantes Universidad de Chile" href="http://www.fech.cl">' . '<img SRC="fech.PNG" align="right">' . '</a>';;
			//}
			//$content = $content . " " . $org . ": " . $comuna["$key"]["$org"] . '<br>';
			//$content = $content . '<a title="Maestro de Ayudas" href="https://spreadsheets.google.com/ccc?key=0AuIaB2XKj-ZkdFZPUGliTVVrRlg3cUUxSy1mRkxXekE&hl=es">' . "Detalle" . '</a>';
			?>
			
				var myLatlng<?php echo $i; ?> = new google.maps.LatLng('<?php echo $comuna['lat']?>', '<?php echo $comuna['lon']; ?>');
				
				var contentString<?php echo $i; ?> = '<?php echo $content; ?>';
				var marker<?php echo $i; ?> = new google.maps.Marker({
					map: map, 
					position: myLatlng<?php echo $i; ?>,
					Title: '<?php echo $key; ?>',
					draggable: true
				});
				var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
					content: contentString<?php echo $i; ?>
				}); 

				google.maps.event.addListener(marker<?php echo $i; ?>, 'click', function() {
					infowindow<?php echo $i; ?>.open(map,marker<?php echo $i; ?>);
				});
<?php } ?>
	}
	initialize();
</script>