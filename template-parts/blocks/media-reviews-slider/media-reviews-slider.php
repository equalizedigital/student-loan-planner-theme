<?php

/**
 * media-reviews-slider Block Template.
 *
 * @param	 array $block The block settings and attributes.
 * @param	 string $content The block inner HTML (empty).
 * @param	 bool $is_preview True during AJAX preview.
 * @param	 (int|string) $post_id The post ID this block is saved to.
 */

if( isset( $block['data']['preview_image_help'] )  ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'media-reviews-slider-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block media-reviews-slider-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="media-reviews-slider-container">

	<?php
	// Check rows existexists.
	if( have_rows('testimonials') ):
		?><div class="media-reviews-slider-container-slider"><?php
		// Loop through rows.
		while( have_rows('testimonials') ) : the_row();

			// Load sub field value.
			$testiomonial = get_sub_field('testiomonial');
			$testimonial_youtube_video_id = get_sub_field('testimonial_youtube_video_id');
			?>
			<div class="media-reviews-slider-container-slider_slide">
				<blockquote class="media-reviews-slider-container-slider_slide_blockquote">
					<span class="text"></span>
					<span class="author"></span>
				</blockquote>
				<?php if($testimonial_youtube_video_id): ?>
					
					<iframe 
						width="560" 
						height="315" 
						src="https://www.youtube.com/embed/<?php _e($testimonial_youtube_video_id); ?>" 
						title="YouTube video player" 
						frameborder="0" 
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
						allowfullscreen></iframe>
				<?php endif; ?>
			</div>
		<?php
		// End loop.
		endwhile;
		?></div><?php
	// No value.
	else :
		// Do something...<
	endif;
	?>


    </div>
</section>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>