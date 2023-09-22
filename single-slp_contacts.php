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

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'container-fluid', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		echo '<main class="site-main" role="main">'; ?>

			<header class="contact-hero">
				<div class="contact-hero-container">
                    <figure class="contact-hero-container__image">
                        <?php
						$featured_image_url = get_the_post_thumbnail_url( $post_id );
						echo wp_kses_post('<img src="' . $featured_image_url . '" alt="Featured Image">');
						?>
                    </figure>
                    <div class="contact-hero-container__content">
                        <h2 class="entry-title">
                            <?php echo wp_kses_post( get_the_title() ); ?>
                        </h2>
                        <span class="info"><?php the_field('job_title'); ?>, NMLS # <?php the_field('mls'); ?></span>
                    </div>
				</div>
			</header>

            <?php
            echo '<div class="site-main-article-content">';
                tha_content_top();
            ?>
                <div class="slp-contact-info">
                    <div class="slp-contact-info-details">
                        <h2 class="title">Property Type</h2>
                        <div class="detail"><?php the_field('property_type'); ?></div>
                        <h2 class="title">Financing Options</h2>
                        <div class="detail"><?php the_field('financing_options'); ?></div>
                        <h2 class="title">Eligible Professions</h2>
                        <div class="detail">
                        <?php 
                        $post_terms = get_the_terms( $post->ID, 'slp_eligible_professions' );
                        if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
                            foreach( $post_terms as $term ) {
                                echo esc_html( $term->name ) . '<span>,</span> ';
                            }
                        }
                        ?>
                        </div>
                        <h2 class="title">Program Requirements</h2>
                        <div class="detail"><?php the_field('program_requirements'); ?></div>
                        <h2 class="title">Eligible States</h2>
                        <div class="detail">
                        <?php 
                        $post_terms = get_the_terms( $post->ID, 'slp_state' );
                        if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
                            $numItems = count($post_terms);
                            $i = 0;
                            foreach( $post_terms as $term ) {
                                if(++$i === $numItems) {
                                    echo "<span>". esc_html( $term->name ) . "</span> ";
                                } else {
                                    echo "<span>". esc_html( $term->name ) . ",</span> ";
                                }
                                
                            }
                        }
                        ?>
                        </div>
                    </div>
                    <div class="slp-contact-info-loop">
                        <?php the_field('form'); ?>
                    </div>
                </div>
            
            <?php
                tha_content_bottom();
            echo '</div>';

        get_sidebar();
        echo '</main>';

        tha_content_wrap_after();
    echo '</div>';

    tha_content_after();

get_footer();
