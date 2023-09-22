<?php
/**
 * Testimonial slider Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'testimonial-slider-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block testimonial-slider-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="testimonial-slider-block-container">

		<header class="testimonial-slider-block-container-header">
			<h2 class="testimonial-slider-block-container-header__title"><?php echo esc_attr( $acf_title ); ?></h2>
		</header>
		<div class="quote_icon">
				<div class="icon">
				<svg width="42" height="36" viewBox="0 0 42 36" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M10.0934 35.2C6.96003 35.2 4.59336 34.0667 2.99336 31.8C1.46003 29.4667 0.69336 26.2333 0.69336 22.1C0.69336 17.3667 1.86003 13.2 4.19336 9.6C6.52669 6 10.0934 3.03333 14.8934 0.699997L18.0934 7.1C15.0934 8.63333 12.8267 10.4 11.2934 12.4C9.82669 14.3333 9.09336 16.8 9.09336 19.8C9.29336 19.7333 9.62669 19.7 10.0934 19.7C12.2267 19.7 14.0267 20.3667 15.4934 21.7C17.0267 22.9667 17.7934 24.7333 17.7934 27C17.7934 29.5333 17.06 31.5333 15.5934 33C14.1267 34.4667 12.2934 35.2 10.0934 35.2ZM33.6934 35.2C30.56 35.2 28.1934 34.0667 26.5934 31.8C25.06 29.4667 24.2934 26.2333 24.2934 22.1C24.2934 17.3667 25.46 13.2 27.7934 9.6C30.1267 6 33.6934 3.03333 38.4934 0.699997L41.6934 7.1C38.6934 8.63333 36.4267 10.4 34.8934 12.4C33.4267 14.3333 32.6934 16.8 32.6934 19.8C32.8934 19.7333 33.2267 19.7 33.6934 19.7C35.8267 19.7 37.6267 20.3667 39.0934 21.7C40.6267 22.9667 41.3934 24.7333 41.3934 27C41.3934 29.5333 40.66 31.5333 39.1934 33C37.7267 34.4667 35.8934 35.2 33.6934 35.2Z" fill="white"/>
				</svg>
				</div>
			</div>
		<div class="testimonial-slider-block-container-testimonial-slider">
			
			<?php
			if ( have_rows( 'testimonials' ) ) :

				// Loop through rows.
				while ( have_rows( 'testimonials' ) ) :
					the_row();
					$testimonial = get_sub_field( 'testimonial' );
					$id_post     = $testimonial->ID;
					$rating      = get_field( 'rating', $id_post );
					?>
					<div class="testimonial-slider-block-container-testimonial-slider-testimonial ">
						<blockquote class="testimonial-slider-block-container-testimonial-slider-testimonial__content">
							<span class="content"><?php echo wp_kses_post( $testimonial->post_content ); ?></span>
							<span class="title"><?php echo wp_kses_post( get_the_title( $id_post ) ); ?></span>
							<span class="date"><span><?php the_field( 'location', $id_post ); ?></span>|<span><?php the_field( 'date', $id_post ); ?></span></span>
							<span class="rating">
							<div class="stars">
								<?php for ( $i = 0; $i < 5; $i++ ) : ?>
									<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
									</svg>
								<?php endfor; ?>


								<div class="cover" style="width: calc(<?php echo 100 - ( $rating * 20 ); ?>% );"></div>
							</div>
						</blockquote>
					</div>
					<?php
					// End loop.
				endwhile;

			endif;
			?>
			 

		</div>
		<div class="testimonial-slider-block-container-testimonial-slider__slider-controls">
			<button class="prev">Previous</button>
			<span class="slide-counter"></span>
			<button class="next">Next</button>
		</div>
		<div class="testimonial-slider-block-container-testimonial_read_more">
			<a href="" class="btn">Read Our 2,400+ Reviews</a>
		</div>
		
		
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
	jQuery(function() {
		jQuery('.testimonial-slider-block-container-testimonial-slider').slick({
			infinite: true,
			speed: 700,
			autoplay:true,
			autoplaySpeed: 2000,
			arrows:false,
			slidesToShow: 1,
			slidesToScroll: 1,
			prevArrow: jQuery(".testimonial-slider-block-container-testimonial-slider__slider-controls .prev"),
			nextArrow: jQuery(".testimonial-slider-block-container-testimonial-slider__slider-controls .next"),
			appendDots: jQuery(".testimonial-slider-block-container-testimonial-slider__slider-controls__slider-controls"),
			customPaging: function(slider, i) {
				return '<span class="dot"></span>';
			},
		});

			jQuery(".testimonial-slider-block-container-testimonial-slider__slider-controls .prev").click(function(){
			slider.slick("slickPrev");
			});
		
			jQuery(".testimonial-slider-block-container-testimonial-slider__slider-controls .next").click(function(){
			slider.slick("slickNext");
			});

		var slider = jQuery(".testimonial-slider-block-container-testimonial-slider");
		var slideCount = slider.slick("getSlick").slideCount;
		var slideCounter = jQuery(".slide-counter");

		slider.on("beforeChange", function(event, slick, currentSlide, nextSlide){
			slideCounter.text(nextSlide + 1 + " of " + slideCount);
		});

		var slideCounte = jQuery(".slide").length;

		jQuery(".slide-counter").append("1 of " + slideCounte);
});

</script>

<?php endif; ?>