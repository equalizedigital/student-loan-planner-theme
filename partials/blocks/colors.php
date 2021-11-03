<?php
/**
 * Colors block
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

$colors = get_theme_support( 'editor-color-palette' );
if ( empty( $colors ) ) {
	return;
}

echo '<div class="style-guide-colors">';
foreach ( $colors[0] as $color ) {
	echo '<div class="style-guide-color">';
	echo '<div class="swatch has-' . esc_attr( $color['slug'] ) . '-background-color"></div>';
	echo '<div class="hex">' . esc_html( $color['color'] ) . '</div>';
	echo '</div>';
}
echo '</div>';
