function ccMapa(parametros) {
	this.opcionesMapa = opcionesMapa;
	this.personalizarOpciones = personalizarOpciones;
	this.verMarca = verMarca;
	this.obtenerMarca = obtenerMarca;
	this.centrarMapa = centrarMapa;
	this.resizeMapa = resizeMapa;
	
	this.parametros = parametros.mapa;
	
	this.gMapa = new google.maps.Map(document.getElementById(this.parametros.canvas_id), this.opcionesMapa());
	
	this.elementos = new Array();
	
	for(var i in parametros.elementos) {
		this.elementos[i] = new ccMarca(this.gMapa, parametros.elementos[i]);
	}
}

function opcionesMapa() {
	var opciones = {
		zoom: this.parametros.zoom,
		center: new google.maps.LatLng(parseFloat(this.parametros.centro.lat), parseFloat(this.parametros.centro.lon)),
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		mapTypeControl : true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		navigationControl: true
	};
	
	return this.personalizarOpciones(opciones);
}

function verMarca(posicion) {
	var gPosicion = new google.maps.LatLng(posicion.lat, posicion.lon);
	
	if(Marca_activa == null) {
		var Marca = this.obtenerMarca(gPosicion);
		this.centrarMapa(gPosicion);
		Marca.activarMarca();
	} else {
		if(Marca_activa.gMarca.getPosition().equals(gPosicion)) {
			this.centrarMapa(gPosicion);
		} else {
			if(Burbuja_activa != null)
				Burbuja_activa.cerrarBurbuja();
			
			Marca_activa.desactivarMarca();
			var Marca = this.obtenerMarca(gPosicion);
			this.centrarMapa(gPosicion);
			Marca.activarMarca();
		}
	}
}

function obtenerMarca(gPosicion) {
	var Marca = null;
	
	for(var i in this.elementos) {
		var Marca_aux = this.elementos[i];
		var pos_gMarca_aux = Marca_aux.gMarca.getPosition();
		
		if(gPosicion.equals(pos_gMarca_aux)) {
			Marca = Marca_aux;
			break;
		}
	}
	
	return Marca;
}

function centrarMapa(gPosicion) {
	if(!this.gMapa.getCenter().equals(gPosicion))
		this.gMapa.setCenter(gPosicion);
}

function resizeMapa() {
	google.maps.event.trigger(this.gMapa, 'resize');
}

function ccMarca(gMapa, parametros) {
	this.opcionesMarca = opcionesMarca;
	this.personalizarOpciones = personalizarOpciones;
	this.clickMarca = clickMarca;
	this.activarMarca = activarMarca;
	this.desactivarMarca = desactivarMarca;
	
	this.gMapa = gMapa;
	this.parametros = parametros.marca;
	
	this.gMarca = new google.maps.Marker(this.opcionesMarca());
	
	if(parametros.burbuja != undefined) {
		this.burbuja = new ccBurbuja(parametros.burbuja);
		this.clickMarca();
	}
}

function opcionesMarca() {
	var opciones = {
		map: this.gMapa,
		position: new google.maps.LatLng(parseFloat(this.parametros.posicion.lat), parseFloat(this.parametros.posicion.lon)),
		title: this.parametros.titulo,
		draggable: false,
		zIndex: 0
	};
	
	if(this.parametros.tipo != undefined)
		opciones.icon = '/img/mapa/'+this.parametros.tipo+'.png';
	
	return this.personalizarOpciones(opciones);
}

function clickMarca() {
	var Marca = this;
	
	this.click = function() {
		if(Marca_activa == null && Burbuja_activa == null) {
			Marca.activarMarca();
			if(Marca_activa.burbuja != undefined)
				Marca_activa.burbuja.abrirBurbuja();
		} else if(Marca_activa != null && Burbuja_activa == null) {
			if(Marca_activa.burbuja != undefined)
				Marca_activa.burbuja.abrirBurbuja();
		} else {
			var pos_gMarca_activa = Marca_activa.gMarca.getPosition();
			var pos_gMarca = Marca.gMarca.getPosition();

			if(pos_gMarca_activa.equals(pos_gMarca)) {
				Burbuja_activa.cerrarBurbuja();
				Marca_activa.desactivarMarca();
			} else {
				Burbuja_activa.cerrarBurbuja();
				Marca_activa.desactivarMarca();
				Marca.activarMarca();
				if(Marca_activa.burbuja != undefined)
					Marca_activa.burbuja.abrirBurbuja();
			}
		}
	}
	
	google.maps.event.addListener(this.gMarca, 'click', this.click);
}

