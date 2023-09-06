<?php

/**
 * full-width-columns-background Block Template.
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
$id = 'full-width-columns-background-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block full-width-columns-background-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
$content = get_field('content');
$image = get_field('image');
$youtube_video_id = get_field('youtube_video_id');
 
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="full-width-columns-background-container">
		<div class="full-width-columns-background-container-content">
			<h2 class="title"><?php echo $title; ?></h2>
			<div class="content"><?php echo $content; ?></div>
		</div>
		<div class="full-width-columns-background-container__video" >
			<button class="modal-btn full-width-columns-background-container__video__button" data-modal="modal1"  onclick="playVideo();" aria-label="Open Video" id="play-iframe">
				<?php if($image): ?>
					<img src="<?php _e($image['url']); ?>" alt="<?php _e($image['alt']); ?>">	
				<?php endif; ?>
				<img class=" play"  src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/play.svg" alt="play video"  >
			</button>
		</div>
	</div>
</section>

<div id="modal1" class="modal">
  <div class="modal-content">
    <span class="close-btn">
		<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
	</span>
    <div id="player"></div>
  </div>
</div>

<script src="https://www.youtube.com/iframe_api"></script>

<script>
let player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '390',
        width: '640',
        videoId: '<?php echo $youtube_video_id; ?>',
        events: {
            // 'onReady': onPlayerReady,
            // 'onStateChange': onPlayerStateChange
        }
    });
}

function playVideo() {
    player.playVideo();
	document.getElementById("thumbnail").style.display = "none";
	document.getElementById("play-iframe").style.display = "none";
}

</script>