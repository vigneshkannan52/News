jQuery( function() {
		
	// Search toggle.
	var searchbutton = jQuery('.search-toggle');
	var searchbuttonX = jQuery('.header-search-x');

	searchbutton.on( 'click', function() {
		jQuery('.header-search-nav').toggleClass("show");
		jQuery('.search-navigation').toggleClass("focus");

	} );
	searchbuttonX.on( 'click', function() {
		jQuery('.header-search-nav').removeClass("show");
		jQuery('.search-navigation').removeClass("focus");
		searchbutton.focus();
	} );

	// Add class
	jQuery( function() {
		var jQuerymuse = jQuery("#page div");
		var jQuerysld = jQuery("body");

		if (jQuerymuse.hasClass("main-slider")) {
			   jQuerysld.addClass("sld-plus");
		}
	});

	// Tab Content
	jQuery(document).ready(function() {

	  var jQuerywrapper = jQuery('.tab-wrapper'),
		  jQueryallTabs = jQuerywrapper.find('.tabs-container > .tab-content'),
		  jQuerytabMenu = jQuerywrapper.find('.tab-menu button')

		  jQueryallTabs.not(':first-of-type').hide();
	  
	  jQuerytabMenu.each(function(i) {
		jQuery(this).attr('data-tab', 'tab'+i);
	  });
	  
	  jQueryallTabs.each(function(i) {
		jQuery(this).attr('data-tab', 'tab'+i);
	  });
	  
	  jQuerytabMenu.on('click', function() {
		
		var dataTab = jQuery(this).data('tab'),
			jQuerygetWrapper = jQuery(this).closest(jQuerywrapper);
		
		jQuerygetWrapper.find(jQuerytabMenu).removeClass('active');
		jQuery(this).addClass('active');
		
		jQuerygetWrapper.find(jQueryallTabs).hide();
		jQuerygetWrapper.find(jQueryallTabs).filter('[data-tab='+dataTab+']').show();
	  });

	});//end Tab

	// Menu toggle for below 981px screens.
	( function() {
		var togglenav = jQuery( '.main-navigation' ), button, menu;
		if ( ! togglenav ) {
			return;
		}

		button = togglenav.find( '.menu-toggle' );
		if ( ! button ) {
			return;
		}
		
		menu = togglenav.find( '.menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		jQuery( '.menu-toggle' ).on( 'click', function() {
			jQuery(this).toggleClass("on");
			togglenav.toggleClass( 'toggled-on' );
		} );
	} )();

	// Top Menu toggle for below 981px screens.
	( function() {
		var togglenav = jQuery( '.top-bar-menu' ), button, menu;
		if ( ! togglenav ) {
			return;
		}

		button = togglenav.find( '.top-menu-toggle' );
		if ( ! button ) {
			return;
		}
		
		menu = togglenav.find( '.top-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		jQuery( '.top-menu-toggle' ).on( 'click', function() {
			jQuery(this).toggleClass("on");
			togglenav.toggleClass( 'toggled-on' );
		} );
	} )();

	jQuery( function() {
		if(jQuery( window ).width() < 981){
			//responsive sub menu toggle
			jQuery('#site-navigation .menu-item-has-children, #site-navigation .page_item_has_children').prepend('<button class="sub-menu-toggle"> <i class="fa fa-plus"></i> </button>');
			jQuery(".main-navigation .menu-item-has-children ul, .main-navigation .page_item_has_children ul").hide();
			jQuery(".main-navigation .menu-item-has-children > .sub-menu-toggle, .main-navigation .page_item_has_children > .sub-menu-toggle").on('click', function () {
				jQuery(this).parent(".main-navigation .menu-item-has-children, .main-navigation .page_item_has_children").children('ul').first().slideToggle();
				jQuery(this).children('.fa-plus').first().toggleClass('fa-minus');
				
			});
		}
	});

	// Menu toggle for side nav.
	jQuery(document).ready( function() {
	  //when the button is clicked
	  jQuery(".show-menu-toggle, .hide-menu-toggle, .page-overlay").click( function() {
		//apply toggleable classes
		jQuery(".side-menu").fadeToggle('fast');
		jQuery(".side-menu").addClass("show");
		jQuery(".page-overlay").toggleClass("side-menu-open"); 
		jQuery("#page").addClass("side-content-open");  
	  });
	  
	  jQuery(".hide-menu-toggle, .page-overlay").click( function() {
		jQuery(".side-menu").removeClass("show");
		jQuery(".page-overlay").removeClass("side-menu-open");
		jQuery("#page").removeClass("side-content-open");
	  });
	});

	// Breaking News.
	jQuery('.marquee').marquee({
		//duration in milliseconds of the marquee
		duration: 15000,
		//gap in pixels between the tickers
		gap: 50,
		//time in milliseconds before the marquee will start animating
		delayBeforeStart: 0,
		//'left' or 'right'
		direction: 'left',
		//true or false - should the marquee be duplicated to show an effect of continues flow
		duplicated: true
	});

	// Header search
	searchbutton.on("click", function(n) {
		if (jQuery(this).attr('aria-expanded') == 'false' ) {
			searchbutton.focus();
		} else {
			jQuery(".search-box input.search-field").focus();
			n.preventDefault();
			var t, a, c, o = document.querySelector(".search-box");
			let e = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])',
				m = document.querySelector(".search-field"),
				u = o.querySelectorAll(e),
				r = u[u.length - 1];
			if (!o) return !1;
			for (a = 0, c = (t = o.getElementsByTagName("button")).length; a < c; a++) t[a].addEventListener("focus", l, !0), t[a].addEventListener("blur", l, !0);

			function l() {
				for (var e = this; - 1 === e.className.indexOf("search-box");) "*" === e.tagName.toLowerCase() && (-1 !== e.className.indexOf("focus") ? e.className = e.className.replace("focus", "") : e.className += " focus"), e = e.parentElement
			}
			document.addEventListener("keydown", function(e) {
				("Tab" === e.key || 9 === e.keyCode) && (e.shiftKey ? document.activeElement === m && (r.focus(), e.preventDefault()) : document.activeElement === r && (m.focus(), e.preventDefault()))
			})
		}
	});
	

	// Go to top button.
	jQuery(document).ready(function(){

	// Hide Go to top icon.
	jQuery(".go-to-top").hide();

	  jQuery(window).scroll(function(){

		var windowScroll = jQuery(window).scrollTop();
		if(windowScroll > 900)
		{
		  jQuery('.go-to-top').fadeIn();
		}
		else
		{
		  jQuery('.go-to-top').fadeOut();
		}
	  });

	  // scroll to Top on click
	  jQuery('.go-to-top').click(function(){
		jQuery('html,header,body').animate({
			scrollTop: 0
		}, 700);
		return false;
	  });

	});

} );