<?php
/**
 * Video Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block Title Template
 */

$block_name = 'video_block_template';

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
$video_path = get_template_directory_uri() . '/assets/videos/';

$heading = get_field( 'heading' );
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="video_block_template_container">
		<div class="video_block_template_container_content">
			<div class="video_block_template_container_content_block">
			<?php
			// Assuming the field name is 'heading_level_select'
			$heading_level = get_field('heading_level_select');

			// Default to h2 if no selection is made
			if (!$heading_level) {
				$heading_level = 'h2';
			}

			// Assuming the field name for the heading text is 'heading_text'
			$heading_text = get_field('heading');
			?>

			<?php if($heading_text): ?>
				<?php if ( $heading ) : ?>
					<<?php echo $heading_level; ?> class="video_block_template_container_content_block_heading"><?php echo esc_html($heading_text); ?></<?php echo $heading_level; ?>>
				<?php endif; ?>
			<?php endif; ?>
				<button class="btn btn-dark-bg">Get Started</button>
			</div>
		</div>
		<div class="video_block_template_container_media">
			<div class="video_block_template_container_media_video">
				<video class="video-element video-placeholder" id="video-placeholder" controlslist="nodownload" loop autoplay muted>
					<source src="<?php echo wp_kses_post( $video_path ); ?>/h264_1080_best.mp4"  type="video/mp4">
				</video>
				<button class="video_block_template_container_media_video_button modal-btn" data-modal="modal_video_block_<?php echo esc_attr( $block_id ); ?>" aria-label="Play Video">
					<img src="<?php echo $image_path; ?>/play.svg" alt="">
				</button>
			</div>
			<div class="video_block_template_container_media_placeholder_action">
				<button class="video_block_template_container_media_placeholder_action_btn" aria-label="Pause Video">
					<span class="img"><img src="<?php echo $image_path; ?>/pause.svg" alt=""></span>
					<span class="text" aria-live>Pause Video</span>
				</button>
			</div>

		</div>
	</div>
</section>

<div id="modal_video_block_<?php echo esc_attr( $block_id ); ?>" class="modal video_block_modal" aria-hidden="true" role="dialog" aria-modal="true">
	<div class="modal-content" >
		<button class="close-btn" aria-label="Close Modal">
			<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
		</button>
		<div class="content">
			<video  class="video-element" controlslist="nodownload"  autoplay muted>
				<source src="<?php echo wp_kses_post( $video_path ); ?>/h264_1080_best.mp4"  type="video/mp4">
			</video>
		</div>
	</div>
</div>
