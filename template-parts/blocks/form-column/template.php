<?php

/**
 * form-column Block Template.
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
$id = 'form-column-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block form-column-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
$copy = get_field('copy');
$form_code = get_field('form_code');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="form-column-container">
		
		<div class="form-column-container-columns">
			<div class="form-column-container-columns__text">
			<h2 class="title" style="max-width:<?php echo $title_max_width_desktop ? $title_max_width_desktop:''; ?>%;"><?php echo $title; ?></h2>
		<span class="$copy"><?php echo $$copy; ?></span>
			</div>
			<div class="form-column-container-columns__form">
			<?php echo $form_code; ?>
			</div>
		</div>
	</div>
		
</section>