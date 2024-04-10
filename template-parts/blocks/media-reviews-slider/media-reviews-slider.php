<?php

/**
 * media-reviews-slider Block Template.
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
$id = 'media-reviews-slider-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block media-reviews-slider-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="media-reviews-slider-block-container">
	<div class="media-reviews-slider-block-container__svg">
				<svg width="42" height="36" viewBox="0 0 42 36" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10.0934 35.2C6.96003 35.2 4.59336 34.0667 2.99336 31.8C1.46003 29.4667 0.69336 26.2333 0.69336 22.1C0.69336 17.3667 1.86003 13.2 4.19336 9.6C6.52669 6 10.0934 3.03333 14.8934 0.699997L18.0934 7.1C15.0934 8.63333 12.8267 10.4 11.2934 12.4C9.82669 14.3333 9.09336 16.8 9.09336 19.8C9.29336 19.7333 9.62669 19.7 10.0934 19.7C12.2267 19.7 14.0267 20.3667 15.4934 21.7C17.0267 22.9667 17.7934 24.7333 17.7934 27C17.7934 29.5333 17.06 31.5333 15.5934 33C14.1267 34.4667 12.2934 35.2 10.0934 35.2ZM33.6934 35.2C30.56 35.2 28.1934 34.0667 26.5934 31.8C25.06 29.4667 24.2934 26.2333 24.2934 22.1C24.2934 17.3667 25.46 13.2 27.7934 9.6C30.1267 6 33.6934 3.03333 38.4934 0.699997L41.6934 7.1C38.6934 8.63333 36.4267 10.4 34.8934 12.4C33.4267 14.3333 32.6934 16.8 32.6934 19.8C32.8934 19.7333 33.2267 19.7 33.6934 19.7C35.8267 19.7 37.6267 20.3667 39.0934 21.7C40.6267 22.9667 41.3934 24.7333 41.3934 27C41.3934 29.5333 40.66 31.5333 39.1934 33C37.7267 34.4667 35.8934 35.2 33.6934 35.2Z" fill="#625089"/>
				</svg>
			</div>
	<?php
	// Check rows existexists.
	if ( have_rows( 'testimonials' ) ) :
		?>
		<div class="media-reviews-slider-block-container-slider">

			<?php
			// Loop through rows.
			while ( have_rows( 'testimonials' ) ) :
				the_row();

				// Load sub field value.
				$testimonial                  = get_sub_field( 'testimonial' );
				$testimonial_youtube_video_id = get_sub_field( 'testimonial_youtube_video_id' );
				?>
			<div class="media-reviews-slider-block-container-slider_slide">
				<blockquote class="media-reviews-slider-block-container-slider_slide_blockquote">
					<span class="text"><?php echo get_post_field( 'post_content', $testimonial->ID ); ?></span>
					<span class="author"><?php echo get_the_title( $testimonial->ID ); ?></span>
				</blockquote>
				<?php if ( $testimonial_youtube_video_id ) : ?>
					<iframe
						width="560"
						height="315"
						src="https://www.youtube.com/embed/<?php _e( $testimonial_youtube_video_id ); ?>"
						title="YouTube video player"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
						allowfullscreen></iframe>
				<?php endif; ?>
			</div>
				<?php
		endwhile;
			?>
		</div>
		<?php
	endif;
	?>


	</div>
</section>
<?php
	// Check rows existexists.
if ( have_rows( 'testimonials' ) ) :
	?>

<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<script>
jQuery('.media-reviews-slider-block-container-slider').slick({
	infinite: true,
	speed: 700,
	autoplay:true,
	autoplaySpeed: 2000,
	arrows:false,
	slidesToShow: 1,
	slidesToScroll: 1
});
</script>

<?php endif; ?>
