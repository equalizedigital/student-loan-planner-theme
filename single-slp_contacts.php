<?php
/**
 * Single Post
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Entry Header.
add_action( 'eqd_entry_title_after', 'eqd_entry_author', 12 );
add_action( 'eqd_entry_title_after', 'eqd_entry_date', 12 );


// Build the page.
get_header();

tha_content_before();

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		echo '<main class="site-main" role="main">';
                ?>

            <header class="hero">
                <div class="hero-container">
                    <h1 class="hero-container__title entry-title">
                        <?php echo wp_kses_post( get_the_title() ); ?>
                        <?php 
                        $featured_image_url = get_the_post_thumbnail_url($post_id);
                        echo '<img src="' . $featured_image_url . '" alt="Featured Image">';
                        ?>
                    </h1>
                </div>
            </header>

                <?php

			echo '<div class="site-main-article-content">';
				tha_content_top();
                ?>
                eee
                <?php tha_content_loop(); ?>
                eee
                <?php
				tha_content_bottom();
			echo '</div>';

			get_sidebar();
		echo '</main>';
		
		tha_content_wrap_after();
	echo '</div>';
	
tha_content_after();

get_footer();
