<?php
$post_id = get_queried_object_id();
$header_main_link = get_field( 'header_main_link', 'option' );
$disable_green_header_cta_link = get_field( 'disable_green_header_cta_link_on_this_page' );

if ( ! function_exists( 'yoast_get_primary_term_id' ) || $disable_green_header_cta_link === true ) {
	return;
}

$primary_category_id = yoast_get_primary_term_id( 'category', $post_id );

if ( ! empty( $primary_category_id ) ) {
	$category_id = $primary_category_id;
	$link_data = get_field( 'header_button_override', 'category_' . $category_id );
}

// if link override otherwise default link
$link = ! empty( $link_data ) ? $link_data : ( ! empty( $header_main_link ) ? $header_main_link : null );

// if archive set to original
if ( ! empty( $header_main_link ) && is_tax( 'slp_occupation' ) ) {
	$link = $header_main_link;
}

if ( ! $link ) {
	return;
}

$url = ! empty( $link['url'] ) ? $link['url'] : '';
$target = ! empty( $link['target'] ) ? 'target="' . $link['target'] . '"' : '';
$title = ! empty( $link['title'] ) ? $link['title'] : 'Get Help';
?>

<a href="<?php echo esc_url( $url ); ?>" <?php echo esc_html( $target ); ?> class="btn">
	<?php echo esc_html( $title ); ?>
</a>
