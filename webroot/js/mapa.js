function initializeMapOperativos(id_map, comunas) {
	var myOptions = {
		zoom: 7,
		navigationControl: true,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById(id_map), myOptions);
	map.setCenter(new google.maps.LatLng(-35.5,-72), 7);
	var image = "pala.png";
	
	for(var i in comunas){
		addFields(comunas[i], map);
	}
}

function addFields(comuna, map){
	var myLatlng = new google.maps.LatLng(comuna['lat'], comuna['lon']);
	
	var contentString = '<div class="bloque"><h4>'+comuna['nombre']+'</h4>'+
						'<table class="burbuja ancho100 noborder">'+
							'<tr><td class="fila2">Salud</td>'+
								'<td class="fila2">Voluntarios '+comuna['salud_vol']+'</td></tr>'+
							'<tr><td class="fila1">Vivienda</td>'+
								'<td class="fila1">Voluntarios '+comuna['vivienda_vol']+
											'<br />Viviendas '+comuna['vivienda_viv']+'</td></tr>'+
							'<tr><td class="fila2">Humanitaria</td>'+
								'<td class="fila2">Voluntarios '+comuna['humanitaria_vol']+
											'<br />Recursos '+comuna['humanitaria_rec']+'</td></tr>'+
							'<tr><td class="fila1">Otros</td>'+
								'<td class="fila1">Recursos '+comuna['otros_rec']+'</td></tr>'+
						'</table></div>'+
					'<div class="alignright"><a href="/comunas/ver/'+comuna['id']+'">Ver detalle</a></div>';
	var marker = new google.maps.Marker({
		map: map, 
		position: myLatlng,
		Title: comuna['nombre'],
		draggable: true
	});
	
	var infowindow = new google.maps.InfoWindow({ content: contentString });

	google.maps.event.addListener(marker, 'click', function() {
		infowindow.open(map,marker);
	});
}
