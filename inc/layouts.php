<?php
/**
 * Sidebar Layouts
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Layout Options
 **/
function mst_page_layout_options() {
	return [
		'content-sidebar',
		'content',
		'full-width-content',
	];
}

/**
 * Gutenberg layout style
 */
function mst_editor_layout_style() {
	wp_enqueue_style( 'ea-editor-layout', get_stylesheet_directory_uri() . '/assets/css/editor-layout.css', [], filemtime( get_stylesheet_directory() . '/assets/css/editor-layout.css' ) );
}
add_action( 'enqueue_block_editor_assets', 'mst_editor_layout_style' );

/**
 * Editor layout class
 *
 * @param string $classes Classes.
 * @return string
 */
function mst_editor_layout_class( $classes ) {
	$screen = get_current_screen();
	if ( ! method_exists( $screen, 'is_block_editor' ) || ! $screen->is_block_editor() ) {
		return $classes;
	}

	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;
	$layout  = mst_page_layout( $post_id );

	$classes .= ' ' . $layout . ' ';
	return $classes;
}
add_filter( 'admin_body_class', 'mst_editor_layout_class' );


/**
 * Layout Metabox (ACF)
 */
function mst_page_layout_metabox() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$choices = [];
	$layouts = mst_page_layout_options();
	foreach ( $layouts as $layout ) {
		$label              = str_replace( '-', ' ', $layout );
		$choices[ $layout ] = ucwords( $label );
	}

	acf_add_local_field_group(
		[
			'key' => 'group_5dd714b369526',
			'title' => 'Page Layout',
			'fields' => array(
				array(
					'key' => 'field_5dd715a02eaf0',
					'label' => 'Page Layout',
					'name' => 'mst_page_layout',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => $choices,
					'default_value' => array(
					),
					'allow_null' => 1,
					'multiple' => 0,
					'ui' => 0,
					'return_format' => 'value',
					'ajax' => 0,
					'placeholder' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		]
	);
}
add_action( 'acf/init', 'mst_page_layout_metabox' );

/**
 * Default Widget Area Arguments
 *
 * @param array $args Args.
 */
function mst_widget_area_args( $args = array() ) {

	$defaults = [
		'name'          => '',
		'id'            => '',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	];
	$args     = wp_parse_args( $args, $defaults );

	if ( ! empty( $args['name'] ) && empty( $args['id'] ) ) {
		$args['id'] = sanitize_title_with_dashes( $args['name'] );
	}
	return $args;
}

/**
 * Register widget area.
 */
function mst_widgets_init() {

	register_sidebar(
		mst_widget_area_args(
			[
				'name' => esc_html__( 'Primary Sidebar', 'mainspring' ),
			]
		)
	);

}
add_action( 'widgets_init', 'mst_widgets_init' );

/**
 * Layout Body Class
 *
 * @param array $classes Body Classes.
 */
function mst_layout_body_class( $classes ) {
	$classes[] = mst_page_layout();
	return $classes;
}
add_filter( 'body_class', 'mst_layout_body_class', 5 );



/**
 * Page Layout
 *
 * @param int $id Post ID.
 */
function mst_page_layout( $id = false ) {

	$id = $id ? intval( $id ) : false;
	if ( empty( $id ) && is_singular() ) {
		$id = get_the_ID();
	}

	$available_layouts = mst_page_layout_options();
	$layout            = 'content';

	// Default layouts.
	$defaults = [
		'post'              => 'content-sidebar',
		'page'              => 'content',
		'cultivate_landing' => 'full-width-content',
	];
	foreach ( $defaults as $post_type => $default_layout ) {
		if ( ( $id && $post_type === get_post_type( $id ) ) || ( ! empty( $_GET['post_type'] ) && $post_type === $_GET['post_type'] ) ) {
			$layout = $default_layout;
		}
	}

	// Selected layout.
	if ( $id ) {
		$selected = get_post_meta( $id, 'mst_page_layout', true );
		if ( ! empty( $selected ) && in_array( $selected, $available_layouts, true ) ) {
			$layout = $selected;
		}
	}

	$layout = apply_filters( 'mst_page_layout', $layout );
	$layout = in_array( $layout, $available_layouts, true ) ? $layout : $available_layouts[0];

	return sanitize_title_with_dashes( $layout );
}

/**
 * Return Full Width Content
 */
function mst_return_full_width_content() {
	return 'full-width-content';
}

/**
 * Return Content Sidebar
 */
function mst_return_content_sidebar() {
	return 'content-sidebar';
}

/**
 * Return Content
 */
function mst_return_content() {
	return 'content';
}
