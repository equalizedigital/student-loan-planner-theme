<?php

/**
 * Video Testimonials Block.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'testimonial-videos-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block testimonial-videos-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<span class="testimonial-videos-block-container-icon">
		<svg width="42" height="36" viewBox="0 0 42 36" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M10.0445 35.3912C6.97787 35.3912 4.64453 34.2245 3.04453 31.8912C1.44453 29.5578 0.644532 26.3578 0.644532 22.2912C0.644532 17.5578 1.8112 13.3912 4.14453 9.79116C6.47786 6.19116 10.0445 3.22449 14.8445 0.891159L18.0445 7.29116C15.0445 8.75783 12.7779 10.5245 11.2445 12.5912C9.77787 14.5912 9.04453 17.0578 9.04453 19.9912C9.17787 19.9245 9.34453 19.8912 9.54453 19.8912C9.74453 19.8912 9.9112 19.8912 10.0445 19.8912C12.1779 19.8912 13.9779 20.5578 15.4445 21.8912C16.9779 23.1578 17.7445 24.9245 17.7445 27.1912C17.7445 29.6578 17.0112 31.6578 15.5445 33.1912C14.0779 34.6578 12.2445 35.3912 10.0445 35.3912ZM33.7445 35.3912C30.6779 35.3912 28.3445 34.2245 26.7445 31.8912C25.1445 29.5578 24.3445 26.3578 24.3445 22.2912C24.3445 17.5578 25.5112 13.3912 27.8445 9.79116C30.1779 6.19116 33.7445 3.22449 38.5445 0.891159L41.7445 7.29116C38.7445 8.75783 36.4779 10.5245 34.9445 12.5912C33.4779 14.5912 32.7445 17.0578 32.7445 19.9912C32.8779 19.9245 33.0445 19.8912 33.2445 19.8912C33.4445 19.8912 33.6112 19.8912 33.7445 19.8912C35.8779 19.8912 37.6779 20.5578 39.1445 21.8912C40.6779 23.1578 41.4445 24.9245 41.4445 27.1912C41.4445 29.6578 40.7112 31.6578 39.2445 33.1912C37.7779 34.6578 35.9445 35.3912 33.7445 35.3912Z" fill="#625089" />
		</svg>

	</span>
	<div class="testimonial-videos-block-container">
		<div class="testimonial-videos-block-container-columns">

			<?php if ( have_rows( 'testimonials' ) ) : ?>
				<?php
				while ( have_rows( 'testimonials' ) ) :
					the_row();
					?>
					<?php if ( $testimonial = get_sub_field( 'testimonial' ) ) : ?>
						<div class="testimonial-videos-block-continer-columns-column">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( $testimonial ); ?>?si=AddWOvgRe2UG6nOQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>
			<?php endif; ?>




		</div>


		<?php if ( $blockquote = get_field( 'blockquote' ) ) : ?>

			<div class="testimonial-videos-block-container-content">
				<blockquote>
					<span class="text">
						<?php echo $blockquote; ?>
					</span>

					<?php if ( $cite = get_field( 'cite' ) ) : ?>

						<cite><?php echo esc_html( $cite ); ?></cite>
					<?php endif; ?>
				</blockquote>
			</div>
		<?php endif; ?>


	</div>
</section>
