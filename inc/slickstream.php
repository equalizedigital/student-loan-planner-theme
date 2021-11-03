<?php
/**
 * Slickstream
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Slickstream Filmstrip
 */
function mst_slickstream_filmstrip() {
	if ( is_single() && function_exists( 'SlickEngagement_init' ) ) {
		echo '<div style="min-height: 72px;" class="slick-film-strip"></div>';
	}
}
add_action( 'tha_header_after', 'mst_slickstream_filmstrip' );
