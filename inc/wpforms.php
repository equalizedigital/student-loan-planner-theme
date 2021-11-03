<?php
/**
 * WPForms
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * WPForms submit button, match Gutenberg button block
 *
 * @param array $form_data Form data.
 */
function mst_wpforms_match_button_block( $form_data ) {
	$form_data['settings']['submit_class'] .= ' wp-block-button__link';
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'mst_wpforms_match_button_block' );

/**
 * WPForms theme locations
 */
function mst_wpforms_theme_locations() {
	return [];
}

/**
 * WPForms theme locations, class
 *
 * @param array $form_data Form data.
 */
function mst_wpforms_theme_locations_class( $form_data ) {
	$locations = mst_wpforms_theme_locations();
	if ( empty( $locations ) ) {
		return $form_data;
	}

	foreach ( $locations as $location ) {
		$form_id = get_option( 'options_mst_' . $location . '_form' );
		if ( ! empty( $form_id ) && $form_id == $form_data['id'] ) {
			$form_data['settings']['form_class'] .= ' wpforms-location-' . $location;
		}
	}
	return $form_data;
}
add_filter( 'wpforms_frontend_form_data', 'mst_wpforms_theme_locations_class' );

/**
 * WPForms admin column
 *
 * @param array $columns Admin columns.
 */
function mst_wpforms_theme_locations_column( $columns ) {

	$locations = mst_wpforms_theme_locations();
	if ( empty( $locations ) ) {
		return $columns;
	}

	$new_columns = [];
	foreach ( $columns as $key => $value ) {
		$new_columns[ $key ] = $value;
		if ( 'form_name' === $key ) {
			$new_columns['mst_theme_location'] = __( 'Theme Location', 'cultivate_textdomain' );
		}
	}
	return $new_columns;
}
add_filter( 'wpforms_overview_table_columns', 'mst_wpforms_theme_locations_column' );

/**
 * WPForms admin column value
 *
 * @param string $value Value.
 * @param array  $form Form.
 * @param string $column_name Column Name.
 */
function mst_wpforms_theme_locations_column_value( $value, $form, $column_name ) {
	if ( 'mst_theme_location' !== $column_name ) {
		return $value;
	}

	$current   = [];
	$locations = mst_wpforms_theme_locations();
	foreach ( $locations as $location ) {
		$form_id = get_option( 'options_mst_' . $location . '_form' );
		if ( ! empty( $form_id ) && $form->ID == $form_id ) {
			$current[] = $location;
		}
	}

	if ( ! empty( $current ) ) {
		$value = ucwords( str_replace( '_', ' ', join( ', ', $current ) ) );
	}

	return $value;
}
add_filter( 'wpforms_overview_table_column_value', 'mst_wpforms_theme_locations_column_value', 10, 3 );


/**
 * Honeypot Class
 * Add this class to the form field you want to use as a honeypot
 *
 * @link http://www.billerickson.net/eliminate-spam-with-a-custom-honeypot/
 */
function mst_honeypot_class() {
	return 'impound';
}

/**
 * WPForms Custom Honeypot
 *
 * @author Road Warrior Creative
 * @link http://www.billerickson.net/eliminate-spam-with-a-custom-honeypot/
 *
 * @param string $honeypot empty if not spam, honeypot text is used in WPForms Log.
 * @param array  $fields Fields.
 * @param array  $entry Entry.
 * @param array  $form_data Form Data.
 */
function mst_wpforms_custom_honeypot( $honeypot, $fields, $entry, $form_data ) {

	$honey_field = false;
	foreach ( $form_data['fields'] as $form_field ) {
		if ( false !== strpos( $form_field['css'], mst_honeypot_class() ) ) {
			$honey_field = absint( $form_field['id'] );
		}
	}

	if ( ! empty( $honey_field ) && ! empty( $entry['fields'][ $honey_field ] ) ) {
		$honeypot = 'Custom honeypot';
	}

	return $honeypot;
}
add_filter( 'wpforms_process_honeypot', 'mst_wpforms_custom_honeypot', 10, 4 );

/**
 * Remove honeypot label from frontend
 *
 * @param array $field Field.
 * @param array $form_data Form Data.
 */
function mst_remove_honeypot_label( $field, $form_data ) {
	if ( ! empty( $field['css'] ) ) {
		$classes = explode( ' ', $field['css'] );
		if ( in_array( mst_honeypot_class(), $classes, true ) ) {
			$field['label'] = str_replace( [ ' (Honeypot)', ' - Honeypot', 'Honeypot' ], '', $field['label'] );
		}
	}
	return $field;
}
add_filter( 'wpforms_field_data', 'mst_remove_honeypot_label', 10, 2 );

/**
 * User activation email
 * See new_user_notification() in wpforms-user-activation
 *
 * @param array $email Email.
 */
function mst_user_activation_email( $email ) {

	// Remove blog name from subject.
	$email['subject'] = esc_html__( 'Your username and password info' );

	/* translators: %s - user username. */
	$message  = sprintf( esc_html__( 'Username: %s' ), $email['user']->user_login ) . "\r\n";
	$message .= esc_html__( 'Password: [the unique password you created]' ) . "\r\n\r\n";

	// Additional details if user activation is enabled.
	if ( $email['activation'] ) {

		$email['subject'] .= ' ' . esc_html__( '(Activation Required)', 'wpforms-user-registration' );

		if ( 'user' === $email['activation'] ) {

			// Create activation link.
			$args     = 'user_id=' . $email['user']->ID . '&user_email=' . $email['user']->user_email . '&hash=' . wp_hash( $email['user']->ID . ',' . $email['user']->user_email );
			$link     = esc_url( add_query_arg( array( 'wpforms_activate' => base64_encode( $args ) ), home_url() ) );
			$message .= esc_html__( 'IMPORTANT: You must activate your account before you can login. Please visit the link below.', 'wpforms-user-registration' ) . "\r\n";
			$message .= $link;
			$message .= ' If you have issues activating your account, try copying the full link above and pasting it into your browser\'s address bar.';
		} else {
			$message .= esc_html__( 'Site administrator must activate your account before you can login.', 'wpforms-user-registration' ) . "\r\n";
		}
	} else {
		$message .= wp_login_url() . "\r\n\r\n";
	}
	$email['message'] = $message;

	return $email;
}
add_filter( 'wpforms_user_registration_email_user', 'mst_user_activation_email' );
