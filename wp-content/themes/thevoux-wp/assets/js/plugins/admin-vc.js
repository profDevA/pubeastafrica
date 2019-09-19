jQuery(document).ready(function($){
	var template_container = $('.thb_templates_container'),
			categories = $('.thb_library_categories li');
	/* Add Template */
	$('.thb_template_import').on("click", function(e){
		var _this = $(this);
		$.ajax({
			method: 'POST',
			url: window.ajaxurl,
			data: {
				'action': 'thb_load_template',
				'template_unique_id': _this.data('thb-id')
			},
			beforeSend: function() {
				_this.addClass('disabled');
			},
			error: function(data) {
				_this.removeClass('disabled');
			},
			success: function(html) {
				var models = '';
				_.each(vc.filters.templates, function(callback) {
				    html = callback(html);
				});
				if ($('body').hasClass('compose-mode')) {
					models = vc.builder.parse( {}, html);
					_.delay( function() {
					    _.each( models, function (model) {
					        vc.builder.create(model);
					    } );
					    vc.builder.render();
					});
				} else {
					models = vc.storage.parseContent({}, html);
					_.each(models, function(model) {
					    vc.shortcodes.create(model);
					});
				}
				vc.closeActivePanel();
				_this.removeClass('disabled');
			}
		});
		return false;
	});

	$('.vc_templates-button').one( 'click' , function() {
		var total = 0;
		categories.each(function() {
			var _this = $(this),
					sort = _this.attr('data-sort'),
					count = $('.thb_template.'+ sort, template_container).length;

			total = total + count;
			_this.find('.count').html( count );
			categories.filter('[data-sort="all"]').find('.count').html( total );
		});
	});

	/* Template Sorting */
	categories.on('click', function(e){
		var _this = $(this),
				$selectedSort = _this.attr('data-sort');

    $('.thb_library_categories li').removeClass('active');
    _this.addClass('active');

    $('.thb_template', template_container ).removeClass('hidden');

    if($selectedSort !== 'all'){
       $('.thb_template:not(.'+$selectedSort+')').addClass('hidden');
    }
    return false;
  });

	/* Radio Image */
  $("body").on('change','.thb_radio_image_val',function(){
  	var _this = $(this),
  			id = _this.parents('.thb-radio-image').data("radio-image-id");
  	$("#thb-radio-image-" + id).val(_this.val()).trigger('change');
  });

	/* Image HotSpot */
	if (typeof vc !== 'undefined') {
		vc.atts.thb_hotspot_param = {
			init: function (param, $field) {

				var imgSrc = '',
						$imgInput = $field.prev().find('input[name="image"]'),
						previewImage = function() {
							if ($field.prev().find('img').length > 0) {
								var id = $field.find('.thb_hotspot_var').attr('id');

								imgSrc = $field.prev().find('img').attr('src');
								imgSrc = imgSrc.replace('-150x150', '', imgSrc);

								if ($field.find('img.thb-hotspot-image').length > 0) {
									$field.find('img.thb-hotspot-image').attr('src', imgSrc);
								} else {
									$field.find('.thb-hotspot-image-holder').removeClass('no-img');
									$field.find('.thb-hotspot-image-holder').append('<img src="'+imgSrc+'" alt="Preview image" class="thb-hotspot-image" />');
								}
								$field.find('.thb-hotspot-image-holder').hotspot({
									mode: 'admin',
									LS_Variable: '#'+id,
									hotspotClass: 'thb_hotspot',
									interactivity: false,
									popupTitle: $field.find('.thb-hotspot-image-holder').data('popup-title') ? $field.find('.thb-hotspot-image-holder').data('popup-title') : 'Save',
									saveText: $field.find('.thb-hotspot-image-holder').data('save-text') ? $field.find('.thb-hotspot-image-holder').data('save-text') : 'Save',
									closeText: $field.find('.thb-hotspot-image-holder').data('close-text') ? $field.find('.thb-hotspot-image-holder').data('close-text') : 'Close',
									dataStuff: [
										{
											'property': 'Product',
											'default': ''
										},
										{
											'property': 'Title',
											'default': 'Tooltip title'
										},
										{
											'property': 'Message',
											'default': 'Tooltip content goes here'
										},
										{
											'property': 'Position',
											'default': 'top'
										}
									]
								});
							}
						};

				previewImage();
				$imgInput.on('change', function() {
					previewImage();
				});
			},
		};
	}
});
