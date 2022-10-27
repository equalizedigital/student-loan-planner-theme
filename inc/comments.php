<?php
/**
 * Comments
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Post Comments
 */
function eqd_comments() {
	if ( is_single() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}
add_action( 'tha_content_while_after', 'eqd_comments' );

/**
 * Comment Navigation
 *
 * @param string $location Location.
 */
function eqd_comment_navigation( $location = '' ) {
	$comment_nav_locations = [ 'after' ];
	if ( ! in_array( $location, $comment_nav_locations, true ) ) {
		return;
	}

	if ( get_comment_pages_count() <= 1 ) {
		return;
	}

	$output  = '<nav id="comment-nav-' . esc_attr( $location ) . '" class="navigation comment-navigation" role="navigation">';
	$output .= '<h4 class="screen-reader-text">' . esc_html__( 'Comment navigation', 'mainspring' ) . '</h4>';
	$output .= '<div class="nav-links">';
	$output .= '<div class="nav-previous">' . get_previous_comments_link( esc_html__( 'Older Comments', 'mainspring' ) ) . '</div>';
	$output .= '<div class="nav-next">' . get_next_comments_link( esc_html__( 'Newer Comments', 'mainspring' ) ) . '</div>';
	$output .= '</div>';
	$output .= '</nav>';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo apply_filters( 'eqd_comment_navigation', $output, $location );
}

/**
 * Staff comment class
 *
 * @param array       $classes    An array of comment classes.
 * @param string      $class      A comma-separated list of additional classes added to the list.
 * @param int         $comment_id The comment ID.
 * @param WP_Comment  $comment    The comment object.
 * @param int|WP_Post $post_id    The post ID or WP_Post object.
 */
function eqd_staff_comment_class( $classes, $class, $comment_id, $comment, $post_id ) {
	if ( empty( $comment->user_id ) ) {
		return $classes;
	}
	$staff_roles = array( 'comment_manager', 'author', 'editor', 'administrator' );
	$staff_roles = apply_filters( 'eqd_staff_roles', $staff_roles );
	$user        = get_userdata( $comment->user_id );
	if ( $user instanceof WP_User && is_array( $user->roles ) && ! empty( array_intersect( $user->roles, $staff_roles ) ) ) {
		$classes[] = 'staff';
	}
	return $classes;
}
add_filter( 'comment_class', 'eqd_staff_comment_class', 10, 5 );


/**
 * Remove avatars from comment list
 *
 * @param string $avatar Avatar.
 */
function eqd_remove_avatars_from_comments( $avatar ) {
	global $in_comment_loop;
	return $in_comment_loop ? '' : $avatar;
}
add_filter( 'get_avatar', 'eqd_remove_avatars_from_comments' );

/**
 * Remove URL field from comment form
 *
 * @param array $fields Comment form fields.
 */
function eqd_remove_url_from_comment_form( $fields ) {
	unset( $fields['url'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'eqd_remove_url_from_comment_form' );

/**
 * Remove URL from existing comments
 *
 * @param string $author_link HTML of author link.
 * @param string $author Author Name.
 */
function eqd_remove_url_from_existing_comments( $author_link, $author ) {
	return $author;
}
add_filter( 'get_comment_author_link', 'eqd_remove_url_from_existing_comments', 10, 2 );

/**
 * Comment form, button class
 *
 * @param array $args Comment Form args.
 */
function eqd_comment_form_button_class( $args ) {
	$args['class_submit'] = 'submit wp-block-button__link';
	return $args;
}
add_filter( 'comment_form_defaults', 'eqd_comment_form_button_class' );
