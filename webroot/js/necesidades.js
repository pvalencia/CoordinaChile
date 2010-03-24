$(document).ready(function() {
	$('.selectlocalidades select').change(function() {
		getNecesidades($(this).val());
	});
		
	function getNecesidades(id_localidad) {
		$.getJSON('/catastros/get_necesidades/'+id_localidad+'.json', echoNecesidades);
	}
	
	function echoNecesidades(necesidades) {
		if(necesidades){
			$('#necesidades-intro').show();
			$('#necesidades').html(necesidades);
			$('#necesidades').parents('div.carpeta.active').height('auto');
		}else{
			$('#necesidades-intro').hide();
			$('#necesidades').html('');
		}
	}
});
