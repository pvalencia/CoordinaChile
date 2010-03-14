

$('.regiones').each(function(){
	$(this).hide();
});
var shown = $('.select-region').val();
$('.region'+shown).show();

$(document).ready(function() {
	$('.select-region').change(function(){
		if(shown != 0)
			$('.region'+shown).hide();
		shown = $('.select-region').val()
		$('.region'+shown).show();
	});

});
