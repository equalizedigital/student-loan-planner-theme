<?php
/**
 * Resource blocks Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package resource block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'resource-blocks-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block resource-blocks-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$title_field = get_field( 'title' );
$subcopy     = get_field( 'subcopy' );
$blocks      = get_field( 'blocks' );
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

	<header class="resource-blocks-block-container">
		<h2 class="title"><?php echo esc_html( $title_field ); ?></h2>
		<span class="subtitle"><?php echo esc_html( $subcopy ); ?></span>
	</header>

	<div class="resource-blocks-block-container-list">
	<?php

	if ( $blocks ) {
		echo '<ul class="resource-blocks-block-container-list-item">';
		foreach ( $blocks as $row ) {
			if ( ! empty( $row['link'] ) ) {
				$link_row = $row['link']['url'];
			}

			if ( ! empty( $row['subcopy'] ) ) {
				$subcopy = $row['subcopy'];
			}


				echo '<li class="resource-blocks-block-container-list-item__block">';
					echo esc_html( "<a href=\"$link_row\">" );
			if ( ! empty( $row['title'] ) ) {
				$title_row = $row['title'];
				?>
							<h3 class="title"><?php esc_html( $title_row ); ?></h3>
						<?php } ?>
							<p><?php esc_html( $subcopy ); ?></p>
						<?php
						echo '</a>';
						echo '</li>';

		}
		echo '</ul>';
	}
	?>
	</div>
</section>
