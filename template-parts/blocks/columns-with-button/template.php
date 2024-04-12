<?php
/**
 * Columns-with-button Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package  Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'columns-with-button-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block columns-with-button-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title       = get_field( 'title' );
$acf_link        = get_field( 'link' );
$acf_link_title  = $acf_link['title'];
$acf_link_url    = $acf_link['url'];
$acf_rating_text = get_field( 'rating_text' );
$acf_copy        = get_field( 'copy' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="columns-with-button-block-container">
		<div class="columns-with-button-block-container-content">
			<h2 class="columns-with-button-block-container-content__title"><?php echo wp_kses_post( $acf_title ); ?></h2>
			<a href="
			<?php
			echo wp_kses_post( $acf_link_url );
			if ( isset( $_SERVER['QUERY_STRING'] ) && ! empty( $_SERVER['QUERY_STRING'] ) ) {
				echo '&#63;' . $_SERVER['QUERY_STRING']; }
			?>
			" class="columns-with-button-block-container-content__button btn">
				<?php echo wp_kses_post( $acf_link_title ); ?>
			</a>
			<div class="columns-with-button-block-container-content__rating">
				<?php
				if ( ! empty( $acf_rating_text['url'] ) ) {
					echo '<a href="' . $acf_rating_text['url'] . '">';
				}
				?>
				<?php echo $acf_rating_text['title']; ?>
				<?php
				if ( ! empty( $acf_rating_text['url'] ) ) {
					echo '</a>';
				}
				?>
			</div>
		</div>
		<div class="columns-with-button-block-container-content-right">
				<?php echo wp_kses_post( $acf_copy ); ?>
		</div>
	</div>
</section>
