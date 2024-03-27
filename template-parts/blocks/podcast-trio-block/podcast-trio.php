<?php

/**
 * podcast-trio Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

// if( isset( $block['example']['attributes']['data']['preview_image_help'] )  ) :
// echo Loader_Gutenberg::get_preview_image( $block['example']['attributes']['data']['preview_image_help'], $block['name'] );
// return;
// endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'podcast-trio-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block podcast-trio-block';
if ( ! empty( $block['className'] ) ) :
	$className .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="podcast-trio-container">
			<?php if ( ! empty( $title ) ) : ?>
				<h2 class="title"><?php echo $title; ?></h2>
			<?php endif; ?>
		<?php 
		$logo_images = get_field( 'logo_images' );
		if ( $logo_images ) {
			echo '<div class="podcast-trio-images">';
			foreach ( $logo_images as $row ) {
				if ( ! empty( $row['image'] ) ) {
					$image = $row['image']['url'];
				}
				if ( ! empty( $row['image'] ) ) {
					$imageAlt = $row['image']['alt'];
				}
				$link = $row['link'];
				echo '<div class="podcast-trio-images__image">';
					echo "<a href=\"$link\">";
				if ( ! empty( $image ) ) {
					echo "<img src='$image' alt='$imageAlt'></img>";
				}
					echo '</a>';
				echo '</div>';
			}
			echo '</div>';
		}
		?>
	</div>
</section>