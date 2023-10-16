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

if ( get_field( 'post_format_style' ) == 'full-width' ) {
	$container_class .= 'site-main-article-content__full-width';
}

tha_content_before();

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		tha_page_header();

		echo '<main class="site-main" role="main">';

			tha_single_header();

			echo "<div class='side-main-article-container'>";
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
