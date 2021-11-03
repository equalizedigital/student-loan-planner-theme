<?php
/**
 * Comments
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Post Comments
 */
function mst_comments() {
	if ( is_single() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}
}
add_action( 'tha_content_while_after', 'mst_comments' );

/**
 * Comment Navigation
 *
 * @param string $location Location.
 */
function mst_comment_navigation( $location = '' ) {
	$comment_nav_locations = [ 'after' ];
	if ( ! in_array( $location, $comment_nav_locations, true ) ) {
		return;
	}

	if ( get_comment_pages_count() <= 1 ) {
		return;
	}

	$output  = '<nav id="comment-nav-' . esc_attr( $location ) . '" class="navigation comment-navigation" role="navigation">';
	$output .= '<h4 class="screen-reader-text">' . esc_html__( 'Comment navigation', 'cultivate_textdomain' ) . '</h4>';
	$output .= '<div class="nav-links">';
	$output .= '<div class="nav-previous">' . get_previous_comments_link( esc_html__( 'Older Comments', 'cultivate_textdomain' ) ) . '</div>';
	$output .= '<div class="nav-next">' . get_next_comments_link( esc_html__( 'Newer Comments', 'cultivate_textdomain' ) ) . '</div>';
	$output .= '</div>';
	$output .= '</nav>';

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo apply_filters( 'mst_comment_navigation', $output, $location );
}


/**
 * Load More Comments button
 *
 * @param string $output Comment navigation output.
 * @param string $location Location.
 */
function mst_load_more_comments_button( $output, $location ) {
	global $wp_query;
	if ( 'after' !== $location || ! empty( $wp_query->query['cpage'] ) ) {
		return $output;
	}
	$output = '';
	global $wp_query;
	$cpage = get_query_var( 'cpage' ) ? get_query_var( 'cpage' ) : 1;
	if ( $cpage > 1 && empty( $wp_query->query['cpage'] ) ) {
		$output = '<p class="wp-block-button is-style-outline"><a class="load-more-comments wp-block-button__link" href="' . add_query_arg( 'load_all_comments', true, get_permalink() . '#comments' ) . '">See More Comments</a></p>';
	}
	return $output;
}
add_filter( 'mst_comment_navigation', 'mst_load_more_comments_button', 10, 2 );

/**
 * Load More Comments script
 */
function mst_load_more_comments_script() {
	wp_enqueue_script( 'be-load-more-comments', get_template_directory_uri() . '/assets/js/load-more-comments-min.js', [ 'jquery' ], filemtime( get_template_directory() . '/assets/js/load-more-comments-min.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'mst_load_more_comments_script' );

/**
 * Load More Comments args
 *
 * @param array $args Comment list args.
 */
function mst_load_more_comments_args( $args ) {
	if ( ! empty( $_GET['load_all_comments'] ) ) {
		$args['per_page'] = -1;
	}
	return $args;
}
add_filter( 'wp_list_comments_args', 'mst_load_more_comments_args', 99 );

/**
 * Staff comment class
 *
 * @param array       $classes    An array of comment classes.
 * @param string      $class      A comma-separated list of additional classes added to the list.
 * @param int         $comment_id The comment ID.
 * @param WP_Comment  $comment    The comment object.
 * @param int|WP_Post $post_id    The post ID or WP_Post object.
 */
function mst_staff_comment_class( $classes, $class, $comment_id, $comment, $post_id ) {
	if ( empty( $comment->user_id ) ) {
		return $classes;
	}
	$staff_roles = array( 'comment_manager', 'author', 'editor', 'administrator' );
	$staff_roles = apply_filters( 'mst_staff_roles', $staff_roles );
	$user        = get_userdata( $comment->user_id );
	if ( $user instanceof WP_User && is_array( $user->roles ) && ! empty( array_intersect( $user->roles, $staff_roles ) ) ) {
		$classes[] = 'staff';
	}
	return $classes;
}
add_filter( 'comment_class', 'mst_staff_comment_class', 10, 5 );


/**
 * Remove avatars from comment list
 *
 * @param string $avatar Avatar.
 */
function mst_remove_avatars_from_comments( $avatar ) {
	global $in_comment_loop;
	return $in_comment_loop ? '' : $avatar;
}
add_filter( 'get_avatar', 'mst_remove_avatars_from_comments' );

/**
 * Remove URL field from comment form
 *
 * @param array $fields Comment form fields.
 */
function mst_remove_url_from_comment_form( $fields ) {
	unset( $fields['url'] );
	return $fields;
}
add_filter( 'comment_form_default_fields', 'mst_remove_url_from_comment_form' );

/**
 * Remove URL from existing comments
 *
 * @param string $author_link HTML of author link.
 * @param string $author Author Name.
 */
function mst_remove_url_from_existing_comments( $author_link, $author ) {
	return $author;
}
add_filter( 'get_comment_author_link', 'mst_remove_url_from_existing_comments', 10, 2 );

/**
 * Comment form, button class
 *
 * @param array $args Comment Form args.
 */
function mst_comment_form_button_class( $args ) {
	$args['class_submit'] = 'submit wp-block-button__link';
	return $args;
}
add_filter( 'comment_form_defaults', 'mst_comment_form_button_class' );
