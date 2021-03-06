 AOS.init({
 	duration: 800,
 	easing: 'slide'
 });

$(document).ready(function () {
	"use strict";


	var flag = 0;
	$.ajax({
		type: "GET",
		url: "ajax_handler/get_data.php",
		data: {
			'offset' : 0,
			'limit'  : 16
		},
		success : function (data){

			$('#loading').hide();   // hide icon loading.gif when loading success
			$('#load_data_table').append(data);
			flag += 16;

			$(window).stellar({
				responsive: true,
				parallaxBackgrounds: true,
				parallaxElements: true,
				horizontalScrolling: false,
				hideDistantElements: false,
				scrollProperty: 'scroll'
			});

			var fullHeight = function() {

				$('.js-fullheight').css('height', $(window).height());
				$(window).resize(function(){
					$('.js-fullheight').css('height', $(window).height());
				});

			};
			fullHeight();

			// loader
			var loader = function() {
				setTimeout(function() {
					if($('#ftco-loader').length > 0) {
						$('#ftco-loader').removeClass('show');
					}
				}, 1);
			};
			loader();

			// Scrollax
			$.Scrollax();


			var burgerMenu = function() {

				$('.js-colorlib-nav-toggle').on('click', function(event){
					event.preventDefault();
					var $this = $(this);

					if ($('body').hasClass('offcanvas')) {
						$this.removeClass('active');
						$('body').removeClass('offcanvas');
					} else {
						$this.addClass('active');
						$('body').addClass('offcanvas');
					}
				});
			};
			burgerMenu();

			// Click outside of offcanvass
			var mobileMenuOutsideClick = function() {

				$(document).click(function (e) {
					var container = $("#colorlib-aside, .js-colorlib-nav-toggle");
					if (!container.is(e.target) && container.has(e.target).length === 0) {

						if ( $('body').hasClass('offcanvas') ) {

							$('body').removeClass('offcanvas');
							$('.js-colorlib-nav-toggle').removeClass('active');

						}

					}
				});

				$(window).scroll(function(){
					if ( $('body').hasClass('offcanvas') ) {

						$('body').removeClass('offcanvas');
						$('.js-colorlib-nav-toggle').removeClass('active');

					}
				});

			};
			mobileMenuOutsideClick();

			var carousel = function() {
				$('.home-slider').owlCarousel({
					loop:true,
					autoplay: true,
					margin:0,
					animateOut: 'fadeOut',
					animateIn: 'fadeIn',
					nav:false,
					autoplayHoverPause: false,
					items: 1,
					navText : ["<span class='ion-md-arrow-back'></span>","<span class='ion-chevron-right'></span>"],
					responsive:{
						0:{
							items:1
						},
						600:{
							items:1
						},
						1000:{
							items:1
						}
					}
				});

			};
			carousel();



			var contentWayPoint = function() {
				var i = 0;
				$('.ftco-animate').waypoint( function( direction ) {

					if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

						i++;

						$(this.element).addClass('item-animate');
						setTimeout(function(){

							$('body .ftco-animate.item-animate').each(function(k){
								var el = $(this);
								setTimeout( function () {
									var effect = el.data('animate-effect');
									if ( effect === 'fadeIn') {
										el.addClass('fadeIn ftco-animated');
									} else if ( effect === 'fadeInLeft') {
										el.addClass('fadeInLeft ftco-animated');
									} else if ( effect === 'fadeInRight') {
										el.addClass('fadeInRight ftco-animated');
									} else {
										el.addClass('fadeInUp ftco-animated');
									}
									el.removeClass('item-animate');
								},  k * 50, 'easeInOutExpo' );
							});

						}, 100);

					}

				} , { offset: '95%' } );
			};
			contentWayPoint();


			// magnific popup
			$('.image-popup').magnificPopup({
				type: 'image',
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					verticalFit: true
				},
				zoom: {
					enabled: true,
					duration: 300 // don't foget to change the duration also in CSS
				}
			});
		}
	});

	$(window).scroll(function () {
		if ($(window).scrollTop() >= $(document).height() - $(window).height() - 350 ){
			$.ajax({
				type: "GET",
				url: "ajax_handler/get_data.php",
				data: {
					'offset' : flag,
					'limit'  : 16
				},
				success : function (data){

					$('#loading').hide();   // hide icon loading.gif when loading success
					$('#load_data_table').append(data);
					flag += 16;
					$(window).stellar({
						responsive: true,
						parallaxBackgrounds: true,
						parallaxElements: true,
						horizontalScrolling: false,
						hideDistantElements: false,
						scrollProperty: 'scroll'
					});


					var fullHeight = function() {

						$('.js-fullheight').css('height', $(window).height());
						$(window).resize(function(){
							$('.js-fullheight').css('height', $(window).height());
						});

					};
					fullHeight();

					// loader
					var loader = function() {
						setTimeout(function() {
							if($('#ftco-loader').length > 0) {
								$('#ftco-loader').removeClass('show');
							}
						}, 1);
					};
					loader();

					// Scrollax
					$.Scrollax();


					var burgerMenu = function() {

						$('.js-colorlib-nav-toggle').on('click', function(event){
							event.preventDefault();
							var $this = $(this);

							if ($('body').hasClass('offcanvas')) {
								$this.removeClass('active');
								$('body').removeClass('offcanvas');
							} else {
								$this.addClass('active');
								$('body').addClass('offcanvas');
							}
						});
					};
					burgerMenu();

					// Click outside of offcanvass
					var mobileMenuOutsideClick = function() {

						$(document).click(function (e) {
							var container = $("#colorlib-aside, .js-colorlib-nav-toggle");
							if (!container.is(e.target) && container.has(e.target).length === 0) {

								if ( $('body').hasClass('offcanvas') ) {

									$('body').removeClass('offcanvas');
									$('.js-colorlib-nav-toggle').removeClass('active');

								}

							}
						});

						$(window).scroll(function(){
							if ( $('body').hasClass('offcanvas') ) {

								$('body').removeClass('offcanvas');
								$('.js-colorlib-nav-toggle').removeClass('active');

							}
						});

					};
					mobileMenuOutsideClick();

					var carousel = function() {
						$('.home-slider').owlCarousel({
							loop:true,
							autoplay: true,
							margin:0,
							animateOut: 'fadeOut',
							animateIn: 'fadeIn',
							nav:false,
							autoplayHoverPause: false,
							items: 1,
							navText : ["<span class='ion-md-arrow-back'></span>","<span class='ion-chevron-right'></span>"],
							responsive:{
								0:{
									items:1
								},
								600:{
									items:1
								},
								1000:{
									items:1
								}
							}
						});

					};
					carousel();

					var contentWayPoint = function() {
						var i = 0;
						$('.ftco-animate').waypoint( function( direction ) {

							if( direction === 'down' && !$(this.element).hasClass('ftco-animated') ) {

								i++;

								$(this.element).addClass('item-animate');
								setTimeout(function(){

									$('body .ftco-animate.item-animate').each(function(k){
										var el = $(this);
										setTimeout( function () {
											var effect = el.data('animate-effect');
											if ( effect === 'fadeIn') {
												el.addClass('fadeIn ftco-animated');
											} else if ( effect === 'fadeInLeft') {
												el.addClass('fadeInLeft ftco-animated');
											} else if ( effect === 'fadeInRight') {
												el.addClass('fadeInRight ftco-animated');
											} else {
												el.addClass('fadeInUp ftco-animated');
											}
											el.removeClass('item-animate');
										},  k * 50, 'easeInOutExpo' );
									});

								}, 100);

							}

						} , { offset: '95%' } );
					};
					contentWayPoint();

					// magnific popup
					$('.image-popup').magnificPopup({
						type: 'image',
						closeOnContentClick: true,
						closeBtnInside: false,
						fixedContentPos: true,
						mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							verticalFit: true
						},
						zoom: {
							enabled: true,
							duration: 300 // don't foget to change the duration also in CSS
						}
					});
				}
			});
		}
	});

		$(window).scroll(function(){
			if($(this).scrollTop() > 500){
				$('#topBtn').fadeIn();
			}else{
				$('#topBtn').fadeOut();
			}
		});
		$("#topBtn").click(function(){
			$('html, body').animate({scrollTop : 0}, 650);
		});

	// load more button function
	/*$(document).on('click', '#btn_more', function(){
		var last_photo_id = $(this).data("vid");
		$('#btn_more').html("Loading...");

		$.ajax({
			url:"ajax_handler/load_data.php",
			method:"POST",
			data:{last_photo_id:last_photo_id},
			dataType:"text",
			success:function(data)
			{
				if(data != '')
				{
					$('#remove_row').remove();
					$('#load_data_table').append(data);
				}
				else
				{
					$('#btn_more').html("No more photo!");
				}

				contentWayPoint();

				// magnific popup
				$('.image-popup').magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					fixedContentPos: true,
					mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
					gallery: {
						enabled: true,
						navigateByImgClick: true,
						preload: [0,1] // Will preload 0 - before current, and 1 after the current image
					},
					image: {
						verticalFit: true
					},
					zoom: {
						enabled: true,
						duration: 300 // don't foget to change the duration also in CSS
					}
				});
			}
		});
	});*/
});

