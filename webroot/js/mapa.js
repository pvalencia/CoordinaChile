function Mapa(id_canvas_mapa, opciones, lugares) {
	this.mapa = new google.maps.Map(document.getElementById(id_canvas_mapa), opciones.mapa);
	
	this.crearMarcas = crearMarcas;
	this.marcas = null;
	this.crearMarcas(lugares, opciones.marcas);
	
	this.crearMarca = crearMarca;
	
	this.crearBurbujas = crearBurbujas;
	this.burbujas = this.crearBurbujas(lugares, opciones.burbujas);
}

function crearMarcas(lugares, opciones) {
	this.marcas = array(lugares.length());
	
	for(var i in lugares) {
		this.marcas[i] = this.crearMarca(lugares[i], opciones);
	}
}

function crearMarca(lugar, opciones) {
	return new google.maps.Marker(opciones_marca);
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
		navigationControl: true,
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
