<?php
/**
 * Singular partial
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<article class="' . esc_attr( join( ' ', get_post_class() ) ) . '">';

echo '<div class="entry-content">';
tha_entry_content_before();
the_content();

wp_link_pages(
	array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eqd' ),
		'after'  => '</div>',
	)
);

tha_entry_content_after();
echo '</div>';

if ( eqd_has_action( 'tha_entry_bottom' ) ) {
	echo '<footer class="entry-footer">';
	tha_entry_bottom();
	echo '</footer>';
}

echo '</article>';
