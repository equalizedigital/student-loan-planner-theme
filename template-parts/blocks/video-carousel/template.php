<?php
/**
 * Video Carousel Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block Title Template
 */

$block_name = 'video_carousel_template';

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = $block_name . '-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block ' . $block_name;
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
$image_path = get_template_directory_uri() . '/assets/images/';
?>


<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="video-carousel-swiper-container">

		<div class="swiper-wrapper">

			<?php
			if ( have_rows( 'video_carousel' ) ) :
				$rows = get_field( 'video_carousel' ); // Assuming 'video_carousel' is a field of the current post
				// Repeat the process 3 times
				for ( $i = 0; $i < 3; $i++ ) :
					// Reset the rows pointer to ensure have_rows works correctly in each iteration
					reset( $rows );
					?>
					<?php
					while ( have_rows( 'video_carousel' ) ) :
						the_row();
						$video_cc = get_sub_field( 'video_cc' );
						?>

				<div class="swiper-slide">
					<div class="slide_main_container">
						<div class="slide_main_container_disable"></div>

						<div class="slide-container">
							<div class="image-object">

								<?php
								$placeholder_image = get_sub_field( 'placeholder_image' );
								if ( $placeholder_image ) {
									echo wp_get_attachment_image( $placeholder_image['ID'], 'full', '', array( 'class' => 'image-placeholder' ) );
								}
								?>
								<button class="image-placeholder-action" aria-label="Play Video">
									<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="play video">
								</button>
							</div>
								<?php
								$video_url = get_sub_field( 'video_url' );
								if ( $video_url ) :
									?>
								<video class="video-autoplay">
									<source src="<?php echo esc_url( $video_url ); ?>"  type="video/mp4">
									<?php if ( $video_cc ) : ?>
									<track src="<?php echo esc_url( $video_cc['url'] ); ?>" kind="subtitles" srclang="en" label="English" default>
								<?php endif; ?>
								</video>
							<?php endif; ?>
						</div>

						<div class="slide_link">
							<?php
							$link_carousel = get_sub_field( 'work_with_link' );
							if ( $link_carousel ) :
								$link_carousel_url    = $link_carousel['url'];
								$link_carousel_title  = $link_carousel['title'];
								$link_carousel_target = $link_carousel['target'] ? $link_carousel['target'] : '_self';
								?>
								<a class="btn" href="<?php echo esc_url( $link_carousel_url ); ?>" target="<?php echo esc_attr( $link_carousel_target ); ?>"><?php echo esc_html( $link_carousel_title ); ?></a>
							<?php endif; ?>
						</div>

					</div>
				</div>

							<?php
						endwhile;
			endfor;
				?>
			<?php endif; ?>

		</div>

		<div class="swiper-nav">
			<div class="swiper-button-prev">
				<span class="arrow">
					<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.5 1L2 5.5L6.5 10" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</span>
				Prev
			</div>
			|
				<div class="swiper-button-next">
				Next
				<span class="arrow">
					<svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M4.5 10L9 5.5L4.5 1" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
					</svg>
				</span>
			</div>

		</div>

	</div>
</section>



<?php
if ( has_block( 'acf/video-carousel' ) ) {
	?>
	<?php
	// Construct the path to the JavaScript file
	$js_file_path = get_template_directory_uri() . '/assets/js/video-carousel-min.js';

	// Retrieve the contents of the JavaScript file
	$js_content = file_get_contents( $js_file_path );

	// Check if the file was successfully read
	if ( $js_content !== false ) {
		// Output the JavaScript content within a <script> tag
		echo '<script>' . $js_content . '</script>';
	}
	?>

	<?php
}

?>
