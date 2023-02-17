<?php
/**
 * 404 / No Results partial
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<section class="no-results not-found">';

echo '<header class="entry-header"><h1 class="entry-title">' . esc_html__( 'Nothing Found', 'eqd' ) . '</h1></header>';
echo '<div class="entry-content">';

if ( is_search() ) {

	echo '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'eqd' ) . '</p>';
	get_search_form();

} else {

	$output = '';
	if ( function_exists( 'cultivate_pro' ) ) {
		ob_start();
		cultivate_pro()->landing_page->show( '404' );
		$output = ob_get_clean();
	}

	if ( empty( $output ) ) {
		$output .= '<p>' . esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eqd' ) . '</p>';
		$output .= get_search_form( false );
	}

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo $output;
}

echo '</div>';
echo '</section>';
