var mapas = new Array();
var Mapa_activa = null;
var Marca_activa = null;
var Burbuja_activa = null;

jQuery(document).ready(function($) {
	$('a[href="#"]').live('click', function(e) {
		e.preventDefault();
	});
	
	$('a[href*="http://"]').click(function(e) {
		if($(this).attr('href').indexOf('coordinachile') == -1) {
			e.preventDefault();
			window.open($(this).attr('href'));
		}
	})
});
