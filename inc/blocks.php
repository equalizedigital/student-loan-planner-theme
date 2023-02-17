<?php
/**
 * Block customizations
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Arrow Button
 *
 * @param string $content HTML Content.
 * @param array  $block Block data.
 */
function eqd_arrow_button( $content, $block ) {
	if ( 'core/button' === $block['blockName'] && ! empty( $block['attrs'] ) && ! empty( $block['attrs']['className'] ) && 'is-style-arrow' === $block['attrs']['className'] ) {
		$content = str_replace(
			'</a>',
			eqd_icon(
				array(
					'icon' => 'arrow-right',
					'size' => 20,
				)
			) . '</a>',
			$content
		);
	}
	return $content;
}
add_filter( 'render_block', 'eqd_arrow_button', 10, 2 );
add_filter( 'eqd_button', 'eqd_arrow_button', 10, 2 );
