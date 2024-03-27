<?php

/**
 * calculator-signup block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'calculator-signup-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block calculator-signup-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$title = get_field( 'title' );
$copy  = get_field( 'copy' );
if ( get_field( 'image' ) ) {
	$image = get_field( 'image' );
}
$link = get_field( 'link' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="calculator-signup-container">
		<figure class="calculator-signup-container-image">
			<?php if ( ! empty( $image ) ) : ?>
			<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
			<?php endif; ?>
		</figure>

		<div class="calculator-signup-container-content">
			<h2 class="title"><?php echo $title; ?></h2>
			<div class="text"><?php echo $copy; ?></div>
			<?php 
			if ( ! empty( $link ) ) {
				$url   = $link['url'];
				$title = $link['title'];
				echo '<span class="content">';
				echo "<a href=\"$url\" class=\"btn btn-dark-bg\">";
					echo $title;
				echo '</a>';
				echo '</span>';
			}
			?>
			<?php
			$list = get_field( 'list' );
			if ( $list ) {
				echo '<div class="calculator-signup-container-content-list">';
				foreach ( $list as $row ) {
					if ( ! empty( $row['image'] ) ) {
						$image = $row['image']['url'];
					}
					if ( ! empty( $row['image'] ) ) {
						$imageAlt = $row['image']['alt'];
					}
					$title   = $row['title'];
					$context = $row['context'];
					

					echo '<div class="calculator-signup-container-content-list-item">';
					if ( ! empty( $image ) ) {
						echo "<img src='$image' alt='$imageAlt'></img>";
					}
					echo '<div class="calculator-signup-container-content-list-item-content">';
					if ( ! empty( $title ) ) {
						echo '<h3>';
							echo $title;
						echo '</h3>';
					}
					if ( ! empty( $context ) ) {
						echo '<span class="content">';
							echo $context;
						echo '</span>';
					}
					
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			}
			?>
		</div>
	</div>
</section>
