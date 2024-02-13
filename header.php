<?php
/**
 * Site Header
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<!DOCTYPE html>';
tha_html_before();
?>
<html <?php language_attributes(); ?>>
<?php

echo '<head>';
	tha_head_top();
	wp_head();
	tha_head_bottom();
echo '</head>';

if ( is_post_type_archive( 'eqd-featured-press' ) ) {
	$body_classes = 'press-archive-page';
}

echo '<body class="'. $body_classes . ' ' . esc_attr( join( ' ', get_body_class() ) ) . '" id="top">';
wp_body_open();
tha_body_top();



echo '<div class="site-container">';
	echo '<a class="skip-link screen-reader-text" href="#main-content">' . esc_html__( 'Skip to content', 'eqd' ) . '</a>';

	tha_header_before();
	echo '<header class="site-header" role="banner"><div class="wrap">';
		tha_header_top();

		echo '<div class="title-area">';
			$logo_tag = ( apply_filters( 'eqd_h1_site_title', false ) ) ? 'h1' : 'p';
			echo '<' . esc_attr( $logo_tag ) . ' class="site-title"><a href="' . esc_url( home_url() ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $logo_tag ) . '>';
		echo '</div>';

		slp_main_menu();
	echo '</div></header>';
	tha_header_after();
	echo '<div class="site-inner" id="main-content">';
