var burbuja_activa = null;

function ccMapa(parametros) {
	this.mapa = new google.maps.Map(document.getElementById(parametros.mapa.canvas_id), opcionesMapa(parametros.mapa));
	
	this.marcas = new Array(parametros.marcas.length);
	this.burbujas = new Array(parametros.burbujas.length);
	
	for(var i in parametros.marcas) {
		parametros.marcas[i].mapa = this.mapa;
		this.marcas[i] = new google.maps.Marker(opcionesMarca(parametros.marcas[i]));
		
		this.burbujas[i] = new google.maps.InfoWindow(opcionesBurbuja(parametros.burbujas[i]));
		
		var objetos = {
			mapa: this.mapa,
			marca: this.marcas[i],
			burbuja: this.burbujas[i]
		};
		
		clickMarca(objetos);
	}
	
	google.maps.event.trigger(this.mapa, 'resize');
}

function opcionesMapa(parametros) {
	var opciones = {
		zoom: parametros.zoom,
		center: new google.maps.LatLng(parametros.centro.lat, parametros.centro.lon),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl : true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		navigationControl: true
	};
	
	opciones = personalizacionParametros(opciones, parametros.personalizar);
	
	return opciones;
}

function opcionesMarca(parametros) {
	var opciones = {
		map: parametros.mapa,
		position: new google.maps.LatLng(parametros.posicion.lat, parametros.posicion.lon),
		title: parametros.titulo,
		draggable: false
	};
	
	opciones = personalizacionParametros(opciones, parametros.personalizar);
	
	return opciones;
}

function clickMarca(objetos) {
	google.maps.event.addListener(objetos.marca, 'click', function() {
		if(burbuja_activa != null)
			burbuja_activa.close();
		
		objetos.burbuja.open(objetos.mapa, objetos.marca);
		burbuja_activa = objetos.burbuja;
	});
}

function opcionesBurbuja(parametros) {
	var opciones = {
		content: parametros.contenido
	};
	
	opciones = personalizacionParametros(opciones, parametros.personalizar);
	
	return opciones;
}

function personalizacionParametros(opciones, personalizacion) {
	if(personalizacion != undefined) {
		if(personalizacion != false && personalizacion != null) {
			for(var campo in personalizacion) {
				opciones[campo] = personalizacion[campo];
			}
		}
	}
	
	return opciones;
}

function randomCentro(marcas) {
	var rango = marcas.length;
	
	var posicion = {
		lat: -35.5,
		lon: -72
	};
	
	if(rango > 0) {
		var n_random = Math.floor(Math.random()*rango);
		
		if(marcas[n_random] != undefined) {
			posicion = {
				lat: marcas[n_random].posicion.lat,
				lon: marcas[n_random].posicion.lon
			};
		}
	}
	
	return posicion;
}