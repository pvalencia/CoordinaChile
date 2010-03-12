$(document).ready(function() {
	$('.filtrar').change(function() {
		if($(this).is(':checked')){
			$('.fecha').show();
		}else{
			$('.fecha').hide();
		}
	});
	
	function responseRegiones(transport){
		var objSelect = $('.comunas');
		var objJSON = ('Array'+transport.responseText).evalJSON();
		var nOpt;
		objSelect.clear();
		for(nOpt=0; nOpt<objJSON.length; nOpt++) {
			objSelect.options[objSelect.options.length] = new Option( objJSON[nOpt].text , objJSON[nOpt].value ) ;
		 };
	}
	function responseComunas(transport){
		var objSelect = $('.localidades');
		var objJSON = ('Array'+transport.responseText).evalJSON();
		var nOpt;
		objSelect.clear();
		for(nOpt=0; nOpt<objJSON.length; nOpt++) {
			objSelect.options[objSelect.options.length] = new Option( objJSON[nOpt].text , objJSON[nOpt].value ) ;
		 };
	}
	
	$('.regiones').change(function(){
	 	var url = '/organizaciones/get_comunas/'+$('.regiones').value+'.json';
        //alert(pars);
        var myAjax = new Ajax.Request(url, { method:'get',
               onSuccess: responseRegiones , onFailure: responseRegiones });
	});
	$('.comunas').change(function(){
	 	var url = '/organizaciones/get_localidades/'+$('.comunas').value+'.json';
        //alert(pars);
        var myAjax = new Ajax.Request(url, { method:'get',
               onSuccess: responseComunas , onFailure: responseComunas });
	});
});
