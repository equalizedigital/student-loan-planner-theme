<?php
/**
 * Taxonomy Select Block Template.
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
$block_id = 'taxonomy-select-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block taxonomy-select-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name        = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
$selected_taxonomy = get_field( 'select_taxonomy' );
$taxonomy_value    = ( isset( $selected_taxonomy['value'] ) ) ? $selected_taxonomy['value'] : null;
$taxonomy_label    = ( isset( $selected_taxonomy['label'] ) ) ? $selected_taxonomy['label'] : '';
$terms             = ( $taxonomy_value ) ? get_field( 'select_' . $taxonomy_value ) : null;
$more_link         = get_field( 'more_link' );
?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

	<?php 
	if ( $terms ) {
		echo '<ul class="taxonomy-select-block-list">';
		foreach ( $terms as $list_term ) {
			$icon        = get_field( 'taxonomy_icon', $taxonomy_value . '_' . $list_term );
			$icon_url    = ( $icon ) ? $icon['url'] : null;
			$term_object = get_term( $list_term, $taxonomy_value );
			if ( isset( $term_object->name ) ) {
				?>
				<li class="taxonomy-select-block-list-item">
					<?php $term_link = get_term_link( $term_object ); ?>
					<a class="taxonomy-select-block-list-item-link" href="<?php echo ! is_wp_error( $term_link ) ? esc_url( $term_link ) : ''; ?>">
						<?php echo ( $icon_url ) ? '<img src="' . esc_url( $icon_url ) . '" alt="" aria-hidden="true" />' : null; ?>
						<?php echo esc_html( $term_object->name ); ?>
					</a>
				</li>
				<?php
			}
		}
		if ( $more_link ) {
			?>
			<li class="taxonomy-select-block-list-item">
				<a class="taxonomy-select-block-list-item-link" href="<?php echo esc_url( $more_link ); ?>">
					<img src="<?php echo esc_url( get_bloginfo( 'stylesheet_directory' ) ); ?>/assets/icons/icon-more.svg" alt="" aria-hidden="true" />
					More <?php echo esc_html( $taxonomy_label ); ?>
				</a>
			</li>
			<?php
		}
		echo '</ul>';
	}
	?>
</section>
