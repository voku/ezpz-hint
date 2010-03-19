// EZPZ Hint v1.1.1; Copyright (c) 2009 Mike Enriquez, http://theezpzway.com; Released under the MIT License
(function($){
	$.fn.ezpz_hint = function(options, focus_callback, blur_callback){
		var defaults = {
			hintClass: 'ezpz-hint',
			hintName: 'ezpz_hint_dummy_input'
		};
		var settings = $.extend(defaults, options);
		
		return this.each(function(i){
			var id = settings.hintName + '_' + i;
			var hint;
			var dummy_input;
                        var text;
                        var ctrl_type;
			
			// grab the input's title attribute
			text = $(this).attr('title');
                        //extract the control type, can't use ctrl.attr('type') because opera returns text for search boxes
                        var typeRegex = /type="(\w+)"/
                        var regexResult = typeRegex.exec(ctrl.attr('outerHTML'))
                        if (regexResult) //ie6 doens't support regex exec'
                        {
                                ctrl_type = regexResult[1]
                        } else {
                                ctrl_type = ctrl.attr('type');
                        }

			// create a dummy input and place it before the input
			$('<input type="' + ctrl_type + '" id="' + id + '" value="" />')
				.insertBefore($(this));
			
			// set the dummy input's attributes
			hint = $(this).prev('input:first');
			hint.attr('class', $(this).attr('class'));

                        //some browsers don't support the size attrib
                        var inputsize = $(this).attr('size')
                        if (typeof(inputsize) == 'number' && inputsize > 0)
                        { hint.attr('size',inputsize); }
                        else { hint.attr('width', $(this).css('width'));}

			hint.attr('autocomplete', 'off');
			hint.attr('tabIndex', $(this).attr('tabIndex'));
			hint.addClass(settings.hintClass);
			hint.val(text);
			
			// hide the input
			$(this).hide();
			
			// don't allow autocomplete (sorry, no remember password)
			$(this).attr('autocomplete', 'off');
			
			// bind focus event on the dummy input to swap with the real input
			hint.focus(function(){
				dummy_input = $(this);
				$(this).next('input:first').show();
				$(this).next('input:first').focus();
				$(this).next('input:first').unbind('blur').blur(function(){
					if ($(this).val() == '') {
						$(this).hide();
						dummy_input.show();
                                                blur_callback();
					}
				});
				$(this).hide();
                                focus_callback();
			});
			
			// swap if there is a default value
			if ($(this).val() != ''){
				hint.focus();
			}
		});
		
	};
})(jQuery);