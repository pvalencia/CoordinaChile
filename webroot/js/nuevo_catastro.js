$(document).ready(function() {
	$('.Catastro.input-checkbox').each(function() {
		if($(this).change(function() {
			if($(this).is(':checked'))
				$('.bloque.'+$(this).attr('id')).show();
			else
				$('.bloque.'+$(this).attr('id')).hide();
		}).is(':checked'))
			$('.bloque.'+$(this).attr('id')).show();
	});
	$('.cantidad').focus(function() {
		if($(this).val() == 0)
			$(this).val('');
	}).blur(function() {
		if($(this).val() == '')
			$(this).val(0);
	});
});
