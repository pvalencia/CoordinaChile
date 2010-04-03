jQuery(document).ready(function($) {
	$('.selectlocalidades select').live('change', function() {
		getNecesidades($(this).val());
	});
		
	function getNecesidades(id_localidad) {
		var lengueta = $('.lengueta.active').attr('id');
		var indice = parseInt(lengueta.replace(/\D/g,''));
		$.getJSON('/operativos/get_necesidades/'+id_localidad+'/'+indice+'.json', echoNecesidades);
	}
	
	function echoNecesidades(necesidades) {
		var indice = parseInt($('.lengueta.active').attr('id').replace(/\D/g, ''));
		if(necesidades){
			$('#necesidades-intro'+indice).show();
			$('#necesidades'+indice).html(necesidades);
			$('#necesidades'+indice).parents('div.carpeta.active').height('auto');
		}else{
			$('#necesidades-intro'+indice).hide();
			$('#necesidades'+indice).html('');
		}
	}
});
