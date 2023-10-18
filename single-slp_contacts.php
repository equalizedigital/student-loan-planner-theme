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
						if(!empty($featured_image_url)):
						echo wp_kses_post('<img src="' . $featured_image_url . '" alt="Featured Image">');
						endif;
						?>
					</figure>
					<div class="contact-hero-container__content">
						<h2 class="entry-title">
							<?php echo wp_kses_post( get_the_title() ); ?>
						</h2>
						<span class="info">
							<?php the_field('job_title'); ?>
							<?php if(get_field('mls')): ?>
							, NMLS # <?php the_field('mls'); ?>
							<?php endif; ?>
						</span>
					</div>
				</div>
			</header>

			<?php
			echo '<div class="site-main-article-content">';
				tha_content_top();
			?>
				<div class="slp-contact-info">
					<div class="slp-contact-info-details">
						
						<?php if(get_field('property_type')): ?>
						<h2 class="title">Property Type</h2>
						<div class="detail"><?php the_field('property_type'); ?></div>
						<?php endif; ?>

						<?php if(get_field('financing_options')): ?>
						<h2 class="title">Financing Options</h2>
						<div class="detail"><?php the_field('financing_options'); ?></div>
						<?php endif; ?>

						<?php 
						$post_terms = get_the_terms( $post->ID, 'slp_eligible_professions' );
						if(!empty($post_terms)): 
						?>
						<h2 class="title">Eligible Professions</h2>
						<div class="detail">
						<?php 
						
						if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
							$numItems = count($post_terms);
							$i = 0;
							foreach( $post_terms as $term ) {
								
								if(++$i === $numItems) {
									echo esc_html( $term->name ) . '';
								} else {
									echo esc_html( $term->name ) . '<span>,</span> ';
								}
							}
						}
						?>
						</div>
						<?php endif; ?>

						<?php if(get_field('program_requirements')): ?>
						<h2 class="title">Program Requirements</h2>
						<div class="detail"><?php the_field('program_requirements'); ?></div>
						<?php endif; ?>

						<?php 
						$post_terms = get_the_terms( $post->ID, 'slp_state' );
						if(!empty($post_terms)): 
						?>
						<h2 class="title">Eligible States</h2>
						<div class="detail">
						<?php 
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
						<?php endif; ?>

					</div>
					<div class="slp-contact-info-loop">
						<?php 
						$contact_email = get_field( 'contact_email_address' );
						if ( !empty($contact_email)  ) : ?>
							<h2>Get Started</h2>
							<?php echo do_shortcode( '[wpforms id="82637"]' ); ?>
						<?php endif; ?>
						
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
