<?php
/**
 * full-width-columns-cta-inner Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package full-width-columns-cta-inner
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'full-width-columns-cta-inner-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block full-width-columns-cta-inner-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title                          = get_field( 'title' );
$content                            = get_field( 'content' );
$image                              = get_field( 'image' );
$youtube_video_id                   = get_field( 'youtube_video_id' );
$acf_link                           = get_field( 'link' );
$modal_button                       = get_field( 'modal_button' );

?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="full-width-columns-cta-inner-container">
		<div class="full-width-columns-cta-inner-container-content">
			<h2 class="title <?php echo !empty(get_field('title_size'))?'title_medium':'';  ?> "><?php echo wp_kses_post( $acf_title ); ?></h2>
			<div class="content"><?php echo wp_kses_post( $content ); ?></div>
			<?php if ( $modal_button ) : ?>
				<button class="btn modal-btn" data-modal="modal1" aria-label="Open Video"><?php echo wp_kses_post( $modal_button ); ?></button>
			<?php endif; ?>
			<?php if ( $acf_link ) : ?>
			<div class="link">
				<a href="<?php echo wp_kses_post( $acf_link['url'] ); ?>" class="btn btn-dark-bg"><?php echo wp_kses_post( $acf_link['title'] ); ?></a>
			</div>
			<?php endif; ?>
		</div>
		<div class="full-width-columns-cta-inner-container__video" >
			<?php if ( $image ) : ?>
				<img src="<?php echo wp_kses_post( $image['url'] ); ?>" alt="<?php echo wp_kses_post( $image['alt'] ); ?>">	
			<?php endif; ?>
			<?php if(!empty($youtube_video_id)): ?>
			<button class="modal-btn full-width-columns-cta-inner-container__video__button" aria-haspopup="dialog" data-modal="modal1" aria-label="Open Video" id="play-iframe" >
				<img class="play" src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility'; ?>/play.svg" alt="play video"  >
			</button>
			<?php endif; ?>
		</div>
	</div>
</section>

<div id="modal1" class="modal" role="dialog" aria-modal="true">
	<div class="modal-content" >
	<button class="close-btn">
		<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
	</button>
	<div id="player"></div>
	<div class="iframe_capture" tabindex="0"></div>
	</div>
</div>

<script src="https://www.youtube.com/iframe_api"></script>

<script>
let player;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: '390',
		width: '640',
		videoId: '<?php echo wp_kses_post( $youtube_video_id ); ?>',
		events: {
			'onReady': onPlayerReady,
			// 'onStateChange': onPlayerStateChange
		}
	});
}
function onPlayerReady(event) {                                        
	event.target.pauseVideo();
}
function playVideo() {
	player.pauseVideo();
	document.getElementById("thumbnail").style.display = "none";
	document.getElementById("play-iframe").style.display = "none";
}

jQuery(function ($) {
	$(document).ready(function () {
		jQuery('.modal .close-btn').click(function(e) {
			player.pauseVideo();
		});
	});
});

</script>
