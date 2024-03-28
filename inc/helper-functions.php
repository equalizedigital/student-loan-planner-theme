<?php
/**
 * Helper Functions
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Duplicate 'the_content' filters.
global $wp_embed;
add_filter( 'eqd_the_content', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'eqd_the_content', array( $wp_embed, 'autoembed' ), 8 );
add_filter( 'eqd_the_content', 'wptexturize' );
add_filter( 'eqd_the_content', 'convert_chars' );
add_filter( 'eqd_the_content', 'wpautop' );
add_filter( 'eqd_the_content', 'shortcode_unautop' );
add_filter( 'eqd_the_content', 'do_shortcode' );
add_filter( 'acf/load_field', 'load_menu_names_to_acf' );

/**
 * Populate select field with menus
 *
 * @param field fields
 */
function load_menu_names_to_acf( $field ) {
	// Ensure it targets the correct field key
	if ( $field['key'] === 'field_64f21f700a2cd' ) {
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );  // get all menus

		foreach ( $menus as $menu ) {
			$field['choices'][ $menu->term_id ] = $menu->name;
		}
	}

	return $field;
}

/**
 * Get the first term attached to post
 *
 * @param array $args Args.
 */
function eqd_first_term( $args = array() ) {

	$defaults = array(
		'taxonomy' => 'category',
		'field'    => null,
		'post_id'  => null,
	);

	$args = wp_parse_args( $args, $defaults );

	$post_id = ! empty( $args['post_id'] ) ? intval( $args['post_id'] ) : get_the_ID();
	$field   = ! empty( $args['field'] ) ? esc_attr( $args['field'] ) : false;
	$term    = false;

	if ( class_exists( 'WPSEO_Primary_Term' ) ) {
		$term = get_term( ( new WPSEO_Primary_Term( $args['taxonomy'], $post_id ) )->get_primary_term(), $args['taxonomy'] );
	}

	if ( ! $term || is_wp_error( $term ) ) {

		$terms = get_the_terms( $post_id, $args['taxonomy'] );

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return false;
		}

		if ( 1 === count( $terms ) ) {
			$term = array_shift( $terms );

		} else {

			if ( isset( $terms[0]->order ) ) {
				$list = array();
				foreach ( $terms as $term ) {
					$list[ $term->order ] = $term;
				}
				ksort( $list, SORT_NUMERIC );

			} else {
				$list = array();
				foreach ( $terms as $term ) {
					$list[ $term->count ] = $term;
				}
				ksort( $list, SORT_NUMERIC );
				$list = array_reverse( $list );
			}

			$term = array_shift( $list );
		}
	}

	if ( ! empty( $field ) && isset( $term->$field ) ) {
		return $term->$field;
	} else {
		return $term;
	}
}

/**
 * Conditional CSS Classes
 *
 * @param string $base_classes classes always applied.
 * @param string $optional_class additional class applied if $conditional is true.
 * @param bool   $conditional whether to add $optional_class or not.
 * @return string $classes
 */
function eqd_class( $base_classes, $optional_class, $conditional ) {
	return $conditional ? $base_classes . ' ' . $optional_class : $base_classes;
}

/**
 *  Background Image Style
 *
 * @param int    $image_id Image ID.
 * @param string $image_size Image Size.
 */
function eqd_bg_image_style( $image_id = false, $image_size = 'full' ) {
	if ( ! empty( $image_id ) ) {
		return ' style="background-image: url(' . wp_get_attachment_image_url( $image_id, $image_size ) . ');"';
	}
}

/**
 * Get Icon
 * This function is in charge of displaying SVG icons across the site.
 *
 * Place each <svg> source in the /assets/icons/{group}/ directory.
 *
 * All icons are assumed to have equal width and height, hence the option
 * to only specify a `$size` parameter in the svg methods. For icons with
 * custom (non-square) sizes, set 'size' => false.
 *
 * Icons will be loaded once in the footer and referenced throughout document.
 *
 * @param array $atts Shortcode Attributes.
 */
