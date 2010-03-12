$(document).ready(function() {
	$('a[href="#"]').click(function(e) {
		e.preventDefault();
	});
	
	$('.menuprincipal li').hover(function() {
		$(this).children('ul.menusecundario').show();
	}, function() {
		$(this).children('ul.menusecundario').hide();
	});
});