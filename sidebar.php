<?php
/**
 * Sidebar
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

if ( ! function_exists( 'mst_page_layout' ) ) {
	return;
}

$layout = mst_page_layout();
if ( ! in_array( $layout, array( 'content-sidebar', 'sidebar-content' ), true ) ) {
	return;
}

$sidebar = apply_filters( 'mst_sidebar', 'primary-sidebar' );
if ( ! apply_filters( 'mst_display_sidebar', true ) ) {
	return;
}

tha_sidebars_before();

echo '<aside class="sidebar-primary" role="complementary">';
tha_sidebar_top();
if ( is_active_sidebar( $sidebar ) ) {
	dynamic_sidebar( $sidebar );
}
tha_sidebar_bottom();
echo '</aside>';

tha_sidebars_after();
