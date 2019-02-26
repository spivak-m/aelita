$(function(){
		// modal
		$('.js-modalCallOpen').wmodal();
	});
	// modal open
	(function($) {
		function wmodalSet(o){
			return $.extend({
				modal: '.js-modalCall',
				over: '.js-modalCallOver',
				back: '..js-modalCallBack',
				close: '.js-modalCall',
				animate: 0,
				animateOpen: 'fadeInDown',
				animateClose: 'fadeOutDown',
			}, o);
		}
		function wmodalOpen(e, o){
			var e = typeof e == 'string' ? $(e) : $($(e).attr('href')),
				over = e.closest(o.over);
			wmodalOver(e, o);
			$('body').css({'overflow-y': 'hidden'});
			over.find(o.close+', '+o.back).click(function() {
				wmodalClose(e, o);
				return false;
			});
			over.fadeIn('fast', function(){
				e.removeAttr('style').removeClass(o.animateClose).fadeIn().addClass('is-active '+o.animateOpen);
			});
		}
		function wmodalClose(e, o){
			var e = $(o.modal),
				over = $(o.over);
			$('body').css({'overflow-y': 'auto'});
			e.removeClass('is-active '+o.animateOpen).addClass(o.animateClose);
			e.fadeOut('fast',function(){
				over.fadeOut('fast');
			});
		}
		function wmodalOver(e, o){
			if (e.closest(o.over).find(o.back).length < 1){
				e.closest(o.over).append('<div class="'+o.back.substr(1)+'"></div>');
			}
		}
		$.fn.wmodal = function(s){
			var o = wmodalSet(s),
				sel = this.selector;
			o.animateOpen = o.animate ? 'animated '+o.animateOpen : '';
			o.animateClose = o.animate ? 'animated '+o.animateClose : '';
			if (typeof s == 'string' && s == 'close')
				wmodalClose(sel, o)
			else if (sel.charAt(0) == '#' && this.length > 0)
				wmodalOpen(sel, o);
			else 
				$(this).click(function(){
					wmodalOpen(this, o);
					return false;
				});
		}
})(jQuery);