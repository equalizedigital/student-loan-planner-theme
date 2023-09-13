<?php
/**
 * Hero Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Hero Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'hero-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block hero-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title               = get_field( 'title' );
$subtitle                = get_field( 'subtitle' );
$background_image        = get_field( 'background_image' );
$title_max_width_desktop = get_field( 'title_max_width_desktop' );
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="hero-container">
		<?php if ( is_front_page() ) : ?>
			<h2 class="title" style="max-width:<?php echo wp_kses_post( $title_max_width_desktop ? $title_max_width_desktop . '%' : 'none' ); ?>;">
				<?php echo wp_kses_post( $acf_title ); ?>
			</h2>
		<?php else : ?>
			<h1 class="title" style="max-width:<?php echo wp_kses_post( $title_max_width_desktop ? $title_max_width_desktop . '%' : 'none' ); ?>;">
				<?php echo wp_kses_post( $acf_title ); ?>
			</h1>
		<?php endif; ?>
		<span class="subtitle"><?php echo wp_kses_post( $subtitle ); ?></span>
	</div>
	<?php if ( $background_image ) : ?>
		<?php echo wp_get_attachment_image( $background_image, 'full' ); ?>
	<?php endif; ?>
</section>
