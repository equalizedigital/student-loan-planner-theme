jQuery(function ($) {
	// Smooth Scroll
	function eqdScroll(hash) {
		let target = null;

		try {
			target = $(hash);
		} catch (error) {
			// Perhaps worth adding some error logging here in the future.
			return false;
		}

		target = target.length
			? target
			: $('[name=' + this.hash.slice(1) + ']');
		if (target.length) {
			let topOffset = 0;
			if ($('.site-header').css('position') === 'fixed') {
				topOffset = $('.site-header').height();
			}
			if ($('body').hasClass('admin-bar')) {
				topOffset = topOffset + $('#wpadminbar').height();
			}
			$('html,body').animate(
				{
					scrollTop: target.offset().top - topOffset,
				},
				1000
			);
			return false;
		}
	}

	// -- Smooth scroll on pageload
	if (window.location.hash) {
		eqdScroll(window.location.hash);
	}
	// -- Smooth scroll on click
	$('a[href*="#"]:not([href="#"]):not(.no-scroll)').click(function () {
		if (
			location.pathname.replace(/^\//, '') ===
				this.pathname.replace(/^\//, '') ||
			location.hostname === this.hostname
		) {
			eqdScroll(this.hash);
		}
	});
});
