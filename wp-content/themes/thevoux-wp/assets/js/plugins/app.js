var skroller;
(function ($, window, _) {
	'use strict';

	var $doc = $(document),
			win = $(window),
			body = $('body'),
			header = $('.header:not(.fixed)'),
			thb_md = new MobileDetect(window.navigator.userAgent);

	var SITE = SITE || {};

	TweenMax.defaultEase = Quart.easeOut;
	TimelineMax.defaultEase = Quart.easeOut;

	SITE = {
		init: function() {
			var self = this,
					obj;


			function initFunctions() {
				for (obj in self) {
					if ( self.hasOwnProperty(obj)) {
						var _method =  self[obj];
						if ( _method.selector !== undefined && _method.init !== undefined ) {
							if ( $(_method.selector).length > 0 ) {
								_method.init();
							}
						}
					}
				}
			}

			if (themeajax.settings.page_transition === 'on' && !body.hasClass('compose-mode') && !body.hasClass('elementor-editor-active')) {
				$('.thb-page-transition-on')
					.animsition({
						inClass : themeajax.settings.page_transition_style +'-in',
						outClass : themeajax.settings.page_transition_style +'-out',
						inDuration : parseInt(themeajax.settings.page_transition_in_speed,10),
						outDuration : parseInt(themeajax.settings.page_transition_out_speed,10),
						loading : false,
						touchSupport: false,
						linkElement: '.animsition-link, a[href]:not([target="_blank"]):not([target=" _blank"]):not([href^="'+themeajax.settings.current_url+'#"]):not([href^="#"]):not([href*="javascript"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".gif"]):not([href*=".png"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".mp4"]):not([href*=".flv"]):not([href*=".avi"]):not([href*=".mp3"]):not([href^="mailto:"]):not([class="no-animation"]):not(.ajax_add_to_cart)'
					})
					.on('animsition.inEnd', function() {
						initFunctions();
					});
			} else {
				initFunctions();
			}
		},
		newsletterPopup: {
			selector: '.newsletter-popup',
			init: function() {
				var base = this,
						container = $(base.selector);

				if ( Cookies.get('newsletter_popup') !== '1' ) {

          if ( themeajax.settings.newsletter === 'off' ) {
            return;
          }
					$.magnificPopup.open({
						type:'inline',
						items: {
							src: '#newsletter-popup',
							type: 'inline'
						},
						mainClass: 'mfp newsletter-popup mfp-zoom-3d',
            tLoading: themeajax.l10n.lightbox_loading,
  					removalDelay: 550,
            fixedBgPos: true,
            fixedContentPos: true,
            closeBtnInside: true,
            closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
						callbacks: {
							close: function() {
								Cookies.set('newsletter_popup', '1', { expires: parseInt(themeajax.settings.newsletter_length,10) });
							}
						}
					});
				}
			}
		},
		cookieBar: {
			selector: '.thb-cookie-bar',
			init: function() {
				var base = this,
						container = $(base.selector),
						button = $('.button', container);

				if (Cookies.get('thb-thevoux-cookiebar') !== 'hide') {
					TweenMax.to(container, 0.5, { opacity: '1', y: '0%' });
				}
				button.on('click', function() {
				  Cookies.set('thb-thevoux-cookiebar', 'hide', { expires: 30 });
				  TweenMax.to(container, 0.5, { opacity: '0', y: '100%' });
					return false;
				});
			}
		},
		responsiveNav: {
			selector: '#wrapper',
			init: function() {
				var base = this,
					container = $(base.selector),
					toggle = $('.mobile-toggle', '.header'),
					cc = $('.click-capture', '#content-container'),
					target = $('#mobile-menu'),
					parents = target.find('.thb-mobile-menu>li>a'),
					span = target.find('.thb-mobile-menu li>span'),
					quick_search = $('.quick_search'),
					header_social = $('.social_header');

				toggle.on('click', function() {
					container.toggleClass('open-menu');
					return false;
				});

				cc.add(target.find('.close')).on('click', function() {
					container.removeClass('open-menu');
					parents.find('.sub-menu').hide();

					return false;
				});

				span.on('click', function(){
					var that = $(this),
							link = that.prev('a'),
							parents = target.find('a');

					if (!that.parents('.sub-menu').length) {
						parents.filter('.active').not(link).removeClass('active').parent('li').find('.sub-menu').eq(0).slideUp();
					}

					if (link.hasClass('active')) {
						link.removeClass('active').parent('li:eq(0)').find('.sub-menu').eq(0).slideUp('200');
					} else {
						link.addClass('active').parent('li:eq(0)').find('.sub-menu').eq(0).slideDown('200');
					}

					return false;
				});

				quick_search.on('click', function(e) {
					if(e.target.classList.contains('quick_search') || e.target.classList.contains('search_icon')) {
						quick_search.toggleClass('active');
						e.stopPropagation();
					}
					return false;
				});
				header_social.on('click', 'i.social_toggle', function() {
					header_social.toggleClass('active');
					return false;
				});
			}
		},
		centeredMenu: {
			selector: '.centered-menu',
			init: function() {
				var base = this,
						container = $(base.selector);

				function centeredMenu() {
					var c_width = container.outerWidth(),
							margin = parseInt(container.offset().left - ((win.outerWidth() / 2) - (c_width / 2)), 10);

					if ( (win.outerWidth() > 1024) && margin !== 0) {
						container.css({
							'marginLeft': -2 * margin + 'px'
						});
					}
				}
				win.on('resize', centeredMenu).trigger('resize');
			}
		},
		fullMenu: {
			selector: '.full-menu',
			init: function() {
				var base = this,
						container = $(base.selector),
						children = container.find('.menu-item-has-children'),
						mega_parent = children.filter('.menu-item-mega-parent');

				children.each(function() {
					var _this = $(this),
						menu = _this.find('>.sub-menu,>.thb_mega_menu_holder'),
						tabs = _this.find('.thb_mega_menu li'),
						contents = _this.find('.category-children>.row');

					tabs.first().addClass('active');
					_this.hoverIntent(
						function() {
							TweenLite.to(menu, 0.5, {autoAlpha: 1, onStart: function() { menu.css('display', 'block'); }});
						},
						function() {
							TweenLite.to(menu, 0.5, {autoAlpha: 0, onComplete: function() { menu.css('display', 'none'); }});
						}
					);
					tabs.on('hover', function() {
						var _li = $(this),
								n = _li.index();
						tabs.removeClass('active');
						_li.addClass('active');
						TweenLite.set(contents, { display: 'none' });
						TweenLite.set(contents.filter(':nth-child('+(n+1)+')'), { display: 'flex' });
					});
				});

				container.each(function() {
					var _this = $(this),
							header = _this.parents('.header');

					var resizeMegaMenu = _.debounce(function(){
						_this.find('.thb_mega_menu_holder').css({
							'width' : function() {
								return header.hasClass('fixed') ? win.outerWidth() : header.outerWidth();
							},
							'left'	: function() {
								return header.hasClass('style4') || header.hasClass('style5')  || header.hasClass('style6') ? ( -1 * ( header.find('.full-menu-container').offset().left - header.find('.nav_holder').offset().left ) ) :
									(header.hasClass('boxed') ? 0 : header.offset().left);
							}
						});
					}, 30);
					var resizeMegaMenu_style2 = _.debounce(function(){
						var borders = $('.thb-borders').length ? $('.thb-borders').css("border-top-width") : 0;
						mega_parent.find('.thb_mega_menu_holder').each(function() {
							var that = $(this),
									return_val;

							that.show();
							if ( that.offset().left <= 0 ) {
								return_val = (-1 * that.offset().left) + parseInt(borders, 10) + 5;
							} else if ( (that.offset().left + that.outerWidth()) > $(window).outerWidth() ) {
								return_val =  -1 * Math.round( that.offset().left + that.outerWidth() - $(window).outerWidth() + parseInt(borders, 10) + 5);
							}
							that.hide();
							that.css({
								'marginLeft': return_val + 'px'
							});
						});
					}, 30);
					if (themeajax.settings.header_submenu_style === 'style1') {
						win.on('resize.resizeMegaMenu', resizeMegaMenu).trigger('resize.resizeMegaMenu');
					} else {
						win.on('resize.resizeMegaMenu_style2', resizeMegaMenu_style2).trigger('resize.resizeMegaMenu_style2');
					}
				});
			}
		},
		fixedHeader: {
			selector: '.header.fixed',
			init: function() {
				var base = this,
						container = $(base.selector),
						single = body.hasClass('single-post');

				win.on('scroll', function(){
					base.scroll(container, single);
				}).trigger('scroll');

			},
			scroll: function (container, single) {
				var animationOffset = 400,
						wOffset = win.scrollTop(),
						stick = 'header--slide',
						unstick = 'header--unslide';

				if (wOffset > animationOffset) {
					if (container.hasClass(unstick)) {
						container.removeClass(unstick);
					}
					if (!container.hasClass(stick)) {
						setTimeout(function () {
							container.addClass(stick);
						}, 10);
					}
				} else if ((wOffset < animationOffset && (wOffset > 0))) {
					if(container.hasClass(stick)) {
						container.removeClass(stick);
						container.addClass(unstick);
					}
				} else {
					container.removeClass(stick);
					container.removeClass(unstick);
				}
			}

		},
		fullHeightContent: {
			selector: '.full-height-content',
			init: function() {
				var base = this,
					container = $(base.selector);

				base.control(container);

				win.resize(_.debounce(function(){
					base.control(container);
				}, 50));

			},
			control: function(container) {
				var h = $('.header'),
						a = $('#wpadminbar'),
						ah = (a ? a.outerHeight() : 0);

				container.each(function() {
					var _this = $(this),
						height = win.height() - h.outerHeight() - ah;

					_this.css('min-height',height);

				});
			}
		},
		pinIt: {
			selector: '.thb-pinit-on',
			init: function(el) {
				var base = this,
						container = $(base.selector);

        if (!container.length) {
          return;
        }
				$('#wrapper').imagesLoaded(function() {
					base.check($('.post-detail .post-content-container img:not(.attachment-woocommerce_thumbnail):not(.thb-pinned)'));
				});
				$('.post-detail .post-content-container img:not(.attachment-woocommerce_thumbnail):not(.thb-pinned)').on('lazyloaded', function() {
					base.check($(this));
				});
			},
			check: function(el) {
				el.each( function() {
					var _this = $(this),
							pinned_class = 'thb-pinned';

					if ( _this.hasClass( pinned_class ) || _this.hasClass('attachment-woocommerce_thumbnail')) {
						return;
					}

					if ( !( _this.width() > 100 && _this.height() > 100 ) ) {
						return;
					}

					var container = _this.parent(),
							postURL = _this.parents('.post[data-url]').data( 'url' ),
							pinURL;

					// If parent is link
					if ( container.is('a') ) {

						var image_link = container.attr( 'href' );

						if ( typeof image_link !== 'undefined' && image_link.match( /\.(gif|jpeg|jpg|png)/ ) ) {
							pinURL = image_link;
						}

						if ( !container.closest( 'figure' ).length ) {
							container.wrap( '<figure class="thb-pin-it-container"></figure>' );
						}

						container = container.parent();

					} else {
						if ( !( container.is( 'figure' ) || container.closest( 'figure' ).length ) ) {
							_this.wrap( '<figure class="thb-pin-it-container"></figure>' );
						}
						container = _this.parent();
					}
					// Add .thb-pin-it-container to already existing figure
					if ( !_this.closest( 'figure' ).hasClass( 'thb-pin-it-container' ) ) {
						_this.closest( 'figure' ).addClass( 'thb-pin-it-container' );
					}

					if ( !pinURL ) {
						if ( _this.is( 'img' ) ) {
							pinURL = ( typeof _this.data( 'src' ) !== 'undefined' ) ? _this.data( 'src' ) : _this.attr( 'src' );
						} else {
							pinURL = ( typeof container.find( 'img' ).data( 'src' ) !== 'undefined' ) ? container.find( 'img' ).data( 'src' ) : container.find( 'img' ).attr( 'src' );
						}
					}

					var figure = container;

					if ( !container.is( 'figure' ) ) {
						figure = container.closest( 'figure' );
					}

					// Description for the image
					var description = figure.find( '.wp-caption-text' ).text() ? figure.find( '.wp-caption-text' ).text() : figure.find( 'img' ).attr( 'alt' ),
              encoded_desc;

					if ( description ) {
						encoded_desc = '&amp;description=' + encodeURIComponent( description );
					}

					// Img classes.
					var imgClasses = [ 'alignnone', 'aligncenter', 'alignleft', 'alignright' ];

					imgClasses.forEach( function( img_class ) {
						if ( container.find( 'img' ).hasClass( img_class ) ) {
								 container.find( 'img' ).removeClass( img_class );
								 container.find( 'img' ).closest( 'figure' ).addClass( img_class );

							var image_width = container.find( 'img' ).attr( 'width' );

							if ( parseInt( image_width) !== 'NaN' ) {
								container.find( 'img' ).closest( 'figure' ).width( image_width );
							}
						}
					} );

					$( '<a class="thb-pin-it" href="https://pinterest.com/pin/create/bookmarklet/?url=' + encodeURIComponent( postURL ) + '&amp;media=' + encodeURIComponent( pinURL ) + encoded_desc + '&is_video=false" target="_blank"><i class="fa fa-pinterest"></i></a>' )
						.appendTo( container )
					  .addClass( 'thb-pin-it-ready' )
						.on( 'click', function() {
						var left = (screen.width/2)-(640/2),
								top = (screen.height/2)-(440/2)-100;
						window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
						return false;
					});
					_this.addClass( pinned_class );
				});
			}
		},
		carousel: {
			selector: '.slick',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector);

				container.each(function() {
					var _this = $(this),
							columns = _this.data('columns'),
							navigation = (_this.data('navigation') === true ? true : false),
							autoplay = (_this.data('autoplay') === true ? true : false),
							autoplay_speed = _this.data('autoplay-speed') ? _this.data('autoplay-speed') : 4000,
							pagination = (_this.data('pagination') === true ? true : false),
							center = (_this.data('center') ? _this.data('center') : false),
							infinite = _this.data('infinite') === false ? false : true,
							vertical = (_this.data('vertical') ? _this.data('vertical') : false),
							asNavFor = _this.data('asnavfor'),
							adaptiveHeight = _this.data('adaptive') === true ? true : false,
							rtl = body.hasClass('rtl'),
							centerarrows = _this.hasClass('center-arrows'),
							bottomleftarrows = _this.hasClass('bottom-left-nav'),
							prev_text = '',
							next_text = '';

					if ( _this.hasClass('bottom-right-nav') ) {
						prev_text = '<span class="arrow-text">'+themeajax.l10n.prev+'</span>';
						next_text = '<span class="arrow-text">'+themeajax.l10n.next+'</span>';
						_this.append('<div class="bottom-right-nav-arrows"></div>');
					}
					var args = {
						dots: pagination,
						arrows: navigation,
						infinite: infinite,
						speed: 1000,
						centerMode: center,
						slidesToShow: columns,
						adaptiveHeight: adaptiveHeight,
						slidesToScroll: 1,
						rtl: rtl,
						rows: 0,
						autoplay: autoplay,
						slide: ':not(.bottom-right-nav-arrows)',
						centerPadding: '50px',
						autoplaySpeed: autoplay_speed,
						pauseOnHover: true,
						vertical: vertical,
						verticalSwiping: vertical,
						accessibility: false,
						focusOnSelect: false,
						prevArrow: '<button type="button" class="slick-nav slick-prev">'+themeajax.svg.prev_arrow+ prev_text +'</button>',
						nextArrow: '<button type="button" class="slick-nav slick-next">'+ next_text +themeajax.svg.next_arrow+'</button>',
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									slidesToShow: (columns < 3 ? columns : 3),
									centerPadding: '30px'
								}
							},
							{
								breakpoint: 641,
								settings: {
									slidesToShow: 1,
									centerPadding: '15px'
								}
							}
						]
					};
					if (asNavFor && $(asNavFor).is(':visible')) {
						args.asNavFor = asNavFor;
					}

					if (_this.hasClass('bottom-right-nav')) {
						args.appendArrows = _this.find('.bottom-right-nav-arrows');
					}
					if (_this.hasClass('product-images') || _this.data('fade') || _this.hasClass('bottom-right-nav')) {
						args.fade = true;
					}
					if (_this.hasClass('product-images')) {
						args.adaptiveHeight = true;
					}
					if (_this.hasClass('product-thumbnails')) {
						args.focusOnSelect = true;
					}
					_this.on('init', function() {
						if (centerarrows || bottomleftarrows) {
							win.trigger('resize.position_arrows');
						}
					});
					if ( centerarrows ) {
						win.on('resize.position_arrows', function() {
							var g = _this.find('.post-gallery').length ? _this.find('.post-gallery') : _this.find('.thb-placeholder'),
									h = Math.round(g.outerHeight() / 2);
							_this.find('.slick-nav').css({'top': h});
						});
					}
					if ( bottomleftarrows ) {
						win.on('resize.position_arrows', function() {
							var container = $('h1,h2', _this.find('.slick-current')),
									left = container.offset().left - _this.offset().left;

							if ( left > 0 ) {
								$('.slick-prev', _this).css('left', function() {
									return left + 'px';
								});
								$('.slick-next', _this).css('left', function() {
									return left + 55 + 'px';
								});
							}
						});
					}
					if (_this.hasClass('featured-style12')) {
						args.dotsClass = 'post-title-bullets';
						args.customPaging = function(slick, i) {
							var slide = $(slick.$slides[i]),
									meta = slide.find('.post-meta').text(),
									title = slide.find('h1').text();
							return $('<button type="button" class="post" />').html('<span>0' + ( i + 1 ) + '</span><div class="thb-post-top"><aside class="post-meta style1">'+ meta + '</aside></div><h6>'+ title+ '</h6>');

						};
						args.responsive[0].settings.dots = false;
						args.responsive[1].settings.dots = false;

						if (_this.parents('.full-width-row').length) {
							_this.on('setPosition', function() {
								var active = _this.find('.slick-active .row.max_width'),
										right = (win.width() - (active.offset().left + active.outerWidth())) + 15;

								_this.find('.post-title-bullets').css('right', right + 'px');
							});
						}
					}
					_this.find('.wp-post-image').on('lazyloaded', function() {
						if (centerarrows) {
							win.trigger('resize.position_arrows');
						}
						_this.trigger('setPosition');
					});
					_this.slick(args);

				});
			}
		},
		masonry: {
			selector: '.masonry',
			init: function() {
				var base = this,
				container = $(base.selector);

				container.each(function() {
					var _this = $(this),
						security = _this.data('security'),
						el = _this.children('.columns'),
						loadmore = $(_this.data('loadmore')),
						rand = _this.data('rand'),
						thb_endpoint = ('thb_postajax_'+rand),
						org = [],
						page = 2,
						args_in = {
							y: 0, opacity:1
						};
					if (rand) {
						var columns = window[thb_endpoint].columns,
								style = window[thb_endpoint].style,
								loop = window[thb_endpoint].loop,
								count = window[thb_endpoint].count;
					}
					if (loadmore) {
						var text = loadmore.text();
					}
					_this.imagesLoaded(function() {
						_this.on('layoutComplete', function(e, items ) {
							var elms = _.map(items, 'element');

							win.scroll(_.debounce(function(){
								items = $(elms).filter(':in-viewport').filter(function() {
								    return $(this).data('thb-in-viewport') === undefined;
								});
								if (items) {
									items.data('thb-in-viewport', true);
									TweenMax.staggerTo(items.find('.post'), 0.5, args_in , 0.1, function() {
										items.data('thb-in-viewport', true);
									});
								}
							}, 20)).trigger('scroll');
						}).isotope({
							itemSelector : '.columns',
							transitionDuration : 0,
							hiddenStyle: { },
							visibleStyle: { },
						});
						if (loadmore) {
							loadmore.on('click', function(){

								loadmore.text(themeajax.l10n.loading).addClass('loading');

								$.post( themeajax.url, {
										action: 'thb_ajax',
										security: security,
										loop: loop,
										columns: columns,
										style: style,
										page: page
								}, function(data){

									page++;
									var d = $.parseHTML($.trim(data)),
											l = d ? d.length : 0;

									if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
										loadmore.text(themeajax.l10n.nomore).removeClass('loading').off('click');
									} else {
										$(d).imagesLoaded(function() {
											$(d).appendTo(_this).hide();

											_this.isotope( 'appended', $(d) );
											$(d).show();
											TweenMax.staggerTo($(d).find('.post'), 0.5, args_in, 0.1);
											if (window.skroller) {
												window.skroller.refresh();
											}
											SITE.shareArticleDetail.init();
											if (l < count){
												loadmore.text(themeajax.l10n.nomore).removeClass('loading');
											} else {
												loadmore.text(text).removeClass('loading');
											}
										});
									}
									$(document.body).trigger('thb_after_masonry_load');
								});
								return false;
							});
						}
					});
				});
			}
		},
		freeScroll: {
			selector: '.thb-freescroll',
			init: function() {
				var base = this,
						container = $(base.selector);


				container.each(function() {
					var _this = $(this),
							args = {
								prevNextButtons: false,
								wrapAround: true,
								pageDots: false,
								freeScroll: true,
								adaptiveHeight: true,
								imagesLoaded: true
							};
					_this.flickity(args);

					var flkty = _this.data('flickity');

					flkty.paused = true;

					function loop() {
						flkty.x--;

						flkty.integratePhysics();
						flkty.settle(flkty.x);

						if (!flkty.paused) {
							flkty.raf = window.requestAnimationFrame(loop);
						}
					}
					function pause() {
						if (!thb_md.mobile() && !thb_md.tablet()) {
							flkty.paused = true;
						}
					}
					function play() {
						if (!thb_md.mobile() && !thb_md.tablet()) {
							flkty.paused = false;
							loop();
						}
					}

					container.on('mouseenter', function() {
						pause();
					}).on('mouseleave', function() {
						play();
					});

					win.on('scroll.flkty', function(e) {
						if (_this.is( ':in-viewport' )) {
							if (flkty.paused) {
								flkty.paused = false;
								loop(flkty);
							}
						} else {
							flkty.paused = true;
						}
					}).trigger('scroll.flkty');

				});

			}
		},
		plyr: {
			selector: '.flex-video, .wp-video video',
			init: function() {
				var base = this,
					container = $(base.selector),
					custom_player = themeajax.settings.thb_custom_video_player,
					publisher_id = themeajax.settings.viai_publisher_id,
					options = {
						playsinline: true
					};

				if (publisher_id && publisher_id !== '') {
					options.ads = {
						enabled: true,
						publisherId: publisher_id
					};
				}
				if (custom_player === 'on') {
					var players = Plyr.setup(base.selector, options);
				}
			}
		},
		commentToggle: {
			selector: '.comment-button',
			init: function() {
				var base = this,
					container = $(base.selector, '.expanded-comments-off'),
					list = container.next('.commentlist_container');

				container.on('click', function() {
					if (container.hasClass('toggled')) {
						container.removeClass("toggled");
					} else {
						container.addClass("toggled");
					}
					return false;
				});
				$(base.selector, '.expanded-comments-on').on('click', function() {
					return false;
				});
			},
			open: function() {
				var base = this,
					container = $(base.selector);

				container.addClass("toggled");
			}
		},
		shareArticleDetail: {
			selector: '.share-article, .share-article-loop',
			init: function() {
				var base = this,
					container = $(base.selector),
					social = container.find('.social');

				social.data('pin-no-hover', true);
				social.not('.whatsapp').on('click', function() {
					var left = (screen.width/2)-(640/2),
							top = (screen.height/2)-(440/2)-100;
					window.open($(this).attr('href'), 'mywin', 'left='+left+',top='+top+',width=640,height=440,toolbar=0');
					return false;
				});
				container.find('.comment').on('click', function() {
					var comments = $(this).parents('.post-detail-row').find('#comments');
					if (comments.length) {
							var ah = $('#wpadminbar').outerHeight(),
									pos = comments.offset().top - 100 - ah;

						TweenMax.to(window, win.height() / 500, {
							scrollTo:{y:pos, autoKill:false},
							onComplete: function() {
								SITE.commentToggle.open();
								SITE.fixedPosition.init();
							}
						});
						return false;
					} else {
						window.location = $(this).attr('href');
						return false;
					}
				});
			}
		},
		skrollr: {
			selector: '.parallax_bg, .single-post',
			init: function() {
				var args = {
					forceHeight: false,
					easing: 'outCubic',
					mobileCheck: function() {
						return false;
					},
					render: function() {
						if (typeof window.vcParallaxSkroll !== 'undefined') {
							if (vcParallaxSkroll) {
								vcParallaxSkroll.refresh();
							}
						}
					}
				};
				window.skroller = skrollr.init(args);
			}
		},
		custom_scroll: {
			selector: '.custom_scroll',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
					    args = {
    						suppressScrollX: true
    					};

					var ps = new PerfectScrollbar(_this[0], args);

				});

			}
		},
		magnificImage: {
			selector: '[rel="mfp"], [rel="magnific"]',
			init: function() {
				var base = this,
						container = $(base.selector),
						stype;

				container.each(function() {
					if ($(this).hasClass('video')) {
						stype = 'iframe';
					} else {
						stype = 'image';
					}
					$(this).magnificPopup({
						type: stype,
						fixedContentPos: false,
						closeBtnInside: false,
						closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
						mainClass: 'mfp-zoom-in',
						removalDelay: 400,
						image: {
							verticalFit: true,
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						},
						callbacks: {
							imageLoadComplete: function()  {
								var _this = this;
								_.delay( function() { _this.wrap.addClass('mfp-image-loaded'); }, 10);
							},
							beforeOpen: function() {
								this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						  }
						}
					});
				});

			}
		},
		magnificInline: {
			selector: '[rel="inline"]',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var eclass = ($(this).data('class') ? $(this).data('class') : '');

					$(this).magnificPopup({
						type:'inline',
						fixedContentPos: false,
						closeBtnInside: false,
						mainClass: 'mfp-zoom-in',
						removalDelay: 400,
						closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
						callbacks: {
							imageLoadComplete: function()  {
								var _this = this;
								_.delay( function() { _this.wrap.addClass('mfp-image-loaded'); }, 10);
							},
							beforeOpen: function() {
								this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						  }
						}
					});
				});

			}
		},
		magnificGallery: {
			selector: '[rel="gallery"], .post-content .gallery',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					$(this).magnificPopup({
						delegate: 'a:not(.thb-pin-it)',
						type: 'image',
						mainClass: 'mfp-zoom-in',
						removalDelay: 400,
						closeBtnInside: false,
						fixedContentPos: false,
						overflowY: 'scroll',
						closeMarkup: '<button title="%title%" class="mfp-close"><span>' + themeajax.svg.close_arrow + '</span></button>',
						gallery: {
							enabled: true,
							arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir% mfp-prevent-close thb-animated-arrow circular">'+ themeajax.svg.prev_arrow +'</button>'
						},
						image: {
							verticalFit: true,
							titleSrc: function(item) {
								return item.el.attr('alt');
							}
						},
						callbacks: {
							imageLoadComplete: function()  {
								var _this = this;
								_.delay( function() { _this.wrap.addClass('mfp-image-loaded'); }, 10);
							},
							beforeOpen: function() {
						    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
						  },
						  open: function() {
						  	$.magnificPopup.instance.next = function() {
						  		var _this = this;
									_this.wrap.removeClass('mfp-image-loaded');

									setTimeout( function() { $.magnificPopup.proto.next.call(_this); }, 125);
								};

								$.magnificPopup.instance.prev = function() {
									var _this = this;
									this.wrap.removeClass('mfp-image-loaded');

									setTimeout( function() { $.magnificPopup.proto.prev.call(_this); }, 125);
								};
						  }
						}
					});
				});
			}
		},
		lightboxGallery: {
			selector: '.gallery-link',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							items = [],
							target = $( _this.attr('href') ),
							galleries = $('.post-gallery-content', target),
							grid = galleries.eq(0).find('.thb-gallery-grid');

					if (_this.data('click-attached')) {
						return;
					}
					_this.data('click-attached', true);
					galleries.each(function(index) {
						var _this = $(this),
								grid_btn = $('.lightbox-grid', _this);

						if (index > 0) {
							grid.clone().appendTo(_this.find('.image'));
						}
						items.push({
							src: $(this)
						});

						grid_btn.on('click',function() {
							_this.find('.image').toggleClass('gridActive');
						});

					});

					_this.on('click', function() {
						$.magnificPopup.open({
							mainClass: 'mfp-zoom-in post-gallery-lightbox',
							alignTop: true,
							closeBtnInside: true,
							items: items,
							removalDelay: 400,
							overflowY: 'hidden',
							gallery: {
								enabled: true
							},
							closeMarkup: '<button title="%title%" class="mfp-close">' + themeajax.svg.close_arrow + '</button>',
							callbacks: {
								imageLoadComplete: function()  {
									var _this = this;
									_.delay( function() { _this.wrap.addClass('mfp-image-loaded'); }, 10);
								},
								beforeOpen: function() {
								  this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
								},
								open: function() {
									var instance = $.magnificPopup.instance;
									$(".lightbox-close").on('click',function(){
										instance.close();
										return false;
									});
									$(".thb-gallery-arrow.prev").on('click',function(){
										instance.prev();
										return false;
									});

									$(".thb-gallery-arrow.next").on('click',function(){
										instance.next();
										return false;
									});

									this.content.find('.thb-grid-image').on('click',function() {
										var index = $(this).parent().index();

										instance.goTo(index);
										return false;
									});
									instance.next = function() {
							  		var _this = this;
										_this.wrap.removeClass('mfp-image-loaded');

										setTimeout( function() {
											galleries.find('.image').removeClass('gridActive');
											$.magnificPopup.proto.next.call(_this);
											_this.content.find('.thb-grid-image').on('click',function() {
												var index = $(this).parent().index();

												instance.goTo(index);
												return false;
											});
										}, 125);
									};

									instance.prev = function() {
										var _this = this;
										_this.wrap.removeClass('mfp-image-loaded');

										setTimeout( function() {
											galleries.find('.image').removeClass('gridActive');
											$.magnificPopup.proto.prev.call(_this);
											_this.content.find('.thb-grid-image').on('click',function() {
												var index = $(this).parent().index();

												instance.goTo(index);
												return false;
											});
										}, 125);
									};
								},
								close: function() {
									galleries.find('.image').removeClass('gridActive');
									$(".thb-gallery-arrow.prev").off('click');

									$(".thb-gallery-arrow.next").off('click');
								}
							}
						});
						return false;
					});

				});

			}
		},
		verticalGalleries: {
			selector: '.thb-gallery-container',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function(){
					var _this = $(this),
					    items = $('.thb-gallery-item', _this),
					    total = items.length;

					items.each(function() {
						var gallery_item = $(this),
						    arrow_top = $('.arrow.to_top', gallery_item),
						    arrow_bottom = $('.arrow.to_bottom', gallery_item),
						    i = items.index(gallery_item);

						arrow_top.on('click', function() {
							if (i > 0) {
								var pos = items.eq(i-1).offset().top - $('#wpadminbar').outerHeight() - $('.header.fixed').outerHeight() - 20;
								TweenMax.to(win, 1, { scrollTo: { y:pos, autoKill:false } });
							}
							return false;
						});
						arrow_bottom.on('click', function() {
							if (i < total) {
								var pos = items.eq(i+1).offset().top - $('#wpadminbar').outerHeight() - $('.header.fixed').outerHeight() - 20;
								TweenMax.to(win, 1, { scrollTo: { y:pos, autoKill:false } });
							}
							return false;
						});

					});
					$doc.keyup(function(e) {
						if (e.keyCode === 40) { // Down Arrow
							$('.thb-gallery-item:in-viewport', _this).last().find('.arrow.to_bottom').trigger('click');
						} else if (e.keyCode === 38) { // Up Arrow
							$('.thb-gallery-item:in-viewport', _this).last().find('.arrow.to_top').trigger('click');
						}
					});
			  });
			}
		},
		overlay: {
			selector: '.panr',
			init: function(el) {
				var base = this,
					container = $(base.selector),
					target = el ? el.find(base.selector) : container;

				target.each(function() {
					var _this = $(this),
							img = _this.find('img');

					img.panr({ moveTarget: _this, scaleDuration: 1, sensitivity: 10, scaleTo: 1.1, panDuration: 2 });
				});
			}
		},
		slideType: {
			selector: '.thb-slidetype',
			control: function(container, delay, skip) {
				if( ( container.data('thb-in-viewport') === undefined ) || skip) {
					container.data('thb-in-viewport', true);
					var style = container.data('style'),
							tl = new TimelineMax(),
							split,
							animated_split,
							dur = 0.25,
							stagger = 0.05;

					if (!container.find('.thb-slidetype-entry').length) {
            return;
          }

					if (style === 'style1') {
						animated_split = container.find('.thb-slidetype-entry .lines');
						dur = 0.65;
						stagger = 0.15;
					} else if (style === 'style2') {
						split = new SplitText(container.find('.thb-slidetype-entry'), { type: 'words' });
						animated_split = split.words;
						dur = 0.65;
						stagger = 0.15;
					} else if (style === 'style3') {
						split = new SplitText(container.find('.thb-slidetype-entry'));
						animated_split = split.chars;
					}

					tl
						.set(container, {visibility:"visible"})
						.staggerFrom(animated_split, dur, {
						  y: '200%',
						  delay: delay
						}, stagger, '+=0', function() {
							if (style !== 'style1') {
								split.revert();
							}
						});

				}
			}
		},
		autoType: {
			selector: '.thb-autotype',
			control: function(container, delay, skip) {
				if ( ( container.data('thb-in-viewport') === undefined ) || skip) {
					container.data('thb-in-viewport', true);

					var _this = container,
							entry = _this.find('.thb-autotype-entry'),
							strings = entry.data('strings'),
							speed = entry.data('speed') ? entry.data('speed') : 50,
							loop = entry.data('thb-loop') === 1 ? true : false,
							cursor = entry.data('thb-cursor') === 1 ? true : false;

					if (!container.find('.thb-autotype-entry').length) {
            return;
          }
					entry.typed({
						strings: strings,
						loop: loop,
						showCursor: cursor,
						cursorChar: '|',
						contentType: 'html',
						typeSpeed: speed,
						backDelay: 1000,
					});
				}
			}
		},
		fadeType: {
			selector: '.thb-fadetype',
			control: function(container, delay, skip) {
				if( ( container.data('thb-in-viewport') === undefined ) || skip) {
					container.data('thb-in-viewport', true);
					var split = new SplitText(container.find('.thb-fadetype-entry')),
							tl = new TimelineMax();

					if (!container.find('.thb-fadetype-entry').length) {
            return;
          }
					tl
						.set(container, {visibility:"visible"})
						.staggerFrom(split.chars, 0.25, {
						  autoAlpha: 0,
						  y: 10,
						  rotationX: '-90deg',
						  delay: delay
						}, 0.05, '+=0', function() {
							split.revert();
						});

				}
			}
		},
		thb_3dImg: {
			selector: '.thb_3dimg',
			init: function(el) {
				var base = this,
						container = $(base.selector),
						target = el ? el.find(base.selector) : container;

				target.thb_3dImg();
			}
		},
		articleScroll: {
			selector: '#infinite-article',
			pagetitle: $('#page-title'),
			org_post_url: window.location.href,
			org_post_title: document.title,
			init: function() {
				var base = this,
						container = $(base.selector),
						security = container.data('security'),
						on = container.data('infinite'),
						org = container.find('.post-detail:first-child'),
						id = org.data('id'),
						tempid = id,
						thb_loading = false,
						footer = $('#footer').outerHeight() + $('#subfooter').outerHeight(),
						count = themeajax.settings.infinite_count,
						i = 0;

				var scrollLocation = _.debounce(function(){
						base.location_change();
					}, 10);

				var scrollAjax = _.debounce(function(){
					if (!count || i < parseInt(count, 10)) {
						if (win.scrollTop() >= ($doc.height() - win.height() - footer - 200) && thb_loading === false) {
						if (id === tempid) {
							container.addClass('thb-loading');
							$.ajax( themeajax.url, {
								method : 'POST',
								data : {
									action: 'thb_infinite_ajax',
									post_id: tempid,
									security: security,
								},
								beforeSend: function() {
									id = null;
									thb_loading = true;
								},
								success : function(data) {
									i++;
									thb_loading = false;
									var d = $.parseHTML(data),
											ads = $(d).find('.adsbygoogle'),
											tweets = $(d).find('.twitter-tweet, .twitter-timeline'),
											instagram = $(d).find('.instagram-media');

									container.removeClass('thb-loading');

									if (d) {
										id = $(d).find('.post-detail').data('id');
										tempid = id;

										$(d).appendTo(container);

										SITE.carousel.init($(d).find('.slick'));
										SITE.plyr.init();
										SITE.fixedPosition.init($(d).find('.fixed-me'));
										if (window.skroller) {
											window.skroller.refresh();
										}
										SITE.verticalGalleries.init();
										SITE.shareArticleDetail.init();
										SITE.lightboxGallery.init();
										SITE.magnificGallery.init();
										SITE.selectionShare.init();
										SITE.animation.init();
										SITE.pinIt.check($(d).find('.post-content-container img'));

										if (typeof window.instgrm !== 'undefined') {
											window.instgrm.Embeds.process();
										} else if (instagram.length && (typeof window.instgrm === 'undefined')) {
											var ins = document.createElement( 'script' );
											ins.src   = "//platform.instagram.com/en_US/embeds.js";
											ins.onload = function(){
							          window.instgrm.Embeds.process();
							        };
											body.append(ins);
										}
										if (typeof window.twttr !== 'undefined') {
											twttr.widgets.load(
											  document.getElementById("infinite-article")
											);
										} else if (tweets.length && (typeof window.twttr === 'undefined')) {
											window.twttr = (function(d, s, id) {
												var js, fjs = d.getElementsByTagName(s)[0],
												  t = window.twttr || {};
												if (d.getElementById(id)) { return t; }
												js = d.createElement(s);
												js.id = id;
												js.src = "https://platform.twitter.com/widgets.js";
												fjs.parentNode.insertBefore(js, fjs);

												t._e = [];
												t.ready = function(f) {
												  t._e.push(f);
												};
												return t;
											}(document, "script", "twitter-wjs"));
										}
										if (typeof window.addthis !== 'undefined') {
											addthis.toolbox();
										}
										if (typeof window.atnt !== 'undefined') {
											window.atnt();
										}
										if (typeof window.googletag !== 'undefined') {
											googletag.pubads().refresh();
										}
										if (typeof window.adsbygoogle !== 'undefined' && ads.length) {
											ads.each(function() {
												(adsbygoogle = window.adsbygoogle || []).push({});
											});
										}
										if (typeof (FB) !== 'undefined') {
											FB.init({ status: true, cookie: true, xfbml: true });
										}
										$(document.body).trigger('thb_after_infinite_load');
									} else {
										id = null;
									}
								}
							});
						}
					}
					}
				}, 50);

				if (on === 'on') {
					win.scroll(scrollLocation);
					win.scroll(scrollAjax);
				} else {
					win.scroll(function(){
						base.borderWidth($('.post-detail-row').offset().top, $('.post-detail-row').outerHeight(true));
					});
				}
			},
			location_change: function() {
				var base = this,
						container = $(base.selector);

				var windowTop           = win.scrollTop(),
						windowBottom        = windowTop + win.height(),
						windowSize          = windowBottom - windowTop,
						setsInView          = [],
						pageChangeThreshold = 0.5,
						post_title,
						post_url;

				$('.post-detail-row').each( function() {
					var _row = $(this),
							post = _row.find('.post-detail'),
							id				= post.data( 'id' ),
							setTop			= _row.offset().top,
							setHeight		= _row.outerHeight(true),
							setBottom		= 0,
							tmp_post_url	= post.data('url'),
							tmp_post_title	= post.find('.post-title h1').text();

					// Determine position of bottom of set by adding its height to the scroll position of its top.
					setBottom = setTop + setHeight;

					if ( setTop < windowTop && setBottom > windowBottom ) { // top of set is above window, bottom is below
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
					else if( setTop > windowTop && setTop < windowBottom ) { // top of set is between top (gt) and bottom (lt)
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
					else if( setBottom > windowTop && setBottom < windowBottom ) { // bottom of set is between top (gt) and bottom (lt)
						setsInView.push({'id': id, 'top': setTop, 'bottom': setBottom, 'post_url': tmp_post_url, 'post_title': tmp_post_title, 'alength' : setHeight });
					}
				});

				// Parse number of sets found in view in an attempt to update the URL to match the set that comprises the majority of the window
				if ( 0 === setsInView.length ) {
					post_url = base.org_post_url;
					post_title = base.org_post_title;
				} else if ( 1 === setsInView.length ) {
					var setData = setsInView.pop();

					post_url = setData.post_url;
					post_title = setData.post_title;

					base.borderWidth(setData.top, setData.alength);
				} else {
					post_url = setsInView[0].post_url;
					post_title = setsInView[0].post_title;
					base.borderWidth(setsInView[0].top, setsInView[0].alength);
				}

				base.updateURL(post_url, post_title);
			},
			updateURL : function(post_url, post_title) {
				if( window.location.href !== post_url ) {

					if ( post_url !== '' ) {
						history.replaceState( null, null, post_url );
						document.title = post_title;
						this.pagetitle.html(post_title);
					}
					this.updateGA(post_url);
				}
			},
			updateGA: function(post_url) {
				if( typeof _gaq !== 'undefined' ) {
					_gaq.push(['_trackPageview', post_url]);
				} else if ( typeof ga !== 'undefined' ) {
					var reg = /.+?\:\/\/.+?(\/.+?)(?:#|\?|$)/,
							pathname = reg.exec( post_url )[1];

					ga('send', 'pageview', pathname );
				}
				if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
					reinvigorate.ajax_track(post_url);
				}
				if ( typeof googletag !== 'undefined' ) {
					googletag.pubads().refresh();
				}
			},
			borderWidth : function(top, setHeight) {
				var windowTop = win.scrollTop(),
						perc = (windowTop - top + ($('.header.fixed').outerHeight() + $('#wpadminbar').outerHeight())) / setHeight;

				$('.progress', '.header').css({ width: perc*100 + '%' });
			}
		},
		videoPlaylist: {
			selector: '.video_playlist',
			init: function() {
				var base = this,
				container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							security = _this.data('security'),
							video_area = _this.find('.video-side'),
							links = _this.find('.video_play');

					links.on('click', function() {
						var _that = $(this),
								url = _that.data('video-url'),
								id = _that.data('post-id');

						if (_that.hasClass('video-active')) {
							return false;
						}
						_this.find('.video_play').removeClass('video-active');
						_this.find('.video_play[data-video-url="'+url+'"]').addClass('video-active');
						video_area.addClass('thb-loading');

						$.post( themeajax.url, {
							action: 'thb-parse-embed',
							security: security,
							post_ID: id
						}, function(d){
							if (d.success) {
								video_area.html(d.data.body);
								SITE.plyr.init();
							}
							video_area.removeClass('thb-loading');
						});
						return false;
					});
				});
			}
		},
		postGridAjaxify: {
			selector: '.ajaxify-pagination',
			init: function() {
				var base = this,
						container = $(base.selector),
						_this = container;

				// Initialized
				_this.data('initialized', true);
				// Prepare our Variables
				var History = window.History,
						document = window.document;

				// Check to see if History.js is enabled for our Browser
				if ( !History.enabled ) {
					return false;
				}

				var rootUrl = History.getRootUrl();

				// Ajaxify Helper
				$.fn.ajaxify = _.debounce(function(){
					// Prepare
					var $_this = $(this);

					// Ajaxify
					$_this.find('.page-numbers').on('click',function(e){

						// Prepare
						var $_this	= $(this),
								url = $_this.attr('href'),
								title = $_this.attr('title') || null;

						// Continue as normal for cmd clicks etc
						if ( e.which === 2 || e.metaKey ) { return true; }

						// Ajaxify this link
						History.pushState(null,title,url);
						e.preventDefault();
						return false;
					});
					// Chain
					return $_this;
				}, 50);

				// Ajaxify our Internal Links
				_this.ajaxify();

				// Hook into State Changes
				$(window).bind('statechange',function(){
					// Prepare Variables
					var State = History.getState(),
							url = State.url,
							relativeUrl = url.replace(rootUrl,''),
							a = $('#wpadminbar'),
							ah = (a ? a.outerHeight() : 0),
							h = $('.header.fixed').length ? $('.header.fixed').outerHeight() : 0;

					// Start Fade Out
					// Animating to opacity to 0 still keeps the element's height intact
					// Which prevents that annoying pop bang issue when loading in new content
					// Let's add some cool animation here

					_this.addClass('thb-loading');
					jQuery('html, body').animate({
						scrollTop: _this.offset().top - ah - h - 30
					}, 800);


					// Ajax Request the Traditional Page
					$.post( url, function(data){
						// Prepare
						var html = $.parseHTML(data),
								contentHTML = $(html).find('.ajaxify-pagination');

						if ( !contentHTML ) {
							document.location.href = url;
							return false;
						}

						// Update the content
						_this.stop(true,true);
						_this.html(contentHTML)
								.ajaxify()
								.animate({'opacity': 1}, 500, 'linear', function() {
									_this.removeClass('thb-loading');
									SITE.shareArticleDetail.init();
									$(document.body).trigger('thb_after_pagination_load');
								});

						// Inform Google Analytics of the change
						if ( typeof window.pageTracker !== 'undefined' ) {
							window.pageTracker._trackPageview(relativeUrl);
						}

						// Inform ReInvigorate of a state change
						if ( typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined' ) {
							reinvigorate.ajax_track(url);// ^ we use the full url here as that is what reinvigorate supports
						}
					}); // end ajax

				}); // end onStateChange
			}
		},
		paginationStyle2: {
			selector: '.pagination-style2',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							security = _this.data('security'),
							page = 2,
							loadmore = $(_this.data('loadmore')),
							rand = _this.data('rand'),
							text = loadmore.text(),
							thb_endpoint = ('thb_postajax_'+rand),
							loop = window[thb_endpoint].loop,
							style = window[thb_endpoint].style,
							columns = window[thb_endpoint].columns,
							count = window[thb_endpoint].count,
							featured_index = window[thb_endpoint].featured_index;

					if (loadmore.length > 0) {
						loadmore.on('click', function() {
							loadmore.text(themeajax.l10n.loading);
							$.post( themeajax.url, {
								action: 'thb_posts',
								security: security,
                count: count,
								loop: loop,
								page: page,
								columns: columns,
								style: style,
								thb_i: container.find('.post').length,
								featured_index: featured_index
							}, function(data){

								page++;
								var d = $.parseHTML($.trim(data)),
										l = d ? d.length : 0;

								if ( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
									data = '';
									loadmore.text(themeajax.l10n.nomore).removeClass('loading').off('click');
								} else {
									$(d).insertBefore(loadmore.parents('.masonry_loader')).hide();

									TweenMax.staggerFromTo($(d), 0.25, { display: 'none', opacity: 0, y:20}, { display: 'block', y: 0, opacity:1, ease: Quart.easeOut }, 0.15);

									if (l < count){
										loadmore.text(themeajax.l10n.nomore).removeClass('loading');
									} else {
										loadmore.text(text).removeClass('loading');
									}
								}
							});
							return false;
						});
					}
				});
			}
		},
		paginationStyle3: {
			selector: '.pagination-style3',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							security = _this.data('security'),
							thb_loading = false,
							page = 2,
							rand = _this.data('rand'),
							thb_endpoint = ('thb_postajax_'+rand),
							loop = window[thb_endpoint].loop,
							style = window[thb_endpoint].style,
							columns = window[thb_endpoint].columns,
							count = window[thb_endpoint].count,
							featured_index = window[thb_endpoint].featured_index;

					var scrollFunction = _.debounce(function(){
						if ( ( thb_loading === false ) && ( (win.scrollTop() + win.height() + 150) >= (_this.offset().top + _this.outerHeight()) ) ) {
							$.ajax( themeajax.url, {
								method : 'POST',
								data : {
									action: 'thb_posts',
									security: security,
	                count: count,
									loop: loop,
									page: page,
									columns: columns,
									style: style,
									thb_i: container.find('.post').length,
									featured_index: featured_index
								},
								beforeSend: function() {
									_this.addClass('thb-loading');
									thb_loading = true;
								},
								success : function(data) {
									thb_loading = false;
									page++;
									var d = $.parseHTML($.trim(data)),
											l = d ? d.length : 0;

									_this.removeClass('thb-loading');
									if( data === '' || data === 'undefined' || data === 'No More Posts' || data === 'No $args array created') {
										win.off('scroll', scrollFunction);
									} else {
										$(d).appendTo(_this).hide();
										TweenMax.staggerFromTo($(d), 0.25, { display: 'none', opacity: 0, y:20}, { display: 'block', y: 0, opacity:1, ease: Quart.easeOut, onComplete: function() {
											if (l >= count) {
												win.on('scroll', scrollFunction);
											}
										} }, 0.15);
									}
								}
							});
						}
					}, 30);

					win.on('scroll', scrollFunction);
				});
			}
		},
		selectionShare: {
			selector: '.thb-selectionSharer',
			init: function() {
				var base = this,
						container = $(base.selector);

				$('.post-content *').thbSelectionSharer();
			}
		},
		retinaJS: {
			selector: 'img.retina_size',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					$(this).attr('width', function() {
						var w = $(this).attr('width') / 2;
						return w;
					}).addClass('retina_active');
				});
			}
		},
		writeFirst: {
			selector: '.write_first',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.on('click', function() {
					var pos = $('.woocommerce-tabs').offset().top - $('#wpadminbar').outerHeight() - $('.header.fixed').outerHeight();
					$('.reviews_tab a').trigger('click');
					TweenMax.to(window, win.height() / 500, { scrollTo: { y:pos, autoKill:false } });
					return false;
				});
			}
		},
		contact: {
			selector: '.contact_map:not(.disabled)',
			init: function() {
				var base = this,
					container = $(base.selector);

				container.each(function() {
					var _this = $(this),
						mapzoom = _this.data('map-zoom'),
						mapstyle = _this.data('map-style'),
						mapType = _this.data('map-type'),
						panControl = _this.data('pan-control'),
						zoomControl = _this.data('zoom-control'),
						mapTypeControl = _this.data('maptype-control'),
						scaleControl = _this.data('scale-control'),
						streetViewControl = _this.data('streetview-control'),
						locations = _this.find('.thb-location'),
						once;

					var bounds = new google.maps.LatLngBounds();

					var mapOptions = {
						center: {
							lat: -34.397,
							lng: 150.644
						},
						styles: mapstyle,
						zoom: mapzoom,
						draggable: !("ontouchend" in document),
						scrollwheel: false,
						panControl: panControl,
						zoomControl: zoomControl,
						mapTypeControl: mapTypeControl,
						scaleControl: scaleControl,
						streetViewControl: streetViewControl,
						mapTypeId: mapType,
						gestureHandling: 'cooperative'
					};

					var map = new google.maps.Map(_this[0], mapOptions);

					map.addListener('tilesloaded', function() {
						if (!once) {
							locations.each(function(i) {
								var location = $(this),
										options = location.data('option'),
										lat = options.latitude,
										long = options.longitude,
										latlng = new google.maps.LatLng(lat, long),
										marker = options.marker_image,
										marker_size = options.marker_size,
										retina = options.retina_marker,
										title = options.marker_title,
										desc = options.marker_description,
										pinimageLoad = new Image();

								bounds.extend(latlng);

								pinimageLoad.src = marker;

								$(pinimageLoad).on('load', function(){
									base.setMarkers(i, locations.length, map, lat, long, marker, marker_size, title, desc, retina);
								});
									once = true;
							});

							if(mapzoom > 0) {
								map.setCenter(bounds.getCenter());
								map.setZoom(mapzoom);
							} else {
								map.setCenter(bounds.getCenter());
								map.fitBounds(bounds);
							}
						}
					});

					win.on('resize', _.debounce(function(){
						map.setCenter(bounds.getCenter());
					}, 50) );
				});
			},
			setMarkers: function(i, count, map, lat, long, marker, marker_size, title, desc, retina) {

				function showPin (i) {

					var markerExt = marker.toLowerCase().split('.');
							markerExt = markerExt[markerExt.length - 1];

					if($.inArray(markerExt, ['svg']) || retina ) {
						 marker = new google.maps.MarkerImage(marker, null, null, null, new google.maps.Size(marker_size[0]/2, marker_size[1]/2));
					}
					var g_marker = new google.maps.Marker({
								position: new google.maps.LatLng(lat,long),
								map: map,
								animation: google.maps.Animation.DROP,
								icon: marker,
								optimized: false
							}),
							contentString = '<h3>'+title+'</h3>'+'<div>'+desc+'</div>';

					// info windows
					var infowindow = new google.maps.InfoWindow({
							content: contentString
					});

					g_marker.addListener('click', function() {
				    infowindow.open(map, g_marker);
				  });
				}
				setTimeout(showPin, i * 250, i);
			}
		},
		fixedPosition: {
			selector: '.fixed-me',
			init: function(el) {
				var base = this,
					container = el ? el : $(base.selector),
					a = $('#wpadminbar'),
					ah = (a ? a.outerHeight() : 0);

				if (!thb_md.mobile()) {
					container.each(function() {
						var _this = $(this),
								off = $('.header.fixed').outerHeight() + 20;

						_this.stick_in_parent({
							offset_top: off + ah,
							spacer: false
						});
						_this.find('.thb-lazyload').on('lazyloaded', function() {
							$(document.body).trigger("sticky_kit:recalc");
						});
					});

					win.resize(_.debounce(function(){
						$(document.body).trigger("sticky_kit:recalc");
					}, 10));
					win.scroll(_.debounce(function(){
						$(document.body).trigger("sticky_kit:recalc");
					}, 50));
				}
			}
		},
		animation: {
			selector: '.animation, .thb-counter, .thb-progressbar, .thb-fadetype, .thb-slidetype, .thb-autotype',
			init: function() {
				var base = this,
						container = $(base.selector);


				win.on('scroll.thb-animation', function(){
					base.control(container, true);
				}).trigger('scroll.thb-animation');
			},
			container: function(container) {
				var base = this,
						element = $(base.selector, container);

				base.control(element, false);
			},
			control: function(element, filter) {
				var t = 0,
						delay = 0.15,
						speed = 0.5,
						el = filter ? element.filter(':in-viewport') : element;

				el.each(function() {
					var _this = $(this),
							params = { autoAlpha: 1, x: 0, y: 0, z:0, rotationZ: '0deg', rotationX: '0deg', rotationY: '0deg', delay: t*delay };

					if ( _this.hasClass('thb-client') || _this.hasClass('thb-counter') || _this.hasClass('thb-iconlist-li')) {
						speed = 0.2;
						delay = 0.05;
					} else if ( _this.hasClass('thb-team-member') ) {
						speed = 0.4;
						delay = 0.1;
					} else {
					  speed = 0.5;
					  delay = 0.15;
					}

					if (_this.data('thb-animated') !== true ) {
						_this.data('thb-animated', true);
						if (_this.hasClass('thb-counter')) {
  						SITE.counter.control(_this, t*delay);
  					} else if (_this.hasClass('thb-autotype')) {
  						SITE.autoType.control(_this, t*delay);
  					} else if (_this.hasClass('thb-fadetype')) {
  						SITE.fadeType.control(_this, t*delay);
  					} else if (_this.hasClass('thb-slidetype')) {
  						SITE.slideType.control(_this, t*delay);
  					} else if (_this.hasClass('thb-progressbar')) {
  						SITE.progressBar.control(_this, t*delay);
  					} else {
							if (_this.hasClass('scale')) {
  							params.scale = 1;
  						}
  						TweenMax.to(_this, speed, params);
						}
						t++;
					}
				});
			}
		},
		hotSpotClick: {
			selector: '.thb-hotspot-container.click',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var _this = $(this),
							spots = $('.thb-hotspot-content', _this);

					spots.on('click', function(e) {
						$(this).parent('.thb-hotspot').toggleClass('active');
						return false;
					});

				}); // each

			}
		},
		counter: {
			selector: '.thb-counter',
			control: function(container, delay) {
				if( container.data('thb-in-viewport') === undefined ) {
					container.data('thb-in-viewport', true);

					var _this = container,
							el = _this.find('.counter').eq(0),
							counter = el[0],
							count = el.data('count'),
							speed = el.data('speed'),
							separator = _this.data('separator'),
							params = {
								el: counter,
								value: 0,
								duration: speed,
								theme: 'minimal'
							};

					if (_this.hasClass('single-decimal')) {
						params.format = '(,ddd).d';
					} else if (!separator || separator === '') {
						params.format = '';
					}
					var od = new Odometer(params);

					TweenMax.set(_this, { visibility: 'visible' });
					setTimeout(function(){
						od.update(count);
					}, delay);
				}
			}
		},
		progressBar: {
			selector: '.thb-progressbar',
			control: function(container, delay, skip) {
				if( ( container.data('thb-in-viewport') === undefined ) || skip) {
					var progress = container.find('.thb-progress'),
							value = progress.data('progress');

					var tl = new TimelineMax();

					tl
						.to(container, 0.6, { autoAlpha: 1, delay: delay })
						.to(progress.find('span'), 1, { scaleX: value/100 });

				}
			}
		},
		newsletter: {
			selector: '.newsletter-form:not(.thb-active)',
			init: function() {
				var base = this,
					container = $(base.selector);

        container.each(function() {
          var _this = $(this),
							security = _this.data('security'),
              args = {
                action: 'thb_subscribe_emails',
                privacy: false,
								security: security
              };
          _this.addClass('thb-active');
          _this.on('submit', function() {
            if (_this.next('.thb-custom-checkbox').length) {
              args.privacy = true;
              args.checked = _this.next('.thb-custom-checkbox').find('.thb-newsletter-privacy').is(':checked');
            }
            args.email = _this.find('.widget_subscribe').val();
            $.ajax( themeajax.url, {
              method: 'POST',
              data: args,
              beforeSend: function() {
                _this.addClass('thb-loading');
              },
              success: function(data) {
                var d = $.parseHTML($.trim(data));
                _this.removeClass('thb-loading');
    						$(d).appendTo(body);
                _.delay(function() { $(d).remove();}, 8000);
              }
            });
  					return false;
  				});
        });

			}
		},
		toTop: {
			selector: '#scroll_totop',
			init: function() {
				var base = this,
					container = $(base.selector);

				container.on('click', function(){
					TweenMax.to(window, 1, { scrollTo: { y:0, autoKill:false } });
					return false;
				});
				win.scroll(_.debounce(function(){
					base.control();
				}, 50));
			},
			control: function() {
				var base = this,
					container = $(base.selector);

				if (win.scrollTop() > 300) {
					TweenMax.to(container, 0.2, { autoAlpha:1 });
				} else {
					TweenMax.to(container, 0.2, { autoAlpha:0 });
				}
			}
		},
		quantity: {
			selector: '.quantity:not(.hidden)',
			init: function() {
				var base = this,
						container = $(base.selector);

				base.initialize();
				body.on( 'updated_cart_totals', function(){
					base.initialize();
				});
			},
			initialize: function() {
				// Quantity buttons
				$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<input type="button" value="+" class="plus" />' ).prepend( '<input type="button" value="-" class="minus" />' ).end().find('input[type="number"]').attr('type', 'text');
				$('.plus, .minus').on('click', function() {
					// Get values
					var $qty		= $( this ).closest( '.quantity' ).find( '.qty' ),
						currentVal	= parseFloat( $qty.val() ),
						max			= parseFloat( $qty.attr( 'max' ) ),
						min			= parseFloat( $qty.attr( 'min' ) ),
						step		= $qty.attr( 'step' );

					// Format values
					if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) { currentVal = 0; }
					if ( max === '' || max === 'NaN' ) { max = ''; }
					if ( min === '' || min === 'NaN' ) { min = 0; }
					if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) { step = 1; }

					// Change the value
					if ( $( this ).is( '.plus' ) ) {

						if ( max && ( max === currentVal || currentVal > max ) ) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}

					} else {

						if ( min && ( min === currentVal || currentVal < min ) ) {
							$qty.val( min );
						} else if ( currentVal > 0 ) {
							$qty.val( currentVal - parseFloat( step ) );
						}

					}

					// Trigger change event
					$qty.trigger( 'change' );
					return false;
				});
			}
		},
		updateCart: {
			selector: '.quick_cart',
			init: function() {
				var base = this,
					container = $(base.selector);
				body.bind('added_to_cart', SITE.updateCart.update_cart_dropdown);
			},
			update_cart_dropdown: function(event) {
				if (body.hasClass('woocommerce-cart')) {
					location.reload();
				} else {
					$('.quick_cart').trigger('click');
				}
			}
		},
		shop: {
			selector: '.products .product',
			init: function() {
				var base = this,
						container = $(base.selector);

				container.each(function() {
					var that = $(this);

					that
					.find('.add_to_cart_button').on('click', function() {
						if ($(this).data('added-text') !== '') {
							$(this).text($(this).data('added-text'));
						}

					});

				}); // each

			}
		},
		productAjaxAddtoCart: {
			selector: '.thb-single-product-ajax-on.single-product .product-type-variable form.cart, .thb-single-product-ajax-on.single-product .product-type-simple form.cart',
			init: function() {
				var base = this,
						container = $(base.selector),
						btn = $('.single_add_to_cart_button', container);

				$doc.on('submit', 'body.single-product form.cart', function(e){
					e.preventDefault();
					var _this = $(this),
							btn_text = btn.text();

					if (btn.is('.disabled') || btn.is('.wc-variation-selection-needed')) {
						return;
					}

					var	data = {
						product_id:	_this.find("[name*='add-to-cart']").val(),
						product_variation_data: _this.serialize()
					};

					$.ajax({
						method: 'POST',
						data: data.product_variation_data,
						dataType: 'html',
						url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'add-to-cart=' + data.product_id + '&thb-ajax-add-to-cart=1' ),
						cache: false,
						headers: {'cache-control': 'no-cache'},
						beforeSend: function() {
							body.trigger( 'adding_to_cart' );
							btn.addClass('disabled').text(themeajax.l10n.adding_to_cart);
						},
						success: function( data ) {
							var parsed_data = $.parseHTML(data);

							var thb_fragments = {
								'.float_count': $(parsed_data).find('.float_count').html(),
								'.thb_prod_ajax_to_cart_notices': $(parsed_data).find('.thb_prod_ajax_to_cart_notices').html(),
								'.widget_shopping_cart_content': $(parsed_data).find('.widget_shopping_cart_content').html()
							};

							$.each( thb_fragments, function( key, value ) {
								$( key ).html(value);
							});
							body.trigger( 'wc_fragments_refreshed' );
							btn.removeClass('disabled').text(btn_text);
						},
						error: function( response ) {
							body.trigger( 'wc_fragments_ajax_error' );
							btn.removeClass('disabled').text(btn_text);
						}
					});
				});
			}
		},
		variations: {
			selector: 'form.variations_form',
			init: function() {
				var base = this,
					container = $(base.selector),
					slider = $('#product-images'),
					thumbnails = $('#product-thumbnails'),
					org_image = $('.first img', slider).attr('src'),
					org_thumb = $('.first img', thumbnails).attr('src');

				container.on("show_variation", function(e, variation) {
					if (variation.hasOwnProperty("image") && variation.image.src) {
						$('.first img', slider).attr("src", variation.image.src).attr("srcset", "");
						$('.first img', thumbnails).attr("src", variation.image.thumb_src).attr("srcset", "");

						if (slider.hasClass('slick-initialized')) {
							slider.slick('slickGoTo', 0);
						}
					}
				}).on('reset_image', function () {
					$('.first img', slider).attr("src", org_image).attr("srcset", "");
					$('.first img', thumbnails).attr("src", org_thumb).attr("srcset", "");
				});
			}
		},
		login_register: {
			selector: '#customer_login',
			init: function() {

				var create = $('#create-account'),
						login = $('#login-account');


				create.on('click', function() {
						TweenMax.fromTo($('.login-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50, onComplete: function() {
								TweenMax.fromTo($('.register-container'), 0.2, {opacity:0, display:'none', y:50}, {opacity:1,display:'block', y: 0});
							}
						});
						return false;
				});

				login.on('click', function() {
						TweenMax.fromTo($('.register-container'), 0.2, {opacity:1, display:'block', y: 0}, {opacity:0,display:'none', y: 50,
							onComplete: function() {
								TweenMax.fromTo($('.login-container'), 0.2, {opacity:0, display:'none', y: 50}, {opacity:1,display:'block', y: 0});
							}
						});

						return false;
				});
			}
		}
	};

	$doc.ready(function() {
		if ($('#vc_inline-anchor').length) {
			win.on('vc_reload', function() {
				SITE.init();
			});
		} else {
			SITE.init();
		}
		window.site = SITE;
	});

})(jQuery, this, _);
