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
	
	var contentString = '<h4>'+comuna['nombre']+'</h4>'+
						'<table class="burbuja ancho100 sinborde">'+
							'<tr><th class="primero alignleft">Rubro</th>'+
								'<th>Voluntarios</th>'+
								'<th class="ultimo sinborde">Recursos</th></tr>'+
							'<tr><td class="fila1 primero">Salud</td>'+
								'<td class="fila1 aligncenter">'+comuna['salud_vol']+'</td>'+
								'<td class="fila1 aligncenter ultimo sinborde">x</td></tr>'+
							'<tr><td class="fila2 primero">Vivienda</td>'+
								'<td class="fila2 aligncenter">'+comuna['vivienda_vol']+'</td>'+
								'<td class="fila2 aligncenter ultimo sinborde">'+comuna['vivienda_viv']+'</td></tr>'+
							'<tr><td class="fila1 primero">Humanitaria</td>'+
								'<td class="fila1 aligncenter">'+comuna['humanitaria_vol']+'</td>'+
								'<td class="fila1 aligncenter ultimo sinborde">'+comuna['humanitaria_rec']+'</td></tr>'+
							'<tr><td class="fila2 primero">Otros</td>'+
								'<td class="fila2 aligncenter">x</td>'+
								'<td class="fila2 aligncenter ultimo sinborde">'+comuna['otros_rec']+'</td></tr>'+
						'</table>'+
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
