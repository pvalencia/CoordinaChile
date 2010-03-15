$(document).ready(function() {
	// Tabs
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
	
	// Select show
	$('select.showit').change(function() {
		if(!$('.toshow.showit'+$(this).val()).hasClass('active')) {
			$('.toshow.active').addClass('oculto').removeClass('active');
			$('.toshow.showit'+$(this).val()).addClass('active').removeClass('oculto');
		}
	});
	
	// Checkbox show
	$('.Operativo.input-checkbox').each(function() {
		if($(this).change(function() {
			if($(this).is(':checked'))
				$('.bloque.'+$(this).attr('id')).show();
			else
				$('.bloque.'+$(this).attr('id')).hide();
		}).is(':checked'))
			$('.bloque.'+$(this).attr('id')).show();
	});
	
	$('.recurso').focus(function() {
		if($(this).val() == 0)
			$(this).val('');
	}).blur(function() {
		if($(this).val() == '')
			$(this).val(0);
	});
});
