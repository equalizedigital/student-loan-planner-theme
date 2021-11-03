<?php
/**
 * ACF Customizations
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * ACF Customizations
 */
class mst_ACF_Customizations {

	/**
	 * Instance of the class.
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Initialization
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof mst_ACF_Customizations ) ) {
			self::$instance = new mst_ACF_Customizations();

			// Don't edit fields in production.
			if ( function_exists( 'wp_get_environment_type' ) && 'production' === wp_get_environment_type() ) {
				add_action( 'admin_menu', array( self::$instance, 'remove_acf_admin_menu' ), 20 );
			}

			// Register options page.
			add_action( 'init', array( self::$instance, 'register_options_page' ) );

			// Custom block category.
			add_filter( 'block_categories_all', array( self::$instance, 'block_categories' ) );

			// Register Blocks.
			add_action( 'acf/init', array( self::$instance, 'register_blocks' ) );

			// Dynamic fields.
			add_filter( 'acf/load_field', array( self::$instance, 'dynamic_icons' ) );
			add_filter( 'acf/load_field/name=dynamic_color', array( self::$instance, 'dynamic_colors' ) );

		}

		return self::$instance;
	}

	/**
	 * Remove ACF admin menu
	 */
	public function remove_acf_admin_menu() {
		$slug = 'edit.php?post_type=acf-field-group';
		remove_submenu_page( $slug, $slug );
		remove_submenu_page( $slug, 'post-new.php?post_type=acf-field-group' );
	}

	/**
	 * Register Options Page
	 */
	public function register_options_page() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page(
				[
					'title'      => __( 'Site Options', 'cultivate_textdomain' ),
					'capability' => 'manage_options',
				]
			);
		}
	}

	/**
	 * Block categories
	 *
	 * @param array $categories Block categories.
	 */
	public function block_categories( $categories ) {
		return array_merge(
			$categories,
			[
				[
					'slug'  => 'cultivatewp',
					'title' => __( 'CultivateWP', 'cultivate_textdomain' ),
					'icon'  => mst_icon( [ 'icon' => 'cultivatewp', 'group' => 'color', 'force' => true ] ),
				],
			]
		);
	}

	/**
	 * Register Blocks
	 *
	 * Categories: common, formatting, layout, widgets, embed
	 * Dashicons: https://developer.wordpress.org/resource/dashicons/
	 * ACF Settings: https://www.advancedcustomfields.com/resources/acf_register_block/
	 */
	public function register_blocks() {

		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return;
		}

		acf_register_block_type(
			[
				'title'           => __( 'Style Guide Colors', 'cultivate_textdomain' ),
				'name'            => 'colors',
				'render_template' => 'partials/blocks/colors.php',
				'category'        => 'cultivatewp',
				'icon'            => mst_icon( [ 'icon' => 'cultivatewp', 'group' => 'color', 'force' => true ] ),
				'mode'            => 'preview',
			]
		);

		acf_register_block_type(
			[
				'title'           => __( 'Icons', 'cultivate_textdomain' ),
				'name'            => 'icons',
				'render_template' => 'partials/blocks/icons.php',
				'category'        => 'cultivatewp',
				'icon'            => mst_icon( [ 'icon' => 'cultivatewp', 'group' => 'color', 'force' => true ] ),
				'mode'            => 'preview',
				'supports'        => [
					'align'           => false,
					'anchor'          => true,
					'customClassName' => true,
				],
			]
		);

		acf_register_block_type(
			[
				'title'           => __( 'Search', 'cultivate_textdomain' ),
				'name'            => 'search',
				'render_template' => 'partials/blocks/search.php',
				'category'        => 'cultivatewp',
				'icon'            => mst_icon( [ 'icon' => 'cultivatewp', 'group' => 'color', 'force' => true ] ),
				'mode'            => 'auto',
				'supports'        => [
					'align'           => false,
					'anchor'          => false,
					'customClassName' => true,
				],
			]
		);

	}

	/**
	 * Dynamic Icons
	 *
	 * @param array $field ACF Field.
	 */
	public function dynamic_icons( $field ) {
		if ( 0 !== strpos( $field['name'], 'dynamic_icon_' ) ) {
			return $field;
		}

		$type  = str_replace( 'dynamic_icon_', '', $field['name'] );
		$icons = self::$instance->get_icons( $type );

		$field['choices'] = [ 0 => '(None)' ];
		foreach ( $icons as $icon ) {
			$field['choices'][ $icon ] = $icon;
		}

		return $field;
	}

	/**
	 * Get Theme Icons
	 * Refresh cache by bumping MST_ICON_VERSION
	 *
	 * @param string $directory Directory.
	 */
	public function get_icons( $directory = 'utility' ) {
		$icons   = get_option( 'mst_theme_icons_' . $directory );
		$version = get_option( 'mst_theme_icons_' . $directory . '_version' );

		if ( empty( $icons ) || ( defined( 'MST_ICON_VERSION' ) && version_compare( MST_ICON_VERSION, $version ) ) ) {
			$icons = scandir( get_stylesheet_directory() . '/assets/icons/' . $directory );
			$icons = array_diff( $icons, array( '..', '.' ) );
			$icons = array_values( $icons );
			if ( empty( $icons ) ) {
				return $icons;
			}

			// remove the .svg.
			foreach ( $icons as $i => $icon ) {
				$icons[ $i ] = substr( $icon, 0, -4 );
			}
			update_option( 'mst_theme_icons_' . $directory, $icons );
			if ( defined( 'MST_ICON_VERSION' ) ) {
				update_option( 'mst_theme_icons_' . $directory . '_version', MST_ICON_VERSION );
			}
		}
		return $icons;
	}

	/**
	 * Dynamic Colors
	 *
	 * @param array $field ACF Field.
	 */
	public function dynamic_colors( $field ) {
		$colors = get_theme_support( 'editor-color-palette' );
		if ( empty( $colors ) ) {
			return $field;
		}

		$field['choices'] = [ 0 => '(None)' ];
		foreach ( $colors[0] as $color ) {
			$field['choices'][ $color['slug'] ] = $color['name'];
		}
		return $field;
	}
}

/**
 * The function provides access to the class methods.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * @return object
 */
function mst_acf_customizations() {
	return mst_ACF_Customizations::instance();
}
mst_acf_customizations();
