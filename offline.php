<?php
/**
 * PWA Offline
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Offline Content
 */
function mst_pwa_offline_content() {
	echo '<h1>Oops, it looks like you\'re offline</h1>';
	if ( function_exists( 'wp_service_worker_error_message_placeholder' ) ) {
		wp_service_worker_error_message_placeholder();
	}

}
add_action( 'tha_content_loop', 'mst_pwa_offline_content' );
remove_action( 'tha_content_loop', 'mst_default_loop' );

// Build the page.
require get_template_directory() . '/index.php';
