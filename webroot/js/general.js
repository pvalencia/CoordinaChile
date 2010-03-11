$(document).ready(function() {
	$('.menuprincipal li').hover(function() {
		$(this).children('ul.menusecundario').show();
	}, function() {
		$(this).children('ul.menusecundario').hide();
	});
});