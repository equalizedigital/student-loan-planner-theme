<?php
/**
 * Social Links
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Social Links
 */
function eqd_social_links() {
	$socials = array(
		'facebook'  => array(
			'key'   => 'facebook_site',
			'label' => 'Facebook',
		),
		'twitter'   => array(
			'key'     => 'twitter_site',
			'label'   => 'Twitter',
			'prepend' => 'https://twitter.com/',
		),
		'pinterest' => array(
			'key'   => 'pinterest_url',
			'label' => 'Pinterest',
		),
		'instagram' => array(
			'key'   => 'instagram_url',
			'label' => 'Instagram',
		),
		'youtube'   => array(
			'key'   => 'youtueqd_url',
			'label' => 'YouTube',
		),
	);

	$output   = array();
	$seo_data = get_option( 'wpseo_social' );
	foreach ( $socials as $social => $settings ) {
		$url = ! empty( $settings['key'] ) && ! empty( $seo_data[ $settings['key'] ] ) ? $seo_data[ $settings['key'] ] : false;
		if ( ! empty( $url ) && ! empty( $settings['prepend'] ) ) {
			$url = $settings['prepend'] . $url;
		}
		if ( ! empty( $settings['url'] ) ) {
			$url = $settings['url'];
		}
		if ( ! empty( $url ) ) {
			$output[] = '<li><a href="' . esc_url_raw( $url ) . '" target="_blank" rel="noopener noreferrer" aria-label="' . $settings['label'] . '">' . eqd_icon( array( 'icon' => $social ) ) . '</a></li>';
		}
	}

	if ( ! empty( $output ) ) {
		return '<ul class="social-links">' . join( PHP_EOL, $output ) . '</ul>';
	}
}
