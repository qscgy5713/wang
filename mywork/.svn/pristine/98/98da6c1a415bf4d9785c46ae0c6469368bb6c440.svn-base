/* Style Switcher
 * Version:1.2.0
 * File Description: Style Switcher
 */

jQuery(document).ready(function($) {

		//SIDE PANEL 
		//--------------------------------------------------------
		style_switcher = $('.style-switcher'),
		panelWidth = style_switcher.outerWidth(true);
			
		$('.style-switcher .trigger').on("click", function(){
			var $this = $(this);
			if ($(".style-switcher.closed").length>0) {
				style_switcher.animate({"left" : "0px"});
				$(".style-switcher.closed").removeClass("closed");
				$(".style-switcher").addClass("opened");
				$(".style-switcher .trigger i").removeClass("fa fa-cog").addClass("fa fa-times");
			} else {
				$(".style-switcher.opened").removeClass("opened");
				$(".style-switcher").addClass("closed");
				$(".style-switcher .trigger i").removeClass("fa fa-times").addClass("fa fa-cog");
				style_switcher.animate({"left" : '-' + panelWidth});
			}
			return false;
		});
		
		// style change 
		var link = $('link[data-style="styles"]'),
		link_no_cookie = $('link[data-style="styles-no-cookie"]');

		// resume last chosen style
		var tp_stylesheet = 'light_blue',
			footer_bg = 'light',
			tp_layout_mode = 'wide',		
			pattern;

		$(".style-switcher .selected").removeClass("selected");

		if (link.length>0) {
			link.attr('href','css/skins/' + tp_stylesheet + '.css');
			$('.style-switcher .styleChange li[data-style="'+tp_stylesheet+'"]').addClass("selected");
			if ($(".header-page-dark").length>0) {
				document.getElementById("logo_img").src="images/logo_dark_header_" + tp_stylesheet + ".png";
			} else {
				if ($("#logo_img").length>0) {
					document.getElementById("logo_img").src="images/logo_" + tp_stylesheet + ".png";
				};
				if ($("#logo-footer").length>0) {
					document.getElementById("logo-footer").src="images/logo_" + tp_stylesheet + ".png";
				};
			};
		};

		if (tp_layout_mode=="boxed") {
			$("body").addClass(tp_layout_mode);
			$("body").removeClass("wide");
			$('.style-switcher .layoutChange li[data-style="boxed"]').addClass("selected");
			$('.style-switcher .layoutChange li[data-style="wide"]').removeClass("selected");
		} else { 
			$("body").addClass(tp_layout_mode);
			$("body").removeClass("boxed pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9");
			$('.style-switcher .layoutChange li[data-style="boxed"]').removeClass("selected");
			$('.style-switcher .layoutChange li[data-style="wide"]').addClass("selected");
		};

		if ((tp_layout_mode =="boxed")) {
			$('.style-switcher .patternChange li[data-style="'+pattern+'"]').addClass("selected");
			$("body").removeClass("pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9 wide");
			$("body").addClass(pattern); 
		} else if (tp_layout_mode =="boxed") {
			$("body").removeClass("pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9");
			$('.style-switcher .patternChange li[data-style="pattern-0"]').addClass("selected");
		} else {
			$('.style-switcher .patternChange li.selected').removeClass("selected");
			$("body").removeClass("pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9 boxed");
		};

		if (footer_bg=="dark") {
			$("#footer").removeClass("light");
			$('.style-switcher .footerChange li[data-style="dark"]').addClass("selected");
			$('.style-switcher .footerChange li[data-style="light"]').removeClass("selected");
		} else { 
			$("#footer").addClass("light");
			$('.style-switcher .footerChange li[data-style="dark"]').removeClass("selected");
			$('.style-switcher .footerChange li[data-style="light"]').addClass("selected");
		};


		// switch colors
		$('.style-switcher .styleChange li').on('click',function(){
			if (link.length>0) {
				var $this = $(this),
					tp_stylesheet = $this.data('style');
				$(".style-switcher .styleChange .selected").removeClass("selected");
				$this.addClass("selected");
				link.attr('href', 'css/skins/' + tp_stylesheet + '.css');
				if ($(".header-page-dark").length>0) {
					document.getElementById("logo_img").src="images/logo_dark_header_" + tp_stylesheet + ".png";
				} else {
					if ($("#logo_img").length>0) {
						document.getElementById("logo_img").src="images/logo_" + tp_stylesheet + ".png";
					};
					if ($("#logo-footer").length>0) {
						document.getElementById("logo-footer").src="images/logo_" + tp_stylesheet + ".png";
					};
				};
			} else {
				var $this = $(this),
					tp_stylesheet_no_cookie = $this.data('style');
				$(".style-switcher .styleChange .selected").removeClass("selected");
				$this.addClass("selected");
				link_no_cookie.attr('href', 'css/skins/' + tp_stylesheet_no_cookie + '.css');
				if ($(".header-page-dark").length>0) {
					document.getElementById("logo_img").src="images/logo_dark_header_" + tp_stylesheet_no_cookie + ".png";
				} else {
					if ($("#logo_img").length>0) {
						document.getElementById("logo_img").src="images/logo_" + tp_stylesheet_no_cookie + ".png";
					};
					if ($("#logo-footer").length>0) {
						document.getElementById("logo-footer").src="images/logo_" + tp_stylesheet_no_cookie + ".png";
					};
				};
			};
		});

		// switch patterns
		$('.style-switcher .patternChange li').on('click',function(){
		var $this = $(this),
			pattern = $this.data('style');
		$(".style-switcher .patternChange .selected").removeClass("selected");
		$this.addClass("selected");
		$("body").removeClass("pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9 wide");
		$("body").addClass(pattern);
		$("body").addClass("boxed");
		$('.style-switcher .layoutChange li[data-style="boxed"]').addClass("selected");
		$('.style-switcher .layoutChange li[data-style="wide"]').removeClass("selected");
		$(".owl-carousel .container").css("marginLeft", "0");
		$(".style-switcher select").val("boxed");
		});

		// Switch layout
		// Boxed Layout
		$('.style-switcher .layoutChange li.boxed').on('click',function(){ 
			$("body").addClass("boxed");
			$("body").removeClass("wide");
			$('.style-switcher .layoutChange li[data-style="boxed"]').addClass("selected");
			$('.style-switcher .layoutChange li[data-style="wide"]').removeClass("selected");
			$(".owl-carousel .container").css("marginLeft", "0");
			if ($(pattern).length>0) {
				$('.style-switcher .patternChange li[data-style="'+pattern+'"]').addClass("selected");
				$("body").removeClass("pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9");
				$("body").addClass(pattern);
			} else {
				$('.style-switcher .patternChange li[data-style="pattern-0"]').addClass("selected");
			}
		});

		// Wide Layout
		$('.style-switcher .layoutChange li.wide').on('click',function(){ 
			$("body").addClass("wide");
			$("body").removeClass("boxed pattern-0 pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9");
			$('.style-switcher .layoutChange li[data-style="boxed"]').removeClass("selected");
			$('.style-switcher .layoutChange li[data-style="wide"]').addClass("selected");
			$(".owl-carousel .container").css("marginLeft", "auto");
			$('.style-switcher .patternChange li.selected').removeClass("selected");
		});

		// Footer bg
		$('.style-switcher .footerChange li.dark').on('click',function(){ 
			$("#footer").removeClass("light");
			$('.style-switcher .footerChange li[data-style="dark"]').addClass("selected");
			$('.style-switcher .footerChange li[data-style="light"]').removeClass("selected");
		});

		$('.style-switcher .footerChange li.light').on('click',function(){ 
			$("#footer").addClass("light");
			$('.style-switcher .footerChange li[data-style="dark"]').removeClass("selected");
			$('.style-switcher .footerChange li[data-style="light"]').addClass("selected");
		});

		//Reset All
		$('.style-switcher .resetAll li.btn-dark').on('click',function() { 
			// footer bg
			$("#footer").removeClass("light");
			$('.style-switcher .footerChange li[data-style="dark"]').addClass("selected");
			$('.style-switcher .footerChange li[data-style="light"]').removeClass("selected");
			// layout mode
			$("body").addClass("wide");
			$("body").removeClass("boxed");
			$('.style-switcher .layoutChange li[data-style="boxed"]').removeClass("selected");
			$('.style-switcher .layoutChange li[data-style="wide"]').addClass("selected");
			$(".owl-carousel .container").css("marginLeft", "auto");
			$('.style-switcher .patternChange li.selected').removeClass("selected");
			//pattern
			$("body").removeClass("reset pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9");
			$(".style-switcher .patternChange .selected").removeClass("selected");
			//Stylesheet
			$('.style-switcher .styleChange li.selected').removeClass("selected");
			$('.style-switcher .styleChange li[data-style="'+tp_stylesheet+'"]').addClass("selected");
			link.attr('href', 'css/skins/' + tp_stylesheet + '.css');
			if ($("#logo_img").length>0) {
				document.getElementById("logo_img").src="images/logo_" + tp_stylesheet + ".png";
			};
			if ($("#logo-footer").length>0) {
				document.getElementById("logo-footer").src="images/logo_" + tp_stylesheet + ".png";
			};
		});

});    	