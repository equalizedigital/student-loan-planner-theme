<?php
/**
 * Fonts
 *
 * @package      Mainspring
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Theme Fonts URL
 */
function mst_theme_fonts_url() {
	return false;
}

/**
 * Preconnect Font
 */
function mst_preconnect_font() {
	$font_url = mst_theme_fonts_url();
	if ( empty( $font_url ) ) {
		return;
	}

	// Preconnect for google font.
	if ( 0 === strpos( $font_url, 'https://fonts.googleapis.com' ) ) {
		echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . PHP_EOL;
		echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . PHP_EOL;
	}
}
add_action( 'wp_head', 'mst_preconnect_font', 5 );

/**
 * Enqueue Frontend Fonts
 */
function mst_enqueue_frontend_fonts() {
	$font_url = mst_theme_fonts_url();
	if ( empty( $font_url ) ) {
		return;
	}

	wp_enqueue_style( 'be-font', esc_url( $font_url ), [], null, 'all' );
}
add_action( 'wp_enqueue_scripts', 'mst_enqueue_frontend_fonts' );

/**
 * Enqueue Backend Fonts
 */
function mst_enqueue_backend_fonts() {
	$font_url = mst_theme_fonts_url();
	if ( ! empty( $font_url ) ) {
		wp_enqueue_style( 'be-font', esc_url( $font_url ), [], null, 'all' );
	}

}
add_action( 'enqueue_block_editor_assets', 'mst_enqueue_backend_fonts' );

/**
 * Fallback Font JS
 */
function mst_fallback_font_js() {
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
//add_action( 'wp_body_open', 'mst_fallback_font_js' );

/**
 * Fallback Font Markup
 */
function mst_fallback_font_markup() {
	?>
	<div aria-hidden="true" class="hidden" style="font-family: 'Open Sans'; position:absolute; overflow:hidden; clip: rect(0 0 0 0); height: 1px; width: 1px; margin: -1px; padding: 0; border: 0;">&nbsp;</div>
	<?php
}
//add_action( 'wp_footer', 'mst_fallback_font_markup' );
