<?php
/**
 * Fonts
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Theme Fonts URL
 */
function eqd_theme_fonts_url() {
	return 'https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200;300;400;500;600;700;800;900&display=swap';
}

/**
 * Preconnect Font
 */
function eqd_preconnect_font() {
	?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> -->

	<link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Sans&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Source+Sans+3:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<?php
}
add_action( 'wp_head', 'eqd_preconnect_font', 1 );

/**
 * Enqueue Frontend Fonts
 */
function eqd_enqueue_frontend_fonts() {
	$font_url = eqd_theme_fonts_url();
	if ( empty( $font_url ) ) {
		return;
	}

	wp_enqueue_style( 'eqd-font', esc_url( $font_url ), array(), null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'eqd_enqueue_frontend_fonts' );

/**
 * Enqueue Backend Fonts
 */
function eqd_enqueue_backend_fonts() {
	$font_url = eqd_theme_fonts_url();
	if ( ! empty( $font_url ) ) {
		wp_enqueue_style( 'eqd-font', esc_url( $font_url ), array(), null, 'all' );
	}
}
add_action( 'enqueue_block_editor_assets', 'eqd_enqueue_backend_fonts' );

/**
 * Fallback Font JS
 */
function eqd_fallback_font_js() {
	?>
	<script>

	var interval = null;

	function fontLoadListener() {
		var hasLoaded = false;

		try {
			hasLoaded = document.fonts.check('12px "Open Sans"');
		} catch(error) {
			console.info("CSS font loading API error", error);
			fontLoadedSuccess();
			return;
		}

		if(hasLoaded) {
			fontLoadedSuccess();
		}
	}

	function fontLoadedSuccess() {
		if(interval) {
			clearInterval(interval);
		}
		document.getElementsByTagName("body")[0].classList.add('cwp-fonts-loaded');
	}

	interval = setInterval(fontLoadListener, 500);
	</script>
	<?php
}
/* add_action( 'wp_body_open', 'eqd_fallback_font_js' ); */

/**
 * Fallback Font Markup
 */
function eqd_fallback_font_markup() {
	?>
	<div aria-hidden="true" class="hidden" style="font-family: 'Open Sans'; position:absolute; overflow:hidden; clip: rect(0 0 0 0); height: 1px; width: 1px; margin: -1px; padding: 0; border: 0;">&nbsp;</div>
	<?php
}
/* add_action( 'wp_footer', 'eqd_fallback_font_markup' ); */
