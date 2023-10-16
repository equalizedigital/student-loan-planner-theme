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
function eqd_page_layout_options() {
	return array(
		'content-sidebar',
		'content',
		'full-width-content',
	);
}

/**
 * Gutenberg layout style
 */
function eqd_editor_layout_style() {
	wp_enqueue_style( 'ea-editor-layout', get_stylesheet_directory_uri() . '/assets/css/editor-layout.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/editor-layout.css' ) );
}
add_action( 'enqueue_block_editor_assets', 'eqd_editor_layout_style' );

/**
 * Editor layout class
 *
 * @param string $classes Classes.
 * @return string
 */
function eqd_editor_layout_class( $classes ) {
	$screen = get_current_screen();
	if ( ! method_exists( $screen, 'is_block_editor' ) || ! $screen->is_block_editor() ) {
		return $classes;
	}

	$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : false;
	$layout  = eqd_page_layout( $post_id );

	$classes .= ' ' . $layout . ' ';
	return $classes;
}
add_filter( 'admin_body_class', 'eqd_editor_layout_class' );


/**
 * Layout Metabox (ACF)
 */
function eqd_page_layout_metabox() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$choices = array();
	$layouts = eqd_page_layout_options();
	foreach ( $layouts as $layout ) {
		$label              = str_replace( '-', ' ', $layout );
		$choices[ $layout ] = ucwords( $label );
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_5dd714b369526',
			'title'                 => 'Page Layout',
			'fields'                => array(
				array(
					'key'               => 'field_5dd715a02eaf0',
					'label'             => 'Page Layout',
					'name'              => 'eqd_page_layout',
					'type'              => 'select',
					'instructions'      => '',
					'required'          => 0,
					'conditional_logic' => 0,
					'wrapper'           => array(
						'width' => '',
						'class' => '',
						'id'    => '',
					),
					'choices'           => $choices,
					'default_value'     => array(),
					'allow_null'        => 1,
					'multiple'          => 0,
					'ui'                => 0,
					'return_format'     => 'value',
					'ajax'              => 0,
					'placeholder'       => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'side',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => '',
		)
	);
}
add_action( 'acf/init', 'eqd_page_layout_metabox' );

/**
 * Default Widget Area Arguments
 *
 * @param array $args Args.
 */
function eqd_widget_area_args( $args = array() ) {

	$defaults = array(
		'name'          => '',
		'id'            => '',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);
	$args     = wp_parse_args( $args, $defaults );

	if ( ! empty( $args['name'] ) && empty( $args['id'] ) ) {
		$args['id'] = sanitize_title_with_dashes( $args['name'] );
	}
	return $args;
}

/**
 * Register widget area.
 */
function eqd_widgets_init() {

	register_sidebar(
		eqd_widget_area_args(
			array(
				'name' => esc_html__( 'Primary Sidebar', 'eqd' ),
			)
		)
	);

	register_sidebar(
		eqd_widget_area_args(
			array(
				'name' => esc_html__( 'Footer Widget Area 1', 'eqd' ),
			)
		)
	);

	register_sidebar(
		eqd_widget_area_args(
			array(
				'name' => esc_html__( 'Footer Widget Area 2', 'eqd' ),
			)
		)
	);

	register_sidebar(
		eqd_widget_area_args(
			array(
				'name' => esc_html__( 'Footer Widget Area 3', 'eqd' ),
			)
		)
	);

	register_sidebar(
		eqd_widget_area_args(
			array(
				'name' => esc_html__( 'Footer Widget Area 4', 'eqd' ),
			)
		)
	);
}
add_action( 'widgets_init', 'eqd_widgets_init' );

add_action( 'tha_footer_top', 'eqd_output_footer_widgets' );
/**
 * Output footer widget area.
 */
function eqd_output_footer_widgets() {
	if ( is_active_sidebar( 'Footer Widget Area 1' ) ) {
		?>
		<div id="footer-widget-area-1" class="widget-area">
			<?php dynamic_sidebar( 'Footer Widget Area 1' ); ?>
		</div>
		<?php
	}
	if ( is_active_sidebar( 'Footer Widget Area 2' ) ) {
		?>
		<div id="footer-widget-area-2" class="widget-area">
			<?php dynamic_sidebar( 'Footer Widget Area 2' ); ?>
		</div>
		<?php
	}
	if ( is_active_sidebar( 'Footer Widget Area 3' ) ) {
		?>
		<div id="footer-widget-area-3" class="widget-area">
			<?php dynamic_sidebar( 'Footer Widget Area 3' ); ?>
		</div>
		<?php
	}
	if ( is_active_sidebar( 'Footer Widget Area 4' ) ) {
		?>
		<div id="footer-widget-area-4" class="widget-area">
			<?php dynamic_sidebar( 'Footer Widget Area 4' ); ?>
		</div>
		<?php
	}
}

/**
 * Layout Body Class
 *
 * @param array $classes Body Classes.
 */
function eqd_layout_body_class( $classes ) {
	$classes[] = eqd_page_layout();
	return $classes;
}
add_filter( 'body_class', 'eqd_layout_body_class', 5 );



/**
 * Page Layout
 *
 * @param int $id Post ID.
 */
