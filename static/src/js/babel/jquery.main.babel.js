$(document).ready(function(){

	function scroll(scrollLink, speed){
		$('html, body').animate({
			scrollTop: scrollLink.offset().top
		}, speed);
		return false;
	}
	$('.anchor').click(function(e){
		e.preventDefault();
		scroll($( $(this).attr('href') ), 1500);
	});

	$('.wave_bottom')
		.append(`<img src="${window.location.protocol}//${window.location.hostname}:${window.location.port}/wp-content/themes/tishenko.wp-school/static/build/img/wave-bottom.png" class="wave_bottom-image" />`);

	$('.wave_top')
		.append(`<img src="${window.location.protocol}//${window.location.hostname}:${window.location.port}/wp-content/themes/tishenko.wp-school/static/build/img/wave-top.png" class="wave_top-image" />`);
	
	// Develope
});	