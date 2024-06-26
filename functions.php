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

// Blocks.
require_once get_template_directory() . '/inc/class-gutenberg-loader.php';

/**
 * Enqueue scripts and styles.
 */
function eqd_scripts() {

	// Global post object to check the current post content.
	global $post;

	// Check if the post is loaded and contains the specific block.
	if ( is_a( $post, 'WP_Post' ) && has_block( 'acf/video-carousel', $post ) ) {
		// Enqueue Swiper CSS.
		wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );

		// Enqueue your custom JS to initialize Swiper.
		wp_enqueue_script( 'custom-swiper-initialization', get_template_directory_uri() . '/assets/js/video-carousel-min.js', array(), filemtime( get_template_directory() . '/assets/js/video-carousel-min.js' ), true );
	}

	wp_enqueue_script( 'theme-global', get_template_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_template_directory() . '/assets/js/global-min.js' ), true );

	wp_localize_script(
		'theme-global',
		'eqd_vars',
		array(
			'nonce'   => wp_create_nonce( 'ajax-nonce' ),
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
			'nonce'    => wp_create_nonce( 'ajax-nonce' ),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);

	wp_enqueue_style( 'dashicons' );
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
		remove_theme_support( 'core-block-patterns' );

		// -- Add custom theme image sizes
		add_image_size( 'squared-image-content-callout-thumbnail', 732, 732, true );
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

/**
 * Custom function to modify the ACF post object field query.
 *
 * This function checks if the field being queried is named 'recommended_posts'.
 * If so, it modifies the query to search for post titles only and ignores the content.
 *
 * @param array $args    The original query arguments.
 * @param array $field   Information about the ACF field.
 * @param int   $post_id The ID of the current post being edited, if applicable.
 *
 * @return array The modified query arguments.
 */
function eqd_custom_acf_post_object_query( $args, $field, $post_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed, VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- ACF hook.
	// Check if the field being queried is named 'recommended_posts'.
	if ( 'recommended_posts' === $field['name'] ) {
		// Modify the query to search for post titles only.
		$args['post_type']      = 'post';
		$args['search_columns'] = array( 'post_title' );
	}
	return $args;
}
add_filter( 'acf/fields/post_object/query', 'eqd_custom_acf_post_object_query', 10, 3 );

/**
 * Filters the query arguments for the 'recommendedfeatured_posts' ACF Post Object field.
 * The filter limits the displayed posts to those associated with the currently edited/viewed term
 * for the taxonomies: 'category', 'post_tag', and 'slp_occupation'.
 *
 * @param array $args   The WP_Query arguments.
 * @param array $field  The field settings.
 * @param int   $post_id The post ID (or term ID, depending on context).
 *
 * @return array Modified query arguments.
 */
function eqd_filter_post_object_query( $args, $field, $post_id ) {
	// Check if this is the specific field we want to modify.
	if ( 'recommendedfeatured_posts' === $field['name'] ) {

		// Check if it's a term ID and extract the ID.
		if ( strpos( $post_id, 'term_' ) === 0 ) {
			$term_id = str_replace( 'term_', '', $post_id );
			$term    = get_term( $term_id );

			// Check if term belongs to the specified taxonomies.
			if ( $term instanceof WP_Term && in_array( $term->taxonomy, array( 'category', 'post_tag', 'slp_occupation' ), true ) ) {
				$args['tax_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- This is a necessary query.
					array(
						'taxonomy' => $term->taxonomy,
						'field'    => 'term_id',
						'terms'    => $term->term_id,
						'operator' => 'IN',
					),
				);
			}
		}
	}

	return $args;
}
add_filter( 'acf/fields/post_object/query', 'eqd_filter_post_object_query', 10, 3 );

/**
 * Modify the query for the 'recommended_posts' field to search by title only.
 *
 * @param array $args The original query arguments.
 * @param array $field Information about the ACF field.
 * @param int   $post_id The ID of the current post being edited, if applicable.
 * @return array
 */
function eqd_modify_post_object_query( $args, $field, $post_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.FoundAfterLastUsed, VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
	// Check if the parent block is 'acf/recommended-posts-block'.
	if ( isset( $field['parent'] ) && 'block_acf/recommended-posts-block' === $field['parent'] ) {
		// If there's a search term, modify the query to search by title only.
		if ( isset( $args['s'] ) ) {
			// Set search term to a variable.
			$search_term = $args['s'];

			// Modify the query.
			unset( $args['s'] ); // Remove default search.
			$args['post_title_like'] = $search_term; // Add title search.
		}
	}
	return $args;
}
add_filter( 'acf/fields/post_object/query', 'eqd_modify_post_object_query', 10, 3 );

/**
 * This function modifies the query for the 'recommended_posts' field to search by title only.
 *
 * @param string $where The original WHERE clause.
 * @param object $wp_query The WP_Query object.
 * @return string
 */
function title_like_posts_where( $where, $wp_query ) {
	global $wpdb;
	$post_title_like = $wp_query->get( 'post_title_like' );
	if ( $post_title_like ) {
		$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'' . esc_sql( $wpdb->esc_like( $post_title_like ) ) . '%\'';
	}
	return $where;
}
add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
