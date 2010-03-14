$(document).ready(function() {
	$('#carpetas #lenguetas li a').click(function(e) {
		if(!$(this).parent().hasClass('active')) {
			var lengueta_activa = $('#carpetas #lenguetas li.active');
			var carpeta_activa = $('#carpetas #carpeta .'+lengueta_activa.attr('id'));
	
			lengueta_activa.toggleClass('active');
			carpeta_activa.addClass('oculto');
	
			var carpeta = $('#carpetas #carpeta .'+$(this).parent().attr('id'));
			$(this).parent().toggleClass('active');
			carpeta.removeClass('oculto');
		}
	});
});
