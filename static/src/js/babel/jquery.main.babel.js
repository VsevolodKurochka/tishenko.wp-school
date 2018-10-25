$(document).ready(function(){

	function themeUrl(concat){
		return `${window.location.protocol}//${window.location.hostname}/${concat}`;
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

	$('[data-action="modal"]').click(function(){
		var text = $(this).text();
		var open = $(this).attr('data-open');
		$(open).find('.modal__title').text(text);
	});

});

$(window).on('load', function(){
	setTimeout( () => {
		$('.preloader').fadeOut('slow');
		$('.site').fadeIn('slow');	
	}, 500);
});