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
		getLocalidades($('.selectcomunas select').val());
	}
	
	function echoOptionsSelectLoc(localidades) {
		$('.selectlocalidades select').html('');
		for(var id in localidades) {
			$('.selectlocalidades select').append('<option value="'+id+'">'+localidades[id]+'</option>');
		}
	}
	
	$('.selelectlocalidades select').change(function() {
		var lengueta = $(this).parents('div#carpetas .lengueta.active');
		var a_lengueta = $('a', lengueta);
		
		a_lengueta.text($(this).val());
		a_lengueta.attr('title', 'Datos de '+$(this).val());
	});
});