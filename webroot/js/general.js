$(document).ready(function() {
	$('a[href="#"]').click(function(e) {
		e.preventDefault();
	});
	
	$('a[href*="http://"]').click(function(e) {
		if($(this).attr('href').indexOf('coordinachile') == -1) {
			e.preventDefault();
			window.open($(this).attr('href'));
		}
	})
});