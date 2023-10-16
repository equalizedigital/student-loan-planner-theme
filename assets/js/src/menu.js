/**
 * An accessible menu for WordPress
 */

(function ($) {
	const nav = $("#main-navigation");
	const navIcon = $("#nav-icon");
	let mobileToggle = $('.zight-mobile-tab-toggle');

	// Select all links with hashes
	$('a[href*="#"]')
		// Remove links that don't actually link to anything
		.not('[href="#"]')
		.not('[href="#0"]')
		.not('[href="#main-content"]')
		.not('.features_buttons_acc a')
		.click(function (event) {
			// On-page links
			if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
				&&
				location.hostname == this.hostname
			) {
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000, function () {
						// Callback after animation
						// Must change focus!
						var $target = $(target);
						$target.focus();
						if ($target.is(":focus")) { // Checking if the target was focused
							return false;
						} else {
							$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
							$target.focus(); // Set focus again
						}
					});
				}
			}
		});


	//   main menu link toggle 
	document.addEventListener("DOMContentLoaded", function () {

		var sideHeader = document.querySelectorAll('.site-header');
		var backButtons = document.querySelectorAll(".sub_menu_back");

		backButtons.forEach(function (button) {
			button.addEventListener("click", function (e) {
				e.preventDefault();
				var parentSubMenu = this.closest('.sub_menu');

				var siblingMainLink =  $(parentSubMenu).parent().find('.menu-item-main-link'); 
				if (siblingMainLink.length) {
					siblingMainLink.focus();
				}

				if (parentSubMenu) {
					parentSubMenu.classList.remove("active");
				}
				sideHeader.forEach(function (element) {
					element.classList.remove('site-header-active');
				});
			});
		});

		if ($(window).innerWidth() >= 768) {
			$('#menu_search_btn').on('click', function() {
				var $popup = $('.search-popup');
				if ($popup.length) {
					$popup.addClass('active');
					$(this).attr('aria-expanded', 'true');
					$('#modal_search').focus();
				}
			});
			
			$('#modal_search').on('input', function() {
				var $popup = $('.search-popup');
				if ($popup.length) {
					$popup.addClass('input-active');
				}
			});
		
			$('#close-search').on('click', function() {
				var $popup = $('.search-popup');
				if ($popup.length) {
					$popup.removeClass('active');
					$('#menu_search_btn').attr('aria-expanded', 'false');
					$('#menu_search_btn').focus();
				}
			});
		}
		


	});


	if ($(window).innerWidth() <= 768) {
		var $mainLinks = $(".menu-item-main-link");
		var $sideHeader = $('.site-header');

		$mainLinks.on("click", function (e) {
			e.preventDefault();

			if($(this).hasClass('menu-item-no-drop') == false){
				$(this).toggleClass("active");
				$(this).parent().toggleClass("active");
	
				// Toggle class on the sibling with class .sub_menu
				var $siblingSubMenu = $(this).siblings(".sub_menu");
				if ($siblingSubMenu.length) {
					$siblingSubMenu.toggleClass("active");
				}
	
				$sideHeader.toggleClass('site-header-active');

				let menuColumn = $(this).siblings(".sub_menu").find('.menu-column'); // Assuming .menu-column is the next sibling

				let firstFocusableItem = menuColumn.find('a[href], button:not([disabled])').first();

				if (firstFocusableItem.length) {
					firstFocusableItem.focus();
				}
			}


			

		});
	}

	document.querySelector('.mobile_help_btn .btn').addEventListener('keydown', function(event) {
		if (event.key === 'Tab') {
			event.preventDefault();

			/*
			* Menu Toggle
			*/
				$('.site-header').removeClass('site-header-active');
				$('.menu-item-main-link').removeClass("active");
				$('.main-nav-link-li').removeClass("active");
				var activeSubMenus = document.querySelectorAll('.sub_menu.active');
				activeSubMenus.forEach(function (element) {
					element.classList.remove('active');
				});


				$(navIcon).toggleClass("open");
				$(navIcon).attr("aria-expanded") === "false"
					? $(navIcon).attr("aria-expanded", "true")
					: $(navIcon).attr("aria-expanded", "false");

				!nav.hasClass("menu-mobile-open")
					? nav.toggleClass("menu-mobile-open")
					: false;

				//Fix the weird behaviour
				$(window).scrollTop() > 40
					? $("#header-top").toggle()
					: $("#header-top").slideToggle();

				$(".primary-navigation").toggleClass("active");

				$("html, body").animate({ scrollTop: $(window).scrollTop() }, 100);
				$("html").toggleClass("overflow-hidden");
		}
	});
	



	/*
	 * Menu Toggle
	 */
	navIcon.click(function () {
		$('.site-header').removeClass('site-header-active');
		$('.menu-item-main-link').removeClass("active");
		$('.main-nav-link-li').removeClass("active");
		var activeSubMenus = document.querySelectorAll('.sub_menu.active');
		activeSubMenus.forEach(function (element) {
			element.classList.remove('active');
		});


		$(this).toggleClass("open");
		$(this).attr("aria-expanded") === "false"
			? $(this).attr("aria-expanded", "true")
			: $(this).attr("aria-expanded", "false");

		!nav.hasClass("menu-mobile-open")
			? nav.toggleClass("menu-mobile-open")
			: false;

		//Fix the weird behaviour
		$(window).scrollTop() > 40
			? $("#header-top").toggle()
			: $("#header-top").slideToggle();

		$(".primary-navigation").toggleClass("active");

		$("html, body").animate({ scrollTop: $(window).scrollTop() }, 100);
		$("html").toggleClass("overflow-hidden");
	});

	// Inner toggle
	$('.nav-icon').click(function () {
		$('.site-header').removeClass('site-header-active');
		$('.menu-item-main-link').removeClass("active");
		$('.main-nav-link-li').removeClass("active");
		var activeSubMenus = document.querySelectorAll('.sub_menu.active');
		activeSubMenus.forEach(function (element) {
			element.classList.remove('active');
		});

		navIcon.removeClass("open");
		// $(this).removeClass("open");
		$(this).attr("aria-expanded", "false");
		nav.removeClass("menu-mobile-open")

		$(".primary-navigation").removeClass("active");

		$("html, body").animate({ scrollTop: $(window).scrollTop() }, 100);
		$("html").removeClass("overflow-hidden");
	});

	//Close the menu if the main menu is opened and the window width is changed
	var ifToClick = true;
	$(window).on("resize", function () {
		if (nav.hasClass("menu-mobile-open")) {
			if ($(window).width() > 880 && ifToClick) {
				navIcon.click();
				nav.removeClass("menu-mobile-open");
				$("html").removeClass("overflow-hidden");
				ifToClick = false;
			} else if ($(window).width() <= 880 && !ifToClick) {
				ifToClick = true;
			}
		}

		if ($(window).width() > 768) {
			$('.zight-tab-content-nav .ul').css('display', 'flex');
		}

		if ($(window).width() <= 768) {
			mobileToggle.next().hide();
		}
	});

	// set all aria expanded to false by default
	$('.primary-navigation li.has-submenus button').attr('aria-expanded', 'false');

	$('.primary-navigation li.has-submenus button').click(function () {
		$(this).attr('aria-expanded', function (index, attr) {
			if (attr == 'true') {
				attr = 'false';
				$(this).siblings('.sub_menu').removeClass('open');
			} else {
				// let's close all the other open submenus first.
				$('.primary-navigation li.has-submenus button').each(function (index, elem) {
					if ($(elem).attr('aria-expanded') == 'true') {
						$(elem).attr('aria-expanded', 'false');
						$(elem).siblings('.sub_menu').removeClass('open');
					}
				});
				attr = 'true';
				// foucs on the first item in the first column submenu.
				$(this).siblings('.sub_menu').addClass('open').find('.menu-column:first-child .sub-menu li:first-child a').focus();
			}
			return attr;
		});
	});

	$('a').keydown(function (event) {
		if (event.keyCode === 13) {
			//wait until the page finish to scroll
			setTimeout(function () {
				// Get the height of the browser viewport
				const windowHeight = window.innerHeight;

				// Get all links on the page
				const links = document.querySelectorAll('#main-content a');

				// Loop through the links to find the first link in the visible area
				for (let i = 0; i < links.length; i++) {
					const link = links[i];

					// Get the position of the link relative to the top of the page
					const linkPosition = link.getBoundingClientRect().top;

					// Check if the link is within the visible area of the page
					if (linkPosition >= 0 && linkPosition < windowHeight) {
						// Focus on the link and break out of the loop

						link.focus();
						break;
					}
				}
			}, 1500);

		}
	});

	/* eslint-disable */
})(jQuery);



