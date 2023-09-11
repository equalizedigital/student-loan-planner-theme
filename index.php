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

tha_content_before();

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		echo '<main class="site-main" role="main">';
			tha_single_header();

			echo '<div class="site-main-article-content">';
				tha_content_top();
				tha_content_loop();
				tha_content_bottom();
			echo '</div>';

			get_sidebar();
		echo '</main>';
		
		tha_content_wrap_after();
	echo '</div>';
	
tha_content_after();

get_footer();
