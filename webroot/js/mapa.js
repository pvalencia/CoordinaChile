var mapas = new Array();
var Mapa_activa = null;
var gMarca_activa = null;
var gBurbuja_activa = null;

function ccMapa(parametros) {
	this.opcionesMapa = opcionesMapa;
	this.personalizarOpciones = personalizarOpciones;
	this.activarMarca = activarMarca;
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

function activarMarca(posicion) {
	var gCentro = new google.maps.LatLng(posicion.lat, posicion.lon);
	
	if(gMarca_activa != null && gBurbuja_activa != null) {
		gMarca_activa.setZIndex(0);
		cerrarBurbuja();
	}
	
	if(!this.gMapa.getCenter().equals(gCentro))
		this.gMapa.setCenter(gCentro);
	
	var gMarca = null;
	var gBurbuja = null
	
	for(var i in this.elementos) {
		gMarca = this.elementos[i].gMarca;
		gBurbuja = this.elementos[i].burbuja.gBurbuja;
		var gPos = gMarca.getPosition();
		
		if(gCentro.equals(gPos)) {
			break;
		}
	}
	gMarca.setZIndex(1000000);
}

function resizeMapa() {
	google.maps.event.trigger(this.gMapa, 'resize');
}

function ccMarca(gMapa, parametros) {
	this.opcionesMarca = opcionesMarca;
	this.personalizarOpciones = personalizarOpciones;
	this.clickMarca = clickMarca;
	
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
	
	if(this.parametros.tipo == 'operativo')
		opciones.icon = '/img/operativo.png';
	else
		opciones.icon = '/img/catastro.png';
	
	return this.personalizarOpciones(opciones);
}

function clickMarca() {
	var gMapa = this.gMapa;
	var gMarca = this.gMarca;
	var gBurbuja = this.burbuja.gBurbuja;
	
	google.maps.event.addListener(gMarca, 'click', function() {
		if(gMarca_activa == null && gBurbuja_activa == null) {
			abrirBurbuja(gMapa, gMarca, gBurbuja);
		} else {
			var pos_gMarca_activa = gMarca_activa.getPosition();
			var pos_gMarca = gMarca.getPosition();

			if(pos_gMarca_activa.equals(pos_gMarca)) {
				cerrarBurbuja()
			} else {
				cerrarBurbuja()
				abrirBurbuja(gMapa, gMarca, gBurbuja);
			}
		}
	});
}

function ccBurbuja(parametros) {
	this.opcionesBurbuja = opcionesBurbuja;
	this.personalizarOpciones = personalizarOpciones;
	
	this.parametros = parametros,
	
	this.gBurbuja = new google.maps.InfoWindow(this.opcionesBurbuja());
}

function opcionesBurbuja() {
	var opciones = {
		content: this.parametros.contenido
	};
	
	return this.personalizarOpciones(opciones);
}

function abrirBurbuja(gMapa, gMarca, gBurbuja) {
	gBurbuja.open(gMapa, gMarca);
	gMarca_activa = gMarca;
	gBurbuja_activa = gBurbuja;
}

function cerrarBurbuja() {
	gBurbuja_activa.close();
	gMarca_activa = null;
	gBurbuja_activa = null;
}

function personalizarOpciones(opciones) {
	if(this.parametros.personalizar != undefined) {
		if(this.parametros.personalizar != false && this.parametros.personalizar != null) {
			for(var campo in this.parametros.personalizar) {
				opciones[campo] = this.parametros.personalizar[campo];
			}
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

function cargarMapaOperativos_OrganizacionesComunas(loc_op) {
	var elementos_op = new Array();

	var i = 0;
	for(var j in loc_op) {
		if(loc_op[j].operativos.length != 0) {
			elementos_op[i] = {
				marca: {
					posicion: {
						lat: loc_op[j].lat,
						lon: loc_op[j].lon
					},
					titulo: loc_op[j].nombre,
					tipo: 'operativo'
				},
				burbuja: {
					contenido: contenidoBurbuja_OrganizacionesComunas({
						loc_id: loc_op[j].id,
						loc_nombre: loc_op[j].nombre,
						eventos: loc_op[j].operativos,
						nombre: 'Operativo',
						tipo: 'operativos'
					})
				}
			}
			i++;
		}
	}

	var parametros_op = {
		mapa: {
			canvas_id: 'mapaoperativos',
			zoom: 7,
			centro: randomCentro(elementos_op)	
		}
	};

	if(elementos_op.length != 0)
		parametros_op.elementos = elementos_op;

	mapas[0] = new ccMapa(parametros_op);
	Mapa_activa = mapas[0];
}

function cargarMapaCatastros_OrganizacionesComunas(loc_cat) {
	var elementos_cat = new Array();
	
	var k = 0;
	for(var j in loc_cat) {
		if(loc_cat[j].catastros.length != 0) {
			elementos_cat[k] = {
				marca: {
					posicion: {
						lat: loc_cat[j].lat,
						lon: loc_cat[j].lon
					},
					titulo: loc_cat[j].nombre,
					tipo: 'catastro'
				},
				burbuja: {
					contenido: contenidoBurbuja_OrganizacionesComunas({
						loc_id: loc_cat[j].id,
						loc_nombre: loc_cat[j].nombre,
						eventos: loc_cat[j].catastros,
						nombre: 'Catastro',
						tipo: 'catastros'
					})
				}
			}
			k++;
		}
	}

	var parametros_cat = {
		mapa: {
			canvas_id: 'mapacatastros',
			zoom: 7,
			centro: randomCentro(elementos_cat)
		}
	};

	if(elementos_cat.length != 0)
		parametros_cat.elementos = elementos_cat;
		
	mapas[1] = new ccMapa(parametros_cat);
}

function contenidoBurbuja_OrganizacionesComunas(datos) {
	var contenido = '<div class="burbuja">'+
						'<ul class="menu floatright"><li><a href="/localidades/ver/'+datos.loc_id+'">Detalle</a></li></ul>'+
							'<h4>'+datos.loc_nombre+'</h4>'+
							'<div>';

	for(var i in datos.eventos) {
		datos.eventos[i] = '<a href="/'+datos.tipo+'/ver/'+datos.eventos[i]+'">'+datos.nombre+' '+datos.eventos[i]+'</a>';
	}

	contenido = contenido+datos.eventos.join(', ')+'</div></div>';

	return contenido;
}

function cargarMapaOperativos_Localidades(loc_op) {
	var elementos_op = new Array();
	
	elementos_op[0] = {
		marca: {
			posicion: {
				lat: loc_op[0].Localidad.lat,
				lon: loc_op[0].Localidad.lon,
			},
			titulo: loc_op[0].Localidad.nombre,
			tipo: 'operativo'
		},
		burbuja: {
			contenido: contenidoBurbuja_Localidades({
				loc_nombre: loc_op[0].Localidad.nombre,
				eventos: loc_op,
				nombre: 'Operativo',
				tipo: 'operativos'
			})
		}
	}
	
	var parametros_op = {
		mapa: {
			canvas_id: 'mapaoperativos',
			zoom: 7,
			centro: randomCentro(elementos_op)	
		}
	};
	
	parametros_op.elementos = elementos_op;

	mapas[0] = new ccMapa(parametros_op);
	Mapa_activa = mapas[0];
}

function cargarMapaCatastros_Localidades(loc_cat) {
	var elementos_cat = new Array();
	
	elementos_cat[0] = {
		marca: {
			posicion: {
				lat: loc_cat[0].Localidad.lat,
				lon: loc_cat[0].Localidad.lon,
			},
			titulo: loc_cat[0].Localidad.nombre,
			tipo: 'catastro'
		},
		burbuja: {
			contenido: contenidoBurbuja_Localidades({
				loc_nombre: loc_cat[0].Localidad.nombre,
				eventos: loc_cat,
				nombre: 'Catastro',
				tipo: 'catastros'
			})
		}
	}
	
	var parametros_cat = {
		mapa: {
			canvas_id: 'mapacatastros',
			zoom: 7,
			centro: randomCentro(elementos_cat)
		}
	};
	
	parametros_cat.elementos = elementos_cat;

	mapas[1] = new ccMapa(parametros_cat);
}

function contenidoBurbuja_Localidades(datos) {
	var contenido = '<div class="burbuja">'+
						'<h4>'+datos.loc_nombre+'</h4>'+
							'<div>';

	for(var i in datos.eventos) {
		datos.eventos[i] = '<a href="/'+datos.tipo+'/ver/'+datos.eventos[i].id+'">'+datos.nombre+' '+datos.eventos[i].id+'</a>';
	}

	contenido = contenido+datos.eventos.join(', ')+'</div></div>';

	return contenido;
}

$(document).ready(function() {
	$('a.verpunto').click(function(e) {
		var posicionMarca = {
			lat: parseFloat($('.'+$(this).attr('id')+' span.latlon .lat').text()),
			lon: parseFloat($('.'+$(this).attr('id')+' span.latlon .lon').text())
		};
		
		Mapa_activa.activarMarca(posicionMarca);
	});
});