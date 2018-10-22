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

	function themeUrl(concat){
		return `${window.location.protocol}//${window.location.hostname}:${window.location.port}/${concat}`;
	}

	$('.wave_bottom')
		.append(`<img src="${themeUrl('wp-content/themes/tishenko.wp-school/static/build/img/wave-bottom.png')}" class="wave_bottom-image" />`);

	$('.wave_top')
		.append(`<img src="${themeUrl('wp-content/themes/tishenko.wp-school/static/build/img/wave-top.png')}" class="wave_top-image" />`);
	
	// Develope

		// Home
		if($(window).width() > 1025){
			$('.home-greeting')
				.prepend(`<video muted="" loop="" autoplay="" class="home-greeting__video"><source src="${themeUrl('wp-content/uploads/2018/10/WhatsApp-Video-2018-10-08-at-19.45.07.mp4')}" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;"></video>`);
		}
});