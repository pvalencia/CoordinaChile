$(document).ready(function() {
	// Menu secundario show/hide
	$('.menuprincipal li').hover(function() {
		$(this).children('ul.menusecundario').show();
	}, function() {
		$(this).children('ul.menusecundario').hide();
	});
	
	// Tabs
	var altura_max = 0;
	$('#carpetas #carpeta .carpeta').each(function() {
		if($(this).height() > altura_max)
			altura_max = $(this).height();
	});
	if(altura_max > 0)
		$('#carpetas #carpeta .carpeta').height(altura_max);
	
	$('#carpetas #lenguetas li a').live('click', function(e) {
		if(!$(this).parent().hasClass('active')) {
			var lengueta_activa = $('#carpetas #lenguetas li.active');
			var carpeta_activa = $('#carpetas #carpeta .'+lengueta_activa.attr('id')+'.active');
			var lengueta = 	$(this).parent();
			var carpeta = $('#carpetas #carpeta .'+$(this).parent().attr('id')+'.oculto');
			
			if($(this).hasClass('agregar')) {
				if($(this).hasClass('localidad'))
					agregarNuevaLocalidad();
			}
	
			lengueta_activa.toggleClass('active');
			carpeta_activa.toggleClass('active').toggleClass('oculto');
			
			lengueta.toggleClass('active');
			carpeta.toggleClass('oculto').toggleClass('active');
			
			arreglarMapa();
		}
	});
	
	// Select show
	$('select.showit').change(function() {
		if(!$('.toshow.showit'+$(this).val()).hasClass('active')) {
			$('.toshow.active').addClass('oculto').removeClass('active');
			$('.toshow.showit'+$(this).val()).addClass('active').removeClass('oculto');
		}
	});
	
	// Checkbox show
	$('.input-checkbox.showit').live('click', function() {
		if($(this).is(':checked'))
			$('.toshow.'+$(this).attr('id')).removeClass('oculto').addClass('active').parents('div.carpeta.active').height('auto');
		else
			$('.toshow.'+$(this).attr('id')).removeClass('active').addClass('oculto');
	});
		
	if($('.input-checkbox.showit').is(':checked'))
		$('.toshow.'+$(this).attr('id')).removeClass('oculto').addClass('active').parents('div.carpeta.active').height('auto');
	
	$('.cantidad').focus(function() {
		if($(this).val() == 0)
			$(this).val('');
	}).blur(function() {
		if($(this).val() == '')
			$(this).val(0);
	});
});

function arreglarMapa() {
	if(mapas != undefined) {
		if(mapas.length > 0) {
			for(var i in mapas) {
				if($('#'+mapas[i].parametros.canvas_id).parent().hasClass('active')) {
					gCentro = mapas[i].gMapa.getCenter();
					
					Mapa_activa = mapas[i];
					Mapa_activa.resizeMapa();
					Mapa_activa.centrarMapa(gCentro);
					break;
				}
			}
		}
	}
}