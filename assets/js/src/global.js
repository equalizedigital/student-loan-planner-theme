// Sticky Header
jQuery(function ($) {

	function navbarheight() {
		return $('.site-header').height();
	}

	// Header Scroll
	var didScroll = false,
		lastScrollTop = 0,
		delta = 5,
		navbarHeight = navbarheight();

	$(window).scroll(function () {
		didScroll = true;
	});

	setInterval(function () {
		if (didScroll) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	function hasScrolled() {
		var st = $(this).scrollTop();

		// Make sure they scroll more than delta
		if (Math.abs(lastScrollTop - st) <= delta)
			return;

		if (st > navbarHeight) {

			if (st > lastScrollTop && !$('.site-header .nav-menu').hasClass('active')) {
				// Scroll Down
				$('body').removeClass('nav-down').addClass('nav-up');
			} else {
				// Scroll Up
				if (st + $(window).height() < $(document).height()) {
					$('body').removeClass('nav-up').addClass('nav-down');
				}
			}

		} else {
			$('body').removeClass('nav-down').removeClass('nav-up');
		}
		lastScrollTop = st;
	}

	$('.backtotop').click(function () {
		$('body').removeClass('nav-up').removeClass('nav-down');
	});
});

window.addEventListener("load", function () {


	const tabbedContent = document.querySelector('.tabbed-content-block');

	if (tabbedContent) {


		// Grab all buttons with the class tabbed-content__nav-item
		const tabButtons = document.querySelectorAll('.tabbed-content__nav-item button');

		tabButtons.forEach(button => {
			// Add a click event listener to each button
			button.addEventListener('click', function () {
				// Get the value of the data-target attribute
				let targetClass = button.getAttribute('data-link');

				// Remove active class from all items before adding to the new one
				tabButtons.forEach(btn => btn.classList.remove('active'));

				let panes = document.querySelectorAll('.tabbed-content__content__pane');
				panes.forEach(element => {
					element.classList.remove('tabbed-content__content__pane--active');
				});

				// If a class that matches the data attribute exists, add the active class
				if (targetClass) {
					let targetElements = document.querySelectorAll('#' + targetClass);
					targetElements.forEach(element => {
						element.classList.add('tabbed-content__content__pane--active');
					});
				}

				// Add active class to the clicked button
				button.classList.add('active');
			});
		});
	}


});
