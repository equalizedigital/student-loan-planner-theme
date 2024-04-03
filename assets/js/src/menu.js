/**
 * An accessible menu for WordPress
 * @param $
 */

(function ($) {
	const nav = $('#main-navigation');
	const navIcon = $('#nav-icon');
	const mobileToggle = $('.zight-mobile-tab-toggle');

	$('a[href*="#"]')
	// Remove links that don't actually link to anything
	.not('[href="#"]')
	.not('[href="#0"]')
	.not('[href="#main-content"]')
	.not('.features_buttons_acc a')
	.click(function(event) {
	  // Prevent default anchor click behavior
	  if (
		location.pathname === this.pathname &&
		location.hostname === this.hostname
	) {
		event.preventDefault();

		// Store hash
		var hash = this.hash;

		// Using jQuery's animate() method to add smooth page scroll
		// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		// -100 is the offset/top margin
		if (hash !== "") {
		  // Don't do anything if there's no target to scroll to
		  var target = $(hash);
		  if (target.length) {
			$('html, body').animate({
			  scrollTop: target.offset().top - 100 // Offset by 100 pixels
			}, 0, function() {
			  // Add hash (#) to URL when done scrolling (default click behavior)
			  window.location.hash = hash;
			});
		  }
		}
	}

	});


	//   main menu link toggle
	document.addEventListener('DOMContentLoaded', function () {
		const sideHeader = document.querySelectorAll('.site-header');
		const backButtons = document.querySelectorAll('.sub_menu_back');

		backButtons.forEach(function (button) {
			button.addEventListener('click', function (e) {
				e.preventDefault();
				const parentSubMenu = this.closest('.sub_menu');

				const siblingMainLink = $(parentSubMenu)
					.parent()
					.find('.menu-item-main-link');
				if (siblingMainLink.length) {
					siblingMainLink.focus();
				}

				if (parentSubMenu) {
					parentSubMenu.classList.remove('active');
				}
				sideHeader.forEach(function (element) {
					element.classList.remove('site-header-active');
				});
			});
		});

		if ($(window).innerWidth() >= 1070) {
			$('#menu_search_btn').on('click', function () {
				const $popup = $('.search-popup');
				if ($popup.length) {
					$popup.addClass('active');
					$(this).attr('aria-expanded', 'true');
					$('#modal_search').focus();
				}
			});

			$('#modal_search').on('input', function () {
				const $popup = $('.search-popup');
				if ($popup.length) {
					$popup.addClass('input-active');
				}
			});

			$('#close-search').on('click', function () {
				const $popup = $('.search-popup');
				if ($popup.length) {
					$popup.removeClass('active');
					$('#menu_search_btn').attr('aria-expanded', 'false');
					$('#menu_search_btn').focus();
				}
			});
		}
	});

	const $mainLinks = $('.menu-item-main-link');

	function handleOpenMobileSubMenus(item) {
		if (!1 === $(item).hasClass('menu-item-no-drop')) {
			$(item).toggleClass('active');
			$(item).parent().toggleClass('active');

			const $siblingSubMenu = $(item).siblings('.sub_menu');
			if ($siblingSubMenu.length) {
				$siblingSubMenu.toggleClass('active');
			}

			$('.site-header').toggleClass('site-header-active');

			const menuColumn = $(item)
				.siblings('.sub_menu')
				.find('.menu-column');
			const firstFocusableItem = menuColumn
				.find('a[href], button:not([disabled])')
				.first();
			if (firstFocusableItem.length) {
				firstFocusableItem.focus();
			}
		}
	}

	$mainLinks.on('click', function (e) {
		if ($(window).innerWidth() < 1070) {
			e.preventDefault();
			handleOpenMobileSubMenus(e.target);
		}
	});

	if ($('mobile-help-button').length) {
		document
			.querySelector('.mobile-help-button .btn')
			.addEventListener('keydown', function (event) {
				if (event.key === 'Tab') {
					event.preventDefault();

					/*
					 * Menu Toggle
					 */
					$('.site-header').removeClass('site-header-active');
					$('.menu-item-main-link').removeClass('active');
					$('.main-nav-link-li').removeClass('active');
					const activeSubMenus =
						document.querySelectorAll('.sub_menu.active');
					activeSubMenus.forEach(function (element) {
						element.classList.remove('active');
					});

					$(navIcon).toggleClass('open');
					$(navIcon).attr('aria-expanded') === 'false'
						? $(navIcon).attr('aria-expanded', 'true')
						: $(navIcon).attr('aria-expanded', 'false');

					!nav.hasClass('menu-mobile-open')
						? nav.addClass('menu-mobile-open')
						: nav.removeClass('menu-mobile-open');

					//Fix the weird behaviour
					$(window).scrollTop() > 40
						? $('#header-top').toggle()
						: $('#header-top').slideToggle();

					$('.primary-navigation').toggleClass('active');

					$('html, body').animate(
						{ scrollTop: $(window).scrollTop() },
						100
					);
					$('body').toggleClass('mobile-navigation-open');
				}
			});
	}

	/*
	 * Menu Toggle
	 */
	navIcon.click(function () {
		$('.site-header').removeClass('site-header-active');
		$('.menu-item-main-link').removeClass('active');
		$('.main-nav-link-li').removeClass('active');
		const activeSubMenus = document.querySelectorAll('.sub_menu.active');
		activeSubMenus.forEach(function (element) {
			element.classList.remove('active');
		});

		$(this).toggleClass('open');
		$(this).attr('aria-expanded') === 'false'
			? $(this).attr('aria-expanded', 'true')
			: $(this).attr('aria-expanded', 'false');

		!nav.hasClass('menu-mobile-open')
			? nav.addClass('menu-mobile-open')
			: nav.removeClass('menu-mobile-open');

		//Fix the weird behaviour
		$(window).scrollTop() > 40
			? $('#header-top').toggle()
			: $('#header-top').slideToggle();

		$('.primary-navigation').toggleClass('active');

		$('html, body').animate({ scrollTop: $(window).scrollTop() }, 100);
		$('body').toggleClass('mobile-navigation-open');
	});

	// Inner toggle
	$('.nav-icon').click(function () {
		closeMobileMenu();
	});

	$(
		'.menu-item-main-link, #nav-icon, #search, .mobile-cta-button a, .site-title a'
	).keydown(function () {
		if (event.keyCode === 27) {
			closeMobileMenu();
		}
	});

	$('.sub-menu .menu-item a').keydown(function () {
		if (event.keyCode === 27) {
			$('button.sub_menu_back').click();
		}
	});

	function closeMobileMenu() {
		nav.removeClass('menu-mobile-open');
		navIcon.removeClass('open');
		$('.site-header').removeClass('site-header-active');
		$('.menu-item-main-link').removeClass('active');
		$('.main-nav-link-li').removeClass('active');
		$('.primary-navigation').removeClass('active');
		$('body').removeClass('mobile-navigation-open');
		$('.nav-icon').attr('aria-expanded', 'false');

		document
			.querySelectorAll('.sub_menu.active')
			.forEach(function (element) {
				element.classList.remove('active');
			});

		$('html, body').animate({ scrollTop: $(window).scrollTop() }, 100);
	}

	//Close the menu if the main menu is opened and the window width is changed
	let ifToClick = true;
	$(window).on('resize', function () {
		if (nav.hasClass('menu-mobile-open')) {
			if ($(window).width() > 1070 && ifToClick) {
				navIcon.click();
				nav.removeClass('menu-mobile-open');
				$('body').removeClass('mobile-navigation-open');
				ifToClick = false;
			} else if ($(window).width() <= 1070 && !ifToClick) {
				ifToClick = true;
			}
		}

		if ($(window).width() > 1070) {
			$('.zight-tab-content-nav .ul').css('display', 'flex');
		}

		if ($(window).width() <= 1070) {
			mobileToggle.next().hide();
		}
	});

	// set all aria expanded to false by default
	$('.primary-navigation li.has-submenus button').attr(
		'aria-expanded',
		'false'
	);

	$('.primary-navigation li.has-submenus button').click(function () {
		$(this).attr('aria-expanded', function (index, attr) {
			if (attr == 'true') {
				attr = 'false';
				$(this).siblings('.sub_menu').removeClass('open');
			} else {
				// let's close all the other open submenus first.
				$('.primary-navigation li.has-submenus button').each(
					function (index, elem) {
						if ($(elem).attr('aria-expanded') == 'true') {
							$(elem).attr('aria-expanded', 'false');
							$(elem).siblings('.sub_menu').removeClass('open');
						}
					}
				);
				attr = 'true';
				// foucs on the first item in the first column submenu.
				$(this)
					.siblings('.sub_menu')
					.addClass('open')
					.find('.menu-column:first-child .sub-menu li:first-child a')
					.focus();
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
				if ($(this).is('.menu-item a')) {
					// All focusable elements inside .sub_menu
					var focusableElems = $(this).closest('.main-nav-link-li').find('.menu-item-main-link').siblings('.sub_menu').find('a[href], button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
					let thisElement = $(this).closest('.main-nav-link-li').find('.menu-item-main-link');
					// Last focusable element
					var lastElem = focusableElems[focusableElems.length - 1];
					// If we're on the last element and the shift key isn't held down (backward tabbing)
					if (e.target === lastElem && !e.shiftKey) {
						e.preventDefault(); // Prevent default tab behavior
						thisElement.attr('aria-expanded', 'false');
						thisElement.focus();
						thisElement.siblings('.sub_menu').removeClass('open')
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

				if ($(this).is('.menu-item a')) {
					if ($(this).closest('.main-nav-link-li').find('.menu-item-main-link')) {
						$(this).closest('.main-nav-link-li').find('.menu-item-main-link').attr('aria-expanded', 'false');
						$(this).closest('.main-nav-link-li').find('.menu-item-main-link').focus();
						$(this).closest('.main-nav-link-li').find('.menu-item-main-link').siblings('.sub_menu').removeClass('open')
					}
				}

				$("body").toggleClass("mobile-navigation-open");

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
