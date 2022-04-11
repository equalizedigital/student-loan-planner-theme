<?php
/**
 * Cultivate Pro customizations
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Change the theme directory.
add_filter(
	'cultivate_pro/theme_directory',
	function() {
		return '/partials/';
	}
);

// Disble plugin assets for blocks styled in theme.
$blocks = [ 'post-listing', 'category-listing', 'quick-links', 'tag-listing', 'browse-by-dropdowns', 'table-of-contents' ];
foreach ( $blocks as $block ) {
	add_filter( 'cultivate_pro/load_assets/' . $block, '__return_false' );
}

// Disable unnecessary plugin settings.
add_filter( 'cultivate_pro/settings/post_listing', '__return_empty_array' );

// Disable term image metabox.
add_filter( 'cultivate_pro/category_listing/category_image_metabox', '__return_false' );

/**
 * Disable plugin blocks that we've custom built in theme.
 *
 * It's a good idea to list custom blocks you've built in the theme
 * in case a block with the same name gets added to Cultivate Pro in
 * a future release.
 */
add_filter(
	'cultivate_pro/supported_blocks',
	function( $blocks ) {
		$disable = [ 'browse-by-dropdowns' ];
		return array_diff( $blocks, $disable );
	}
);

/**
 * Layouts for Post listing
 * alpha, beta, gamma, delta, epsilon, zeta, eta, theta, iota, kappa, lambda, mu
 */
add_filter(
	'cultivate_pro/post_listing/layouts',
	function( $layouts ) {
		$layouts = [
			'alpha' => [
				'label'          => __( '3 Column', 'mainspring' ),
				'posts_per_page' => 3,
				'partial'        => 'primary',
			],
			'beta'  => [
				'label'          => __( '4 Column', 'mainspring' ),
				'posts_per_page' => 4,
				'partial'        => 'tertiary',
			],
			'gamma' => [
				'label'          => __( '2x2 Grid', 'mainspring' ),
				'posts_per_page' => 4,
				'partial'        => 'secondary',
			],
		];

		return $layouts;
	}
);

/**
 * Layouts for Quick Links
 * alpha, beta, gamma, delta, epsilon, zeta, eta, theta, iota, kappa, lambda, mu
 *
 * @param array $layouts Layouts.
 */
function mst_quick_links_layouts( $layouts ) {
	return [
		'alpha' => [
			'label' => __( 'Large', 'mainspring' ),
		],
		'beta'  => [
			'label' => __( 'Small', 'mainspring' ),
		],
	];
}
add_filter( 'cultivate_pro/quick_links/layouts', 'mst_quick_links_layouts' );
add_filter( 'cultivate_pro/category_listing/layouts', 'mst_quick_links_layouts' );
add_filter( 'cultivate_pro/subcategory_listing/layouts', 'mst_quick_links_layouts' );
add_filter( 'cultivate_pro/term_listing/layouts', 'mst_quick_links_layouts' );
