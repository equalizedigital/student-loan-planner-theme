<?php

/**
 * resource blocks Block Template.
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
$id = 'resource-blocks-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block resource-blocks-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
$subcopy = get_field('subcopy');
$blocks = get_field('blocks');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<header class="resource-blocks-block-container">
		<h2 class="title"><?php echo $title; ?></h2>
		<span class="subtitle"><?php echo $subcopy; ?></span>
	</header>

	<div class="resource-blocks-block-container-list">
	<?php 
		 
		if( $blocks ) {
			echo '<ul class="resource-blocks-block-container-list-item">';
			foreach( $blocks as $row ) {
				if(!empty($row['link'])){
					$link = $row['link']['url'];
				}
				
				if(!empty($row['subcopy'])){
					$subcopy = $row['subcopy'];
				}
				if(!empty($row['title'])){
					$title = $row['title'];
					echo '<li class="resource-blocks-block-container-list-item__block">';
						echo "<a href=\"$link\">";
						?>
							<h3 class="title"><?php _e($title); ?></h3>
							<p><?php _e($subcopy); ?></p>
						<?php
						echo "</a>";
					echo '</li>';
				}

			}
			echo '</ul>';
		}
		?>
	</div>
</section>