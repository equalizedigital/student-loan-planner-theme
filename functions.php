<?php
/**
 * Functions
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Bump this when adding new icons, see inc/acf.php.
define( 'EQD_ICON_VERSION', '0.1' );

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
require_once get_template_directory() . '/inc/admin-branding-ed.php';

// Functionality.
require_once get_template_directory() . '/inc/blocks.php';
require_once get_template_directory() . '/inc/fonts.php';
require_once get_template_directory() . '/inc/login-logo.php';
require_once get_template_directory() . '/inc/social-links.php';
require_once get_template_directory() . '/inc/map-block-functionality.php';

// Plugin Support.
require_once get_template_directory() . '/inc/pwa.php';
require_once get_template_directory() . '/inc/shared-counts.php';
require_once get_template_directory() . '/inc/wordpress-seo.php';

// Blocks
require_once(get_template_directory() . '/inc/class-gutenberg-loader.php');

/**
 * Enqueue scripts and styles.
 */
function eqd_scripts() {

	wp_enqueue_script( 'theme-global', get_template_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_template_directory() . '/assets/js/global-min.js' ), true );

	wp_localize_script(
		'theme-global',
		'eqd_vars',
		array(
			'nonce' => wp_create_nonce( 'ajax-nonce' ),
			'post_id' => get_the_ID(),
		)
	);

	wp_enqueue_script( 'theme-menu', get_template_directory_uri() . '/assets/js/menu-min.js', array( 'jquery' ), filemtime( get_template_directory() . '/assets/js/menu-min.js' ), true );
	wp_localize_script(
		'theme-menu',
		'screenReaderText',
		array(
			'expand'   => __( 'Expand child menu', 'eqd' ),
			'collapse' => __( 'Collapse child menu', 'eqd' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style(
		'rwc-font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_template_directory() . '/assets/css/main.css' ) );

	wp_enqueue_script( 'doctor-mortgages-map-block', get_stylesheet_directory_uri() . '/template-parts/blocks/doctor-mortgages-map-block/doctor-mortgages-map-block.js', array( 'jquery' ), filemtime( get_template_directory() . '/template-parts/blocks/doctor-mortgages-map-block/doctor-mortgages-map-block.js' ), true );
	wp_localize_script(
		'doctor-mortgages-map-block',
		'rwc_base_vars',
		array(
			'nonce' => wp_create_nonce( 'ajax-nonce' ),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);

}
add_action( 'wp_enqueue_scripts', 'eqd_scripts' );

/**
 * Gutenberg scripts and styles
 */
function eqd_gutenberg_scripts() {
	wp_enqueue_script( 'theme-editor', get_template_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/editor.js' ), true );
	wp_enqueue_script( 'theme-editor-js', get_template_directory_uri() . '/assets/js/global-min.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_template_directory() . '/assets/js/global-min.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'eqd_gutenberg_scripts', 9000 );

if ( ! function_exists( 'eqd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eqd_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'eqd', get_template_directory() . '/languages' );

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
		$GLOBALS['content_width'] = apply_filters( 'eqd_content_width', 768 );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary Navigation Menu', 'eqd' ),
				'secondary' => esc_html__( 'Secondary Navigation Menu', 'eqd' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
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
			array(
				array(
					'name'      => __( 'Large', 'eqd' ),
					'shortName' => __( 'L', 'eqd' ),
					'size'      => 23,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Normal', 'eqd' ),
					'shortName' => __( 'M', 'eqd' ),
					'size'      => 19,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Small', 'eqd' ),
					'shortName' => __( 'S', 'eqd' ),
					'size'      => 17,
					'slug'      => 'small',
				),
			)
		);

		// -- Disable Custom Colors
		add_theme_support( 'disable-custom-colors' );

		// -- Disable Gradients
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'editor-gradient-presets', array() );

		// -- Editor Color Palette
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'eqd' ),
					'slug'  => 'primary',
					'color' => '#82BC46',
				),
				array(
					'name'  => __( 'Secondary', 'eqd' ),
					'slug'  => 'secondary',
					'color' => '#547C2D',
				),
				array(
					'name'  => __( 'Tertiary', 'eqd' ),
					'slug'  => 'tertiary',
					'color' => '#625089',
				),
				array(
					'name'  => __( 'text_dark', 'eqd' ),
					'slug'  => 'text_dark',
					'color' => '#1D1F20',
				),
				array(
					'name'  => __( 'text_medium', 'eqd' ),
					'slug'  => 'text_medium',
					'color' => '#737373',
				),
				array(
					'name'  => __( 'cream', 'eqd' ),
					'slug'  => 'cream',
					'color' => '#fffde9',
				),
				array(
					'name'  => __( 'Grey', 'eqd' ),
					'slug'  => 'grey',
					'color' => '#FAFAFA',
				),
				array(
					'name'  => __( 'White', 'eqd' ),
					'slug'  => 'white',
					'color' => '#FFFFFF',
				),
			)
		);

		remove_theme_support( 'widgets-block-editor' );

	}
endif;
add_action( 'after_setup_theme', 'eqd_setup' );

/**
 * Template Hierarchy
 *
 * @param string $template Template.
 */
function eqd_template_hierarchy( $template ) {

	if ( is_home() || is_search() ) {
		$template = get_query_template( 'archive' );
	}
	return $template;
}
add_filter( 'template_include', 'eqd_template_hierarchy' );

