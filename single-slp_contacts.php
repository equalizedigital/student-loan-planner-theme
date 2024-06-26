<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
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
						if ( ! empty( $featured_image_url ) ) :
							echo wp_kses_post( '<img src="' . $featured_image_url . '" alt="Featured Image">' );
						endif;
						?>
					</figure>
					<div class="contact-hero-container__content">
						<h1 class="entry-title">
							<?php 
							$insti = get_field( 'institution_name' );
							echo 'Contact ' . wp_kses_post( get_the_title() );
							if ( ! empty( $insti ) ) {
								echo ' at ' . esc_html( $insti );
							}
							?>
						</h1>
						<span class="info">
							<?php echo esc_html( get_field( 'job_title' ) ); ?>
							<?php if ( get_field( 'mls' ) ) : ?>
							, NMLS # <?php echo esc_html( get_field( 'mls' ) ); ?>
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
						
						<?php if ( get_field( 'property_type' ) ) : ?>
						<h2 class="title">Property Type</h2>
						<div class="detail"><?php echo wp_kses_post( get_field( 'property_type' ) ); ?></div>
						<?php endif; ?>

						<?php if ( get_field( 'financing_options' ) ) : ?>
						<h2 class="title">Financing Options</h2>
						<div class="detail"><?php echo wp_kses_post( get_field( 'financing_options' ) ); ?></div>
						<?php endif; ?>

						<?php 
						$post_terms = get_the_terms( $post->ID, 'slp_eligible_professions' );
						if ( ! empty( $post_terms ) ) : 
							?>
						<h2 class="title">Eligible Professions</h2>
						<div class="detail">
							<?php 
						
							if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
								$num_items = count( $post_terms );
								$i         = 0;
								foreach ( $post_terms as $post_term ) {
								
									if ( ++$i === $num_items ) {
										echo esc_html( $post_term->name ) . '';
									} else {
										echo esc_html( $post_term->name ) . '<span>,</span> ';
									}
								}
							}
							?>
						</div>
						<?php endif; ?>

						<?php if ( get_field( 'program_requirements' ) ) : ?>
						<h2 class="title">Program Requirements</h2>
						<div class="detail"><?php echo wp_kses_post( get_field( 'program_requirements' ) ); ?></div>
						<?php endif; ?>

						<?php 
						$post_terms = get_the_terms( $post->ID, 'slp_state' );
						if ( ! empty( $post_terms ) ) : 
							?>
						<h2 class="title">Eligible States</h2>
						<div class="detail">
							<?php 
							if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
								$num_items = count( $post_terms );
								$i         = 0;
								foreach ( $post_terms as $post_term ) {
									if ( ++$i === $num_items ) {
										echo '<span>' . esc_html( $post_term->name ) . '</span> ';
									} else {
										echo '<span>' . esc_html( $post_term->name ) . ',</span> ';
									}                               
								}
							}
							?>
						</div>
						<?php endif; ?>

					</div>
					<div class="slp-contact-info-loop">
						<?php 
						$form_shortcode = get_field( 'form_shortcode' );
						if ( ! empty( $form_shortcode ) ) :
							?>
							<h2>Get Started</h2>
							<?php $form_code = get_field( 'form_shortcode' ); ?>
							<?php echo do_shortcode( $form_code ); ?>
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