function eqd_icon( $atts = array() ) {

	$atts = shortcode_atts(
		array(
			'icon'  => false,
			'group' => 'utility',
			'size'  => 24,
			'class' => false,
			'label' => false,
			'defs'  => false,
			'force' => false,
		),
		$atts
	);

	if ( empty( $atts['icon'] ) ) {
		return;
	}

	if ( is_admin() ) {
		$atts['force'] = true;
	}

	$icon_path = get_theme_file_path( '/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg' );
	if ( 'images' === $atts['group'] ) {
		$icon_path    = get_theme_file_path( '/assets/images/' . $atts['icon'] . '.svg' );
		$atts['size'] = false;
	}
	if ( ! file_exists( $icon_path ) ) {
		return;
	}

	// Display the icon directly.
	if ( true === $atts['force'] ) {
		$icon = file_get_contents( $icon_path );
		if ( false !== $atts['size'] ) {
			$repl = sprintf( '<svg width="%d" height="%d" aria-hidden="true" role="img" focusable="false" ', $atts['size'], $atts['size'] );
			$svg  = preg_replace( '/^<svg /', $repl, trim( $icon ) ); // Add extra attributes to SVG code.
		} else {
			$svg = preg_replace( '/^<svg /', '<svg ', trim( $icon ) );
		}
		$svg = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
		$svg = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.
		if ( ! empty( $atts['class'] ) ) {
			$svg = preg_replace( '/^<svg /', '<svg class="' . $atts['class'] . '"', $svg );
		}

		// Display the icon as symbol in defs.
	} elseif ( true === $atts['defs'] ) {
		$icon = file_get_contents( $icon_path );
		$svg  = preg_replace( '/^<svg /', '<svg id="' . $atts['group'] . '-' . $atts['icon'] . '"', trim( $icon ) );
		$svg  = str_replace( '<svg', '<symbol', $svg );
		$svg  = str_replace( '</svg>', '</symbol>', $svg );
		$svg  = preg_replace( "/([\n\t]+)/", ' ', $svg ); // Remove newlines & tabs.
		$svg  = preg_replace( '/>\s*</', '><', $svg ); // Remove white space between SVG tags.

		// Display reference to icon.
	} else {

		global $eqd_icons;
		if ( empty( $eqd_icons[ $atts['group'] ] ) ) {
			$eqd_icons[ $atts['group'] ] = array();
		}
		if ( empty( $eqd_icons[ $atts['group'] ][ $atts['icon'] ] ) ) {
			$eqd_icons[ $atts['group'] ][ $atts['icon'] ] = 1;
		} else {
			++$eqd_icons[ $atts['group'] ][ $atts['icon'] ];
		}

		$attr = '';
		if ( ! empty( $atts['class'] ) ) {
			$attr .= ' class="' . esc_attr( $atts['class'] ) . '"';
		}
		if ( false !== $atts['size'] ) {
			$attr .= sprintf( ' width="%d" height="%d"', $atts['size'], $atts['size'] );
		}
		if ( ! empty( $atts['label'] ) ) {
			$attr .= ' aria-label="' . esc_attr( $atts['label'] ) . '"';
		} else {
			$attr .= ' aria-hidden="true" role="img" focusable="false"';
		}
		$svg = '<svg' . $attr . '><use href="#' . $atts['group'] . '-' . $atts['icon'] . '"></use></svg>';
	}

	return $svg;
}

/**
 * Icon as image
 *
 * @param array $atts array of attributes.
 */
function eqd_icon_as_img( $atts = array() ) {

	$atts['size']  = false;
	$atts['force'] = true;

	$icon       = eqd_icon( $atts );
	$dimensions = str_replace( '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ', '', $icon );
	$dimensions = explode( ' ', substr( $dimensions, 0, strpos( $dimensions, '">' ) ) );
	if ( 2 !== count( $dimensions ) ) {
		return;
	}

	return '<img src="' . get_stylesheet_directory_uri() . '/assets/icons/' . $atts['group'] . '/' . $atts['icon'] . '.svg" alt="' . $atts['icon'] . '" width="' . $dimensions[0] . '" height="' . $dimensions[1] . '" />';
}

/**
 * Icon Definitions
 */
function eqd_icon_definitions() {
	global $eqd_icons;

	if ( empty( $eqd_icons ) ) {
		return;
	}

	echo '<svg style="display:none;"><defs>';
	foreach ( $eqd_icons as $group => $icons ) {
		foreach ( $icons as $icon => $count ) {
			echo eqd_icon(
				array(
					'icon'  => $icon,
					'group' => $group,
					'defs'  => true,
				)
			);
		}
	}
	echo '</defs></svg>';
}
add_action( 'wp_footer', 'eqd_icon_definitions', 20 );

/**
 * Has Action
 *
 * @param string $hook Hook.
 */
function eqd_has_action( $hook ) {
	ob_start();
	do_action( $hook );
	$output = ob_get_clean();
	return ! empty( $output );
}

/**
 * Button
 *
 * @param array $field ACF Field data.
 * @param array $atts Button attributes.
 */
