var $ = jQuery;
$.fn.exists = function () {
	return this.length !== 0;
};
//----------- cookie -----------//
function setCookie(name, value, date) {
	var path = 'path=/';
	if (typeof date !== 'undefined')
		date = date.toUTCString();
	else {var date = new Date; date.setDate( date.getDate() + 15 );}
	document.cookie = name + "=" + value +"; "+ path +"; "+ "expires="+date;
}
function getCookie(name) {
	var r = document.cookie.match("(^|;) ?" + name + "=([^;]*)(;|$)");
	if (r) return r[2];
	else return "";
}

$(function(){
	if ( $('.booking__form-field').exists() )
	{
		$.datetimepicker.setLocale('ru'); //TODO Check lang site
		$('.booking__form-field').datetimepicker({
			timepicker: false,
			format:	'Y-m-d',
		});
	}
	

	// modal
	$('.js-modalCallOpen').wmodal();
	$('.js-modalFeedOpen').wmodal({
		modal: '.js-modalFeed',
		over: '.js-modalFeedOver',
		back: '.js-modalFeedBack',
		close: '.js-modalFeedClose',
		animate: 1,
		animateOpen: 'fadeInDown',
		animateClose: 'fadeOutDown',
	});

	$('.rooms__item').addClass("invisible").viewportChecker({
		classToAdd: 'visible opacityanim',
		offset: 125
	});

	if ( $('.gallery__img').exists() )
	{
		$('.gallery__img').viewbox();
	}

	if (getCookie('show_modal') == '')
	{
		setCookie('show_modal', 1);
		wmodalOpen('#modalOffer', {
			modal: '.js-modalOffer',
			over: '.js-modalOfferOver',
			back: '.js-modalOfferBack',
			close: '.js-modalOfferClose',
			animate: 1,
			animateOpen: 'fadeInDown',
			animateClose: 'fadeOutDown',
		});
	}

	if ($('.main-carousel').exists()) 
	{
		var $carousel = $('.main-carousel').flickity({
			cellAlign: 'left',
			contain: true,
			wrapAround: true,
			freeScroll: false,
			pageDots: false,
			percentPosition: false,
			prevNextButtons: false,
			draggable: true,
			autoPlay: 8000,
			pauseAutoPlayOnHover: true
		});
		var flkty = $carousel.data('flickity');
		// elements
		var $cellButtonGroup = $('.slider__controls-wrapper');
		var $cellButtons = $cellButtonGroup.find('button');

		// update selected cellButtons
		$carousel.on( 'select.flickity', function() {
			$cellButtons.filter('.slider__controls-item--active').removeClass('slider__controls-item--active');
			$cellButtons.eq( flkty.selectedIndex ).addClass('slider__controls-item--active');
		});

		// select cell on button click
		$cellButtonGroup.on( 'click', 'button', function() {
			var index = $(this).index();
			$carousel.flickity( 'select', index );
		});
				
	}

});

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

function wmodalSet(o){
	return $.extend({
		modal: '.js-modalCall',
		over: '.js-modalCallOver',
		back: '.js-modalCallBack',
		close: '.js-modalCallClose',
		animate: 1,
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

// modal open
(function($) {
	
})(jQuery);