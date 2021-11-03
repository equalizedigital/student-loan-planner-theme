var menuToggle = document.querySelector('.menu-toggle');
var headerSearch = document.querySelector('.header-search');
var navMenu = document.querySelector('.nav-menu');
var subMenu = document.querySelectorAll('.menu-item-has-children > .submenu-expand');
var searchToggle = document.querySelectorAll('.search-toggle');
var searchField = document.querySelector('.header-search .search-field');

// Mobile Menu toggle
menuToggle.addEventListener('click', function(e) {
	for( i = 0, len = searchToggle.length; i < len; i++ ) {
		searchToggle[i].classList.remove('active');
	}

	if( headerSearch ) {
		headerSearch.classList.remove('active');
	}
	navMenu.classList.toggle('active');
	this.classList.toggle('active');
});


// Menu item toggle
for( var i = 0, len = subMenu.length; i < len; i++ ) {
	subMenu[i].addEventListener('click', function(e) {
		this.classList.toggle('expanded');
		e.preventDefault();
	});
};


// Search toggle
for( var i = 0, len = searchToggle.length; i < len; i++ ) {
	searchToggle[i].addEventListener('click', function(e) {
		if ( headerSearch ) {
			menuToggle.classList.remove('active');
			navMenu.classList.remove('active');
			this.classList.toggle('active');
			headerSearch.classList.toggle('active');
			searchField.focus();
		} else {
			document.dispatchEvent(new CustomEvent('slick-show-discovery'));
		}
	});
}

// Sticky Header
jQuery(function($){

	function navbarheight() {
		return $('.site-header').height();
	}

	// Header Scroll
	var didScroll = false,
		lastScrollTop = 0,
		delta = 5,
		navbarHeight = navbarheight();

	$(window).scroll(function(){
		didScroll = true;
	});

	setInterval(function() {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();

		// Make sure they scroll more than delta
		if(Math.abs(lastScrollTop - st) <= delta)
			return;

		if( st > navbarHeight ) {

			if (st > lastScrollTop && ! $('.site-header .nav-menu').hasClass('active') ){
				// Scroll Down
				$('body').removeClass('nav-down').addClass('nav-up');
			} else {
				// Scroll Up
				if(st + $(window).height() < $(document).height()) {
					$('body').removeClass('nav-up').addClass('nav-down');
				}
			}

		} else {
			$('body').removeClass('nav-down').removeClass('nav-up');
		}
		lastScrollTop = st;
	}

	$('.backtotop').click(function(){
		$('body').removeClass('nav-up').removeClass('nav-down');
	});
});
