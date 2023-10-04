<?php
/**
 * Navigation
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Mobile Menu
 */
function eqd_site_header() {

	if ( has_nav_menu( 'primary' ) ) : ?>
		<div class="menu-container">
			<button class="menu-button"><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'rwc' ); ?></span></button>
			<div id="site-header-menu" class="site-header-menu">
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'rwc' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'depth'          => 3,
						'menu_id' => 'primary-menu',
						'container_class' => 'nav-primary',
					)
				);
				?>
				</nav>
			</div>
		</div>
		<?php
	endif;

}
add_action( 'tha_header_bottom', 'eqd_site_header', 11 );


function slp_header_main() {
	get_template_part('partials/content/header/main');
}
add_action( 'slp_main_menu', 'slp_header_main' );


function slp_cta_button() { 
	$slp_cta = get_field('cta_header', 'option');
	if(isset($slp_cta)) : ?>
		<div class="cta-header">
			<a href="<?php echo esc_attr($slp_cta['url']); ?>" <?php echo esc_html(slp_a_target($slp_cta['target'])); ?>>
				<?php echo esc_html($slp_cta['title']); ?>
			</a>
		</div>
	<?php 
	endif;
}



/**
 * Nav Extras
 *
 * @param string $menu Menu.
 * @param array  $args Args.
 */
function eqd_nav_extras( $menu, $args ) {

	if ( 'primary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search menu-item-extra">' . eqd_search_toggle() . '</li>';
	}

	if ( 'primary' === $args->theme_location ) {
		$menu .= '<li class="menu-item help menu-item-extra">' . eqd_help_btn() . '</li>';
	}

	if ( 'secondary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . get_search_form( false ) . '</li>';
	}

	return $menu;
}
add_filter( 'wp_nav_menu_items', 'eqd_nav_extras', 10, 2 ); 

/**
 * Search toggle
 */
function eqd_search_toggle() {
	$output  = '<button aria-label="Search" class="search-toggle">';
	$output .= eqd_icon(
		array(
			'icon' => 'search-fat',
			'class' => 'open',
		)
	);
	$output .= eqd_icon(
		array(
			'icon' => 'close',
			'class' => 'close',
		)
	);
	$output .= '</button>';
	return $output;
}

/**
 * help btn
 */
function eqd_help_btn() {
	$output  = '<button aria-label="Get Help" class="btn">';
	$output .= esc_html('Get Help');
	$output .= '</button>';
	return $output;
}

/**
 * Mobile menu toggle
 */
function eqd_mobile_menu_toggle() {
	$output  = '<button aria-label="Menu" class="menu-toggle ">';
	$output .= eqd_icon(
		array(
			'icon' => 'menu',
			'class' => 'open',
		)
	);
	$output .= eqd_icon(
		array(
			'icon' => 'close',
			'class' => 'close',
		)
	);
	$output .= '</button>';
	return $output;
}

/**
 * Add a dropdown icon to top-level menu items.
 *
 * @param string $output Nav menu item start element.
 * @param object $item   Nav menu item.
 * @param int    $depth  Depth.
 * @param object $args   Nav menu args.
 * @return string Nav menu item start element.
 * Add a dropdown icon to top-level menu items
 */
function eqd_nav_add_dropdown_icons( $output, $item, $depth, $args ) {

	if ( ! isset( $args->theme_location ) || 'primary' !== $args->theme_location ) {
		return $output;
	}

	if ( 1 === $args->depth ) {
		return $output;
	}

	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {

		// Add SVG icon to parent items.
		$icon = eqd_icon( array( 'icon' => 'carat-down' ) );

		$output .= sprintf(
			'<button aria-label="Submenu Dropdown" class="submenu-expand" tabindex="-1">%s</button>',
			$icon
		);
	}

	return $output;
}
/* add_filter( 'walker_nav_menu_start_el', 'eqd_nav_add_dropdown_icons', 10, 4 ); */

/**
 * Previous/Next Archive Navigation (disabled)
 */
function eqd_archive_navigation() {
	if ( ! is_singular() ) {
		the_posts_navigation();
	}
}
/* add_action( 'tha_content_while_after', 'eqd_archive_navigation' ); */

/**
 * Archive Paginated Navigation
 */
function eqd_archive_paginated_navigation() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	// Stop execution if there's only one page.
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = (int) $wp_query->max_num_pages;

	// Add current page to the array.
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="archive-pagination pagination">';

	$before_number = '<span class="screen-reader-text">' . __( 'Go to page', 'eqd' ) . '</span>';

	printf( '<ul role="navigation" aria-label="%s">', esc_attr__( 'Pagination', 'eqd' ) );

	// Previous Post Link.
	if ( get_previous_posts_link() ) {
		$label = __( ' <span class="screen-reader-text">Go to</span> Previous', 'eqd' );
		$link  = get_previous_posts_link( $label );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		printf( '<li class="pagination-previous">%s</li>' . "\n", $link );
	}

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links, true ) ) {
		$class = 1 === $paged ? ' class="active"' : '';

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( 1 ), trim( $before_number . ' 1' ) );

		if ( ! in_array( 2, $links, true ) ) {
			$label = sprintf( '<span class="screen-reader-text">%s</span> &#x02026;', __( 'Interim pages omitted', 'eqd' ) );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
			printf( '<li class="pagination-omission">%s</li> ' . "\n", $label );
		}
	}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = '';
		$aria  = '';
		if ( $paged === $link ) {
			$class = ' class="active" ';
			$aria  = ' aria-label="' . esc_attr__( 'Current page', 'eqd' ) . '" aria-current="page"';
		}

		printf(
			'<li%s><a href="%s"%s>%s</a></li>' . "\n",
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			$class,
			esc_url( get_pagenum_link( $link ) ),
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			$aria,
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
			trim( $before_number . ' ' . $link )
		);
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links, true ) ) {

		if ( ! in_array( $max - 1, $links, true ) ) {
			$label = sprintf( '<span class="screen-reader-text">%s</span> &#x02026;', __( 'Interim pages omitted', 'eqd' ) );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is known to be safe, not set via input.
			printf( '<li class="pagination-omission">%s</li> ' . "\n", $label );
		}

		$class = $paged === $max ? ' class="active"' : '';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is safe, not set via input.
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, get_pagenum_link( $max ), trim( $before_number . ' ' . $max ) );

	}

	// Next Post Link.
	if ( get_next_posts_link() ) {
		$label = __( '<span class="screen-reader-text">Go to</span> Next', 'eqd' );
		$link  = get_next_posts_link( $label );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		printf( '<li class="pagination-next">%s</li>' . "\n", $link );
	}

	echo '</ul>';
	echo '</nav>';
}
add_action( 'tha_content_while_after', 'eqd_archive_paginated_navigation' );
