<?php
/**
 * Media-reviews Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package slp
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'media-reviews-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block media-reviews-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_style             = get_field( 'block_style' );
$select_testimonials     = get_field( 'select_testimonials' );
$testimonial_block_style = get_field( 'testimonial_block_style' );
$remove_padding          = get_field( 'remove_padding' );
$hide_author_image       = get_field( 'hide_author_image' );
if ( $testimonial_block_style ) :
	$class_name .= ' media-reviews-block_' . $testimonial_block_style;
endif;

if ( $remove_padding ) :
	$class_name .= ' media-reviews-block_padding_' . $remove_padding;
endif;

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> <?php echo 'purple' === $block_style ? 'media-reviews-block-purple' : ''; ?>">
	<div class="media-reviews-container">
		<div class="media-reviews-container-review-items-loop">

		<?php
		if ( ! empty( $select_testimonials ) ) {
			$args = array(
				'post_type' => 'slp_testimonials',
				'post__in'  => $select_testimonials,
				'orderby'   => 'post__in',
			);

		} else {
			$args = array(
				'post_type'      => 'slp_testimonials',
				'posts_per_page' => 4,
			);
		}

		$testimonial_query = new WP_Query( $args );

		if ( $testimonial_query->have_posts() ) :
			while ( $testimonial_query->have_posts() ) :
				$testimonial_query->the_post();
				?>
					<div class="media-reviews-container-review-items-loop-item">
						<blockquote>

							<div class="info">
							<?php
							if ( $testimonial_block_style ) :

								if ( ! $hide_author_image ) {
									the_post_thumbnail( 'medium_large' );    // Medium large (max width 768px unlimited height).
								}
								?>
								<?php endif; ?>
								<h3 class="title"><?php the_title(); ?></h3>

									<div class="location">
									<?php
									$location = get_field( 'location', get_the_ID() );
									?>
									<?php echo wp_kses_post( $location ? $location : '' ); ?>
										<div class="date">
										<?php
										$date = get_field( 'date', get_the_ID() );
										echo wp_kses_post( $date ? $date : '' );
										?>
										</div>
								</div>

								<?php
									$rating                     = get_field( 'rating', get_the_ID() );
									$rating ? $rating : $rating = 0;
								?>
								<?php
								if ( ! empty( $rating ) ) :
									?>
									<div class="rating">

										<div class="rating-stars">
											<span class="star">
													<?php for ( $i = 0; $i < 5; $i++ ) : ?>
														<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
														</svg>
													<?php endfor; ?>

													<div class="cover" style="width: calc(<?php echo wp_kses_post( 100 - ( $rating * 20 ) ); ?>% ));"></div>
											</span>
										</div>
									</div>
								<?php endif; ?>
							</div>

							<div class="content">
								<p>
								<?php
								$content = get_the_content();
								$content = '"' . $content . '"';
								echo wp_kses_post( wp_strip_all_tags( apply_filters( 'the_content', $content ) ) );
								?>
								</p>
							</div>

						</blockquote>
					</div>
				<?php
				endwhile;
			wp_reset_postdata();
			endif;
		?>

		</div>
		<div class="media-reviews-container-review-items-read">
			<?php
			$read_more_link = get_field( 'read_more_link' );
			if ( $read_more_link ) :
				?>
			<a class="btn" href="<?php echo esc_url( $read_more_link['url'] ); ?>"><?php echo wp_kses_post( $read_more_link['title'] ); ?></a>
			<?php endif; ?>
		</div>


	</div>
</section>
