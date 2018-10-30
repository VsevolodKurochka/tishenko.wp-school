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

	// Master Class form submit
	$('#mc-form').submit(function(e){
		e.preventDefault();

		// Declare info object with information about submited form
		var info = {};

		// Get info about selected category
		var cat = $('#select-cat').val();
		var catTax = $('input[name="tax_category"]').val();


		var tag = $('#select-tag').val();
		var tagTax = $('input[name="tax_tag"]').val();

		var homeUrl = $('input[name="home_url"]').val();
		var redirectUrl = $('input[name="mc_url"]').val();

		// If exists
		info.cat = cat;

		info.tag = tag;

		// If only category
		if( info.cat != -1 && info.tag == -1){
			redirectUrl = `${homeUrl}/${catTax}/${cat}`;
		}

		// If only tag
		if( info.tag != -1 && info.cat == -1){
			redirectUrl = `${homeUrl}/${tagTax}/${tag}`;
		}

		// If tag and category
		if( info.tag != -1 && info.cat != -1){
			redirectUrl = `${homeUrl}/${catTax}/${cat}/${tagTax}/${tag}`;
		}

		window.location = redirectUrl;

		//console.log(redirectUrl);
		//console.log(info);
	});

	// Check if this is Master Class page
	var href = window.location.href;
	var indexOfHref = 'mc-tag';
	if( href.indexOf(indexOfHref) > -1 ){
		href = href.slice(href.indexOf(indexOfHref) + indexOfHref.length + 1);
		href = href.replace('/', '');
		console.log(href);
		$("#select-tag > option").each(function(){
			if(this.value == href){
				$(this).attr('selected', 'selected');
			}
		});
	}
});

$(window).on('load', function(){
	setTimeout( () => {
		$('.preloader').fadeOut('slow');
		$('.site').fadeIn('slow');	
	}, 500);
});