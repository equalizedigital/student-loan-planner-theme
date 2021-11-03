<?php
/**
 * Loop
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Default Loop
 */
function mst_default_loop() {

	if ( have_posts() ) :

		tha_content_while_before();

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			tha_entry_before();

			$partial = apply_filters( 'mst_loop_partial', is_singular() ? 'content' : 'post-summary' );
			$context = apply_filters( 'mst_loop_partial_context', is_singular() ? 'content' : 'primary' );
			get_template_part( 'partials/' . $partial . '/' . $context );

			tha_entry_after();
		endwhile;

		tha_content_while_after();

	else :

		tha_entry_before();
		$context = apply_filters( 'mst_empty_loop_partial_context', 'no-content' );
		get_template_part( 'partials/content/' . $context );
		tha_entry_after();

	endif;

}
add_action( 'tha_content_loop', 'mst_default_loop' );

/**
 * Archive post listing open
 */
function mst_archive_post_listing_open() {
	if ( apply_filters( 'mst_archive_post_listing', is_home() || is_archive() || is_search() ) ) {
		echo '<div class="archive-post-listing">';
	}
}
add_action( 'tha_content_while_before', 'mst_archive_post_listing_open', 80 );

/**
 * Archive post listing close
 */
function mst_archive_post_listing_close() {
	if ( apply_filters( 'mst_archive_post_listing', is_home() || is_archive() || is_search() ) ) {
		echo '</div>'; // .archive-post-listing
	}
}
add_action( 'tha_content_while_after', 'mst_archive_post_listing_close', 5 );

/**
 * Entry Title
 */
function mst_entry_header() {
	if ( mst_has_h1_block() ) {
		add_filter( 'render_block', 'mst_entry_header_in_content', 10, 2 );

	} else {
		do_action( 'mst_entry_title_before' );
		echo '<h1 class="entry-title">' . esc_html( get_the_title() ) . '</h1>';
		do_action( 'mst_entry_title_after' );
	}
}
add_action( 'tha_entry_top', 'mst_entry_header' );

/**
 * Entry header in content
 *
 * @param string $output Outout.
 * @param array  $block Block.
 */
function mst_entry_header_in_content( $output, $block ) {
	if ( 'core/heading' === $block['blockName'] && ! empty( $block['attrs'] ) && 1 === $block['attrs']['level'] ) {
		ob_start();
		do_action( 'mst_entry_title_before' );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		echo $output;
		do_action( 'mst_entry_title_after' );
		$output = ob_get_clean();
		remove_filter( 'render_block', 'mst_entry_header_in_content', 10, 2 );
	}

	return $output;
}

/**
 * Recursively searches content for h1 blocks.
 *
 * @link https://www.billerickson.net/building-a-header-block-in-wordpress/
 *
 * @param array $blocks Blocks.
 */
function mst_has_h1_block( $blocks = array() ) {

	if ( is_singular() && empty( $blocks ) ) {
		global $post;
		$blocks = parse_blocks( $post->post_content );
	}

	foreach ( $blocks as $block ) {

		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		// Custom header block.
		if ( 'acf/header' === $block['blockName'] ) {
			return true;

			// Heading block.
		} elseif ( 'core/heading' === $block['blockName'] && isset( $block['attrs']['level'] ) && 1 === $block['attrs']['level'] ) {
			return true;

			// Scan inner blocks for headings.
		} elseif ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			$inner_h1 = mst_has_h1_block( $block['innerBlocks'] );
			if ( $inner_h1 ) {
				return true;
			}
		}
	}

	return false;
}