function activarMarca() {
	this.gMarca.setOptions({zIndex: 1000000});
	if(this.parametros.tipo != undefined)
		this.gMarca.setOptions({icon: '/img/mapa/'+this.parametros.tipo+'_activo.png'});
	Marca_activa = this;
}

function desactivarMarca() {
	this.gMarca.setOptions({zIndex: 0});
	if(this.parametros.tipo != undefined)
		this.gMarca.setOptions({icon: '/img/mapa/'+this.parametros.tipo+'.png'});
	Marca_activa = null;
	$('a.verpunto.active').toggleClass('active');
}

function ccBurbuja(parametros) {
	this.opcionesBurbuja = opcionesBurbuja;
	this.personalizarOpciones = personalizarOpciones;
	this.abrirBurbuja = abrirBurbuja;
	this.cerrarBurbuja = cerrarBurbuja;
	this.clickBotonCerrarBurbuja = clickBotonCerrarBurbuja;
	
	this.parametros = parametros,
	
	this.gBurbuja = new google.maps.InfoWindow(this.opcionesBurbuja());
	this.clickBotonCerrarBurbuja();
}

function opcionesBurbuja() {
	var opciones = {
		content: this.parametros.contenido
	};
	
	return this.personalizarOpciones(opciones);
}

function abrirBurbuja() {
	this.gBurbuja.open(Mapa_activa.gMapa, Marca_activa.gMarca);
	Burbuja_activa = this;
}

function cerrarBurbuja(tipo) {
	this.gBurbuja.close();
	Burbuja_activa = null;
}

function clickBotonCerrarBurbuja() {
	google.maps.event.addListener(this.gBurbuja, 'closeclick', function() {
		Marca_activa.desactivarMarca();
		Burbuja_activa = null;
	});
}

function personalizarOpciones(opciones) {
	if(this.parametros.personalizar != undefined) {
		for(var campo in this.parametros.personalizar) {
			opciones[campo] = this.parametros.personalizar[campo];
		}
	}
	
	return opciones;
}

function randomCentro(elementos) {
	var rango = elementos.length;
	
	var posicion = {
		lat: -35.5,
		lon: -72
	};
	
	if(rango == 1) {
		posicion = {
			lat: parseFloat(elementos[0].marca.posicion.lat),
			lon: parseFloat(elementos[0].marca.posicion.lon)
		};
	} else if(rango > 1) {
		var n_random = Math.floor(Math.random()*rango);
		
		if(elementos[n_random] != undefined) {
			posicion = {
				lat: parseFloat(elementos[n_random].marca.posicion.lat),
				lon: parseFloat(elementos[n_random].marca.posicion.lon)
			};
		}
	}
	
	return posicion;
}

function cargarMapa(localidades, params) {
	var elementos = new Array();
	
	var parametros = {
		mapa: {
			canvas_id: params.canvasmapa_id,
			zoom: 7
		}
	};

	if(params.controlador != 'localidades') {
		var i = 0;
		if(params.vista == 'ver') {
			for(var j in localidades) {
				if(localidades[j][params.tipo].length != 0) {
					elementos[i] = {
						marca: {
							posicion: {
								lat: localidades[j].lat,
								lon: localidades[j].lon
							},
							titulo: 'Localidad de '+localidades[j].nombre,
							tipo: params.tipo
						},
						burbuja: {
							contenido: contenidoBurbuja({
								loc_id: localidades[j].id,
								loc_nombre: localidades[j].nombre,
								controlador: params.controlador,
								vista: params.vista,
								eventos: localidades[j][params.tipo],
								nombre: params.nombre,
								tipo: params.tipo
							})
						}
					}
					i++;
				}
			}
		} else if(params.vista == 'mapa') {
			for(var j in localidades) {
				elementos[i] = {
					marca:  {
						posicion: {
							lat: localidades[j].lat,
							lon: localidades[j].lon
						},
						titulo: 'Comuna de '+j,
						tipo: params.tipo
					},
					burbuja: {
						contenido: contenidoBurbuja({
							loc_id: localidades[j].id,
							loc_nombre: j,
							controlador: params.cotrolador,
							vista: params.vista,
							eventos: localidades[j].Recursos
						})
					}
				};
				i++;
			}
			parametros.mapa.personalizar = {
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DEFAULT
				}
			};
		}
	} else {
		if(params.vista == 'ver') {
			elementos[0] = {
				marca: {
					posicion: {
						lat: localidades[0].Localidad.lat,
						lon: localidades[0].Localidad.lon,
					},
					titulo: 'Localidad de '+localidades[0].Localidad.nombre,
					tipo: params.tipo
				},
				burbuja: {
					contenido: contenidoBurbuja({
						loc_nombre: localidades[0].Localidad.nombre,
						controlador: params.controlador,
						vista: params.vista,
						eventos: localidades,
						nombre: params.nombre,
						tipo: params.tipo
					})
				}
			}
		}
		parametros.mapa.zoom = 11;
	}
	
	parametros.mapa.centro = randomCentro(elementos);

	if(elementos.length != 0)
		parametros.elementos = elementos;

	if(mapas.length == 0) {
		mapas[0] = new ccMapa(parametros);
		Mapa_activa = mapas[0];
	} else {
		mapas[mapas.length] = new ccMapa(parametros);
	}
}

