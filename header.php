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
                <?php $logo_tag = ( apply_filters( 'eqd_h1_site_title', false ) ) ? 'h1' : 'p'; ?>
                <<?php echo esc_attr( $logo_tag ); ?> class="site-title">
                <a href="<?php echo esc_url( home_url() ); ?>" rel="home">
                    <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
                </a>
                </<?php esc_attr( $logo_tag ); ?>>
            </div>

            <div id="main-navigation">
                <?php get_template_part( 'partials/content/header/mobile-navigation' ); ?>
                <?php get_template_part( 'partials/content/header/desktop-navigation' ); ?>
            </div>
        </div>
    </header>

    <?php tha_header_after(); ?>

    <div class="site-inner" id="main-content">
