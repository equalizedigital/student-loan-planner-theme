<?php
/**
 * Taxonomy Select Block Template.
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
$id = 'taxonomy-select-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block taxonomy-select-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name     = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
$taxonomy       = get_field( 'select_taxonomy' );
$taxonomy_value = ( isset( $taxonomy['value'] ) ) ? $taxonomy['value'] : null;
$taxonomy_label = ( isset( $taxonomy['label'] ) ) ? $taxonomy['label'] : '';
$terms          = ( $taxonomy_value ) ? get_field( 'select_' . $taxonomy_value ) : null;
$more_link      = get_field( 'more_link' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

	<?php 
	if ( $terms ) {
		echo '<ul class="taxonomy-select-block-list">';
		foreach ( $terms as $term ) {
			$icon        = get_field( 'taxonomy_icon', $taxonomy_value . '_' . $term );
			$icon_url    = ( $icon ) ? $icon['url'] : null;
			$term_object = get_term( $term, $taxonomy_value );
			if ( isset( $term_object->name ) ) {
				?>
				<li class="taxonomy-select-block-list-item">
					<a class="taxonomy-select-block-list-item-link" href="<?php echo get_term_link( $term_object ); ?>">
						<?php echo ( $icon_url ) ? '<img src="' . $icon_url . '" alt="" aria-hidden="true" />' : null; ?>
						<?php echo $term_object->name; ?>
					</a>
				</li>
				<?php
			}
		}
		if ( $more_link ) {
			?>
			<li class="taxonomy-select-block-list-item">
				<a class="taxonomy-select-block-list-item-link" href="<?php echo $more_link; ?>">
					<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/icons/icon-more.svg" alt="" aria-hidden="true" />
					More <?php echo $taxonomy_label; ?>
				</a>
			</li>
			<?php
		}
		echo '</ul>';
	}
	?>
</section>
