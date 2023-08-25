<?php

/**
 * featured in block Block Template.
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
$id = 'featured-in-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block featured-in-block';
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
	<div class="featured-in-block-container">
		<?php echo "<header class=\"featured-in-block-container-header\"><h2 class=\"featured-in-block-container-header__title\">$title</h2></header>"; ?>
		<?php 
		$images = get_field('images');
		if( $images ) {
			echo '<div class="featured-in-block-container-images">';
			foreach( $images as $row ) {
				$image = $row['image']['url'];
				echo '<div class="featured-in-block-container-images__image">';
					echo "<img src='$image'></img>";
				echo '</div>';
			}
			echo '</div>';
		}
		?>
	</div>
</section>