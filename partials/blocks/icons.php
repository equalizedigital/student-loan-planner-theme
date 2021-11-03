<?php
/**
 * Icons block
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

$classes = ['block-icons'];
if ( ! empty( $block['className'] ) ) {
	$classes = array_merge( $classes, explode( ' ', $block['className'] ) );
}
if ( ! empty( $block['align'] ) ) {
	$classes[] = 'align' . $block['align'];
}

printf(
	'<div class="%s"%s>',
	esc_attr( join( ' ', $classes ) ),
	! empty( $block['anchor'] ) ? ' id="' . esc_attr( sanitize_title( $block['anchor'] ) ) . '"' : '',
);

$group = 'utility';
$icons = mst_acf_customizations()->get_icons( $group );
foreach ( $icons as $icon ) {
	echo '<div class="block-icons__item">';
	echo mst_icon( [ 'icon' => $icon, 'group' => $group, 'size' => 68 ] );
	echo '<p>' . esc_html( $icon ) . '</p>';
	echo '</div>';
}

echo '</div>';
