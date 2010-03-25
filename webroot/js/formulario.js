$(document).ready(function() {
	if($('.selectregiones select').val() != '') {
		getComunas($('.selectregiones select').val());
	}
	
	$('.selectregiones select').change(function() {
		getComunas($(this).val());
	});
	
	$('.selectcomunas select').change(function() {
		getLocalidades($(this).val());
	});
	
	function getComunas(id_region) {
		$.getJSON('/comunas/get_comunas/'+id_region+'.json', echoOptionsSelectCom);
	}
	
	function getLocalidades(id_comuna) {
		$.getJSON('/localidades/get_localidades/'+id_comuna+'.json', echoOptionsSelectLoc);
	}
	
	function echoOptionsSelectCom(comunas) {
		$('.selectcomunas select').html('');
		for(var id in comunas) {
			$('.selectcomunas select').append('<option value="'+id+'">'+comunas[id]+'</option>');
		}
		var id_comuna = $('.selectcomunas select').val();
		$('.selectcomunas select').prepend('<option selected="true">Selecciona una comuna</option>').removeClass('oculto');
	}
	
	function echoOptionsSelectLoc(localidades) {
		$('.selectlocalidades select').html('');

		var i = 0;
		for(var id in localidades) {
			$('.selectlocalidades select').append('<option value="'+id+'">'+localidades[id]+'</option>');
			i++;
		}

		if(i > 1)
			$('.agregar.localidad').parent().removeClass('oculto');
		else
			$('.agregar.localidad').parent().addClass('oculto');
		
		$('.selectlocalidades .avisotemporal').remove();
		$('.selectlocalidades select').prepend('<option selected="true">Selecciona una localidad</option>').removeClass('oculto');
	}
	
	$('.selectlocalidades select').live('change', function() {
		var opcion_activa = $('option[value="'+$(this).val()+'"]', $(this));
		var lengueta = $(this).parents('div#carpetas').find('.lengueta.active');
		var a_lengueta = $('a', lengueta);
		
		a_lengueta.text(opcion_activa.text());
		a_lengueta.attr('title', 'Datos de la localidad de '+opcion_activa.text());
	});
});

function agregarNuevaLocalidad() {
	var a_lengueta = $('.agregar.localidad');
	var lengueta = a_lengueta.parent();
	
	var num_localidad = extraerNumero(lengueta.attr('id'));
	
	var carpeta = $('.carpeta.lengueta'+(num_localidad-1));
	
	var nuevo_agregar_lengueta = lengueta.clone().attr('id', 'lengueta'+(num_localidad+1));
	var nuevo_carpeta = carpeta.clone().removeClass('lengueta'+(num_localidad-1)).addClass('lengueta'+num_localidad);
	
	a_lengueta.attr({
		'title': 'Datos de la localidad',
		'class': ''
	}).text(a_lengueta.attr('title'));
	
	reiniciarValoresLocalidad(nuevo_carpeta, num_localidad);
	
	lengueta.after(nuevo_agregar_lengueta);
	carpeta.after(nuevo_carpeta);

	if(a_lengueta.parents('ul.menu').find('li').size() == $('.selectlocalidades select option').size()) {
		lengueta.addClass('oculto');
	}
}

function reiniciarValoresLocalidad(carpeta_localidad, num_localidad) {
	$('*', carpeta_localidad).each(function() {
		if($(this).attr('for') != undefined) {
			if($(this).attr('for').indexOf(num_localidad-1) != -1)
				$(this).attr('for', $(this).attr('for').replace(num_localidad-1, num_localidad));
		}
		
		if($(this).hasClass('toshow')) {
			if($(this).attr('class').indexOf('showit'+(num_localidad-1)) != -1)
				$(this).attr('class', $(this).attr('class').replace('showit'+(num_localidad-1), 'showit'+num_localidad)).removeClass('active').addClass('oculto');
		}

		if($(this).is(':input')) {
			$(this).attr({
				'id': $(this).attr('id').replace(num_localidad-1, num_localidad),
				'name': $(this).attr('name').replace(num_localidad-1, num_localidad)
			});
			
			if($(this).is(':checked'))
				$(this).attr('checked', false);

			if(!$(this).hasClass('fecha')) {
				if($(this).hasClass('cantidad')) {
					if($(this).attr('id').indexOf('Duracion') != -1)
						$(this).val(1);
					else
						$(this).val(0);
				} else
					$(this).val('');
			}
		}
	});
}

function extraerNumero(text) {
	return parseInt(text.replace(/\D/g,''));
}