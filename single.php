<?php
/**
 * Single Post
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Entry Header.
add_action( 'mst_entry_title_after', 'mst_entry_author', 12 );
add_action( 'mst_entry_title_after', 'mst_entry_date', 12 );

/**
 * After Entry
 */
function mst_single_after_entry() {
	echo '<div class="after-entry">';

	// Publish date.
	mst_entry_date();

	// Author Box.
	mst_author_box();

	// Newsletter signup.
	$form_id = get_option( 'options_mst_newsletter_form' );
	if ( $form_id && function_exists( 'wpforms_display' ) ) {
		wpforms_display( $form_id, true, true );
	}

	// Related Posts.
	if ( function_exists( 'cultivate_pro' ) ) {
		$args = [
			'layout'     => 'gamma',
			'title'      => 'You May Also Like',
			'query_args' => [
				'post__not_in' => [ get_the_ID() ],
				'cat'          => mst_first_term( [ 'field' => 'term_id' ] ),
			],
		];
		cultivate_pro()->blocks->post_listing->display( $args );
	}

	echo '</div>';
}
add_action( 'tha_content_while_after', 'mst_single_after_entry', 8 );

// Build the page.
require get_template_directory() . '/index.php';
