<?php

/**
 * hero Block Template.
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
$id = 'hero-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block hero-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
$subtitle = get_field('subtitle');
$background_image = get_field('background_image');
$title_max_width_desktop = get_field('title_max_width_desktop');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="hero-container">
		<h2 class="title" style="max-width:<?php echo $title_max_width_desktop ? $title_max_width_desktop:''; ?>%;"><?php echo $title; ?></h2>
		<span class="subtitle"><?php echo $subtitle; ?></span>
	</div>
	<?php if($background_image): ?>
		<?php echo wp_get_attachment_image($background_image,'full'); ?>
	<?php endif; ?>
</section>