//============================== header =========================
jQuery(document).ready(function(){
	'use strict';

	setTimeout(function(){
		$('body').addClass('loaded');
	}, 3000);


	$(window).on('load',function(){
		$('.scrolling  a[href*="#"]').on('click',function(e){
			e.preventDefault();e.stopPropagation();
			var target=$(this).attr('href');
			$(target).velocity('scroll',{
				duration:800,
				offset:-50,
				easing:'easeOutExpo',
				mobileHA:false
			});
		});

		$('.body-wrapper').each(function(){
			var header_area = $('.header');
			var main_area = header_area.children('.navbar');

			var logo = main_area.find('.navbar-header');
			var navigation = main_area.find('.navbar-collapse');
			var original = {
				nav_top: navigation.css('margin-top')
			};

			$(window).scroll(function(){
				if( main_area.hasClass('bb-fixed-header') && ($(this).scrollTop() === 0 || $(this).width() < 750)){
					main_area.removeClass('bb-fixed-header').appendTo(header_area);
					navigation.animate({'margin-top': original.nav_top}, {duration: 100, queue: false, complete: function(){
						header_area.css('height', 'auto');
					}});
				}else if( !main_area.hasClass('bb-fixed-header') && $(this).width() > 750 &&
					$(this).scrollTop() > header_area.offset().top + header_area.height() - parseInt($('html').css('margin-top'), 10) ){

					header_area.css('height', header_area.height());
					main_area.css({'opacity': '0'}).addClass('bb-fixed-header');
					main_area.appendTo($('body')).animate({'opacity': 1});

					navigation.css({'margin-top': '0px'});
				}
			});
		});

		$(window).trigger('resize');
		$(window).trigger('scroll');
	});

});


//============================== ALL DROPDOWN ON HOVER =========================
	if($('.navbar').width() > 750)
	  {
	    $('.nav .dropdown').on('mouseover', function() {
			'use strict';
	          $(this).addClass('show');
	      }),
	    $('.nav .dropdown').on('mouseleave', function() {
			'use strict';
	          $(this).removeClass('show');
	      });
	  }

	$('.nav-category .dropdown-submenu ').hover(function() {
		'use strict';
    	$(this).addClass('show');
    },
    function() {
		'use strict';
        $(this).removeClass('show');
    });
//============================== SEARCH =========================
jQuery(document).ready(function(){
	'use strict';
	$('.searchBox a').on('click',function() {
	    $('.searchBox .dropdown-menu').toggleClass('display-block');
	    $('.searchBox a i').toggleClass('fa-close').toggleClass('fa-search');
	});

	// Home Version 4 mobile menu searchbox toggle
	$('#searchButton').on('click', function(x){
		x.preventDefault();
		$('#searchbox').toggleClass('visibleIt');
	});

});
//============================== RS-SLIDER =========================
jQuery(document).ready(function() {
	'use strict';
	jQuery('.bannerV1 .fullscreenbanner').revolution({
		delay: 5000,
		responsiveLevels: [1400, 1366, 992, 480],
		startwidth: 1170,
		startheight: 526,
		fullWidth: 'on',
		fullScreen: 'off',
		hideCaptionAtLimit: '',
		dottedOverlay: 'twoxtwo',
		navigationStyle: 'preview4',
		fullScreenOffsetContainer: '',
		// stopLoop: 'on',
		// stopAfterLoops: 0,
		// stopAtSlide: 1,
		hideTimerBar:'on'
	});

	jQuery('.bannerV4 .fullscreenbanner').revolution({
		delay: 5000,
		startwidth: 835,
		startheight: 470,
		fullWidth: 'off',
		fullScreen: 'off',
		hideCaptionAtLimit: '',
		dottedOverlay: 'twoxtwo',
		navigationStyle: 'preview4',
		fullScreenOffsetContainer: '',
		hideTimerBar:'on',
		onHoverStop:'on'
	});
});

