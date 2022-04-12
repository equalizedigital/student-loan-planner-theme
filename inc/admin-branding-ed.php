<?php

/**
 *
 * @author       Equalize Digital
 * @subpackage   Customizations
 * @link         http://equalizedigital.com
 */

//* Modify the admin footer text
add_filter('admin_footer_text', 'roadwarriorwp_modify_footer_admin');
function roadwarriorwp_modify_footer_admin () {

  echo '<span id="footer-thankyou">Theme Development by <a href="https://equalizedigital.com" target="_blank">Equalize Digital</a></span>';

}

//* Change the login logo
add_action('login_head', 'custom_loginlogo');
function custom_loginlogo() {
	//$custom_logo_id = get_theme_mod( 'custom_logo' );
	//$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	$image = get_bloginfo('stylesheet_directory').'/assets/images/logo.svg';
	echo '<style type="text/css">
		.login h1 a {
			background-image: url('.$image.') !important; 
			background-size: contain;
	    	width: 100%;
	    	height: 67px;
		}
	</style>';
}

//* Chance login logo URL & name
add_filter( 'login_headerurl', 'my_login_logo_url' );
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headertext', 'my_login_logo_url_title' );
function my_login_logo_url_title() {
    return get_bloginfo('name');
}


//* Add dashboard widget
add_action( 'wp_dashboard_setup', 'roadwarriorwp_add_dashboard_widgets' );
function roadwarriorwp_add_dashboard_widgets() {

    add_meta_box( 'rwc_dashboard_widget', 'Welcome to the '.get_bloginfo('name').' Website', 'roadwarriorwp_dashboard_widget_function', 'dashboard', 'side', 'high' );
    add_meta_box( 'rwc_dashboard_rss', 'Equalize Digital News', 'roadwarriorwp_dashboard_rss', 'dashboard', 'side', 'high' );

}

function roadwarriorwp_dashboard_widget_function() {

	echo '<style> .roadwarriorwp-widget strong { 
					display: inline-block; 
					min-width: 100px; 
					margin-left: 5px; 
				} 
				.roadwarriorwp-widget li { 
					margin-bottom: 10px; 
				} 
				.fa {
					font-size: 18px;
    				padding: 10px;
    				border-radius: 50%;
				    background: #0d5f9d;
				    width: 20px;
				    text-align: center;
				    color: #fff;
				}
				.fa:hover {
					color: #f3cd1e;
					background: #062446;
				}
		</style>
		<script src="https://use.fontawesome.com/accb49702d.js"></script>';
	echo '<div class="roadwarriorwp-widget">';
	echo '<p>This website was designed with great care by Equalize Digital. 
		If you have any questions at all while working with it, please don&#39;t hesitate to ask! We are happy to help.</p>'; 
	echo '<p>Enjoy!<br/>
		Amber & Chris Hinds<br/>
		and the Equalize Digital team</p>';
	echo '<a href="https://equalizedigital.com" target="_blank"><img src="https://equalizedigital.com/wp-content/uploads/2021/01/ED-Brand-FullColor-F_TM-V2.png" width="250"></a>';
	echo '<h2>HOW TO GET HELP</h2>';
	echo '<ul>';
	echo '<li><span class="dashicons dashicons-admin-site"></span><strong>Website</strong> <a href="https://equalizedigital.com" target="_blank">equalizedigital.com</a></li>';
	echo '<li><span class="dashicons dashicons-email"></span><strong>Email</strong> <a href="mailto:support@equalizedigital.com?body='.get_bloginfo('url').'" target="_blank">support@equalizedigital.com</a></li>';
	echo '<li><span class="dashicons dashicons-phone"></span><strong>Phone</strong> <a href="tel:5129425858" target="_blank">512-942-5858</a></li>';
	//echo '<li><span class="dashicons dashicons-editor-help"></span><strong><a href="https://equalizedigital.com/contact/customer-support/#faq" target="_blank">Support FAQ & Hours</a></strong></li>';
	echo'</ul>';
	echo '<h3>FOLLOW US</h3>';
	echo '<a href="https://www.facebook.com/groups/wordpress.accessibility" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
		<a href="https://www.linkedin.com/company/equalizedigital" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
		<a href="https://twitter.com/equalizedigital" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

	echo '</div>';

}

function roadwarriorwp_dashboard_rss() {
	echo '<div class="roadwarriorwp-widget">';

	$rss = fetch_feed( "https://equalizedigital.com/feed/" );

    if ( is_wp_error($rss) ) {
      	if ( is_admin() || current_user_can( 'manage_options' ) ) {
           echo '<p>';
           printf( __( '<strong>RSS Error</strong>: %s' ), $rss->get_error_message() );
           echo '</p>';
      	}
     	return;
	}

	if ( !$rss->get_item_quantity() ) {
	     echo '<p>Apparently, there are no updates to show!</p>';
	     $rss->__destruct();
	     unset($rss);
	     return;
	}

	echo "<ul>\n";

	if ( !isset($items) )
	     $items = 5;

	     foreach ( $rss->get_items( 0, $items ) as $item ) {
	          $publisher = '';
	          $site_link = '';
	          $link = '';
	          $content = '';
	          $date = '';
	          $link = esc_url( strip_tags( $item->get_link() ) );
	          $title = esc_html( $item->get_title() );
	          $content = $item->get_content();
	          $content = wp_html_excerpt( $content, 200 ) . ' ...<a target="_blank" href="' . $link . '">Keep Reading</a>';

	         echo "<li><a class='rsswidget' href='$link' target='_blank'>$title</a>\n<div class='rssSummary'>$content</div>\n";
	}

	echo "</ul>\n";
	$rss->__destruct();
	unset($rss);

	echo '</div>';
}