<?php
/**
 * Archive
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Full width.
add_filter( 'mst_page_layout', 'mst_return_full_width_content' );

/**
 * Body Class
 *
 * @param array $classes Body classes.
 */
function mst_archive_body_class( $classes ) {
	$classes[] = 'archive';
	return $classes;
}
add_filter( 'body_class', 'mst_archive_body_class' );

/**
 * Archive Header
 */
function mst_archive_header() {

	$title       = false;
	$subtitle    = false;
	$description = false;

	if ( is_author() ) {
		mst_author_box( get_queried_object_id(), 'author-archive' );
		return;
	}

	if ( is_home() && get_option( 'page_for_posts' ) ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );

	} elseif ( is_search() ) {
		$title = 'Search Results';

	} elseif ( is_archive() ) {
		$title = false;
		if ( is_category() || is_tag() ) {
			$title = get_term_meta( get_queried_object_id(), 'mst_archive_headline', true );
		}
		if ( empty( $title ) ) {
			$title = get_the_archive_title();
		}
		if ( ! get_query_var( 'paged' ) ) {
			$description = get_the_archive_description();
		}
	}

	if ( empty( $title ) && empty( $description ) ) {
		return;
	}

	$classes = array( 'archive-description' );
	if ( is_author() ) {
		$classes[] = 'author-archive-description';
	}

	echo '<header class="' . esc_attr( join( ' ', $classes ) ) . '">';
	do_action( 'mst_archive_header_before' );
	if ( ! empty( $title ) ) {
		echo '<h1 class="archive-title">' . esc_html( wp_strip_all_tags( $title ) ) . '</h1>';
	}
	if ( ! empty( $subtitle ) ) {
		echo '<h4>' . esc_html( wp_strip_all_tags( $subtitle ) ) . '</h4>';
	}
	echo wp_kses_post( apply_filters( 'mst_the_content', $description ) );
	do_action( 'mst_archive_header_after' );
	echo '</header>';

}
add_action( 'tha_content_while_before', 'mst_archive_header' );

// Build the page.
require get_template_directory() . '/index.php';
