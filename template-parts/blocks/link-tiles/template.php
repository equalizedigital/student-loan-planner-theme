<?php
/**
 * Link Tiles Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block Title Template
 */

$block_name = 'link_tiles_template';

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = $block_name . '-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block ' . $block_name;
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );


// get_field( 'heading_level_select' )


?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

<div class="link_tiles_template_container">
	<div class="link_tiles_template_container_header">

	<?php
	// Assuming the field name is 'heading_level_select'
	$heading_level = get_field( 'heading_level_select' );

	// Default to h2 if no selection is made
	if ( ! $heading_level ) {
		$heading_level = 'h2';
	}

	// Assuming the field name for the heading text is 'heading_text'
	$heading_text = get_field( 'heading' );
	?>

	<?php if ( $heading_text ) : ?>
		<<?php echo $heading_level; ?>><?php echo wp_kses_post( $heading_text ); ?></<?php echo $heading_level; ?>>
	<?php endif; ?>

	</div>
	<ul class="link_tiles_template_container_tiles">
	<?php
	if ( have_rows( 'tiles' ) ) :
		while ( have_rows( 'tiles' ) ) :
			the_row();
			?>
			<li class="link_tiles_template_container_tiles_tile">
			<?php
			$link = get_sub_field( 'link' );
			if ( $link ) :
				$link_url    = $link['url'];
				$link_title  = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<a class="link" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
				<?php
				$icon = get_sub_field( 'icon' );
				if ( $icon ) {
					echo wp_get_attachment_image( $icon['ID'], 'full', false, array( 'aria-hidden' => 'true' ) );
				}
				?>
				<?php echo wp_kses_post( $link_title ); ?>
			</a>
			<?php endif; ?>
			</li>
			<?php
		endwhile;
	endif;
	?>
	</ul>
</div>

</section>
