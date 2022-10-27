<?php
/**
 * WordPress SEO
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Breadcrumbs
 */
function mst_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumb">', '</p>' );
	}
}
add_action( 'tha_content_top', 'mst_breadcrumbs' );

/**
 * Remove post title from breadcrumbs
 *
 * @param string $link_output Link Output.
 */
function mst_breadcrumb_remove_post_title( $link_output ) {
	if ( is_singular() && strpos( $link_output, 'breadcrumb_last' ) !== false ) {
		$link_output = '';
	}
	return $link_output;
}
add_filter( 'wpseo_breadcrumb_single_link', 'mst_breadcrumb_remove_post_title' );

/**
 * Home Breadcrumb
 *
 * @param array $crumbs Crumbs.
 */
function ea_home_breadcrumb( $crumbs ) {

	foreach ( $crumbs as $i => $crumb ) {
		if ( ! empty( $crumb['text'] ) && 'Home' === $crumb['text'] ) {
			$crumbs[ $i ]['text'] = '<span class="home">' . mst_icon( [ 'icon' => 'home', 'size' => 16 ] ) . '<span class="screen-reader-text">Home</span></span>';
		}
	}
	return $crumbs;
}
//add_filter( 'wpseo_breadcrumb_links', 'ea_home_breadcrumb' );
