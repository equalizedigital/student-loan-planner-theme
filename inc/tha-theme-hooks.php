<?php
/**
 * Theme Hook Alliance hook stub list.
 *
 * @package  themehookalliance
 * @version  1.0-draft
 * @since    1.0-draft
 * @license  http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Define the version of THA support, in case that becomes useful down the road.
 */
define( 'THA_HOOKS_VERSION', '1.0-draft' );

/**
 * Themes and Plugins can check for tha_hooks using current_theme_supports( 'tha_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 * // Declare support for all hook types
 * add_theme_support( 'tha_hooks', array( 'all' ) );
 *
 * // Declare support for certain hook types only
 * add_theme_support( 'tha_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support(
	'tha_hooks',
	array(

		/**
		 * As a Theme developer, use the 'all' parameter, to declare support for all
		 * hook types.
		 * Please make sure you then actually reference all the hooks in this file,
		 * Plugin developers depend on it!
		 */
		'all',

		/**
		 * Themes can also choose to only support certain hook types.
		 * Please make sure you then actually reference all the hooks in this type
		 * family.
		 *
		 * When the 'all' parameter was set, specific hook types do not need to be
		 * added explicitly.
		 */
		'html',
		'body',
		'head',
		'header',
		'content',
		'entry',
		'comments',
		'sidebars',
		'sidebar',
		'footer',
	)
);

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 * if ( current_theme_supports( 'tha_hooks', 'header' ) )
 * add_action( 'tha_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool  $bool true.
 * @param array $args The hook type being checked.
 * @param array $registered All registered hook types.
 *
 * @return bool
 */
function tha_current_theme_supports( $bool, $args, $registered ) { // phpcs:ignore Universal.NamingConventions.NoReservedKeywordParameterNames.boolFound -- This is a third-party library, so we can't change the parameter names.
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] ); // phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict -- This is a thrid-party library, so we can't change the comparison.
}
add_filter( 'current_theme_supports-tha_hooks', 'tha_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $tha_supports[] = 'html;
 */
function tha_html_before() {
	do_action( 'tha_html_before' );
}
/**
 * HTML <body> hooks
 * $tha_supports[] = 'body';
 */
function tha_body_top() {
	do_action( 'tha_body_top' );
}

/**
 * Body Bottom .
 */
function tha_body_bottom() {
	do_action( 'tha_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $tha_supports[] = 'head';
 */
function tha_head_top() {
	do_action( 'tha_head_top' );
}

/**
 * Head Bottom .
 */
function tha_head_bottom() {
	do_action( 'tha_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $tha_supports[] = 'header';
 */
function tha_header_before() {
	do_action( 'tha_header_before' );
}

/**
 * Header After.
 */
function tha_header_after() {
	do_action( 'tha_header_after' );
}

/**
 * Header Top.
 */
function tha_header_top() {
	do_action( 'tha_header_top' );
}

/**
 * Header Bottom
 */
function tha_header_bottom() {
	do_action( 'tha_header_bottom' );
}

/**
 * Header Main
 */
function slp_main_menu() {
	do_action( 'slp_main_menu' );
}

/**
 * Semantic <content> hooks
 *
 * $tha_supports[] = 'content';
 */
function tha_content_before() {
	do_action( 'tha_content_before' );
}

/**
 * Content Wrap Before
 */
function tha_content_wrap_before() {
	do_action( 'tha_content_wrap_before' );
}

/**
 * Content Loop
 */
function tha_content_loop() {
	do_action( 'tha_content_loop' );
}

/**
 * Content Wrap After.
 */
function tha_content_wrap_after() {
	do_action( 'tha_content_wrap_after' );
}

/**
 * Content After.
 */
function tha_content_after() {
	do_action( 'tha_content_after' );
}

/**
 * Content Top.
 */
function tha_content_top() {
	do_action( 'tha_content_top' );
}

/**
 * Content Bottom.
 */
function tha_content_bottom() {
	do_action( 'tha_content_bottom' );
}

/**
 * Content While Before.
 */
function tha_content_while_before() {
	do_action( 'tha_content_while_before' );
}

/**
 * Content Before Container.
 */
function tha_content_before_container() {
	do_action( 'tha_content_before_container' );
}

/**
 * Content While After.
 */
function tha_content_while_after() {
	do_action( 'tha_content_while_after' );
}

/**
 * Single Header.
 */
function tha_single_header() {
	do_action( 'tha_single_header' );
}

/**
 * Semantic <entry> hooks
 *
 * $tha_supports[] = 'entry';
 */
function tha_entry_before() {
	do_action( 'tha_entry_before' );
}

/**
 * Entry After.
 */
function tha_entry_after() {
	do_action( 'tha_entry_after' );
}

/**
 * Entry Content Before.
 */
function tha_entry_content_before() {
	do_action( 'tha_entry_content_before' );
}

/**
 * Entry Content After.
 */
function tha_entry_content_after() {
	do_action( 'tha_entry_content_after' );
}

/**
 * Entry Top.
 */
function tha_entry_top() {
	do_action( 'tha_entry_top' );
}

/**
 * Entry Bottom.
 */
function tha_entry_bottom() {
	do_action( 'tha_entry_bottom' );
}

/**
 * Comments block hooks
 *
 * $tha_supports[] = 'comments';
 */
function tha_comments_before() {
	do_action( 'tha_comments_before' );
}

/**
 * Comments After.
 */
function tha_comments_after() {
	do_action( 'tha_comments_after' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $tha_supports[] = 'sidebar';
 */
function tha_sidebars_before() {
	do_action( 'tha_sidebars_before' );
}

/**
 * Sidebars After
 */
function tha_sidebars_after() {
	do_action( 'tha_sidebars_after' );
}

/**
 * Sidebar Top.
 */
function tha_sidebar_top() {
	do_action( 'tha_sidebar_top' );
}

/**
 * Sidebar Bottom.
 */
function tha_sidebar_bottom() {
	do_action( 'tha_sidebar_bottom' );
}

/**
 * Page Header.
 */
function tha_page_header() {
	do_action( 'tha_page_header' );
}

/**
 * Landing Page Header.
 */
function tha_landing_page_header() {
	do_action( 'tha_landing_page_header' );
}

/**
 * Single Sidebar.
 */
function tha_single_sidebar() {
	do_action( 'tha_single_sidebar' );
}

/**
 * Single Page End.
 */
function tha_single_page_end() {
	do_action( 'tha_single_page_end' );
}

/**
 * Footer CTA.
 */
function tha_footer_cta() {
	do_action( 'tha_footer_cta' );
}


/**
 * Semantic <footer> hooks
 *
 * $tha_supports[] = 'footer';
 */
function tha_footer_before() {
	do_action( 'tha_footer_before' );
}

/**
 * Footer After.
 */
function tha_footer_after() {
	do_action( 'tha_footer_after' );
}

/**
 * Footer Top.
 */
function tha_footer_top() {
	do_action( 'tha_footer_top' );
}

/**
 * Footer Bottom.
 */
function tha_footer_bottom() {
	do_action( 'tha_footer_bottom' );
}



/**
 * Single Full Width Content.
 */
function tha_single_fullwidth() {
	do_action( 'tha_single_fullwidth' );
}
