/**
 * jQuery Hotspot : A jQuery Plugin to create hotspot for an HTML element
 *
 * Author: Aniruddha Nath
 * Version: 1.0.0
 *
 * Modified by: Fuel Themes
 */

;(function($) {

	// Default settings for the plugin
	var defaults = {

		// Data
		data: [],

		// Hotspot Tag
		tag: 'img',

		// Mode of the plugin
		// Options: admin, display
		mode: 'display',

		// HTML5 LocalStorage variable
		LS_Variable: '__HotspotPlugin_LocalStorage',

		// Hidden class for hiding the data
		hiddenClass: 'hidden',

		// Event on which the data will show up
		// Options: click, hover, none
		interactivity: 'hover',

		// Buttons' id (Used only in Admin mode)
		done_btnId: 'HotspotPlugin_Done',
		remove_btnId: 'HotspotPlugin_Remove',
		sync_btnId: 'HotspotPlugin_Server',

		// Buttons class
		done_btnClass: 'btn btn-success HotspotPlugin_Done',
		remove_btnClass: 'vc_ui-button-default HotspotPlugin_Remove',
		sync_btnClass: 'btn btn-info HotspotPlugin_Server',

		// Classes for Hotspots
		hotspotClass: 'HotspotPlugin_Hotspot',
		hotspotAuxClass: 'HotspotPlugin_inc',

		// Overlay
		hotspotOverlayClass: 'HotspotPlugin_Overlay',

		// Text
		popupTitle: 'Tooltip content',
		saveText: 'Save',
		closeText: 'Close',

		// No. of variables included in the spots
		dataStuff: [
			{
				'property': 'Title',
				'default': 'Hotspot Title'
			},
			{
				'property': 'Message',
				'default': 'Hotspot Content'
			}
		]
	},
	count = 1;

	//Constructor
	function Hotspot(element, options) {

		// Overwriting defaults with options
		this.config = $.extend(true, {}, defaults, options);

		this.element = element;
		this.imageEl = element.find(this.config.tag);
		this.imageParent = this.imageEl.parent();

		this.broadcast = '';

		var widget = this;

		// Event API for users
		$.each(this.config, function(index, val) {
			if (typeof val === 'function') {
				widget.element.on(index + '.thb_hotspot', function() {
					val(widget.broadcast);
				});
			}
		});

		this.init();
	}

	Hotspot.prototype.init = function() {

		this.getData();

		if (this.config.mode !== 'admin') {
			return;
		}

		var spotedImage = new Image(),
			self = this;

		spotedImage.src = $(this.imageEl).attr('src');

		spotedImage.onload = function() {
			var height = self.imageEl[0].height;
			var width = self.imageEl[0].width;

			// Masking the image
			$('<span/>', {
				html: '<p>This is Admin-mode. Click this Panel to Store Messages</p>'
			}).addClass(self.config.hotspotOverlayClass).appendTo(self.imageParent);

			var widget = self;
			var data = [];
			var counter = count;

			// Start storing
			self.element.delegate('span', 'click', function(event) {
				event.preventDefault();
				counter++;

				var offset = $(this).offset();
				var relativeX = (event.pageX - offset.left) / width * 100;
				var relativeY = (event.pageY - offset.top) / height * 100;

				var dataStuff = widget.config.dataStuff;

				var dataBuild = {index: counter, x: relativeX, y: relativeY};

				for (var i = 0; i < dataStuff.length; i++) {
					var val = dataStuff[i];
					dataBuild[val.property] = val.default;
				}

				data.push(dataBuild);

				widget.storeData(data);
				data = [];

				widget.popupWindow(counter);

				$('body').trigger('ihwt-hotspot-updated');
			});

			self.element.delegate('.thb_hotspot', 'click', function(event) {
				var $self = $(this),
					index = $self.find('> div').data('index'),
					currentData = widget.getItemData(index)[0];

				widget.popupWindow(index, currentData);
			});

			self.element.delegate('.delete-item', 'click', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var index = $(this).parent().data('index');

				widget.removeItem(index);

				setTimeout(function() {
					widget.updateView();
				}, 0);
			});

			if(typeof $.fn.draggable !== 'undefined') {
				var config = {
						containment: 'parent',
						stop: function(event, ui) {
							var index = +$(event.target).find('> div').data('index'),
								data = {};

							data.x = ui.position.left / width * 100;
							data.y = ui.position.top / height * 100;

							widget.updateData(data, index);
						}
					};

				if ($('.thb_hotspot').length > 0) {
					$('.thb_hotspot').draggable(config);
					$('body').on('ihwt-hotspot-updated', function() {
						$('.thb_hotspot:not(.ui-draggable-handle)').draggable(config);
					});
				}
			}
		};
	};

	Hotspot.prototype.popupWindow = function(index, currentData) {
		var self = this,
			dataStuff = this.config.dataStuff,
			$popupInnerHtml = '',
			popupTitle = this.config.popupTitle,
			saveText = this.config.saveText,
			closeText = this.config.closeText;

		for (var i = 0; i < dataStuff.length; i++) {
			var val = dataStuff[i],
					defaultText = (typeof currentData !== 'undefined' && typeof currentData[val.property] !== 'undefined') ? currentData[val.property] : val.default,
					input = '',
					positions = ['top', 'left', 'right', 'bottom'];

			if (val.property === 'Title') {
				input = '<label class="wpb_element_label">'+val.property+'</label><input type="text" class="ihwt-hotspot-'+val.property+'" value="'+defaultText+'" />';
			}
			if (val.property === 'Product') {
				input += '<label class="wpb_element_label">Enter WooCommerce Product ID</label><input type="text" class="ihwt-hotspot-'+val.property+'" value="'+defaultText+'" /><span class="vc_description vc_clearfix">If a WooCommerce Product ID is entered, Title &amp; Message are not used.</span>';
			}
			if (val.property === 'Message') {
				input = '<label class="wpb_element_label">'+val.property+'</label><textarea class="ihwt-hotspot-'+val.property+'">'+defaultText+'</textarea>';
			}
			if (val.property === 'Position') {
				input = '<label class="wpb_element_label">Tooltip Position</label><select class="wpb_vc_param_value wpb-input wpb-select thb_tooltip_position dropdown ihwt-hotspot-'+val.property+'">';
				positions.forEach(function(value) {
					var selected = value === defaultText ? 'selected="selected"' : '';
					input += '<option value="'+value+'" '+selected+'>'+value+'</option>';
				});
				input +='</select>';
			}
			$popupInnerHtml += '<div class="vc_shortcode-param vc_column">'+input+'</div>';
		}

		var $popupBtnsHtml = '<div class="vc_ui-panel-footer-container" data-vc-ui-element="panel-footer"><div class="vc_ui-panel-footer"><div class="vc_ui-button-group"><a href="#" title="'+closeText+'" class="vc_general vc_ui-button vc_ui-button-default vc_ui-button-shape-rounded vc_ui-button-fw ihwt-hotspot-close">'+closeText+'</a><a href="#" title="'+saveText+'" class="vc_general vc_ui-button vc_ui-button-action vc_ui-button-shape-rounded vc_ui-button-fw ihwt-hotspot-save">'+saveText+'</a></div></div></div>';
		var $popupHeaderHtml = '<div class="vc_ui-panel-window-inner"><div class="vc_ui-panel-header-container vc_ui-panel-header-o-stacked-bottom"><div class="vc_ui-panel-header"><div class="vc_ui-panel-header-controls"><button type="button" class="vc_general vc_ui-control-button vc_ui-close-button" data-vc-ui-element="button-close"><i class="vc-composer-icon vc-c-icon-close"></i></button></div><h3 class="vc_ui-panel-header-heading" data-vc-ui-element="panel-title">'+popupTitle+'<h3></div></div>';
		var $popupHtml = '<div class="vc_ui-panel vc_active thb-hotspot-popup">'+$popupHeaderHtml+'<div class="vc_ui-panel-content-container"><div class="vc_ui-panel-content vc_properties-list vc_edit_form_elements">'+$popupInnerHtml+'</div></div>'+$popupBtnsHtml+'</div></div>';

		$('body').append($popupHtml);

		$('.ihwt-hotspot-save').on('click', function() {
			var $container = $(this).parents('.thb-hotspot-popup'),
				dataBuild = {};

			for (var i = 0; i < dataStuff.length; i++) {
				var val = dataStuff[i];
				dataBuild[val.property] = $container.find('.ihwt-hotspot-'+val.property).val();
			}

			$('.thb-hotspot-popup').remove();

			self.updateData(dataBuild, index);

			self.updateView();

			return false;
		});

		$('body').on('click', '.ihwt-hotspot-close, .thb-hotspot-popup .vc_ui-close-button', function() {
			$('.thb-hotspot-popup').remove();
			return false;
		});
	};

	Hotspot.prototype.getItemData = function(index) {
		if (index === '') {
			return;
		}

		var raw = decodeURIComponent($(this.config.LS_Variable).val()),
			obj = [],
			newObj = [];

		if (raw) {
			obj = JSON.parse(raw);
		}

		$.each(obj, function(count) {
			var node = obj[count];

			if(node.index === index) {
				newObj.push(node);
			}
		});

		return newObj;
	};

	Hotspot.prototype.getData = function() {
		if (($(this.config.LS_Variable).val() === '' || $(this.config.LS_Variable).val()) === null && this.config.data.length === 0) {
			return;
		}

		if (this.config.mode === 'admin' && ($(this.config.LS_Variable).val() === '' || $(this.config.LS_Variable).val() === null)) {
			return;
		}

		this.beautifyData();

		$('body').trigger('ihwt-hotspot-initialized');
	};

	Hotspot.prototype.beautifyData = function() {
		var widget = this;
		var obj;
		if (this.config.mode !== 'admin' && this.config.data.length !== 0) {
			obj = this.config.data;
		} else {
			var raw = decodeURIComponent($(this.config.LS_Variable).val());
			obj = JSON.parse(raw);
		}

		for (var i = obj.length - 1; i >= 0; i--) {
			var el = obj[i];

			if(i === obj.length - 1) {
				count = el.index;
			}

			var htmlBuilt = '';
			if (this.config.interactivity === 'none') {
				htmlBuilt = $('<div id="ihwt-hotspot-dot-'+el.index+'" class="thb-hotspot-content" data-index="'+el.index+'">'+(i+1)+'<i class="delete-item vc-composer-icon vc-c-icon-close"></i></div>');
			} else {
				htmlBuilt = $('<div id="ihwt-hotspot-dot-'+el.index+'" class="thb-hotspot-content" data-index="'+el.index+'">'+(i+1)+'<i class="delete-item vc-composer-icon vc-c-icon-close"></i></div>').addClass(this.config.hiddenClass);
			}

			$.each(el, function(index, val) {
				if (typeof val === "string") {
					$('<div/>', {
						html: val
					}).addClass('thb-hotspot-param Hotspot_' + index).appendTo(htmlBuilt);
				}
			});

			var div = $('<div/>', {
				html: htmlBuilt
			}).css({
				'top': el.y + '%',
				'left': el.x + '%'
			}).addClass(this.config.hotspotClass).appendTo(this.element);

			if (widget.config.interactivity === 'click') {
				div.on(widget.config.interactivity, function(event) {
					$(this).children('div').toggleClass(widget.config.hiddenClass);
				});
				htmlBuilt.css('display', 'block');
			} else {
				htmlBuilt.removeClass(this.config.hiddenClass);
			}

			if (this.config.interactivity === 'none') {
				htmlBuilt.css('display', 'block');
			}
		}
	};

	Hotspot.prototype.storeData = function(data) {

		if (data.length === 0) {
			return;
		}

		var raw = decodeURIComponent($(this.config.LS_Variable).val());
		var obj = [];

		if (raw) {
			obj = JSON.parse(raw);
		}
		$.each(data, function(index) {
			var node = data[index];

			obj.push(node);
		});

		$(this.config.LS_Variable).val(encodeURIComponent(JSON.stringify(obj)));

		this.broadcast = 'Saved to LocalStorage';
		this.element.trigger('afterSave.hotspot');
	};

	Hotspot.prototype.updateData = function(data, index) {

		if (data.length === 0 || index === '') {
			return;
		}

		var raw = decodeURIComponent($(this.config.LS_Variable).val()),
				obj = [];

		if (raw) {
			obj = JSON.parse(raw);
		}

		$.each(obj, function(count) {
			if(obj[count].index === index) {
				$.each(obj[count], function(i) {
					if(typeof data[i] !== 'undefined' && typeof obj[count][i] !== 'undefined') {
						obj[count][i] = data[i];
					}
				});
			}
		});

		$(this.config.LS_Variable).val(encodeURIComponent(JSON.stringify(obj)));

		this.broadcast = 'Saved to LocalStorage';
		this.element.trigger('afterSave.hotspot');
	};

	Hotspot.prototype.removeItem = function(index) {
		if (index === '') {
			return;
		}

		var raw = decodeURIComponent($(this.config.LS_Variable).val()),
			obj = [],
			newObj = [];

		if (raw) {
			obj = JSON.parse(raw);
		}

		$.each(obj, function(count) {
			var node = obj[count];

			if(node.index !== index) {
				newObj.push(node);
			}
		});

		$(this.config.LS_Variable).val(encodeURIComponent(JSON.stringify(newObj)));

		this.broadcast = 'Saved to LocalStorage';
		this.element.trigger('afterSave.hotspot');
	};

	Hotspot.prototype.removeData = function() {
		if ($(this.config.LS_Variable).val === null) {
			return;
		}

		if (!confirm("Are you sure you want delete all spots?")) {
			return;
		}

		$(this.config.LS_Variable).val('');
		this.broadcast = 'Removed successfully';
		this.element.trigger('afterRemove.hotspot');

		this.updateView();
	};

	Hotspot.prototype.updateView = function() {
		if(this.element.find('.thb_hotspot').length > 0) {
			this.element.find('.thb_hotspot').remove();
		}

		this.beautifyData();

		$('body').trigger('ihwt-hotspot-updated');
	};

	$.fn.hotspot = function (options) {
		new Hotspot(this, options);
		return this;
	};

}(jQuery));
