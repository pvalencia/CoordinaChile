function coordinaChileMapa(id_canvas_mapa, parametros) {
	this.mapa = new google.maps.Map(document.getElementById(id_canvas_mapa), parametros.mapa);
	
	this.marcas = array(lugares.length());
	this.burbujas = array(lugares.length());
	this.burbuja_activa = null;
	
	for(var i in lugares) {
		this.marcas[i] = new google.maps.Marker(parametros.marca);
		
		this.burbujas[i] = new google.maps.InfoWindow(parametros.burbuja);
		
		google.maps.event.addListener(this.marcas[i], 'click', function() {
			if(burbuja_activa != null)
				this.burbuja_activa.close();
			
			this.burbujas[i].open(this.mapa, this.marcas[i]);
			this.burbuja_activa = this.burbujas[i];
		});
	}
}

var infowindow_active = null;

function initializeMapOperativos(id_map, lugar) {
	var myOptions = {
		zoom: 7,
		center: new google.maps.LatLng(-35.5,-72),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl : true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.TOP_LEFT
		},
		navigationControl: true
	};
	var map = new google.maps.Map(document.getElementById(id_map), myOptions);
	
	for(var i in lugar){
		addFields(map, lugar[i]);
	}
}

function addFields(map, lugar){
	var myLatlng = new google.maps.LatLng(lugar['lat'], lugar['lon']);
	
	var contentString = '<ul class="menu floatright"><li><a href="/comunas/ver/'+lugar['id']+'">Detalle</a></li></ul>'+
						'<h4>'+lugar['nombre']+'</h4>'+
						'<table class="burbuja ancho100 sinborde">'+
							'<tr><th class="primero alignleft">Rubro</th>'+
								'<th>Voluntarios</th>'+
								'<th class="ultimo sinborde">Recursos</th></tr>'+
							'<tr><td class="fila1 primero">Salud</td>'+
								'<td class="fila1 aligncenter">'+lugar['salud_vol']+'</td>'+
								'<td class="fila1 aligncenter ultimo sinborde">x</td></tr>'+
							'<tr><td class="fila2 primero">Vivienda</td>'+
								'<td class="fila2 aligncenter">'+lugar['vivienda_vol']+'</td>'+
								'<td class="fila2 aligncenter ultimo sinborde">'+lugar['vivienda_viv']+'</td></tr>'+
							'<tr><td class="fila1 primero">Humanitaria</td>'+
								'<td class="fila1 aligncenter">'+lugar['humanitaria_vol']+'</td>'+
								'<td class="fila1 aligncenter ultimo sinborde">'+lugar['humanitaria_rec']+'</td></tr>'+
							'<tr><td class="fila2 primero">Otros</td>'+
								'<td class="fila2 aligncenter">x</td>'+
								'<td class="fila2 aligncenter ultimo sinborde">'+lugar['otros_rec']+'</td></tr>'+
						'</table>';
	
	var marker = new google.maps.Marker({
		map: map, 
		position: myLatlng,
		Title: lugar['nombre'],
		draggable: false
	});
	
	var infowindow = new google.maps.InfoWindow({ content: contentString });

	google.maps.event.addListener(marker, 'click', function() {
		if(infowindow_active != null)
			infowindow_active.close();
		
		infowindow.open(map, marker);
		infowindow_active = infowindow;
	});
}
