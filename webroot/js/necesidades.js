$(document).ready(function() {
	$('.selectlocalidades select').live('change', function() {
		getNecesidades($(this).val(), $('.lengueta.active').attr('id'));
	});
		
	function getNecesidades(id_localidad, lengueta) {
		var indice = parseInt(lengueta.replace(/\D/g,''));
		$.getJSON('/catastros/get_necesidades/'+id_localidad+'/'+indice+'.json', echoNecesidades);
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
