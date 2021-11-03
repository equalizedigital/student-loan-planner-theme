<?php
/**
 * Functions
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Bump this when adding new icons, see inc/acf.php.
define( 'MST_ICON_VERSION', '0.1' );

// General cleanup.
require_once get_template_directory() . '/inc/wordpress-cleanup.php';

// Theme.
require_once get_template_directory() . '/inc/tha-theme-hooks.php';
require_once get_template_directory() . '/inc/layouts.php';
require_once get_template_directory() . '/inc/helper-functions.php';
require_once get_template_directory() . '/inc/navigation.php';
require_once get_template_directory() . '/inc/loop.php';
require_once get_template_directory() . '/inc/author-box.php';
require_once get_template_directory() . '/inc/comments.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/admin-branding.php';

// Functionality.
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/fonts.php';
require_once get_template_directory() . '/inc/login-logo.php';
require_once get_template_directory() . '/inc/social-links.php';

// Plugin Support.
//require_once get_template_directory() . '/inc/class-be-acf-customizations.php';
require_once get_template_directory() . '/inc/amp.php';
require_once get_template_directory() . '/inc/cultivate-pro.php';
require_once get_template_directory() . '/inc/pwa.php';
require_once get_template_directory() . '/inc/shared-counts.php';
require_once get_template_directory() . '/inc/slickstream.php';
require_once get_template_directory() . '/inc/wordpress-seo.php';
//require_once get_template_directory() . '/inc/wpforms.php';
//require_once get_template_directory() . '/inc/wp-recipe-maker.php';

/**
 * Enqueue scripts and styles.
 */
function mst_scripts() {

	if ( ! ( function_exists( 'mst_is_amp' ) && mst_is_amp() ) ) {
		wp_enqueue_script( 'theme-global', get_template_directory_uri() . '/assets/js/global-min.js', [], filemtime( get_template_directory() . '/assets/js/global-min.js' ), true );

		wp_localize_script(
			'theme-global',
			'mainspring_vars',
			array(
				'nonce' => wp_create_nonce('ajax-nonce'),
				'post_id' => get_the_ID(),
			)
		);

		wp_enqueue_script( 'theme-menu', get_template_directory_uri() . '/assets/js/menu.js', [], filemtime( get_template_directory() . '/assets/js/menu.js' ), true );
		wp_localize_script( 'theme-menu', 'screenReaderText', array(
			'expand'   => __( 'Expand child menu', 'mainspring' ),
			'collapse' => __( 'Collapse child menu', 'mainspring' ),
		));

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	wp_enqueue_style(
		'rwc-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );

}
add_action( 'wp_enqueue_scripts', 'mst_scripts' );

/**
 * Gutenberg scripts and styles
 */
function mst_gutenberg_scripts() {
	wp_enqueue_script( 'theme-editor', get_template_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'mst_gutenberg_scripts' );

if ( ! function_exists( 'mst_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mst_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'cultivate_textdomain', get_template_directory() . '/languages' );

		// Editor Styles.
		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/editor-style.css' );

		// Admin Bar Styling.
		add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Body open hook.
		add_theme_support( 'body-open' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 */
		$GLOBALS['content_width'] = apply_filters( 'mst_content_width', 768 );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			[
				'primary'   => esc_html__( 'Primary Navigation Menu', 'cultivate_textdomain' ),
				'secondary' => esc_html__( 'Secondary Navigation Menu', 'cultivate_textdomain' ),
			]
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		// Gutenberg.

		// -- Responsive embeds
		add_theme_support( 'responsive-embeds' );

		// -- Wide Images
		add_theme_support( 'align-wide' );

		// -- Disable custom font sizes
		add_theme_support( 'disable-custom-font-sizes' );

		// -- Editor Font Styles
		add_theme_support(
			'editor-font-sizes',
			[
				[
					'name'      => __( 'Large', 'cultivate_textdomain' ),
					'shortName' => __( 'L', 'cultivate_textdomain' ),
					'size'      => 23,
					'slug'      => 'large',
				],
				[
					'name'      => __( 'Normal', 'cultivate_textdomain' ),
					'shortName' => __( 'M', 'cultivate_textdomain' ),
					'size'      => 19,
					'slug'      => 'normal',
				],
				[
					'name'      => __( 'Small', 'cultivate_textdomain' ),
					'shortName' => __( 'S', 'cultivate_textdomain' ),
					'size'      => 17,
					'slug'      => 'small',
				],
			]
		);

		// -- Disable Custom Colors
		add_theme_support( 'disable-custom-colors' );

		// -- Disable Gradients
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'editor-gradient-presets', array() );

		// -- Editor Color Palette
		add_theme_support(
			'editor-color-palette',
			[
				[
					'name'  => __( 'Primary', 'cultivate_textdomain' ),
					'slug'  => 'primary',
					'color' => '#24509A',
				],
				[
					'name'  => __( 'Primary Background', 'cultivate_textdomain' ),
					'slug'  => 'primary-bg',
					'color' => '#E9EDF4',
				],
				[
					'name'  => __( 'Secondary', 'cultivate_textdomain' ),
					'slug'  => 'secondary',
					'color' => '#FEC72D',
				],
				[
					'name'  => __( 'Secondary Background', 'cultivate_textdomain' ),
					'slug'  => 'secondary-bg',
					'color' => '#FEF9EA',
				],
				[
					'name'  => __( 'Grey', 'cultivate_textdomain' ),
					'slug'  => 'grey',
					'color' => '#FAFAFA',
				],
				[
					'name'  => __( 'White', 'cultivate_textdomain' ),
					'slug'  => 'white',
					'color' => '#FFFFFF',
				],
			]
		);

	}
endif;
add_action( 'after_setup_theme', 'mst_setup' );

/**
 * Template Hierarchy
 *
 * @param string $template Template.
 */
function mst_template_hierarchy( $template ) {

	if ( is_home() || is_search() ) {
		$template = get_query_template( 'archive' );
	}
	return $template;
}
add_filter( 'template_include', 'mst_template_hierarchy' );
