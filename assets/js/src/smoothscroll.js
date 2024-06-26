jQuery(function ($) {
	// Smooth Scroll
	function eqd_scroll(hash) {
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
			let top_offset = 0;
			if ($('.site-header').css('position') == 'fixed') {
				top_offset = $('.site-header').height();
			}
			if ($('body').hasClass('admin-bar')) {
				top_offset = top_offset + $('#wpadminbar').height();
			}
			$('html,body').animate(
				{
					scrollTop: target.offset().top - top_offset,
				},
				1000
			);
			return false;
		}
	}

	// -- Smooth scroll on pageload
	if (window.location.hash) {
		eqd_scroll(window.location.hash);
	}
	// -- Smooth scroll on click
	$('a[href*="#"]:not([href="#"]):not(.no-scroll)').click(function () {
		if (
			location.pathname.replace(/^\//, '') ==
				this.pathname.replace(/^\//, '') ||
			location.hostname == this.hostname
		) {
			eqd_scroll(this.hash);
		}
	});
});
