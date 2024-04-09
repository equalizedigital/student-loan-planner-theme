<?php
/**
 * Green cta button
 *
 * @package Equalize Digital Base Theme
 */

$post_id_object                = get_queried_object_id();
$header_main_link              = get_field( 'header_main_link', 'option' );
$disable_green_header_cta_link = get_field( 'disable_green_header_cta_link_on_this_page' );

if ( ! function_exists( 'yoast_get_primary_term_id' ) || true === $disable_green_header_cta_link ) {
	return;
}

$primary_category_id = yoast_get_primary_term_id( 'category', $post_id_object );

if ( ! empty( $primary_category_id ) ) {
	$category_id = $primary_category_id;
	$link_data   = get_field( 'header_button_override', 'category_' . $category_id );
}

// if link override otherwise default link.
$link_item = ! empty( $link_data ) ? $link_data : ( ! empty( $header_main_link ) ? $header_main_link : null );

// if archive set to original.
if ( ! empty( $header_main_link ) && is_tax( 'slp_occupation' ) ) {
	$link_item = $header_main_link;
}

if ( ! $link_item ) {
	return;
}

$url        = ! empty( $link['url'] ) ? $link['url'] : '';
$target     = ! empty( $link['target'] ) ? 'target="' . $link['target'] . '"' : '';
$title_item = ! empty( $link['title'] ) ? $link['title'] : 'Get Help';
?>

<a href="<?php echo esc_url( $url ); ?>" <?php echo esc_html( $target ); ?> class="btn">
	<?php echo esc_html( $title_item ); ?>
</a>
