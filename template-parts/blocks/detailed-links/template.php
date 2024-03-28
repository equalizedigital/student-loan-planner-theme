<?php
/**
 * detailed-links Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'detailed-links-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block detailed-links-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="detailed_links_block_container">
		<div class="detailed_links_block_container_items">
			<?php

			// Check rows existexists.
			if ( have_rows( 'items' ) ) :
			
				// Loop through rows.
				while ( have_rows( 'items' ) ) :
					the_row();
			
					// Load sub field value.
					$link  = get_sub_field( 'link' );
					$title = get_sub_field( 'title' );
					$copy  = get_sub_field( 'copy' );
					?>
					<a href="<?php echo ! empty( $link['url'] ) ? $link['url'] : '#'; ?>" class="detailed_links_block_container_items_item">
						<div class="detailed_links_block_container_items_item_header">
							<h3 class="title"><?php echo wp_kses_post( $title ); ?></h3>
						</div>
						<div class="detailed_links_block_container_items_item_text">
						<?php echo wp_kses_post( $copy ); ?>
						</div>
						<div class="detailed_links_block_container_items_item_link">
							<div class="link_space">
							<?php echo ! empty( $link['title'] ) ? $link['title'] : 'Learn More'; ?>
							<span class="svg">
							<svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
							<path d="M10.3536 4.35355C10.5488 4.15829 10.5488 3.84171 10.3536 3.64645L7.17157 0.464465C6.97631 0.269203 6.65973 0.269203 6.46447 0.464466C6.2692 0.659728 6.2692 0.97631 6.46447 1.17157L9.29289 4L6.46447 6.82843C6.2692 7.02369 6.2692 7.34027 6.46447 7.53553C6.65973 7.7308 6.97631 7.7308 7.17157 7.53553L10.3536 4.35355ZM4.37114e-08 4.5L10 4.5L10 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#82BC46"/>
							</svg>
							</span>
							</div>
						</div>
					</a>
					<?php
			
					// End loop.
				endwhile;
			
				// No value.
			else :
				// Do something...
			endif;
			?>

		</div>
	</div>
</section>
