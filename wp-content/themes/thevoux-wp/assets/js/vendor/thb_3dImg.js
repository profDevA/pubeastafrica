/*
 * atvImg - Modified by Fuel Themes
 * Copyright 2017 Fuel Themes
 * http://fuelthemes.net
 *
 */
 
;(function ($, window) {
  'use strict';
  
  $.fn.thb_3dImg = function (options) {
		var win = $(window),
				imgs = $(this),
				d = document,
				de = d.documentElement,
				bd = d.getElementsByTagName('body')[0],
				htm = d.getElementsByTagName('html')[0],
				totalImgs = imgs.length,
				thb_md = new MobileDetect(window.navigator.userAgent),
				supportsTouch = 'ontouchstart' in win || navigator.msMaxTouchPoints;
		
		function processMovement(e, touchEnabled, elem, layers, totalLayers){

			var atvContainer = elem.find('.atvImg-container'), 
					bdst = bd.scrollTop || htm.scrollTop,
					bdsl = bd.scrollLeft,
					pageX = (touchEnabled)? e.touches[0].pageX : e.pageX,
					pageY = (touchEnabled)? e.touches[0].pageY : e.pageY,
					offsets = elem[0].getBoundingClientRect(),
					w = elem.width(), // width
					h = elem.height(), // height
					wMultiple = 320/w,
					offsetX = 0.52 - ( pageX - offsets.left - bdsl ) / w, //cursor position X
					offsetY = 0.52 - ( pageY - offsets.top - bdst ) / h, //cursor position Y
					dy = (pageY - offsets.top - bdst) - h / 2, //@h/2 = center of container
					dx = (pageX - offsets.left - bdsl) - w / 2, //@w/2 = center of container
					x_ratio = elem.parents('.type-portfolio').hasClass('masonry-tall') ? 0.03 : 0.05,
					yRotate = (offsetX - dx)*(0.03 * wMultiple), //rotation for container Y
					xRotate = (dy - offsetY)*(x_ratio * wMultiple), //rotation for container X
					args = {
							rotationX: xRotate + 'deg',
							rotationY: yRotate + 'deg',
							scale: 1.07,
							force3D: true
					};

			TweenMax.to(atvContainer, 0.15, args);
	
			//parallax for each layer
			var revNum = totalLayers;
			$.each(layers, function(i,v) {
				TweenMax.set($(this), { 
					x: (offsetX * revNum) * ((i * 2.5) / wMultiple), 
					y: (offsetY * totalLayers) * ((i * 2.5) / wMultiple) 
				});
				revNum--;
				
			});
		}
	
		function processEnter(e, containerHTML){
			containerHTML.addClass('over');
			//TweenMax.to(containerHTML, 0.2, { scale: 1.07 });
		}
	
		function processExit(e, containerHTML, layers){
	
			containerHTML.removeClass('over');
			TweenMax.to(containerHTML, 0.15, { scale: 1, rotationX: '0deg', rotationY: '0deg' });
			//TweenMax.set(containerHTML, {clearProps:"transform"});
			
			$.each(layers, function() {
				TweenMax.set($(this), {clearProps:"transform"});
			});
	
		}
		
		// build HTML
		imgs.each(function() {
	
			var thisImg = $(this),
					layerElems = thisImg.find('.atvImg-layer'),
					totalLayerElems = layerElems.length,
					containerHTML = $('<div />').addClass('atvImg-container'),
					shadowHTML = $('<div />').addClass('atvImg-shadow'),
					layersHTML = $('<div />').addClass('atvImg-layers'),
					layers = [];
	
			layerElems.each(function() {
				var _this = $(this);
	
				_this.addClass('atvImg-rendered-layer');
				_this.appendTo(layersHTML);
				
				layers.push(_this);
			});
	
			containerHTML.append(shadowHTML);
			containerHTML.append(layersHTML);
			thisImg.append(containerHTML);
	
			var w = thisImg.width();
			
			TweenMax.set(thisImg, { perspective:w*3 } );
			
			if(supportsTouch && !thb_md.mobile()){
				win.preventScroll = false;
				(function(_thisImg,_layers,_totalLayers,_containerHTML) {
					
					// Touchstart
					thisImg.on('touchstart', function(e){
					  win.preventScroll = true;
						processEnter(e,_containerHTML);		
					});
					
					// Touchmove
					thisImg.on('touchmove', function(e){
						if (win.preventScroll){
							e.preventDefault();
						}
						window.requestAnimationFrame(function(){
							processMovement(e,true,_thisImg,_layers,_totalLayers);	
						});	
					});
					
					// Touchend
					thisImg.on('touchend', function(e){
						win.preventScroll = false;
						processExit(e,_containerHTML,_layers);		
					});
					
				})(thisImg,layers,totalLayerElems, containerHTML);
			} else {
				(function(_thisImg,_layers,_totalLayers,_containerHTML) {
					// Mouseenter
					thisImg.on('mouseenter', function(e){
						processEnter(e,_containerHTML);		
					});
					
					// Mousemove
					thisImg.on('mousemove', function(e){
						processMovement(e,false,_thisImg,_layers,_totalLayers);		
					});
					
					// Mouseleave
					thisImg.on('mouseleave', function(e){
						processExit(e,_containerHTML,_layers);		
					});
					
				})(thisImg,layers,totalLayerElems, containerHTML);
			}
		});
	
	};
})(jQuery, this);