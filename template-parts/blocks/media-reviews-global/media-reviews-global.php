<?php
/**
 * Media Reviews Global Block Template.
 * 
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'media-reviews-global-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block media-reviews-global-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title             = get_field( 'title', 'option' );
$block_style             = get_field( 'block_style', 'option' );
$testimonial_block_style = get_field( 'testimonial_block_style', 'option' );
$hide_title              = get_field( 'hide_title' );

if ( $testimonial_block_style ) :
	$class_name .= ' media-reviews-global-block_' . $testimonial_block_style;
endif;
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> <?php echo 'purple' === $block_style ? 'media-reviews-global-block-purple' : ''; ?>">
	<div class="media-reviews-global-container">

		<?php if ( ! $hide_title ) : ?>
			<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
		<?php endif; ?>
		<div class="media-reviews-global-container-review-items">
			<?php
			if ( have_rows( 'select_reviews', 'option' ) ) :
				while ( have_rows( 'select_reviews', 'option' ) ) :
					the_row();

					$review_link       = get_sub_field( 'link' );
					$logo              = get_sub_field( 'logo' );
					$logo_white        = get_sub_field( 'logo_white' );
					$stars             = get_sub_field( 'stars' );
					$number_of_reviews = get_sub_field( 'number_of_reviews' );
					?>
				<div class="media-reviews-global-container-review-items-item">
					<a href="<?php echo esc_url( $review_link ); ?>" aria-label="<?php echo esc_attr( $logo['alt'] ); ?>. <?php echo esc_html( $stars ); ?> out of 5 stars. <?php echo esc_html( $number_of_reviews ); ?> reviews.">
						<figure>
							<?php if ( ! empty( $logo ) ) : ?>
								<img src="<?php echo esc_url( $logo['url'] ); ?>" class="image" alt="<?php echo esc_attr( $logo['alt'] ); ?>">
							<?php endif; ?>
							<?php if ( ! empty( $logo_white ) ) : ?>
								<img src="<?php echo esc_url( $logo_white['url'] ); ?>" class="image-white" alt="<?php echo esc_attr( $logo_white['alt'] ); ?>">
							<?php endif; ?>
						</figure>
						<div class="rating-stars">
							<span class="star">
								<?php for ( $i = 0; $i < 5; $i++ ) : ?>
									<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
									</svg>
								<?php endfor; ?>

								<div class="cover" style="width: calc(<?php echo 100 - ( esc_html( $stars ) * 20 ); ?>% );"></div>
							</span>
							<div class="number_of_stars"><?php echo esc_html( $stars ); ?> out of 5</div>
						</div>
						<span class="reviews_amount"><?php echo esc_html( $number_of_reviews ); ?> Reviews</span>
					</a>
				</div>
					<?php
				endwhile;
			endif;
			?>
		</div>


	</div>
</section>
