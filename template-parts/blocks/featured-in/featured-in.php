<?php

/**
 * featured in block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'featured-in-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block featured-in-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="featured-in-block-container">
		<?php echo "<header class=\"featured-in-block-container-header\"><h2 class=\"featured-in-block-container-header__title\">$title</h2></header>"; ?>
		<?php
		$images = get_field( 'images' );
		if ( $images ) {
			echo '<div class="featured-in-block-container-images">';
			foreach ( $images as $row ) {
				if ( ! empty( $row['image'] ) ) {
					$image = $row['image']['url'];
				}
				if ( ! empty( $row['image'] ) ) {
					$imageAlt = $row['image']['alt'];
				}

				echo '<div class="featured-in-block-container-images__image">';
				if ( ! empty( $image ) ) {
					echo "<img src='$image' alt='$imageAlt'></img>";
				}
				echo '</div>';
			}
			echo '</div>';
		}
		?>
	</div>
</section>
