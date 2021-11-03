<?php
/**
 * WP Recipe Maker
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Add blocks before/after recipe card
 *
 * @param string $output Output.
 */
function mst_recipe_card_blocks( $output ) {
	if ( ! is_single() ) {
		return $output;
	}

	// Only show it once.
	global $mst_recipe_card_blocks;
	if ( ! empty( $mst_recipe_card_blocks ) ) {
		return $output;
	}

	$mst_recipe_card_blocks = 1;

	ob_start();
	get_template_part( 'partials/blocks/pinterest-cta' );
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo $output;
	return ob_get_clean();
}
//add_filter( 'wprm_recipe_shortcode_output', 'mst_recipe_card_blocks' );
