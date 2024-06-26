<?php
/**
 * Shared Counts
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Disable CSS and JS.
add_filter( 'shared_counts_load_css', '__return_false' );
add_filter( 'shared_counts_load_js', '__return_false' );

/**
 * Simple email button
 * Does not require loading JS
 *
 * @param array $link Link.
 * @param int   $id ID.
 */
function eqd_shared_counts_email_link( $link, $id ) {
	if ( 'email' !== $link['type'] ) {
		return $link;
	}

	$subject      = esc_html__( 'Your friend has shared an article with you.', 'eqd' );
	$subject      = apply_filters( 'shared_counts_amp_email_subject', $subject, $id );
	$body         = html_entity_decode( get_the_title( $id ), ENT_QUOTES ) . "\r\n";
	$body        .= get_permalink( $id ) . "\r\n";
	$body         = apply_filters( 'shared_counts_amp_email_body', $body, $id );
	$link['link'] = 'mailto:?subject=' . rawurlencode( $subject ) . '&body=' . rawurlencode( $body );

	return $link;
}
add_filter( 'shared_counts_link', 'eqd_shared_counts_email_link', 10, 2 );
add_filter( 'shared_counts_disable_email_modal', '__return_true' );

/**
 * Production URL
 *
 * @param string $url (optional), URL to convert to production.
 */
function eqd_production_url( $url = false ) {
	$production = false; // put production URL here.

	if ( ! empty( $production ) ) {
		$url = $url ? esc_url( $url ) : home_url();
		$url = str_replace( home_url(), $production, $url );
	}

	return esc_url( $url );
}

/**
 * Use Production URL for Share Count API
 *
 * @param array $params API parameters used when fetching share counts.
 */
function eqd_production_url_share_count_api( $params ) {
	$params['url'] = eqd_production_url( $params['url'] );
	return $params;
}
add_filter( 'shared_counts_api_params', 'eqd_production_url_share_count_api' );

/**
 * Use Production URL for Share Count link
 *
 * @param array $link elements of the link.
 */
function eqd_production_url_share_count_link( $link ) {
	$exclude = array( 'print', 'email' );
	if ( ! in_array( $link['type'], $exclude, true ) ) {
		$link['link'] = eqd_production_url( $link['link'] );
	}
	return $link;
}
add_filter( 'shared_counts_link', 'eqd_production_url_share_count_link' );

/**
 * Shared Counts Icon
 *
 * @param array $link Link.
 */
function eqd_shared_counts_icon( $link ) {

	$social_icons = array(
		'facebook'        => 'facebook',
		'facebook_likes'  => 'facebook',
		'facebook_shares' => 'facebook',
		'twitter'         => 'twitter',
		'pinterest'       => 'pinterest',
		'yummly'          => 'yummly',
		'linkedin'        => 'linkedin',
		'print'           => 'device-printer',
		'email'           => 'email1',
	);

	if ( array_key_exists( $link['type'], $social_icons ) ) {
		$link['icon'] = eqd_icon(
			array(
				'icon'  => $social_icons[ $link['type'] ],
				'size'  => 20,
				'force' => true, // Force rendering in the admin context for testing.
			)
		);
	}

	return $link;
}
add_filter( 'shared_counts_link', 'eqd_shared_counts_icon' );
