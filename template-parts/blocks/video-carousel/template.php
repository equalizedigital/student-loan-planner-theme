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
  <div class="swiper-container">
      <div class="swiper-wrapper">

          <div class="swiper-slide">
						<div class="slide-container">
							<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            	<video src="https://into-the-program.com/uploads/sample_video01.mp4" muted></video>
						</div>
          </div>

					<div class="swiper-slide">
						<div class="slide-container">
							<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            	<video src="https://into-the-program.com/uploads/sample_video01.mp4" muted></video>
						</div>
          </div>

					<div class="swiper-slide">
						<div class="slide-container">
							<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            	<video src="https://into-the-program.com/uploads/sample_video01.mp4" muted></video>
						</div>
          </div>

					<div class="swiper-slide">
						<div class="slide-container">
							<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            	<video src="https://into-the-program.com/uploads/sample_video01.mp4" muted></video>
						</div>
          </div>

					<div class="swiper-slide">
						<div class="slide-container">
							<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            	<video src="https://into-the-program.com/uploads/sample_video01.mp4" muted></video>
						</div>
          </div>

          <div class="swiper-slide">
					<div class="slide-container">
					<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            <video src="https://into-the-program.com/uploads/sample_video02.mp4" preload="none" muted></video>
						</div>
          </div>
          <div class="swiper-slide">
					<div class="slide-container">
					<div class="image-object">
								<img class="image-placeholder" src="https://slpwealth.test/wp-content/uploads/2024/03/Rectangle-56.jpg" alt="">
								<button class="image-placeholder-action">
								<img class="image-placeholder-btn" src="<?php echo $image_path; ?>/play.svg" alt="">
								</button>
							</div>
            <video src="https://into-the-program.com/uploads/sample_video03.mp4" preload="none" muted></video>
						</div>
          </div>
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
  </div>
</section>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
