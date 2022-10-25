<?php
/**
 * Block customizations
 *
 * @package      Mainspring
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
function mst_arrow_button( $content, $block ) {
	if ( 'core/button' === $block['blockName'] && ! empty( $block['attrs'] ) && ! empty( $block['attrs']['className'] ) && 'is-style-arrow' === $block['attrs']['className'] ) {
		$content = str_replace( '</a>', mst_icon( [ 'icon' => 'arrow-right', 'size' => 20 ] ) . '</a>', $content );
	}
	return $content;
}
add_filter( 'render_block', 'mst_arrow_button', 10, 2 );
add_filter( 'mst_button', 'mst_arrow_button', 10, 2 );
