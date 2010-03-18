<?php if($full): ?>
	<div id="map_canvas" class="canvasmapa" style="width: 100%; height: 100%;"></div>
<?php else: ?>
	<h1>
		Operativos
	</h1>
	
	<div id="carpetas">
		<div id="lenguetas">
			<ul class="menu">
				<li class="lengueta active" id="lenguetaactivos">
					<a href="#" title="Operativos realizados">Activos</a>
				</li>
				<li class="lengueta" id="lenguetaprogramados">
					<a href="#" title="Catastros realizados">Programados</a>
				</li>
				<li class="lengueta" id="lenguetarealizados">
					<a href="#" title="Catastros realizados">Realizados</a>
				</li>
			</ul>
			<div class="clear"></div>
		</div>
		<div id="carpeta">
			<div class="lenguetaactivos carpeta active">
				<div id="map_canvas" class="canvasmapa" style="width:100%; height:558px"></div>
			</div>
			<div class="lenguetaprogramados carpeta oculto"></div>
			<div class="lenguetarealizados carpeta oculto"></div>
		</div>
	</div>
<?php endif; ?>

<?php echo $javascript->link('http://maps.google.com/maps/api/js?sensor=true'); ?>
<?php echo $javascript->link('mapa.js'); ?>
<script type="text/javascript">
	function cargarMapa() {
		var comunas = <?php echo $javascript->Object($comunas); ?>;
		var marcas = new Array(<?php echo count($comunas); ?>);
		var burbujas = new Array(<?php echo count($comunas); ?>);

		var i = 0;
		for(var nombre in comunas) {
			marcas[i] = {
				posicion: {
					lat: comunas[nombre].lat,
					lon: comunas[nombre].lon
				},
				titulo: nombre
			};

			burbujas[i] = {
				contenido: contenidoBurbuja({
					id: comunas[nombre].id,
					nombre: nombre,
					recursos: comunas[nombre].Recursos
				})
			};

			i++;
		}

		var parametros = {
			mapa: {
				canvas_id: 'map_canvas',
				zoom: 7,
				centro: randomCentro(marcas),
				personalizar: {
					mapTypeControlOptions: {
						style: google.maps.MapTypeControlStyle.DEFAULT
					}
				}
			},
			marcas: marcas,
			burbujas: burbujas
		};

		mapas[0] = new ccMapa(parametros);
	}

	function contenidoBurbuja(datos) {
		var contenido = '<ul class="menu floatright"><li><a href="/comunas/ver/'+datos.id+'">Detalle</a></li></ul>'+
						'<h4>'+datos.nombre+'</h4>'+
						'<div>'+
							'<table class="burbuja ancho100 sinborde">'+
								'<tr><th class="primero alignleft">Rubro</th>'+
									'<th>Voluntarios</th>'+
									'<th class="ultimo sinborde">Recursos</th></tr>'+
								'<tr><td class="fila1 primero">Salud</td>'+
									'<td class="fila1 aligncenter">'+datos.recursos.salud_vol+'</td>'+
									'<td class="fila1 aligncenter ultimo sinborde">-</td></tr>'+
								'<tr><td class="fila2 primero">Vivienda</td>'+
									'<td class="fila2 aligncenter">'+datos.recursos.vivienda_vol+'</td>'+
									'<td class="fila2 aligncenter ultimo sinborde">'+datos.recursos.vivienda_viv+'</td></tr>'+
								'<tr><td class="fila1 primero">Humanitaria</td>'+
									'<td class="fila1 aligncenter">'+datos.recursos.humanitaria_vol+'</td>'+
									'<td class="fila1 aligncenter ultimo sinborde">'+datos.recursos.humanitaria_rec+'</td></tr>'+
								'<tr><td class="fila2 primero">Otros</td>'+
									'<td class="fila2 aligncenter">-</td>'+
									'<td class="fila2 aligncenter ultimo sinborde">'+datos.recursos.otros_rec+'</td></tr>'+
							'</table>'+
						'</div>';

		return contenido;
	}

	cargarMapa();
</script>
<?php echo $javascript->link('visualizacion.js'); ?>