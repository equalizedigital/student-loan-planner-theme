<?php
/**
 * Equalize Digital Base Theme file.
 *
 * @package Equalize Digital Base Theme
 */

if ( isset( $block['data']['preview_image_help'] ) ) {
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
}

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'squared-image-content-callout-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$block_id = $block['anchor'];
}

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block squared-image-content-callout-block';
if ( ! empty( $block['className'] ) ) {
	$class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class_name .= ' align' . $block['align'];
}

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title = get_field( 'title' );
$copy        = get_field( 'copy' ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.
if ( get_field( 'image' ) ) {
	$image = get_field( 'image' );
}
$callout_link = get_field( 'link' );
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="squared-image-content-callout-container">
		<figure class="squared-image-content-callout-container-image">
			<?php 
			if ( ! empty( $image ) ) {
				echo wp_get_attachment_image( $image['id'], 'squared-image-content-callout-thumbnail' );
			}
			?>
		</figure>

		<div class="squared-image-content-callout-container-content">
			<div>
				<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
				<?php if ( ! empty( $callout_link ) ) { ?>
					<span class="content">
						<a href="<?php echo esc_url( $callout_link['url'] ); ?>" class="btn btn-dark-bg">
							<?php echo esc_html( $callout_link['title'] ); ?>
						</a>
					</span>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
