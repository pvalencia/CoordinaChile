jQuery(document).ready(function($) {
	if($('.selectregiones select').val() != '') {
		getComunas($('.selectregiones select').val());
	}
	
	$('.selectregiones select').change(function() {
		getComunas($(this).val());
	});
	
	var nuevo_id_comuna = '';
	$('.selectcomunas select').change(function() {
		if(nuevo_id_comuna == '') {
			nuevo_id_comuna = $(this).val();
			getLocalidades(nuevo_id_comuna);
			$('#carpetas.oculto').removeClass('oculto');
		} else if($(this).val() != nuevo_id_comuna) {
			var confirmar = confirm('Si cambias de comuna perderás toda la información sobre las localidades que hayas ingresado.\n¿Deseas continuar?');
			if(confirmar) {
				reiniciarLocalidades();
				nuevo_id_comuna = $(this).val();
				getLocalidades(nuevo_id_comuna);
			}else{
				$(this).val(nuevo_id_comuna);
			}
		}
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
		$('.selectcomunas select').prepend('<option selected="true">Selecciona una comuna</option>');
		$('.selectcomunas select').removeClass('oculto').addClass('active');
		$('.carpeta.active').height('auto');
	}
	
	function echoOptionsSelectLoc(localidades) {
		$('.selectlocalidades select').html('');
		var count = 0;
		for(var id in localidades) {
			$('.selectlocalidades select').append('<option value="'+id+'">'+localidades[id]+'</option>');
			++count;
		}
		
		if(count > 1){
			$('.selectlocalidades select').prepend('<option selected="true">Selecciona una localidad</option>');
			$('.agregar.localidad').parent().removeClass('oculto');
		}else{
			$('.agregar.localidad').parent().addClass('oculto');
			$('.selectlocalidades select').change();
		}
	}
	
	$('.selectlocalidades select').live('change', function() {
		var opcion_activa = $('option[value="'+$(this).val()+'"]', $(this));
		var lengueta = $(this).parents('div#carpetas').find('.lengueta.active');
		var a_lengueta = $('a', lengueta);
		
		a_lengueta.text(opcion_activa.text());
		a_lengueta.attr('title', 'Datos de la localidad de '+opcion_activa.text());
	});
});

function reiniciarLocalidades() {
	$('#carpetas #lenguetas .lengueta').each(function() {
		if($(this).attr('id') != 'lengueta0' && !$(this).children().hasClass('agregar')) {
			$('.carpeta.'+$(this).attr('id')).remove();
			$(this).remove();
		} else {
			if($(this).attr('id') == 'lengueta0') {
				$(this).children().attr('title', 'Datos de la localidad').text($(this).children().attr('title'));
				if(!$(this).hasClass('active')) {
					$(this).addClass('active');
					$('.carpeta.'+$(this).attr('id')).removeClass('oculto').addClass('active');
				}
			}
			if($(this).children().hasClass('agregar'))
				$(this).attr('id', 'lengueta1');
		}
	});
	$('.input-checkbox.showit').each(function (){
		if($(this).is(':checked'))
			$(this).attr('checked', false);
	});
}

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
		
		if($(this).hasClass('necesidades')){
			$(this).attr({
				'id': $(this).attr('id').replace(num_localidad-1, num_localidad),
			});
			if($(this).hasClass('intro')){
				$(this).addClass('oculto').hide();
			}else{
				$(this).html('');
			}
		}
		if($(this).hasClass('contacto')){
			$(this).attr({
				'id': $(this).attr('id').replace(num_localidad-1, num_localidad),
			});
		}
	});
	$('#necesidades'+num_localidad).html('');
}

function extraerNumero(text) {
	return parseInt(text.replace(/\D/g,''));
}
