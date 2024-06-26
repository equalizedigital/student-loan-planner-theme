<?php
/**
 * Calculator Signup Block.
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

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'calculator-signup-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
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
$block_title = get_field( 'title' );
$copy        = get_field( 'copy' );
if ( get_field( 'image' ) ) {
	$image = get_field( 'image' );
}

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?> ">
	<div class="calculator-signup-container">
		<figure class="calculator-signup-container-image">
			<?php if ( ! empty( $image ) ) : ?>
			<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>">
			<?php endif; ?>
		</figure>

		<div class="calculator-signup-container-content">
			<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
			<div class="text"><?php echo wp_kses_post( $copy ); ?></div>
		</div>
	</div>
</section>