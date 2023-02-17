<?php
/**
 * Single Post
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Entry Header.
add_action( 'eqd_entry_title_after', 'eqd_entry_author', 12 );
add_action( 'eqd_entry_title_after', 'eqd_entry_date', 12 );

/**
 * After Entry
 */
function eqd_single_after_entry() {
	echo '<div class="after-entry">';

	// Publish date.
	eqd_entry_date();

	// Author Box.
	eqd_author_box();

	// Newsletter signup.
	$form_id = get_option( 'options_eqd_newsletter_form' );
	if ( $form_id && function_exists( 'wpforms_display' ) ) {
		wpforms_display( $form_id, true, true );
	}

	// Related Posts.
	if ( function_exists( 'cultivate_pro' ) ) {
		$args = array(
			'layout'     => 'gamma',
			'title'      => 'You May Also Like',
			'query_args' => array(
				'post__not_in' => array( get_the_ID() ),
				'cat'          => eqd_first_term( array( 'field' => 'term_id' ) ),
			),
		);
		cultivate_pro()->blocks->post_listing->display( $args );
	}

	echo '</div>';
}
add_action( 'tha_content_while_after', 'eqd_single_after_entry', 8 );

// Build the page.
require get_template_directory() . '/index.php';
