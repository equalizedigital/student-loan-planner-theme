<?php
/**
 * Site Header
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
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

echo '<body class="' . esc_attr( join( ' ', get_body_class() ) ) . '" id="top">';
wp_body_open();
tha_body_top();
echo '<div class="site-container">';
	echo '<a class="skip-link screen-reader-text" href="#main-content">' . esc_html__( 'Skip to content', 'mainspring' ) . '</a>';

	tha_header_before();
	echo '<header class="site-header" role="banner"><div class="wrap">';
		tha_header_top();

		echo '<div class="title-area">';
		$logo_tag = ( apply_filters( 'mst_h1_site_title', false ) || ( is_front_page() && is_home() ) ) ? 'h1' : 'p';
		echo '<' . esc_attr( $logo_tag ) . ' class="site-title"><a href="' . esc_url( home_url() ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $logo_tag ) . '>';
		echo '</div>';

		tha_header_bottom();
	echo '</div></header>';
	tha_header_after();
	echo '<div class="site-inner" id="main-content">';