function eqd_page_layout( $id = false ) {

	$id = $id ? intval( $id ) : false;
	if ( empty( $id ) && is_singular() ) {
		$id = get_the_ID();
	}

	$available_layouts = eqd_page_layout_options();
	$layout            = 'content';

	// Default layouts.
	$defaults = array(
		'post'              => 'content-sidebar',
		'page'              => 'content',
		'cultivate_landing' => 'full-width-content',
	);
	foreach ( $defaults as $post_type => $default_layout ) {
		if ( ( $id && $post_type === get_post_type( $id ) ) || ( ! empty( $_GET['post_type'] ) && $post_type === $_GET['post_type'] ) ) {
			$layout = $default_layout;
		}
	}

	// Selected layout.
	if ( $id ) {
		$selected = get_post_meta( $id, 'eqd_page_layout', true );
		if ( ! empty( $selected ) && in_array( $selected, $available_layouts, true ) ) {
			$layout = $selected;
		}
	}

	$layout = apply_filters( 'eqd_page_layout', $layout );
	$layout = in_array( $layout, $available_layouts, true ) ? $layout : $available_layouts[0];

	return sanitize_title_with_dashes( $layout );
}

/**
 * Return Full Width Content
 */
function eqd_return_full_width_content() {
	return 'full-width-content';
}

/**
 * Return Content Sidebar
 */
function eqd_return_content_sidebar() {
	return 'content-sidebar';
}

/**
 * Return Content
 */
function eqd_return_content() {
	return 'content';
}



add_action( 'tha_single_fullwidth', 'eqd_single_fullwidth_content' );

/**
 * Output footer widget area.
 */
function eqd_single_fullwidth_content() {

	if ( is_single() && get_post_type() == 'post' ) {

		if ( get_field( 'post_format_style' ) !== 'full-width' ) :
			?>
				<?php
				$featured_image = get_the_post_thumbnail_url( get_the_ID() );
				if ( $featured_image ) {
				?>
				<span class="hero_featured_image">
					<?php echo '<img src="' . esc_url( $featured_image ) . '" />'; ?>
					<div class="hero_featured_image_data">
						<?php
						$output = '';
						if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
							$output .= 'Updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
						}
						$post_data = get_the_content( get_the_ID() );
						$time_read = estimateReadingTime( esc_html( $post_data ) );

						?>

						<?php echo ( $time_read['minutes'] ); ?> Min Read |  <?php echo wp_kses_post( $output ); ?>
					</div>
				</span>
			<?php } else { echo "</br>";} ?>

			<div class="site-main-article__author-data">
				<div class="article_author">
					<?php
					$post_author    = get_the_author();
					$id             = get_field( 'post_reviewed_by', get_the_ID() );
					$id_post_editor = get_field( 'post_editor', get_the_ID() );
					if(!empty($id_post_editor)){
						$edit_auth_id   = $id_post_editor['ID'];
						$author_info    = get_field( 'job_title', "user_$edit_auth_id" );
					}
					
					?>
					<span class="entry-author">
							<?php echo !empty($edit_auth_id)? get_avatar( $edit_auth_id, 40 ):''; ?>
						<span class="entry-info">
							<span>
								<?php echo ! empty( $id_post_editor ) ? 'Edited by' : 'Written By'; ?>
								<?php echo ! empty($edit_auth_id)?get_author_posts_link_by_id($edit_auth_id):$post_author; ?>
							</span>
							<span class="entry-data">
								<?php
								echo !empty($author_info)?wp_kses_post( $author_info ):'';
								?>
							</span>
						</span>
					</span>
				</div>
				<?php
						$review_by_auth_id = get_field( 'post_reviewed_by', get_the_ID() );
						if($review_by_auth_id != false){
							$profile_picture   = get_avatar( $review_by_auth_id, 64 );
							$user_info         = get_userdata( $review_by_auth_id );
							$first_name        = $user_info->first_name;
							$last_name         = $user_info->last_name;
							$nickname          = $user_info->nickname;
						}

				?>
						<?php if ( $review_by_auth_id ) : ?>

				<div class="reviewed_author">
						
					<div class="profile">
							<?php echo $profile_picture; ?>
					</div>
					
					<div class="author_info">
					Reviewed By
					<?php  echo get_author_posts_link_by_id($review_by_auth_id); ?>
					</div>
				</div>
				<?php endif; ?>

			</div>

			<section class="site-main-article__author-data-editorial_statement">
				<div class="site-main-article__author-data-editorial_statement-container">
					<div class="site-main-article__author-data-editorial_statement-container__title"><h2>Editorial Ethics at Student Loan Planner</h2></div>
					<div class="site-main-article__author-data-editorial_statement-container__copy">
						<p>
						At Student Loan Planner, we follow a strict <a href="https://studentloanstg.wpengine.com/editorial-ethics-policy/">editorial ethics policy</a>. This post may contain references to products from our partners within the guidelines of this policy. Read our 
						<button class="modal-btn btn-style-link" aria-haspopup="true" aria-expanded="false" aria-controls="modal_disclosure" data-modal="modal_disclosure" aria-label="Open Disclosure Modal">advertising disclosure</button> to learn more.
						</p>
					</div>
				</div>
			</section>

			<?php
		endif;
	}
}
