<?php
/**
 * Author Box
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Use custom website as author url
 *
 * @param string $link Link.
 * @param int    $author_id Author ID.
 */
function eqd_custom_author_url( $link, $author_id ) {
	$website = get_the_author_meta( 'user_url', $author_id );
	if ( ! empty( $website ) ) {
		$link = esc_url_raw( $website );
	}
	return $link;
}
// add_filter( 'author_link', 'eqd_custom_author_url', 10, 2 ); phpcs:ignore Squiz.PHP.CommentedOutCode.Found -- Uncomment this line to use the custom author url.

/**
 * Author archive avatar
 */
function eqd_author_archive_avatar() {
	if ( ! is_author() || get_query_var( 'paged' ) ) {
		return;
	}

	echo get_avatar( get_queried_object_id(), 200 );
}
add_action( 'eqd_archive_header_before', 'eqd_author_archive_avatar' );

/**
 * Author archive introduction
 */
function eqd_author_intro() {
	if ( ! is_author() || get_query_var( 'paged' ) ) {
		return;
	}

	echo '<h3 class="has-text-align-center">Recent Articles by ' . esc_html( get_the_author_meta( 'first_name' ) ) . '</h3>';
}
add_action( 'eqd_archive_header_after', 'eqd_author_intro' );

/**
 * Author Box
 */
function eqd_author_box() {

	echo '<section class="author-box">';
		echo get_avatar( get_the_author_meta( 'ID' ), 100 );
		echo '<h4 class="author-box-title">About ' . get_the_author() . '</h4>';
		echo '<div class="author-box-content">' . wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ) . '</div>';
	echo '</section>';
}