// Navigation

(function ($) {

	// Adds aria attribute
	$('.menu-item-has-children').attr('aria-haspopup', 'true');

	// Toggles the sub-menu when dropdown toggle button clicked
	$('.dropdown-toggle').click(function (e) {

		// close open submenus
		$('.dropdown-toggle').not(this).each(function () {
			$(this).closest('.main-nav-link-li').removeClass('ada-active-menu');
			$(this).removeClass('toggled-on');
			$(this).closest('.sub-menu').removeClass('toggled-on');
			$(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'false' ? 'true' : 'false');
		});

		e.preventDefault();

		$(this).toggleClass('toggled-on');
		$(this).closest('.has-submenus').toggleClass('ada-active-menu');
		$(this).nextAll('.sub-menu').toggleClass('toggled-on');

		// jscs:disable
		$(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'false'
			? 'true' : 'false');
	});


	// Keyboard navigation
	$('.menu-item a, .dropdown-toggle, .menu-item-main-link, #close-search, #modal_search').on('keydown', function (e) {

		if ([37, 38, 39, 40, 27, 9].indexOf(e.keyCode) == -1) {
			return;
		}
		let aIndex;

		switch (e.keyCode) {

			case 9: // tab key
				var focusableSelectors = 'a[href]:not([disabled]), button:not([disabled]), textarea:not([disabled]), input[type="text"]:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex="-1"])';
				var lastFocusableElement = $('.sub_menu.active').find(focusableSelectors).last();

				// mobile nav dropdown
				if($(this).is(lastFocusableElement)){
					$('.sub_menu_back').focus()
				}


				if($(this).is('#close-search')){
					e.preventDefault();
					$('.under_line .input-group input').focus()
				}

				if($(this).is('#modal_search')){
					if(e.shiftKey) {
						//Focus previous input
						e.preventDefault();
					 }
				}
				
				break;

			case 27: // escape key

				$(this).parents('ul').first().prev('.dropdown-toggle.toggled-on').focus();
				$(this).parents('ul').first().prev('.dropdown-toggle.toggled-on').click();

				$('.main-nav-link-li').removeClass('ada-active-menu');
				$('.dropdown-toggle.toggled-on').removeClass('toggled-on');
				$('.sub-menu').removeClass('toggled-on');
				$('.dropdown-toggle.toggled-on').attr('aria-expanded', $(this).attr('aria-expanded') === 'false' ? 'true' : 'false');

				break;

			case 37: 				// left key
				e.preventDefault();
				e.stopPropagation();
				aIndex = $(this).index();

				if ($(this).is('.menu-item a')) {
					$(this).closest('.menu-column').prev().find(`li`).eq(aIndex).find('a').focus()
				}
				if ($(this).is('.menu-item-main-link')) {

					if ($(this).closest('.main-nav-link-li').prev().find('.dropdown-toggle').length != 0) {
						$(this).closest('.main-nav-link-li').prev().find('.dropdown-toggle').focus();
					} else {
						$(this).closest('.main-nav-link-li').prev().find('.menu-item-main-link').focus();
					}
				}

				if ($(this).is('.dropdown-toggle')) {
					if ($(this).closest('.main-nav-link-li').find('.menu-item-main-link')) {
						$(this).closest('.main-nav-link-li').find('.menu-item-main-link').focus();
					} else {
						$(this).closest('.main-nav-link-li').prev().find('.menu-item-main-link').focus();
					}
				}

				break;

			case 39: 				// right key
				e.preventDefault();
				e.stopPropagation();
				aIndex = $(this).index();

				if ($(this).is('.menu-item a')) {
					$(this).closest('.menu-column').next().find(`li`).eq(aIndex).find('a').focus()
				}

				if ($(this).is('.menu-item-main-link')) {

					if ($(this).siblings(".menu-item-rel").find('.dropdown-toggle').length != 0) {
						$(this).siblings(".menu-item-rel").find('.dropdown-toggle').focus();
					} else {
						$(this).closest('.main-nav-link-li').next().find('.menu-item-main-link').focus();
					}
				}

				if ($(this).is('.dropdown-toggle')) {
					$(this).closest('.main-nav-link-li').next().find('.menu-item-main-link').focus();
				}

				break;


			case 40: 				// down key
				e.preventDefault();
				e.stopPropagation();

				if ($(this).next().length) {
					$(this).next().find('li:first-child a').first().focus();
				}
				else {
					$(this).parent().next().children('a').focus();
				}

				if (($(this).is('ul.sub-menu a')) && ($(this).next('button.dropdown-toggle').length)) {
					$(this).parent().next().children('a').focus();
				}

				if (($(this).is('ul.sub-menu .dropdown-toggle')) && ($(this).parent().next().children('.dropdown-toggle').length)) {
					$(this).parent().next().children('.dropdown-toggle').focus();
				}

				if ($(this).is('.dropdown-toggle')) {
					if ($(this).closest('.ada-active-menu')) {
						$(this).closest('.ada-active-menu').find('.menu-column .menu-item').first().find('a').focus();
					}
				}

				if ($(this).is('.menu-item-main-link')) {
					if ($(this).closest('.ada-active-menu')) {
						$(this).closest('.ada-active-menu').find('.menu-column .menu-item').first().find('a').focus();
					}
				}


				break;


			case 38: 				// up key
				e.preventDefault();
				e.stopPropagation();

				if ($(this).is('.menu-item a')) {
					console.log($(this).parent('.menu-item').index())
					if ($(this).parent('.menu-item').index() == 0) {
						$(this).closest('.ada-active-menu').find('.menu-item-main-link').focus();
					} else {
						if ($(this).parent().prev().length) {
							$(this).parent().prev().children('a').focus();
						} else {
							$(this).parents('ul').first().prev('.dropdown-toggle.toggled-on').focus();
						}
					}
				}

				break;

		}
	});
})(jQuery);

// End Navigation