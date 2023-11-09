<?php
/**
 * Table-of-contents Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'table-of-contents-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block table-of-contents-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_copy = get_field( 'copy' );

if ( get_field( 'post_format_style',get_the_ID() ) == 'full-width' ) {
	$class_name .= ' post_format_style-full-width';
} else {
	$class_name .= ' post_format_style-standard';
}
$header_main_link = get_field( 'header_main_link', 'option' );
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="table-of-contents-block-container">
		<div class="table-of-contents-block-container-main">
			<div class="toc_container">
				<?php echo wp_kses_post( $acf_copy ); ?>
				<InnerBlocks />
			</div>
			<div class="toc-nav-container">
				<div class="toc-nav-sticky">
					<div class="toc-nav_title">Table of Contents</div>
					<nav  aria-label="Table of Contents Navigation" class="toc-nav"></nav>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="contents-nav-mobile">
	<div class="contents-nav-mobile-header">
		<button class="contents-nav-mobile-header-dropdown-select">
			<span class="dropdown">
			<div class="open">
				<svg width="27" height="16" viewBox="0 0 27 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M6 1L26 1" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M1 1L3 1" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M6 8L26 8" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M1 8L3 8" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M6 15L26 15" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M1 15L3 15" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</div>
			<span class="close">
				<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1.72168 1.01477L17.9851 17.2782" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				<path d="M1.72168 17.9854L17.9851 1.7219" stroke="#2D2D2D" stroke-width="2" stroke-linecap="round"/>
				</svg>
			</span>
			</span>
			<span class="text">Jump to</span>
		</button>
		<div class="cta-btn">
			<?php if ( ! empty( $header_main_link ) ) : ?>
				<a href="<?php echo ! empty( $header_main_link ) ? $header_main_link['url'] : ''; ?>" <?php echo ! empty( $header_main_link['target'] ) ? 'target="' . $header_main_link['target'] . '"' : ''; ?> class="btn">
					<?php echo ! empty( $header_main_link ) ? $header_main_link['title'] : 'Get Help'; ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="contents-nav-mobile-menu"></div>
</div>
