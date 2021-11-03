<?php
/**
 * Template Tags
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Entry Category
 */
function mst_entry_category() {
	$term = mst_first_term();
	if ( empty( $term ) || is_wp_error( $term ) ) {
		return;
	}

	echo '<p class="entry-category">' . esc_html( $term->name ) . '</p>';
}

/**
 * Post Summary Title
 */
function mst_post_summary_title() {
	global $wp_query, $cp_loop;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	if ( isset( $cp_loop->cp_no_title ) ) {
		$tag = 'h2';
	}
	echo '<' . esc_attr( $tag ) . ' class="post-summary__title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></' . esc_attr( $tag ) . '>';
}

/**
 * Post Summary Image
 *
 * @param array $size Image size.
 */
function mst_post_summary_image( $size = 'thumbnail' ) {
	echo '<div class="post-summary__image"><a href="' . esc_url( get_permalink() ) . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( mst_entry_image_id(), $size ) . '</a></div>';
}


/**
 * Entry Image ID
 */
function mst_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_mst_default_image' );
}

/**
 * Entry Author
 */
function mst_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . esc_url( get_author_posts_url( $id ) ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . esc_url( get_author_posts_url( $id ) ) . '">' . get_the_author() . '</a></p>';
}

/**
 * Entry Date
 */
function mst_entry_date() {
	$output = 'Published on <time datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date( 'F j, Y' ) . '</time>';
	if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
		$output .= ' / Last updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
	}
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo '<p class="entry-date">' . $output . '</p>';
}
