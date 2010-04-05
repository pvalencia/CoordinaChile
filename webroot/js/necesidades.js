jQuery(document).ready(function($) {

	if($('.selectlocalidades select').hasClass('editar')){
		$('.selectlocalidades select').live('change', function() {
			var lengueta = parseInt($(this).attr('id').replace(/\D/g, ''));
			var subop = $('#Suboperativo'+lengueta+'Id').val();
			getNecesidades(lengueta, $(this).val(), subop);
		});
		
		var echoNecesidadesArray = [];
		$('.carpeta').each(function(){
				var lengueta = parseInt($(this).attr('id').replace(/\D/g, ''));
				var subop = $('#Suboperativo'+lengueta+'Id').val();
				echoNecesidadesArray[subop] = function(value){ return echoNecesidades(value, lengueta); }
			}
		);
		
		$('.selectlocalidades select').change();
	}else{
		$('.selectlocalidades select').live('change', function() {
			var lengueta = parseInt($(this).attr('id').replace(/\D/g, ''));
			getNecesidades(lengueta, $(this).val());
		});
	}
	
	
	function getNecesidades(lengueta, id_localidad, suboperativo_id) {
		var indice = lengueta; //parseInt(lengueta.replace(/\D/g,''));
		if(suboperativo_id === undefined)
			$.getJSON('/operativos/get_necesidades/'+id_localidad+'/'+indice+'.json', echoNecesidades);
		else
			$.getJSON('/operativos/get_necesidades/'+id_localidad+'/'+indice+'/subop:'+suboperativo_id+'.json', echoNecesidadesArray[suboperativo_id]);
	}
	
	function echoNecesidades(necesidades, lengueta) {
		var indice;
		if(lengueta !== undefined && lengueta != 'success')
			indice = lengueta;
		else
			indice = parseInt($('.lengueta.active').attr('id').replace(/\D/g, ''));
		if(necesidades){
			$('#necesidades-intro'+indice).show();
			$('#necesidades'+indice).html(necesidades);
			$('#necesidades'+indice).parents('div.carpeta.lengueta'+indice).height('auto');
			if(typeof(sortables_init) != 'undefined')
				sortables_init(); 	//para hacer 'ordenable' la tabla de necesidades
		}else{
			$('#necesidades-intro'+indice).hide();
			$('#necesidades'+indice).html('');
		}
		$('#necesidades'+indice).change();
	}
});
