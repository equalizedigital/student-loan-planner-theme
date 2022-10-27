<?php
/**
 * WordPress Cleanup
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Dont Update the Theme
 *
 * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @author Equalize Digital
 * @link   http://www.billerickson.net/excluding-theme-from-updates
 *
 * @param  array  $r Existing request arguments.
 * @param  string $url Request URL.
 * @return array Amended request arguments
 */
function eqd_dont_update_theme( $r, $url ) {
	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) ) {
		return $r; // Not a theme update request. Bail immediately.
	}
	$themes = json_decode( $r['body']['themes'] );
	$child  = get_option( 'stylesheet' );
	unset( $themes->themes->$child );
	$r['body']['themes'] = json_encode( $themes );
	return $r;
}
add_filter( 'http_request_args', 'eqd_dont_update_theme', 5, 2 );

/**
 * Header Meta Tags
 */
function ea_header_meta_tags() {
	echo '<meta charset="' . esc_attr( get_bloginfo( 'charset' ) ) . '">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '<link rel="profile" href="http://gmpg.org/xfn/11">';
	echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">';
}
add_action( 'wp_head', 'ea_header_meta_tags' );

/**
 * Extra body classes
 *
 * @param array $classes Body classes.
 */
function eqd_extra_body_classes( $classes ) {
	if ( is_singular() ) {
		$classes[] = 'singular';
	}

	if ( function_exists( 'adthrive_ads_autoload' ) && function_exists( 'wp_get_environment_type' ) && 'staging' === wp_get_environment_type() ) {
		$classes[] = 'adthrive-staging';
	}

	return $classes;
}
add_filter( 'body_class', 'eqd_extra_body_classes' );

/**
 * Clean body classes
 *
 * @param array $classes Body classes.
 */
function eqd_clean_body_classes( $classes ) {

	$allowed_classes = [
		'singular',
		'single',
		'page',
		'archive',
		'home',
		'search',
		'admin-bar',
		'logged-in',
		'wp-embed-responsive',
	];

	// AdThrive Classes.
	$allowed_classes = array_merge(
		$allowed_classes,
		[
			'adthrive-disable-all',
			'adthrive-disable-in-image',
			'adthrive-disable-content',
			'adthrive-disable-video',
			'adthrive-staging',
		]
	);

	if ( function_exists( 'eqd_page_layout_options' ) ) {
		$allowed_classes = array_merge( $allowed_classes, eqd_page_layout_options() );
	}

	return array_intersect( $classes, $allowed_classes );

}
add_filter( 'body_class', 'eqd_clean_body_classes', 20 );

/**
 * Clean Nav Menu Classes
 *
 * @param array $classes Nav item classes.
 */
function eqd_clean_nav_menu_classes( $classes ) {
	if ( ! is_array( $classes ) ) {
		return $classes;
	}

	foreach ( $classes as $i => $class ) {

		// Remove class with menu item id.
		$id = strtok( $class, 'menu-item-' );
		if ( 0 < intval( $id ) ) {
			unset( $classes[ $i ] );
		}

		// Remove menu-item-type-*.
		if ( false !== strpos( $class, 'menu-item-type-' ) ) {
			unset( $classes[ $i ] );
		}

		// Remove menu-item-object-*.
		if ( false !== strpos( $class, 'menu-item-object-' ) ) {
			unset( $classes[ $i ] );
		}

		// Change page ancestor to menu ancestor.
		if ( 'current-page-ancestor' === $class ) {
			$classes[] = 'current-menu-ancestor';
			unset( $classes[ $i ] );
		}
	}

	// Remove submenu class if depth is limited.
	if ( isset( $args->depth ) && 1 === $args->depth ) {
		$classes = array_diff( $classes, array( 'menu-item-has-children' ) );
	}

	return $classes;
}
add_filter( 'nav_menu_css_class', 'eqd_clean_nav_menu_classes', 5 );

/**
 * Clean Post Classes
 *
 * @param array $classes Post Classes.
 */
function eqd_clean_post_classes( $classes ) {

	if ( ! is_array( $classes ) ) {
		return $classes;
	}

	$allowed_classes = [
		'entry',
		'type-' . get_post_type(),
	];

	return array_intersect( $classes, $allowed_classes );
}
add_filter( 'post_class', 'eqd_clean_post_classes', 5 );

/**
 * Archive Title, remove prefix
 *
 * @param string $title Title.
 */
function eqd_archive_title_remove_prefix( $title ) {
	$title_pieces = explode( ': ', $title );
	if ( count( $title_pieces ) > 1 ) {
		unset( $title_pieces[0] );
		$title = join( ': ', $title_pieces );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'eqd_archive_title_remove_prefix' );

/**
 * Excerpt More
 */
function eqd_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'eqd_excerpt_more' );

// Remove inline CSS for emoji.
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Max srcset width
 *
 * @param int   $max_width  The maximum image width to be included in the 'srcset'. Default '2048'.
 * @param int[] $size_array {
 *     An array of requested width and height values.
 *
 *     @type int $0 The width in pixels.
 *     @type int $1 The height in pixels.
 * }
 */
function eqd_max_srcset_width( $max_width, $size_array ) {
	return 1200;
}
add_filter( 'max_srcset_image_width', 'eqd_max_srcset_width', 10, 2 );

/**
 * Customize image srcset
 *
 * @param array  $sources {
 *     One or more arrays of source data to include in the 'srcset'.
 *
 *     @type array $width {
 *         @type string $url        The URL of an image source.
 *         @type string $descriptor The descriptor type used in the image candidate string,
 *                                  either 'w' or 'x'.
 *         @type int    $value      The source width if paired with a 'w' descriptor, or a
 *                                  pixel density value if paired with an 'x' descriptor.
 *     }
 * }
 * @param array  $size_array     {
 *     An array of requested width and height values.
 *
 *     @type int $0 The width in pixels.
 *     @type int $1 The height in pixels.
 * }
 * @param string $image_src     The 'src' of the image.
 * @param array  $image_meta    The image meta data as returned by 'wp_get_attachment_metadata()'.
 * @param int    $attachment_id Image attachment ID or 0.
 */
function eqd_image_srcset( $sources, $size_array, $image_src, $image_meta, $attachment_id ) {

	// Array of image widths used in grid.
	$grid_sizes = [];

	// Max srcset size multiplier.
	$max = 1.5;

	if ( empty( $grid_sizes ) ) {
		return $sources;
	}

	if ( ! in_array( $size_array[0], $grid_sizes, true ) ) {
		return $sources;
	}

	foreach ( $sources as $width => $source ) {

		// Remove smaller image sizes.
		if ( $width < $size_array[0] ) {
			unset( $sources[ $width ] );
		}

		// Set max image size.
		if ( $width > ( $max * $size_array[0] ) ) {
			unset( $sources[ $width ] );
		}
	}

	return $sources;
}
add_filter( 'wp_calculate_image_srcset', 'eqd_image_srcset', 10, 5 );
