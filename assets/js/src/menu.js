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

		if (window.innerWidth <= 768) {
			var mainLinks = document.querySelectorAll(".menu-item-main-link");
			var sideHeader = document.querySelectorAll('.site-header');

			mainLinks.forEach(function (mainLink) {
				mainLink.addEventListener("click", function (e) {
					e.preventDefault();  // Prevent the default action if it's a link

					// Add class to the clicked element
					this.classList.toggle("active");

					// Add class to the parent of the clicked element
					this.parentNode.classList.toggle("active");

					// Add class to the sibling with class .sub_menu
					var siblingSubMenu = this.nextElementSibling;
					if (siblingSubMenu && siblingSubMenu.classList.contains("sub_menu")) {
						siblingSubMenu.classList.toggle("active");
					}
					sideHeader.forEach(function(element) {
						element.classList.toggle('site-header-active');
					});
				});
			});
		}

		var backButtons = document.querySelectorAll(".sub_menu_back");

		backButtons.forEach(function(button) {
			button.addEventListener("click", function(e) {
				// Prevent the default action if the button is within a form, or if it's a link
				e.preventDefault();
	
				// Get the closest .sub_menu parent and remove the active class
				var parentSubMenu = this.closest('.sub_menu');
				if (parentSubMenu) {
					parentSubMenu.classList.remove("active");
				}
				sideHeader.forEach(function(element) {
					element.classList.remove('site-header-active');
				});
			});
		});

		if (window.innerWidth >= 768) {
			document.getElementById('menu_search_btn').addEventListener('click', function() {
				var popup = document.querySelector('.search-popup');
				if(popup) {
					popup.classList.add('active'); 
				}
			});
			document.querySelector('#search').addEventListener('input', function() {
				var popup = document.querySelector('.search-popup');
				if (popup) {
					popup.classList.add('input-active'); 
				}
			});
			document.getElementById('close-search').addEventListener('click', function() {
				var popup = document.querySelector('.search-popup');
				if (popup) {
					popup.classList.remove('active');
				}
			});
		}

		
	});



	/*
	 * Menu Toggle
	 */
	navIcon.click(function () {
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

		$(".primary-navigation").slideToggle();
		$("html, body").animate({ scrollTop: $(window).scrollTop() }, 100);
		$("html").toggleClass("overflow-hidden");
	});

	//navIcon leave focus
	navIcon.focusout(function () {
		$(".primary-navigation>ul>li:first-child button").focus();
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

	// close on escape key.
	$(document).keyup(function (e) {
		if (e.keyCode == 27) {
			$('.primary-navigation li.has-submenus button').each(function (index, elem) {
				if ($(elem).attr('aria-expanded') == 'true') {
					$(elem).attr('aria-expanded', 'false');
					$(elem).siblings('.sub_menu').removeClass('open');
					$(elem).focus();
				}
			});
		}
	});

	// close on click outside
	$(document).click(function (e) {
		if (!$(e.target).closest('.primary-navigation li.has-submenus button').length) {
			$('.primary-navigation li.has-submenus button').each(function (index, elem) {
				if ($(elem).attr('aria-expanded') == 'true') {
					$(elem).attr('aria-expanded', 'false');
					$(elem).siblings('.sub_menu').removeClass('open');
				}
			});
		}
	});

	// on desktop only
	if (window.matchMedia("(min-width: 768px)").matches) {
		$('.primary-navigation li.has-submenus').hover(function () {
			$('.primary-navigation li.has-submenus button').each(function (index, elem) {
				if ($(elem).attr('aria-expanded') == 'true') {
					$(elem).attr('aria-expanded', 'false');
					$(elem).siblings('.sub_menu').removeClass('open');
				}
			});
			$(this).find('button').attr('aria-expanded', 'true');
		}, function () {
			$(this).find('button').attr('aria-expanded', 'false');
		});
	}

	//#top-search input on focus shift the sibling label to the top by 20px
	$('#top-search input').focus(function () {
		$(this).siblings('label').css({
			'top': '-5px',
			'font-size': '14px'
		});
	});
	$('#top-search input').focusout(function () {
		// only if not empty
		if ($(this).val() === '') {
			$(this).siblings('label').css({
				'top': '10px',
				'font-size': '18px'
			});
		}
	});
	$('#top-search input').each(function () {
		if ($(this).hasClass('active-input')) {
			$(this).siblings('label').css({
				'top': '-5px',
				'font-size': '14px'
			});
		}
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
