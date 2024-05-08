<?php
/**
 * PWA
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

namespace Basic_Site_Caching;

// Customize the manifest.
add_filter(
	'web_app_manifest',
	function ( $manifest ) {
		$manifest['display'] = 'standalone';

		$name = get_bloginfo( 'name' );
		if ( 12 < strlen( $name ) ) {
			$manifest['short_name'] = substr( $name, 0, 12 );
		}

		if ( ! empty( $manifest['icons'] ) ) {
			$manifest['icons'] = array_map(
				function ( $icon ) {
					if ( ! isset( $icon['purpose'] ) ) {
						$icon['purpose'] = 'any maskable';
					}
					return $icon;
				},
				$manifest['icons']
			);
		}

		return $manifest;
	}
);