function eqd_button( $field = array(), $atts = array() ) {

	if ( empty( $field ) ) {
		return;
	}

	$block       = array( 'blockName' => 'core/button' );
	$target      = ! empty( $field['target'] ) ? ' target="' . $field['target'] . '"' : '';
	$block_class = array( 'wp-block-button' );

	if ( false !== strpos( $target, '_blank' ) ) {
		$target .= ' rel="noopener noreferrer"';
	}

	if ( ! empty( $atts['style'] ) ) {
		$block_class[]               = 'is-style-' . $atts['style'];
		$block['attrs']['className'] = 'is-style-' . $atts['style'];
	}

	$button_class = array( 'wp-block-button__link' );
	if ( ! empty( $atts['bg'] ) ) {
		$button_class[] = 'has-background';
		$button_class[] = 'has-' . $atts['bg'] . '-background-color';
	}

	$output = '<div class="' . join( ' ', $block_class ) . '"><a class="' . join( ' ', $button_class ) . '" href="' . esc_html( $field['url'] ) . '"' . $target . '>' . esc_html( $field['title'] ) . '</a></div>';
	return apply_filters( 'eqd_button', $output, $block );
}

/**
 * Add the target attribute for links
 *
 * @param string
 * @return void
 */
function slp_a_target( $value ) {
	if ( ! $value ) {
		return;
	}

	return ' target="' . $value . '"';
}

/**
 * Appends a superscript at the end of each line in the provided HTML content.
 *
 * @param string $content          The original HTML content.
 * @param string $superscript_text The text to be added as superscript.
 *
 * @return string Updated content with superscripts appended.
 */
function slp_append_superscript( $content, $superscript_text ) {
	// Convert the superscript text to actual HTML tag.
	$superscript = '<sup>' . $superscript_text . '</sup>';

	// Use regex to match <br> tags with potential white spaces and replace them with the superscript
	$updated_content = preg_replace( '/\s*<br\s*\/?\s*>\s*/', $superscript . '<br>', $content );

	// Additionally, add superscript to the end of the paragraph if needed.
	$updated_content = str_replace( '</p>', $superscript . '</p>', $updated_content );

	return $updated_content;
}



function get_company_name_shortcode( $atts ) {
	$fallback = shortcode_atts(
		array(
			'fallback' => 'eee',
		),
		$atts
	);


	// Default message
	$message = esc_attr( $fallback['fallback'] );

	if ( isset( $_GET['landing_page'] ) ) {
		$page_slug = sanitize_text_field( $_GET['landing_page'] );

		// Query the CPT for the company name using the 'page_slug'
		$args  = array(
			'post_type'   => 'slp_landing',
			'post_status' => 'publish',
			'numberposts' => 1,
			'meta_query'  => array(
				array(
					'key'     => 'landing_page_url_text',
					'value'   => $page_slug,
					'compare' => '=',
				),
			),
		);
		$query = new WP_Query( $args );

		// If a post is found, retrieve the Company Name
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				// Assuming the company name is stored in a custom field. Replace 'company_name' with your actual custom field key
				$company_name = get_post_meta( get_the_ID(), 'company_name', true );
				if ( ! empty( $company_name ) ) {
					$message = $company_name; // Set the message to the company name
				}
			}
			wp_reset_postdata(); // Reset post data
		}
	}

	// Return the company name or default message
	return $message;
}

add_shortcode( 'get_company_name', 'get_company_name_shortcode' );


function generate_custom_booking_button_shortcode( $atts ) {
	// Default URL for the booking button
	$default_url = 'https://calendly.com/studentloanplanner-team';
	$button_url  = $default_url; // Set the button URL to default initially

	// Check if the 'landing_page' URL parameter is present
	if ( isset( $_GET['landing_page'] ) ) {
		$page_slug = sanitize_text_field( $_GET['landing_page'] );

		// Query the CPT for the booking link using the 'page_slug'
		$args  = array(
			'post_type'   => 'slp_landing',
			'post_status' => 'publish',
			'numberposts' => 1,
			'meta_query'  => array(
				array(
					'key'     => 'landing_page_url_text',
					'value'   => $page_slug,
					'compare' => '=',
				),
			),
		);
		$query = new WP_Query( $args );

		// If a post is found, retrieve the Booking Link
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				// Assuming the booking link is stored in a custom field. Replace 'booking_link' with your actual custom field key
				$booking_link = get_post_meta( get_the_ID(), 'booking_link', true );
				if ( ! empty( $booking_link ) ) {
					$button_url = $booking_link; // Update the button URL to the custom link
				}
			}
			wp_reset_postdata(); // Reset post data
		}
	}

	// Generate the HTML for the button
	$button_html = '<div class="wp-block-buttons"><div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="' . esc_url( $button_url ) . '">Book Your Custom Plan</a></div>';


	// Return the button HTML
	return $button_html;
}
add_shortcode( 'custom_booking_button', 'generate_custom_booking_button_shortcode' );

function eqd_logo_setup() {
    $defaults = array(
        'height'      => 70, // Set the desired height for the logo
        'width'       => 240, // Set the desired width for the logo
        'flex-height' => true, // Allow flexible height
        'flex-width'  => true, // Allow flexible width
        'header-text' => array( 'site-title', 'site-description' ), // Selectively hide or show site title and tagline
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'eqd_logo_setup' );
