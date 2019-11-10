( function( $, elementor ) {

	"use strict";

	var ElementPack = {

		init: function() {

			var widgets = {
				'bdt-advanced-gmap.default' 			   : ElementPack.widgetAvdGoogleMap,
				'bdt-animated-heading.default'  		   : ElementPack.widgetAnimatedHeading,
				'bdt-audio-player.default' 				   : ElementPack.widgetAudioPlayer,
				'bdt-audio-player.bdt-poster' 			   : ElementPack.widgetAudioPlayer,
				'bdt-chart.default' 					   : ElementPack.widgetChart,
				'bdt-carousel.default' 					   : ElementPack.widgetCarousel,
				'bdt-carousel.bdt-alice' 				   : ElementPack.widgetCarousel,
				'bdt-carousel.bdt-vertical' 			   : ElementPack.widgetCarousel,
				'bdt-custom-carousel.default' 			   : ElementPack.widgetCustomCarousel,
				'bdt-custom-carousel.bdt-custom-content'   : ElementPack.widgetCustomCarousel,
				'bdt-panel-slider.default' 				   : ElementPack.widgetPanelSlider,
				'bdt-panel-slider.bdt-middle' 		   	   : ElementPack.widgetPanelSlider,
				'bdt-slider.default' 					   : ElementPack.widgetSlider,
				'bdt-circle-menu.default' 				   : ElementPack.widgetCircleMenu,
				'bdt-open-street-map.default' 			   : ElementPack.widgetOpenStreetMap,
				'bdt-contact-form.default' 				   : ElementPack.widgetSimpleContactForm,
				'bdt-cookie-consent.default' 			   : ElementPack.widgetCookieConsent,
				'bdt-helpdesk.default' 					   : ElementPack.widgetHelpDesk,
				'bdt-iconnav.default' 					   : ElementPack.widgetIconNav,
				'bdt-iframe.default' 					   : ElementPack.widgetIframe,
				'bdt-image-compare.default' 			   : ElementPack.widgetImageCompare,
				'bdt-image-magnifier.default' 			   : ElementPack.widgetImageMagnifier,
				//'bdt-image-magnifier.bdt-thumbnail' 		   : ElementPack.widgetImageMagnifierThumb,
				'bdt-instagram.default' 				   : ElementPack.widgetInstagram,
				'bdt-marker.default' 					   : ElementPack.widgetMarker,
				'bdt-modal.default' 					   : ElementPack.widgetModal,
				'bdt-scrollnav.default' 				   : ElementPack.widgetScrollNav,
				'bdt-post-grid-tab.default' 			   : ElementPack.widgetPostGridTab,
				'bdt-price-table.default' 				   : ElementPack.widgetPriceTable,
				'bdt-price-table.bdt-partait' 			   : ElementPack.widgetPriceTable,
				'bdt-progress-pie.default' 				   : ElementPack.widgetProgressPie,
				'bdt-comment.default' 					   : ElementPack.widgetComment,
				'bdt-qrcode.default' 					   : ElementPack.widgetQRCode,
				'bdt-table.default' 				  	   : ElementPack.widgetTable,
				'bdt-table-of-content.default' 			   : ElementPack.widgetTableOfContent,
				'bdt-tabs.default' 			   			   : ElementPack.widgetTabs,
				'bdt-timeline.bdt-olivier' 				   : ElementPack.widgetTimeline,
				'bdt-testimonial-carousel.default' 		   : ElementPack.widgetTCarousel,
				'bdt-testimonial-carousel.bdt-twyla' 	   : ElementPack.widgetTCarousel,
				'bdt-testimonial-carousel.bdt-vyxo' 	   : ElementPack.widgetTCarousel,
				'bdt-testimonial-slider.default' 		   : ElementPack.widgetTSlider,
				'bdt-twitter-carousel.default' 		       : ElementPack.widgetTwitterCarousel,
				'bdt-twitter-slider.default' 		       : ElementPack.widgetTwitterSlider,
				'bdt-threesixty-product-viewer.default'    : ElementPack.widgetTSProductViewer,
				'bdt-video-gallery.default' 			   : ElementPack.widgetVideoGallery,
				'bdt-weather.default' 					   : ElementPack.widgetWeather,
				'bdt-wc-carousel.default' 				   : ElementPack.widgetWCCarousel,
			};

			$.each( widgets, function( widget, callback ) {
				elementor.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});

			elementor.hooks.addAction( 'frontend/element_ready/section', ElementPack.elementorSection );
		},		
		
		//Animated Heading object
		widgetAnimatedHeading: function( $scope ) {
			var $animatedHeading = $scope.find( '.bdt-heading > * > .bdt-animated-heading' );
				
			if ( ! $animatedHeading.length ) {
				return;
			}

    		if ( $animatedHeading.data('heading_layout') == 'animated' ) {
				$($animatedHeading).Morphext({
				    animation : $animatedHeading.data('heading_animation'), 
				    speed     : $animatedHeading.data('heading_animation_delay'),
				});
			} else if ( $animatedHeading.data('heading_layout') == 'typed' ) {
				var animateSelector = $($animatedHeading).attr('id');
				var typed = new Typed('#'+animateSelector, {
				  strings    : $animatedHeading.data('animate_text'),
				  typeSpeed  : $animatedHeading.data('type_speed'),
				  startDelay : $animatedHeading.data('start_delay'),
				  backSpeed  : $animatedHeading.data('back_speed'),
				  backDelay  : $animatedHeading.data('back_delay'),
				  loop       : $animatedHeading.data('type_loop'),
				  loopCount  : $animatedHeading.data('type_loop_count'),
				});
			}

		},

		//Audio Player object
		widgetAudioPlayer: function( $scope ) {

			var $audioPlayer         = $scope.find( '.bdt-audio-player > .jp-jplayer' ),
				$container 			 = $audioPlayer.next('.jp-audio').attr('id'),
				$settings 		 	 = $audioPlayer.data('settings');
				

			if ( ! $audioPlayer.length ) {
				return;
			}

			$($audioPlayer).jPlayer({
				ready: function (event) {
					$(this).jPlayer("setMedia", {
						title : $settings['audio_title'],
						mp3   : $settings['audio_source'],
					});
					if($settings['autoplay']) {
						$(this).jPlayer("play", 1);
					}
				},
				play: function() {
					$(this).next('.jp-audio').removeClass('bdt-player-played');
					$(this).jPlayer("pauseOthers");
				},
				ended: function() {
			    	$(this).next('.jp-audio').addClass('bdt-player-played');
			  	},

				timeupdate: function(event) {
					if($settings['time_restrict']) {
						if ( event.jPlayer.status.currentTime > $settings['restrict_duration'] ) {
							$(this).jPlayer('stop');
						}
					}
				},

				cssSelectorAncestor : '#' + $container,
				useStateClassSkin   : true,
				autoBlur            : $settings['smooth_show'],
				smoothPlayBar       : true,
				keyEnabled          : $settings['keyboard_enable'],
				remainingDuration   : true,
				toggleDuration      : true,
				volume              : $settings['volume_level'],
				//verticalVolume 		: true
			});

		},

		//Advanced Google Map object
		widgetAvdGoogleMap: function( $scope ) {

			var $advancedGoogleMap = $scope.find( '.bdt-advanced-gmap' ),
				map_settings       = $advancedGoogleMap.data('map_settings'),
				markers            = $advancedGoogleMap.data('map_markers'),
				map_form           = $scope.find('.bdt-gmap-search-wrapper > form');				

			if ( ! $advancedGoogleMap.length ) {
				return;
			}
			
			var avdGoogleMap = new GMaps( map_settings );

			for (var i in markers) {
				avdGoogleMap.addMarker(markers[i]);
			}

			if($advancedGoogleMap.data('map_geocode')) {
				$(map_form).submit(function(e){
					e.preventDefault();
					GMaps.geocode({
						address: $(this).find('.bdt-search-input').val().trim(),
						callback: function(results, status){
							if(status=='OK'){
								var latlng = results[0].geometry.location;
								avdGoogleMap.setCenter(
									latlng.lat(), 
									latlng.lng()
								);
								avdGoogleMap.addMarker({
									lat: latlng.lat(),
									lng: latlng.lng()
								});
							}	
						}
					});
				});
			}

			if($advancedGoogleMap.data('map_style')) {
		        avdGoogleMap.addStyle({
		            styledMapName:"Custom Map",
		            styles: $advancedGoogleMap.data('map_style'),
		            mapTypeId: "map_style"  
		        });
		        avdGoogleMap.setStyle("map_style");
	        }
		},

		//Open Street Map object
		widgetOpenStreetMap: function( $scope ) {

			var $openStreetMap = $scope.find( '.bdt-open-street-map' ),
				settings       = $openStreetMap.data('settings'),
				markers        = $openStreetMap.data('map_markers');

			if ( ! $openStreetMap.length ) {
				return;
			}

			var avdOSMap = L.map($openStreetMap[0], {
					zoomControl: settings['zoomControl']
				}).setView([
						settings['lat'], 
						settings['lng']
					], 
				    settings['zoom']
				);


			L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=' + settings['osmAccessToken'], {
				maxZoom: 18,
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
					'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
					'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
				id: 'mapbox.streets'
			}).addTo(avdOSMap);

			var LeafIcon = L.Icon.extend({
				options: {
					iconSize:     [38, 95],
					iconAnchor:   [22, 94],
					shadowAnchor: [4, 62],
					popupAnchor:  [-3, -76]
				}
			});

			for (var i in markers) {
				var greenIcon = new LeafIcon({iconUrl: markers[i]['iconUrl'] });
				L.marker([markers[i]['lat'], markers[i]['lng']], {icon: greenIcon}).bindPopup(markers[i]['infoWindow']).addTo(avdOSMap);
			}			

		},

		//Chart widget object
		widgetChart: function( $scope ) {

			var	$chart    	  = $scope.find( '.bdt-chart' ),
				$chart_canvas = $chart.find( '> canvas' ),
				settings      = $chart.data('settings');

			if ( ! $chart.length ) {
				return;
			}

			elementorFrontend.waypoint( $chart_canvas, function() {
				var $this   = $( this ),
					ctx     = $this[0].getContext('2d'),
					myChart = new Chart(ctx, settings);
			}, {
				offset: 'bottom-in-view'
			} );
		},

		//Carousel object
		widgetCarousel: function( $scope ) {

			var $carousel 		   = $scope.find( '.bdt-carousel' );
				
			if ( ! $carousel.length ) {
				return;
			}

			ElementPack.swiperSlider($carousel);		    
		},

		//Carousel object
		widgetCustomCarousel: function( $scope ) {

			var $carousel = $scope.find( '.bdt-custom-carousel' );
				
			if ( ! $carousel.length ) {
				return;
			}

			ElementPack.swiperSlider($carousel);		    
		},

		//Testimonial Carousel object
		widgetTCarousel: function( $scope ) {

			var $tCarousel = $scope.find( '.bdt-testimonial-carousel' );
				
			if ( ! $tCarousel.length ) {
				return;
			}

			ElementPack.swiperSlider($tCarousel);		    
		},

		//Twitter Carousel object
		widgetTwitterCarousel: function( $scope ) {

			var $twitterCarousel = $scope.find( '.bdt-twitter-carousel' );
				
			if ( ! $twitterCarousel.length ) {
				return;
			}

			console.log($twitterCarousel);

			ElementPack.swiperSlider($twitterCarousel);		    
		},

		//Twitter Slider object
		widgetTwitterSlider: function( $scope ) {

			var $twitterSlider = $scope.find( '.bdt-twitter-slider' );
				
			if ( ! $twitterSlider.length ) {
				return;
			}

			ElementPack.swiperSlider($twitterSlider);		    
		},

		//WC Carousel object
		widgetWCCarousel: function( $scope ) {

			var $wcCarousel = $scope.find( '.bdt-wc-carousel' );
				
			if ( ! $wcCarousel.length ) {
				return;
			}

			ElementPack.swiperSlider($wcCarousel);		    
		},

		//Panel Slider object
		widgetPanelSlider: function( $scope ) {

			var $slider = $scope.find( '.bdt-panel-slider' );
				
			if ( ! $slider.length ) {
				return;
			}

			ElementPack.swiperSlider($slider);		    
		},

		//Slider object
		widgetSlider: function( $scope ) {

			var $slider = $scope.find( '.bdt-slider' );
				
			if ( ! $slider.length ) {
				return;
			}

			ElementPack.swiperSlider($slider);		    
		},

		swiperSlider: function( $slider ) {

			var $sliderContainer = $slider.find('.swiper-container'),
				$settings 		 = $slider.data('settings');

		    var swiper = new Swiper($sliderContainer, $settings);

		    if ($settings['pauseOnHover']) {
			 	$($sliderContainer).hover(function() {
				    (this).swiper.autoplay.stop();
				}, function() {
				    (this).swiper.autoplay.start();
				});
			}
		},

		// Comment widget object
		widgetComment: function( $scope ) {

			var $comment = $scope.find( '.bdt-comment-container' ),
				$settings = $comment.data('settings');
				
			if ( ! $comment.length ) {
				return;
			}

		    if ($settings['layout'] == 'disqus') {

			    var disqus_config = function () {
			    this.page.url = $settings['permalink'];  // Replace PAGE_URL with your page's canonical URL variable
			    this.page.identifier = $comment; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			    };
			    
			    (function() { // DON'T EDIT BELOW THIS LINE
			    var d = document, s = d.createElement('script');
			    s.src = '//' + $settings['username'] + '.disqus.com/embed.js';
			    s.setAttribute('data-timestamp', +new Date());
			    (d.head || d.body).appendChild(s);
			    })();

		    } else if ($settings['layout'] == 'facebook') {
		    	
		    	var $fb_script = document.getElementById("facebook-jssdk");

		    	console.log($fb_script);

		    	// if($fb_script){
		    	// 	$($fb_script).remove();
		    	// } else {
		    	// }

				// jQuery.ajax({
				// 	url: 'https://connect.facebook.net/en_US/sdk.js',
				// 	dataType: 'script',
				// 	cache: true,
				// 	success: function() {
				// 		FB.init( {
				// 			appId: config.app_id,
				// 			version: 'v2.10',
				// 			xfbml: false
				// 		} );
				// 		config.isLoaded = true;
				// 		config.isLoading = false;
				// 		jQuery( document ).trigger( 'fb:sdk:loaded' );
				// 	}
				// });
				// 
				// 
				(function(d, s, id){
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) {return;}
					js = d.createElement(s); js.id = id;
					js.src = "https://connect.facebook.net/en_US/sdk.js";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
	    	        

    	        window.fbAsyncInit = function() {
    	           FB.init({
    	             appId            : $settings['app_id'],
    	             autoLogAppEvents : true,
    	             xfbml            : true,
    	             version          : 'v3.2'
    	           });
    	        };

		    } 
		},

		// loadSDK: function() {
		// 	// Don't load in parallel
		// 	if ( config.isLoading || config.isLoaded ) {
		// 		return;
		// 	}

		// 	config.isLoading = true;

		// 	jQuery.ajax( {
		// 		url: 'https://connect.facebook.net/en_US/sdk.js',
		// 		dataType: 'script',
		// 		cache: true,
		// 		success: function() {
		// 			FB.init( {
		// 				appId: $settings['app_id'],
		// 				version: 'v2.10',
		// 				xfbml: false
		// 			} );
		// 			config.isLoaded = true;
		// 			config.isLoading = false;
		// 			jQuery( document ).trigger( 'fb:sdk:loaded' );
		// 		}
		// 	} );
		// },


		//360 degree product viewer
		widgetTSProductViewer: function( $scope ) {

			var $TSPV      	   = $scope.find( '.bdt-threesixty-product-viewer' ),
				$settings      = $TSPV.data('settings'),
				$container     = $TSPV.find('> .bdt-tspv-container'), 
				$fullScreenBtn = $TSPV.find('> .bdt-tspv-fb');  

			if ( ! $TSPV.length ) {
				return;
			}
			

			if ($settings['source_type'] == 'remote') {
				$settings.source = SpriteSpin.sourceArray( $settings['source'], { frame: $settings['frame_limit'], digits: $settings['image_digits']} );
			}

			elementorFrontend.waypoint( $container, function() {
				var $this = $( this );
				$this.spritespin($settings);

			}, {
				offset: 'bottom-in-view'
			} );

			

			//if ( ! $fullScreenBtn.length ) {
				$($fullScreenBtn).click(function(e) {
				    e.preventDefault();
				    $($container).spritespin('api').requestFullscreen();
			    });
			//}			

		},

		//Image Compare object
		widgetImageCompare: function( $scope ) {

			var $imageCompare         = $scope.find( '.bdt-image-compare > .twentytwenty-container' ),
				default_offset_pct    = $imageCompare.data('default_offset_pct'),
				orientation           = $imageCompare.data('orientation'),
				before_label          = $imageCompare.data('before_label'),
				after_label           = $imageCompare.data('after_label'),
				no_overlay            = $imageCompare.data('no_overlay'),
				move_slider_on_hover  = $imageCompare.data('move_slider_on_hover'),
				move_with_handle_only = $imageCompare.data('move_with_handle_only'),
				click_to_move         = $imageCompare.data('click_to_move');

			if ( ! $imageCompare.length ) {
				return;
			}

			$($imageCompare).twentytwenty({
			    default_offset_pct: default_offset_pct,
			    orientation: orientation,
			    before_label: before_label,
			    after_label: after_label,
			    no_overlay: no_overlay,
			    move_slider_on_hover: move_slider_on_hover,
			    move_with_handle_only: move_with_handle_only,
			    click_to_move: click_to_move
		  	});

		},

		// QR Code Object
		widgetQRCode: function($scope) {
			var $qrcode = $scope.find( '.bdt-qrcode' ),
				image   = $scope.find( '.bdt-qrcode-image' );

			if ( ! $qrcode.length ) {
				return;
			}
			var settings=$qrcode.data('settings');
				settings.image=image[0];

		   $($qrcode).qrcode(settings);
		},

		// Table Code Object
		widgetTable: function($scope) {
			var $tableContainer = $scope.find( '.bdt-data-table' ),
				$settings       = $tableContainer.data('settings'),
				$table          = $tableContainer.find('> table');

			if ( ! $tableContainer.length ) {
				return;
			}

		   $($table).DataTable($settings);
		},

		//Progress Iframe object
		widgetIframe: function( $scope ) {

			var $iframe = $scope.find( '.bdt-iframe > iframe' ),
				$autoHeight = $iframe.data('auto_height');

			if ( ! $iframe.length ) {
				return;
			}

			// Auto height only works when cross origin properly set
			if ($autoHeight) {
				$($iframe).load(function() {
				    $(this).height( $(this).contents().find("html").height() );
				});
			}

			ElementPack.lazyLoader($iframe);
		},


		lazyLoader:function( $scope ) {
			var $lazyload = $scope;

			$($lazyload).recliner({
				throttle : $lazyload.data('throttle'),
				threshold : $lazyload.data('threshold'),
				live : $lazyload.data('live')
			});
		},

		//Iconnav object
		widgetIconNav: function( $scope ) {

			var $iconnav        = $scope.find( 'div.bdt-icon-nav' ),
				$iconnavTooltip = $iconnav.find( '.bdt-icon-nav' );

			if ( ! $iconnav.length ) {
				return;
			}

			ElementPack.tippyTooltip($iconnavTooltip, $scope);
		},

		widgetMarker: function( $scope ) {

			var $marker = $scope.find( '.bdt-marker-wrapper' );

			if ( ! $marker.length ) {
				return;
			}

			ElementPack.tippyTooltip($marker, $scope);
		},

		widgetHelpDesk: function( $scope ) {

			var $helpdesk = $scope.find( '.bdt-helpdesk' ),
				$helpdeskTooltip = $helpdesk.find('.bdt-helpdesk-icons');

			if ( ! $helpdesk.length ) {
				return;
			}

			ElementPack.tippyTooltip($helpdeskTooltip, $scope);
		},

		widgetModal: function( $scope ) {

			var $modal = $scope.find( '.bdt-modal' );
			
			if ( ! $modal.length ) {
				return;
			}


			$.each($modal, function(index, val) {
				
				var $this   	= $(this),
					$settings   = $this.data('settings'),
					modalShowed = false,
					modalID     = $settings['id'];
				
				if (!$settings['dev']) {
					modalShowed = localStorage.getItem( modalID );
				}
				
				if(!modalShowed){
					if ('exit' === $settings['layout']) {
						document.addEventListener("mouseleave", function(event){
							if(event.clientY <= 0 || event.clientX <= 0 || (event.clientX >= window.innerWidth || event.clientY >= window.innerHeight)) {
								bdtUIkit.modal($this).show();
							    localStorage.setItem( modalID , true );      
							}
							
						});
					} else if ('splash' === $settings['layout']) {
						setTimeout(function(){
						  bdtUIkit.modal($this).show();      
						  localStorage.setItem( modalID , true );      
						}, $settings['delayed'] );
					}	
				}
				
				if ( $(modalID).length ) {
					// global custom link for a tag
					$(modalID).on("click", function(event){
						event.preventDefault();       
						bdtUIkit.modal( $this ).show();
					});
				}

			});
			

			

		},

		widgetScrollNav: function( $scope ) {

			var $scrollnav = $scope.find( '.bdt-dotnav > li' );

			if ( ! $scrollnav.length ) {
				return;
			}

			ElementPack.tippyTooltip($scrollnav, $scope);
		},

		widgetPriceTable: function( $scope ) {

			var $priceTable = $scope.find( '.bdt-price-table' ),
				$featuresList = $priceTable.find( '.bdt-price-table-feature-inner' );

			if ( ! $priceTable.length ) {
				return;
			}

			ElementPack.tippyTooltip($featuresList, $scope);
		},

		tippyTooltip:function( $selector, $appendIn ) {
			var $tooltip = $selector.find('> .bdt-tippy-tooltip');
			
			$tooltip.each( function( index ) {
				tippy( this, {
					appendTo: $appendIn[0]
				});				
			});

		},

		// Circle Menu object
		widgetCircleMenu: function( $scope ) {
			var $circleMenu = $scope.find('.bdt-circle-menu'),
				$settings = $circleMenu.data('settings');

			if ( ! $circleMenu.length ) {
				return;
			}

            $($circleMenu[0]).circleMenu({
				direction           : $settings['direction'],
				item_diameter       : $settings['item_diameter'],
				circle_radius       : $settings['circle_radius'],
				speed               : $settings['speed'],
				delay               : $settings['delay'],
				step_out            : $settings['step_out'],
				step_in             : $settings['step_in'],
				trigger             : $settings['trigger'],
				transition_function : $settings['transition_function']
            });
		},

		// Contact Form object
		widgetSimpleContactForm: function( $scope ) {
			var $contactForm = $scope.find('.bdt-contact-form form');
			
			if ( ! $contactForm.length ) {
				return;
			}

			$contactForm.submit(function(){
				ElementPack.sendContactForm($contactForm);
				return false;
			});

        	return false;
            
		},

		// Contact Form object
		widgetCookieConsent: function( $scope ) {
			var $cookieConsent = $scope.find('.bdt-cookie-consent'),
				$settings      = $cookieConsent.data('settings'),
				editMode  = Boolean( elementor.isEditMode() );;
			
			if ( ! $cookieConsent.length || editMode ) {
				return;
			}

			window.cookieconsent.initialise($settings);
            
		},

		elementPackGIC: function(token) {         		
			return new Promise(function(resolve, reject) {  
				if (grecaptcha === undefined) {
					bdtUIkit.notification({message: '<div bdt-spinner></div> Invisible captcha not defined!', timeout: false, status: 'warning'});
					reject();
				}

				var response = grecaptcha.getResponse();

				if (!response) {
					bdtUIkit.notification({message: '<div bdt-spinner></div> Could not get invisible captcha response!', timeout: false, status: 'warning'});
					reject();
				}

				var $contactForm=$('textarea.g-recaptcha-response').filter(function () {
					return $(this).val() === response;
					}).closest('form.bdt-contact-form-form');
				var contactFormAction = $contactForm.attr('action');
				if(contactFormAction && contactFormAction!=""){					
					ElementPack.sendContactForm($contactForm);
				} else {
					console.log($contactForm);
				}
				
				grecaptcha.reset();

			}); //end promise
		},

		sendContactForm: function($contactForm) {
			$.ajax({
				url:$contactForm.attr('action'),
				type:'POST',
				data:$contactForm.serialize(),
				beforeSend:function(){
					bdtUIkit.notification({message: '<div bdt-spinner></div> Sending message please wait...', timeout: false, status: 'primary'});
				},
				success:function(data){
					bdtUIkit.notification.closeAll();
					bdtUIkit.notification({message: data});
					//$contactForm[0].reset();
				}
			});
			return false;
		},



		//Post Grid Tab object
		widgetPostGridTab: function( $scope ) {

			var $postGridTab = $scope.find( '.bdt-post-grid-tab' ),
			    gridTab      = $postGridTab.find('> .gridtab');
			    //tabImage = $postGridTab.find('> dl > dd > div > div > div > img');

			if ( ! $postGridTab.length ) {
				return;
			}

			$(gridTab).gridtab($postGridTab.data('settings'));

			//.is(':visible')

			//console.log(tabImage);

			// $.each(tabImage, function( index ) {
			// 	var image = $(this);
			// 	ElementPack.lazyLoader(image[0]);
			// });

		},

		//Progress pie object
		widgetProgressPie: function( $scope ) {

			var $progressPie = $scope.find( '.bdt-progress-pie' );

			if ( ! $progressPie.length ) {
				return;
			}

			elementorFrontend.waypoint( $progressPie, function() {
				var $this = $( this );
				
					$this.asPieProgress({
					  namespace: "pieProgress",
					  classes: {
					      svg     : "bdt-progress-pie-svg",
					      number  : "bdt-progress-pie-number",
					      content : "bdt-progress-pie-content"
					  }
					});
					
					$this.asPieProgress("start");

			}, {
				offset: 'bottom-in-view'
			} );

		},

		//Image Magnifier widget
		widgetImageMagnifier: function( $scope ) {

			var $imageMagnifier = $scope.find( '.bdt-image-magnifier' ),
				settings        = $imageMagnifier.data('settings'),
				magnifier       = $imageMagnifier.find('> .bdt-image-magnifier-image');

			if ( ! $imageMagnifier.length ) {
				return;
			}

			$(magnifier).ImageZoom(settings);

		},

		//Image Magnifier widget
		widgetImageMagnifierThumb: function( $scope ) {

			var $imageMagnifier     = $scope.find( '.bdt-image-magnifier > .bdt-image-magnifier-image' );

			if ( ! $imageMagnifier.length ) {
				return;
			}

			$($imageMagnifier).ImageZoom($imageMagnifier.data('settings'));

		},

		//Instagram widget
		widgetInstagram: function( $scope ) {

			var $instagram 		  = $scope.find( '.bdt-instagram' );

			if ( ! $instagram.length ) {
				return;
			}

			$.instagramFeed($instagram.data('settings'));
		},

		//Table Of Content widget
		widgetTableOfContent: function( $scope ) {

			var $tableOfContent = $scope.find( '.bdt-table-of-content' );
				
			if ( ! $tableOfContent.length ) {
				return;
			}			

			$($tableOfContent).tocify($tableOfContent.data('settings'));			
		},

		//Tabs widget
		widgetTabs: function( $scope ) {

			var $tabs = $scope.find( '.bdt-tabs' );
				
			if ( ! $tabs.length ) {
				return;
			}

			// console.log($settings);

			// if (location.hash == '#bdt-tab-tab-3') {

		 //        $('html, body').animate({
		 //        	easing:  'slow',
	  //               scrollTop: $("#bdt-tab-tab-3").offset().top,
	  //           }, 1000, function() {

	  //               	bdtUIkit.tab('.bdt-tab').show($("#bdt-tab-tab-3"));
	  //           });  
		 //    }			
		},

		// Video Gallery
		widgetVideoGallery: function( $scope ) {

			var $video_gallery = $scope.find( '.rvs-container' );
				
			if ( ! $video_gallery.length ) {
				return;
			}

			$($video_gallery).rvslider();			
		},

		// Timeline
		widgetTimeline: function( $scope ) {

			var $timeline = $scope.find( '.bdt-timeline-skin-olivier' );
				
			if ( ! $timeline.length ) {
				return;
			}

			$($timeline).timeline({
				visibleItems : $timeline.data('visible_items'),
			});			
		},

		//Weather widget
		widgetWeather: function( $scope ) {

			// var $weather = $scope.find( '.bdt-weather' ),
			// 	$settings = $weather.data('settings');				

			// if ( ! $weather.length ) {
			// 	return;
			// }

			// var bdt_weather = $weather.flatWeatherPlugin($settings);

			// console.log($settings);

			// if ('tiny' == $settings['layout']) {
			// 	bdt_weather.flatWeatherPlugin('fetchWeather').then(function(data){

			// 		var temparature_unit = $settings['units'] == "metric"?"&#176;C":"&#176;F";

			// 		$("<span />", {"class" : "wi wi" + data.today.code}).appendTo(bdt_weather);
					
			// 		if ('yes' == $settings['show_city']) {
			// 			$("<span />", {"class" : "bdt-weather-city"}).text(data.city).appendTo(bdt_weather);
			// 		}

			// 		if ('yes' == $settings['show_temperature']) {
			// 			$("<span />", {"class" : "bdt-weather-temperature"}).html(data.today.temp.now + temparature_unit).appendTo(bdt_weather);
			// 		}
					
			// 		if ('yes' == $settings['show_weather_desc']) {
			// 			$("<span />", {"class" : "bdt-weather-desc"}).html(data.today.desc).appendTo(bdt_weather);
			// 		}

			// 	});
			// }
			
		},

		elementorSection: function( $scope ) {
			var $section   = $scope,
				instance   = null,
				sectionID  = $section.data('id'),
				editMode   = Boolean( elementor.isEditMode() ),
				particleID = 'bdt-particle-container-' + sectionID,
				particleSettings = {};

			instance = new bdtWidgetTooltip( $section );
			instance.init();

			if ( window.ElementPackConfig && window.ElementPackConfig.elements_data.sections.hasOwnProperty( sectionID ) ) {
				particleSettings = window.ElementPackConfig.elements_data.sections[ sectionID ];
			}
			
			$.each($section, function( index ) {
				var $this = $(this);
				if ($this.hasClass('bdt-particles-yes')) {
					$section.prepend( '<div id="'+particleID+'" class="bdt-particle-container"></div>' );
					particlesJS( particleID, JSON.parse( particleSettings.particles_js ));
				}
			})

			
		},
	};

	$( window ).on( 'elementor/frontend/init', ElementPack.init );
	
	//Contact form recaptcha callback, if needed
	window.elementPackGICCB = ElementPack.elementPackGIC;

	window.bdtWidgetTooltip = function ( $selector ) {

		var self 	 = this,
			$tooltip = $selector.find('.elementor-widget.bdt-tippy-tooltip');


		self.init = function() {
			
			if ( ! $tooltip.length ) {
				return;
			}

			$tooltip.each( function( index ) {
				tippy( this, {
					appendTo: $tooltip[0]
				});				
			});

		};
		
	}

}( jQuery, window.elementorFrontend ) );
