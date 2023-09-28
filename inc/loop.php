<?php
/**
 * Loop
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Default Loop
 */
function eqd_default_loop() {

	if ( have_posts() ) :

		tha_content_while_before();

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			tha_entry_before();

			$partial = apply_filters( 'eqd_loop_partial', is_singular() ? 'content' : 'post-summary' );
			$context = apply_filters( 'eqd_loop_partial_context', is_singular() ? 'content' : 'primary' );
			get_template_part( 'partials/' . $partial . '/' . $context );

			tha_entry_after();
		endwhile;

		tha_content_while_after();

	else :

		tha_entry_before();
		$context = apply_filters( 'eqd_empty_loop_partial_context', 'no-content' );
		get_template_part( 'partials/content/' . $context );
		tha_entry_after();

	endif;
}
add_action( 'tha_content_loop', 'eqd_default_loop' );

/**
 * Archive post listing open
 */
function eqd_archive_post_listing_open() {
	if ( apply_filters( 'eqd_archive_post_listing', is_home() || is_archive() || is_search() ) ) {
		echo '<div class="archive-post-listing">';
	}
}
add_action( 'tha_content_while_before', 'eqd_archive_post_listing_open', 80 );

/**
 * Archive post listing close
 */
function eqd_archive_post_listing_close() {
	if ( apply_filters( 'eqd_archive_post_listing', is_home() || is_archive() || is_search() ) ) {
		echo '</div>'; // .archive-post-listing
	}
}
add_action( 'tha_content_while_after', 'eqd_archive_post_listing_close', 5 );

/**
 * Entry Title
 */
function eqd_entry_header() {
	if ( eqd_has_h1_block() || is_front_page() ) {
		add_filter( 'render_block', 'eqd_entry_header_in_content', 10, 2 );

	} else {
		do_action( 'eqd_entry_title_before' );
		echo '<h1 class="entry-title">' . esc_html( get_the_title() ) . '</h1>';
		do_action( 'eqd_entry_title_after' );
	}
}
add_action( 'tha_entry_top', 'eqd_entry_header' );

/**
 * Single Title
 */
function eqd_single_header() {
	if( is_single()  ) {
		// Load values and assing defaults.
		$page_id = get_the_ID();

		$subtitle                = get_field( 'subtitle', $page_id );
		$background_image        = get_field( 'background_image', $page_id );
		$title_max_width_desktop = get_field( 'title_max_width_desktop', $page_id );
		$link                    = get_field( 'link' );
		$container_class         = '';
		if ( get_field( 'post_format_style' ) == 'full-width' ) {
			$container_class .= 'hero_relative';
		}
		?>
		<header class="inner-hero <?php echo wp_kses_post( $container_class ); ?>">
			<div class="inner-hero-container">
				<?php
				// Breadcrumbs
				if ( get_field( 'post_format_style' ) != 'full-width' ) {
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<span id="breadcrumbs_top">', '</span>' );
					}
				}
				?>

				<?php
				// Title
				?>
				<h1 class="title" style="max-width:<?php echo wp_kses_post( ! empty( $title_max_width_desktop ) ? $title_max_width_desktop . '%' : 'none' ); ?>;">
					<?php echo wp_kses_post( get_the_title() ); ?>
				</h1>

				<?php
				// post author data
				if ( get_field( 'post_format_style' ) == 'full-width' ) {
					if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
						$output .= 'Updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
					}
					$id = get_the_author_meta( 'ID' );
					?>
					<span class="entry-author">
						<a href="<?php echo esc_url( get_author_posts_url( $id ) ); ?>" aria-hidden="true" tabindex="-1">
							<?php echo get_avatar( $id, 40 ); ?>
						</a>
						<span class="entry-info">
							<span>
								Written By <a href="<?php echo wp_kses_post( esc_url( get_author_posts_url( $id ) ) ); ?>">
								<?php echo get_the_author(); ?></a>
							</span>
							<span class="entry-data"><?php echo wp_kses_post( $output ); ?></span>
						</span>
					</span>
					<?php
				}
				?>

				<?php
				// optional subtitle
				?>
				<span class="subtitle">
					<?php echo wp_kses_post( $subtitle ); ?>
				</span>

				<?php // optional link ?>
				<?php if ( ! empty( $link ) ) : ?>
					<span class="link">
						<a href="<?php echo $link['url'] ? $link['url'] : ''; ?>" class="btn">
							<?php echo $link['title'] ? $link['title'] : ''; ?>
						</a>
					</span>
				<?php endif; ?>

			</div>
			
			<?php
			// Background image.
			if ( get_field( 'post_format_style' ) == 'full-width' ) :
				?>
				<span class="hero_image">
					<?php if ( ! empty( $background_image['ID'] ) ) : ?>
						<?php echo wp_get_attachment_image( $background_image['ID'], 'full' ); ?>
					<?php endif; ?>

					<?php
					$featured_image = get_the_post_thumbnail_url( get_the_ID() );
					if ( $featured_image ) {
						?>
						<?php echo '<img src="' . esc_url( $featured_image ) . '" />'; ?>
					<?php } ?>
				</span>
			<?php endif; ?>
		</header>

		<?php if ( get_field( 'post_format_style' ) === 'full-width' ) : ?>
			<section class="header_editorial_statement">
				<div class="header_editorial_statement-container">
					<div class="header_editorial_statement-container__title">
						<h2>
						Editorial Ethics at Student Loan Planner
						</h2>
					</div>
					<div class="header_editorial_statement-container__copy">
						<p>
						At Student Loan Planner, we follow a strict <a href="https://studentloanstg.wpengine.com/editorial-ethics-policy/">editorial ethics policy</a>. This post may contain references to products from our partners within the guidelines of this policy. Read our <button class="modal-btn btn-style-link" data-modal="modal_disclosure" aria-label="Open Disclosure Modal">advertising disclosure</button> to learn more.
						</p>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php
	}
}
add_action( 'tha_single_header', 'eqd_single_header' );


/**
 * Entry header in content
 *
 * @param string $output Outout.
 * @param array  $block Block.
 */
function eqd_entry_header_in_content( $output, $block ) {
	if ( 'core/heading' === $block['blockName'] && ! empty( $block['attrs'] ) && 1 === $block['attrs']['level'] ) {
		ob_start();
		do_action( 'eqd_entry_title_before' );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
		echo $output;
		do_action( 'eqd_entry_title_after' );
		$output = ob_get_clean();
		remove_filter( 'render_block', 'eqd_entry_header_in_content', 10, 2 );
	}

	return $output;
}

/**
 * Recursively searches content for h1 blocks.
 *
 * @link https://www.billerickson.net/building-a-header-block-in-wordpress/
 *
 * @param array $blocks Blocks.
 */
function eqd_has_h1_block( $blocks = array() ) {

	if ( is_singular() && empty( $blocks ) ) {
		global $post;
		$blocks = parse_blocks( $post->post_content );
	}

	foreach ( $blocks as $block ) {

		if ( ! isset( $block['blockName'] ) ) {
			continue;
		}

		// Custom header block.
		if ( 'acf/header' === $block['blockName'] ) {
			return true;

			// Heading block.
		} elseif ( 'core/heading' === $block['blockName'] && isset( $block['attrs']['level'] ) && 1 === $block['attrs']['level'] ) {
			return true;

			// Scan inner blocks for headings.
		} elseif ( isset( $block['innerBlocks'] ) && ! empty( $block['innerBlocks'] ) ) {
			$inner_h1 = eqd_has_h1_block( $block['innerBlocks'] );
			if ( $inner_h1 ) {
				return true;
			}
		}
	}

	return false;
}