function contenidoBurbuja(datos) {
	var contenido = '<div class="burbuja">';
	
	if(datos.controlador != 'localidades') {
		if(datos.vista == 'ver') {
			contenido = contenido+'<ul class="menu floatright"><li><a href="/localidades/ver/'+datos.loc_id+'">Detalle</a></li></ul>'+
				'<h4>Localidad de '+datos.loc_nombre+'</h4><div>';
		} else if(datos.vista == 'mapa') {
			contenido = contenido+'<ul class="menu floatright"><li><a href="/comunas/ver/'+datos.loc_id+'">Detalle</a></li></ul>'+
				'<h4>Comuna de '+datos.loc_nombre+'</h4><div>';
		}
	} else {
		contenido = contenido+'<h4>Localidad de '+datos.loc_nombre+'</h4><div>';
	}
	
	if(datos.vista != 'mapa') {
		for(var i in datos.eventos) {
			if(datos.controlador != 'localidades')
				datos.eventos[i] = '<a href="/'+datos.tipo+'/ver/'+datos.eventos[i]+'">'+datos.nombre+' '+datos.eventos[i]+'</a>';
			else
				datos.eventos[i] = '<a href="/'+datos.tipo+'/ver/'+datos.eventos[i].id+'">'+datos.nombre+' '+datos.eventos[i].id+'</a>';
		}
			
		contenido = contenido+datos.eventos.join(', ');
	} else {
		contenido = contenido+'<table class="ancho100 sinborde">'+
						'<tr><th class="primero alignleft">Rubro</th>'+
							'<th>Voluntarios</th>'+
							'<th class="ultimo sinborde">Recursos</th></tr>'+
						'<tr><td class="fila1 primero">Salud</td>'+
							'<td class="fila1 aligncenter">'+datos.eventos.salud_vol+'</td>'+
							'<td class="fila1 aligncenter ultimo sinborde">&mdash;</td></tr>'+
						'<tr><td class="fila2 primero">Vivienda</td>'+
							'<td class="fila2 aligncenter">'+datos.eventos.vivienda_vol+'</td>'+
							'<td class="fila2 aligncenter ultimo sinborde">'+datos.eventos.vivienda_viv+'</td></tr>'+
						'<tr><td class="fila1 primero">Humanitaria</td>'+
							'<td class="fila1 aligncenter">'+datos.eventos.humanitaria_vol+'</td>'+
							'<td class="fila1 aligncenter ultimo sinborde">'+datos.eventos.humanitaria_rec+'</td></tr>'+
						'<tr><td class="fila2 primero">Otros</td>'+
							'<td class="fila2 aligncenter">&mdash;</td>'+
							'<td class="fila2 aligncenter ultimo sinborde">'+datos.eventos.otros_rec+'</td></tr>'+
					'</table>'
	}
	
	contenido = contenido+'</div></div>';

	return contenido;
}

$(document).ready(function() {
	$('a.verpunto').click(function(e) {
		var posicionMarca = {
			lat: parseFloat($('.'+$(this).attr('id')+' span.latlon .lat').text()),
			lon: parseFloat($('.'+$(this).attr('id')+' span.latlon .lon').text())
		};
		
		if(!$(this).hasClass('active')) {
			$('a.verpunto.active').toggleClass('active');
			$(this).toggleClass('active');
		}
		
		Mapa_activa.verMarca(posicionMarca);
	});
});