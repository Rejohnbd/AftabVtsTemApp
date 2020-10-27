(function($) {
	"use strict";
	

	/*PMboYSIqMee+p4uAjskftSrErYaF9PDNDn+EGSzR9N2BspYI8=
feCz66HNQhyoUIndT6pXQpWta+PA3e1h3yExMyH1EsOo6f8PXnNPyHGLRfchOSF9WSX7exs=*/
	// ______________Full screen
	$("#fullscreen-button").on("click", function toggleFullScreen() {
		if ((document.fullScreenElement !== undefined && document.fullScreenElement === null) || (document.msFullscreenElement !== undefined && document.msFullscreenElement === null) || (document.mozFullScreen !== undefined && !document.mozFullScreen) || (document.webkitIsFullScreen !== undefined && !document.webkitIsFullScreen)) {
			if (document.documentElement.requestFullScreen) {
				document.documentElement.requestFullScreen();
			} else if (document.documentElement.mozRequestFullScreen) {
				document.documentElement.mozRequestFullScreen();
			} else if (document.documentElement.webkitRequestFullScreen) {
				document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
			} else if (document.documentElement.msRequestFullscreen) {
				document.documentElement.msRequestFullscreen();
			}
		} else {
			if (document.cancelFullScreen) {
				document.cancelFullScreen();
			} else if (document.mozCancelFullScreen) {
				document.mozCancelFullScreen();
			} else if (document.webkitCancelFullScreen) {
				document.webkitCancelFullScreen();
			} else if (document.msExitFullscreen) {
				document.msExitFullscreen();
			}
		}
	})
	
	// ______________ Color-skin
	$(document).on("click", "a[data-theme]", function(e) {
        $("head link#theme").attr("href", $(this).data("theme"));
        $(this).toggleClass('active').siblings().removeClass('active');
    });
	
	
	// ______________Active Class
	$(document).ready(function() {
		$(".horizontalMenu-list li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".horizontal-megamenu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
		$(".horizontalMenu-list .sub-menu .sub-menu li a").each(function() {
			var pageUrl = window.location.href.split(/[?#]/)[0];
			if (this.href == pageUrl) {
				$(this).addClass("active");
				$(this).parent().addClass("active"); // add active to li of the current link
				$(this).parent().parent().parent().parent().prev().addClass("active"); // add active class to an anchor
				$(this).parent().parent().prev().click(); // click the item to make it drop
			}
		});
	});
	
	
	// ______________ PAGE LOADING
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})
	
	// ______________ BACK TO TOP BUTTON
	$(window).on("scroll", function(e) {
		if ($(this).scrollTop() > 0) {
			$('#back-to-top').fadeIn('slow');
		} else {
			$('#back-to-top').fadeOut('slow');
		}
	});
	$("#back-to-top").on("click", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	// ______________ COVER IMAGE
	$(".cover-image").each(function() {
		var attr = $(this).attr('data-image-src');
		if (typeof attr !== typeof undefined && attr !== false) {
			$(this).css('background', 'url(' + attr + ') center center');
		}
	});
	
	// ______________ RATING STAR
	var ratingOptions = {
		selectors: {
			starsSelector: '.rating-stars',
			starSelector: '.rating-star',
			starActiveClass: 'is--active',
			starHoverClass: 'is--hover',
			starNoHoverClass: 'is--no-hover',
			targetFormElementSelector: '.rating-value'
		}
	};
	$(".rating-stars").ratingStars(ratingOptions);
	
	
	// ______________Chart-circle
	if ($('.chart-circle').length) {
		$('.chart-circle').each(function() {
			let $this = $(this);
			$this.circleProgress({
				fill: {
					color: $this.attr('data-color')
				},
				size: $this.height(),
				startAngle: -Math.PI / 4 * 2,
				emptyFill: 'rgba(89, 92, 115, 0.2)',
				lineCap: 'round'
			});
		});
	}
	
	// ______________ GLOBAL SEARCH
	$(document).on("click", "[data-toggle='search']", function(e) {
		var body = $("body");

		if(body.hasClass('search-gone')) {
			body.addClass('search-gone');
			body.removeClass('search-show');
		}else{
			body.removeClass('search-gone');
			body.addClass('search-show');
		}
	});
	var toggleSidebar = function() {
		var w = $(window);
		if(w.outerWidth() <= 1024) {
			$("body").addClass("sidebar-gone");
			$(document).off("click", "body").on("click", "body", function(e) {
				if($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
					$("body").removeClass("sidebar-show");
					$("body").addClass("sidebar-gone");
					$("body").removeClass("search-show");
				}
			});
		}else{
			$("body").removeClass("sidebar-gone");
		}
	}
	toggleSidebar();
	$(window).resize(toggleSidebar);
	
	/** Constant div card */
	const DIV_CARD = 'div.card';
	/** Initialize tooltips */
	$('[data-toggle="tooltip"]').tooltip();
	/** Initialize popovers */
	$('[data-toggle="popover"]').popover({
		html: true
	});
	
	// ______________ FUNCTION FOR REMOVE CARD
	$('[data-toggle="card-remove"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.remove();
		e.preventDefault();
		return false;
	});
	
	// ______________ FUNCTIONS FOR COLLAPSED CARD
	$('[data-toggle="card-collapse"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	/*PMboYSIqMee+p4uAjskftSrErYaF9PDNDn+EGSzR9N2BspYI8=
feCz66HNQhyoUIndT6pXQpWta+PA3e1h3yExMyH1EsOo6f8PXnNPyHGLRfchOSF9WSX7exs=*/
	// ______________ CARD FULL SCREEN
	$('[data-toggle="card-fullscreen"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);
		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');
		e.preventDefault();
		return false;
	});
	
	
	// ______________Skins
	
	/*//////////////////// Header skins  //////////////////////*/
	
	//$('body').addClass("default-header"); // 
	
	// $('body').addClass("light-header"); //
	
	/*//////////////////// Horizontal skins  //////////////////////*/
	
	//$('body').addClass("light-hor");  //
	
	// $('body').addClass("color-hor"); //
	
	// $('body').addClass("dark-hor"); //
	
	/*//////////////////// Toggle-Left-menu skins  //////////////////////*/
	
	//$('body').addClass("dark-leftmenu"); // 
	
	//$('body').addClass("light-leftmenu"); // 
	
	//$('body').addClass("color-leftmenu"); // 
	
	//$('body').addClass("menu-style1"); // 
	
	
	
	
	// ______________ SWITCHER-toggle1
	
	/*Header Switcher*/
	$('#myonoffswitch').click(function () {    
		if (this.checked) {
			$('body').addClass('default-header');
			$('body').removeClass('light-header');
			localStorage.setItem("default-header", "True");
		}
		else {
			$('body').removeClass('default-header');
			localStorage.setItem("default-header", "false");
		}
	});
	$('#myonoffswitch1').click(function () {    
		if (this.checked) {
			$('body').addClass('light-header');
			$('body').removeClass('default-header');
			localStorage.setItem("light-header", "True");
		}
		else {
			$('body').removeClass('light-header');
			localStorage.setItem("light-header", "false");
		}
	});
	
	/*Horizontal-menu Switcher*/
	$('#myonoffswitch2').click(function () {    
		if (this.checked) {
			$('body').addClass('light-hor');
			$('body').removeClass('color-hor');
			$('body').removeClass('dark-hor');
			localStorage.setItem("light-hor", "True");
		}
		else {
			$('body').removeClass('light-hor');
			localStorage.setItem("light-hor", "false");
		}
	});
	$('#myonoffswitch3').click(function () {    
		if (this.checked) {
			$('body').addClass('color-hor');
			$('body').removeClass('default-hor');
			$('body').removeClass('dark-hor');
			localStorage.setItem("color-hor", "True");
		}
		else {
			$('body').removeClass('color-hor');
			localStorage.setItem("color-hor", "false");
		}
	});
	$('#myonoffswitch4').click(function () {    
		if (this.checked) {
			$('body').addClass('dark-hor');
			$('body').removeClass('color-hor');
			$('body').removeClass('light-hor');
			localStorage.setItem("dark-hor", "True");
		}
		else {
			$('body').removeClass('dark-hor');
			localStorage.setItem("dark-hor", "false");
		}
	});	
	
	/*Left-menu Switcher*/
	$('#myonoffswitch5').click(function () {    
		if (this.checked) {
			$('body').addClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('color-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("dark-leftmenu", "True");
		}
		else {
			$('body').removeClass('dark-leftmenu');
			localStorage.setItem("dark-leftmenu", "false");
		}
	});	
	$('#myonoffswitch6').click(function () {    
		if (this.checked) {
			$('body').addClass('light-leftmenu');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('color-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("light-leftmenu", "True");
		}
		else {
			$('body').removeClass('light-leftmenu');
			localStorage.setItem("light-leftmenu", "false");
		}
	});	
	$('#myonoffswitch7').click(function () {    
		if (this.checked) {
			$('body').addClass('color-leftmenu');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('menu-style1');
			localStorage.setItem("color-leftmenu", "True");
		}
		else {
			$('body').removeClass('color-leftmenu');
			localStorage.setItem("color-leftmenu", "false");
		}
	});	
	$('#myonoffswitch8').click(function () {    
		if (this.checked) {
			$('body').addClass('menu-style1');
			$('body').removeClass('dark-leftmenu');
			$('body').removeClass('light-leftmenu');
			$('body').removeClass('color-leftmenu');
			localStorage.setItem("menu-style1", "True");
		}
		else {
			$('body').removeClass('menu-style1');
			localStorage.setItem("menu-style1", "false");
		}
	});
	
})(jQuery);
