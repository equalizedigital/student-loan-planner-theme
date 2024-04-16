<?php
/**
 * Base template
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

get_header();

$container_class = null;

if ( get_field( 'post_format_style' ) === 'full-width' ) {
	$container_class .= ' site-main-article-content__full-width';
}
$layout_style = get_field( 'post_format_style' );

if ( empty( $layout_style ) ) {
	$layout_style = 'standard';
}

$container_class     .= ' post_type_layout_' . $layout_style . ' ';
$hide_page_header     = get_field( 'hide_page_header' );
$side_container_class = '';

if ( get_field( 'post_format_style' ) === 'full-width' ) {
} else {
	$side_container_class .= 'inner-hero-alternate-style';
}

if ( $hide_page_header ) {
	$container_class .= ' post_type_layout_hide_page_header ';
}

tha_content_before();

	echo '<div class="' . $container_class . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';

		tha_content_wrap_before();

		tha_page_header();

		echo '<main class="site-main" role="main">';

			tha_single_header();

			echo "<div class='side-main-article-container $side_container_class'>";
				tha_content_before_container();
				echo "<div class=\"site-main-article-content $container_class\">";

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
