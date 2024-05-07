<?php
/**
 * Template name: Landing Page
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

get_header();

// Check if 'slug' is set in the URL parameters.
if ( isset( $_GET['landing_page'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Using $_GET to allow for URL parameters.
	$page_slug = sanitize_text_field( $_GET['landing_page'] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Using $_GET to allow for URL parameters.

	// Query for the page by slug.
	$args         = array(
		'post_type'   => 'slp_landing',
		'post_status' => 'publish',
		'numberposts' => 1,
		'meta_query'  => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Meta query is necessary to query by custom field.
			array(
				'key'     => 'landing_page_url_text', 
				'value'   => $page_slug, 
				'compare' => '=', 
			),
		),
	);
	$landing_page = get_posts( $args );

	// If the page exists, redirect or load the page.
	if ( $landing_page ) {
		$page_id = $landing_page[0]->ID;

		$parameter_page = $page_id; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
	}
}

$container_class = null;

if ( get_field( 'post_format_style' ) === 'full-width' ) {
	$container_class .= ' site-main-article-content__full-width';
}
$layout_style = get_field( 'post_format_style' );

if ( empty( $layout_style ) ) {
	$layout_style = 'standard';
}

$container_class .= ' post_type_layout_' . $layout_style . ' ';

$side_container_class = '';
if ( get_field( 'post_format_style' ) !== 'full-width' ) {
	$side_container_class .= 'inner-hero-alternate-style';
}

tha_content_before();

echo '<div class="' . esc_attr( $container_class ) . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';

tha_content_wrap_before();

tha_landing_page_header();

echo '<main class="site-main" role="main">';

tha_single_header();

echo "<div class='side-main-article-container " . esc_attr( $side_container_class ) . "'>";
tha_content_before_container();
echo '<div class="site-main-article-content ' . esc_attr( $container_class ) . '">';

tha_content_top();
tha_single_fullwidth();
tha_content_loop();
tha_content_bottom();

echo '</div>';

tha_single_sidebar();

echo '</div>';

tha_single_page_end();

echo '</main>';

tha_content_wrap_after();

echo '</div>';

tha_content_after();


get_footer();
