<?php
/**
 * Green CTA Button.
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

$current_post_id               = get_queried_object_id();
$header_main_link              = get_field( 'header_main_link', 'option' );
$disable_green_header_cta_link = get_field( 'disable_green_header_cta_link_on_this_page' );

if ( ! function_exists( 'yoast_get_primary_term_id' ) || true === $disable_green_header_cta_link ) {
	return;
}

$primary_category_id = yoast_get_primary_term_id( 'category', $current_post_id );

if ( ! empty( $primary_category_id ) ) {
	$category_id   = $primary_category_id;
	$cta_link_data = get_field( 'header_button_override', 'category_' . $category_id );
}

// if link override otherwise default link.
$cta_link = ! empty( $cta_link_data ) ? $cta_link_data : ( ! empty( $header_main_link ) ? $header_main_link : null );

// if archive set to original.
if ( ! empty( $header_main_link ) && is_tax( 'slp_occupation' ) ) {
	$cta_link = $header_main_link;
}

if ( ! $cta_link ) {
	return;
}

$url        = ! empty( $cta_link['url'] ) ? $cta_link['url'] : '';
$target     = ! empty( $cta_link['target'] ) ? 'target="' . $cta_link['target'] . '"' : '';
$link_title = ! empty( $cta_link['title'] ) ? $cta_link['title'] : 'Get Help';
?>

<a href="<?php echo esc_url( $url ); ?>" <?php echo esc_html( $target ); ?> class="btn">
	<?php echo esc_html( $link_title ); ?>
</a>
