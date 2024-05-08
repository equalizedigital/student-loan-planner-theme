<?php
/**
 * Podcast Trio Block Template.
 * 
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'podcast-trio-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block podcast-trio-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="podcast-trio-container">
			<?php if ( ! empty( $block_title ) ) : ?>
				<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
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
					$image_alt = $row['image']['alt'];
				}
				$podcast_link = $row['link'];
				echo '<div class="podcast-trio-images__image">';
					echo '<a href="' . esc_url( $podcast_link ) . '">';
				if ( ! empty( $image ) ) {
					echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $image_alt ) . '" />';
				}
					echo '</a>';
				echo '</div>';
			}
			echo '</div>';
		}
		?>
	</div>
</section>