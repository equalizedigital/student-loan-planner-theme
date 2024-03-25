<?php

/**
 * Site Header
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
?>

<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes(); ?>>

<head>
	<?php
	tha_head_top();
	wp_head();
	tha_head_bottom();
	?>
</head>

<?php
$featured_press_classes = is_post_type_archive( 'eqd-featured-press' ) ? 'press-archive-page' : '';
$body_classes = implode( ' ', get_body_class() );

if ( is_post_type_archive( 'eqd-featured-press' ) ) {
	$body_classes .= ' press-archive-page';
}
?>

<body class="<?php echo esc_attr( $body_classes ); ?>" id="top">
<?php
wp_body_open();
tha_body_top();
?>

<div class="site-container">
    <a class="skip-link screen-reader-text" href="#main-content">
		<?php echo esc_html__( 'Skip to content', 'eqd' ); ?>
    </a>

	<?php tha_header_before(); ?>

    <header class="site-header" role="banner">
        <div class="wrap">

			<?php tha_header_top(); ?>

            <div class="title-area">
				<?php $logo_tag = ( apply_filters( 'eqd_h1_site_title',
						false ) || ( is_front_page() || is_home() ) ) ? 'h1' : 'p'; ?>
                <<?php echo esc_attr( $logo_tag ); ?> class="site-title">

				<?php 
				$site_logo = get_field('site_logo','option'); 
				$site_logo_style = '';

				if( $site_logo ) {
					$image_url = $site_logo;
					
					$site_logo_style = 'style="background-image:url(\'' . esc_url($image_url) . '\');"';
				}
				?>
                <a href="<?php echo esc_url( home_url() ); ?>" rel="home" <?php  echo wp_kses_post($site_logo_style); ?> >
					<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </a>

            </<?php esc_attr( $logo_tag ); ?>>
        </div>

		<?php 
		$template_slug = get_page_template_slug( get_the_ID() );
		if ( 'page-landing.php' != $template_slug ) {
		?>
        <div id="main-navigation">
			<?php get_template_part( 'partials/content/header/mobile-navigation' ); ?>
			<?php get_template_part( 'partials/content/header/desktop-navigation' ); ?>
        </div>
		<?php } else { 
					// Check if 'slug' is set in the URL parameters
		if (isset($_GET['landing_page'])) {
			$page_slug = $_GET['landing_page'];
	
			// Query for the page by slug
			$args = array(
				'post_type'   => 'slp_landing',
				'post_status' => 'publish',
				'numberposts' => 1,
				'meta_query'     => array(
					array(
						'key'   => 'landing_page_url_text', 
						'value' => $page_slug, 
						'compare' => '=', 
					),
				),
			);
			$page = get_posts($args);
	
			// If the page exists, redirect or load the page
			if ($page) {
				$page_id = $page[0]->ID;
	
				$parameter_page = $page_id;
			}
		}

			?>

			<?php
					$link_page = get_field('booking_link', $parameter_page);
					if($link_page):
					?>

		<section class="landing-page-navigation">
			<a href="<?php the_field('booking_link', $parameter_page); ?>" class="btn">Get Help</a>
		</section>
		<?php endif; ?>

<div class="site-container">
    <a class="skip-link screen-reader-text" href="#main-content">
		<?php echo esc_html__( 'Skip to content', 'eqd' ); ?>
    </a>

		<?php } ?>
</div>
</header>

<?php tha_header_after(); ?>

<div class="site-inner" id="main-content">