//============================== SLICK-CAROUSEL =========================
jQuery(document).ready(function() {
	'use strict';
	$('.featuredProductsSlider').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: true,
		autoplay: true,
		infinite: true,
		dots: false,
		autoplaySpeed: 2000,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 1
				}
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1					
				}
			}
		]
	});

	$('.partnersLogoSlider').slick({
		autoplay: true,
		autoplaySpeed: 2000,
		dots: false,
		arrows: false,
		slidesToShow: 5,
		slidesToScroll: 3,
		infinite: true,
		responsive: [
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 4
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 670,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2					
				}
			}
		]
	});
	
	$('.featuredCollectionSlider').slick({
		slidesToShow: 2,
		slidesToScroll: 2,
		arrows: true,
		autoplay: false,
		infinite: true,
		dots: false,
		autoplaySpeed: 4000,
		responsive: [
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1					
				}
			},
			{
				breakpoint: 670,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1					
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2					
				}
			}
		]
	});

	$('.dealSlider').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		infinite: true,
		dots: false,
		autoplaySpeed: 3000,
		responsive: [
			{
				breakpoint: 670,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1					
				}
			}
		]
	});

	$('.testimonialSlider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		autoplay: false,
		infinite: true,
		dots: false,
		autoplaySpeed: 5000,
		responsive: [
			{
				breakpoint: 480,
				settings: {
					autoplay: true,
					arrows: false					
				}
			}
		]
	});

	$('.categorySlider').slick({
		dots: false,
		speed: 1000,
		arrows: true
	});

	$('.testimoni-carousel').slick({
		arrows: false,
		autoplay: true,
		infinite: true,
		dots: false,
		autoplaySpeed: 3000
	});
	$('.productGallery').slick({
		arrows: true,
		autoplay: true,
		infinite: true,
		dots: false,
		slidesToShow: 3,
		slidesToScroll: 1,
		autoplaySpeed: 3000,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2
				}
			},
			{
				breakpoint: 480,
				settings: {
					arrows: false,
					slidesToShow: 1
				}
			}
		]
	});
	//============================== Count down triger =========================
 	$('#simple_timer').syotimer({
			year: 2018,
			month: 5,
			day: 9,
			hour: 20,
			minute: 30
	});
	$('.slider_timer').syotimer({
			year: 2018,
			month: 10,
			day: 9,
			hour: 20,
			minute: 30
	});

	//============================== iziToast  =========================
	$('[data-toast]').on('click', function() {
		var b = $(this),
			c = b.data('toast-type'),
			d = b.data('toast-icon'),
			e = b.data('toast-position'),
			f = b.data('toast-title'),
			g = b.data('toast-message'),
			h = {
				class: 'iziToast-' + c || '',
				title: f || 'Title',
				message: g || 'toast message',
				animateInside: !1,
				position: 'topRight',
				progressBar: !1,
				icon: d,
				timeout: 3200,
				transitionIn: 'fadeInLeft',
				transitionOut: 'fadeOut',
				transitionInMobile: 'fadeIn',
				transitionOutMobile: 'fadeOut'
			};
		iziToast.show(h);
	});


	$('.btn-wishlist').on('click', function() {
		var b = $(this).data('iteration') || 1,
			c = {
				title: 'Product',
				animateInside: !1,
				position: 'topRight',
				progressBar: !1,
				timeout: 3200,
				transitionIn: 'fadeInLeft',
				transitionOut: 'fadeOut',
				transitionInMobile: 'fadeIn',
				transitionOutMobile: 'fadeOut'
			};
		switch (b) {
			case 1:
				$(this).addClass('active'), c.class = 'iziToast-info', c.message = 'added to your wishlist!', c.icon = 'icon-bell';
				break;
			case 2:
				$(this).removeClass('active'), c.class = 'iziToast-danger', c.message = 'removed from your wishlist!', c.icon = 'icon-ban';
		}
		iziToast.show(c), b++, b > 2 && (b = 1), $(this).data('iteration', b);
	});
	//============================== SELECT BOX =========================
	$('.select-drop').selectbox();
	
	//============================== SIDE NAV MENU TOGGLE =========================
	// $('.side-nav li a').click(function() {
	// 	$(this).find('i').toggleClass('fa fa-minus fa fa-plus');
	// });

	/*---------------------------------
    ---> quantity
    ---------------------------------*/
    $('.incr-btn').on('click', function(e) {
		var $button = $(this);
		var newVal = 0;
        var oldValue = $button.parent().find('.quantity').val();
        $button.parent().find('.incr-btn[data-action="decrease"]').removeClass('inactive');
        if ($button.data('action') === 'increase') {
            newVal = parseFloat(oldValue) + 1;
        } else {
         // Don't allow decrementing below 1
            if (oldValue > 1) {
                 newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 1;
                $button.addClass('inactive');
            }
        }
        $button.parent().find('.quantity').val(newVal);
        e.preventDefault();
    });

	//============================== PRICE SLIDER RANGER =========================
	var minimum = 20;
	var maximum = 300;
	
	$( '#price-range' ).slider({
		range: true,
		min: minimum,
		max: maximum,
		values: [ minimum, maximum ],
		slide: function( event, ui ) {
			$( '#price-amount-1' ).val( '$' + ui.values[ 0 ] );
			$( '#price-amount-2' ).val( '$' + ui.values[ 1 ] );
		}
	});
	
	$( '#price-amount-1' ).val( '$' + $( '#price-range' ).slider( 'values', 0 ));
	$( '#price-amount-2' ).val( '$' + $( '#price-range' ).slider( 'values', 1 ));

	//============================== PRODUCT SINGLE SLIDER =========================
	(function ($) {
		$('#thumbcarousel').carousel(0);
		var $thumbItems = $('#thumbcarousel .item');
		$('#carousel').on('slide.bs.carousel', function (event) {
			var $slide = $(event.relatedTarget);
			var thumbIndex = $slide.data('thumb');
			var curThumbIndex = $thumbItems.index($thumbItems.filter('.active').get(0));
			if (curThumbIndex > thumbIndex) {
				$('#thumbcarousel').one('slid.bs.carousel', function (event) {
					$('#thumbcarousel').carousel(thumbIndex);
				});
				if (curThumbIndex === ($thumbItems.length - 1)) {
					$('#thumbcarousel').carousel('next');
				} else {
					$('#thumbcarousel').carousel(numThumbItems - 1);
				}
			} else {
				$('#thumbcarousel').carousel(thumbIndex);
			}
		});
	})(jQuery);


	$('.quick-view .btn-block').click(function () {
		$('.quick-view').modal('hide');
	});

	//============================== VIDEOBOX =========================
	var videoBox = $('.video-box i');
	videoBox.on('click', function(){
		var video = '<iframe class="embed-responsive-item"  allowfullscreen src="'+ $(this).attr('data-video') +'"></iframe>';
		$(this).replaceWith(video);
	});

	
	//============================== ACCORDION OR COLLAPSE ICON CHANGE =========================
	var allIcons = $('#faqAccordion .panel-heading i.fa');
	$('#faqAccordion .panel-heading').click(function () {
		allIcons.removeClass('fa-chevron-down').addClass('fa-chevron-up');
		$(this).find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
	});

	var allIconsOne = $('#accordionOne .panel-heading i.fa');
	$('#accordionOne .panel-heading').click(function () {
		allIconsOne.removeClass('fa-chevron-down').addClass('fa-chevron-up');
		$(this).find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
	});

	var allIconsTwo = $('#accordionTwo .panel-heading i.fa');
	$('#accordionTwo .panel-heading').click(function () {
		allIconsTwo.removeClass('fa-chevron-down').addClass('fa-chevron-up');
		$(this).find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
	});

	var allIconsThree = $('#togglesOne .panel-heading i.fa');
	$('#togglesOne .panel-heading').click(function () {
		allIconsThree.removeClass('fa-chevron-down').addClass('fa-chevron-up');
		$(this).find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
	});

	var allIconsFour = $('#togglesTwo .panel-heading i.fa');
	$('#togglesTwo .panel-heading').click(function () {
		allIconsFour.removeClass('fa-chevron-down').addClass('fa-chevron-up');
		$(this).find('i.fa').removeClass('fa-chevron-up').addClass('fa-chevron-down');
	});

	$('[data-toggle="tooltip"]').tooltip();

});

