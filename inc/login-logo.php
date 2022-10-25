<?php
/**
 * Login Logo
 *
 * @package      Mainspring
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Login Logo URL
 *
 * @param string $url URL.
 */
function mst_login_header_url( $url ) {
	return esc_url( home_url() );
}
add_filter( 'login_headerurl', 'mst_login_header_url' );
add_filter( 'login_headertext', '__return_empty_string' );

/**
 * Login Logo
 */
function mst_login_logo() {

	$logo_path   = '/assets/images/logo.svg';
	$logo_width  = 212;
	$logo_height = 40;

	if ( ! file_exists( get_stylesheet_directory() . $logo_path ) ) {
		return;
	}

	$logo   = get_stylesheet_directory_uri() . $logo_path;
	$height = floor( $logo_height / $logo_width * 312 );
	?>
		<style type="text/css">
		.login h1 a {
			background-image: url(<?php echo esc_url( $logo ); ?>);
			background-size: contain;
			background-repeat: no-repeat;
			background-position: center center;
			display: block;
			overflow: hidden;
			text-indent: -9999em;
			width: 312px;
			height: <?php echo esc_attr( $height ); ?>px;
		}
		</style>
		<?php
}
add_action( 'login_head', 'mst_login_logo' );
