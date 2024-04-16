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
	if ( is_single() ) {
		// Load values and assing defaults.
		$page_id    = get_the_ID();
		$title_copy = get_field( 'title_copy', $page_id );

		$subtitle                = get_field( 'subtitle', $page_id );
		$background_image        = get_field( 'background_image', $page_id );
		$title_max_width_desktop = get_field( 'title_max_width_desktop', $page_id );
		$link                    = get_field( 'single_post_link', $page_id );
		$output                  = null;
		$container_class         = '';
		$title_override          = get_field( 'title_override', $page_id );


		if ( get_field( 'post_format_style' ) === 'full-width' ) {
			$container_class .= 'hero_relative';
		} else {
			$container_class .= 'inner-hero-alternate-style';
		}
		?>
		<header class="inner-hero <?php echo wp_kses_post( $container_class ); ?>">
			<div class="inner-hero-container">
				<?php
				// Breadcrumbs
				if ( get_field( 'post_format_style' ) !== 'full-width' ) {
					if ( function_exists( 'yoast_breadcrumb' ) ) {
						yoast_breadcrumb( '<span id="breadcrumbs_top">', '</span>' );
					}
				}
				?>

				<?php
				// Title
				?>
				<h1 class="title" style="<?php echo wp_kses_post( ! empty( $title_max_width_desktop ) ? 'max-width:' . $title_max_width_desktop . '%;' : '' ); ?>">
					<?php
					if ( $title_override ) {
						echo wp_kses_post( $title_override );
					} else {
						echo wp_kses_post( get_the_title() );
					}
					?>
				</h1>

				<?php
				if ( ! is_singular( 'slp_profession' ) ) {
					// post author data
					if ( get_field( 'post_format_style' ) === 'full-width' ) {
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
				}
				?>

				<?php
				// optional subtitle
				if ( ! is_singular( 'slp_profession' ) ) {
					?>
				<span class="subtitle">
					<?php echo wp_kses_post( $subtitle ); ?>
				</span>

					<?php
				}
				// optional link
				?>
				<?php
				if ( ! is_singular( 'slp_profession' ) ) {
					if ( ! empty( $link ) ) :
						?>
					<span class="link">
						<a href="<?php echo $link['url'] ? $link['url'] : ''; ?>" class="btn">
							<?php echo $link['title'] ? $link['title'] : ''; ?>
						</a>
					</span>
						<?php
				endif;
				}
				?>

			</div>

			<?php
			// Background image.
			if ( get_field( 'post_format_style' ) === 'full-width' ) :
				?>
				<span class="hero_image" style="position:absolute;left:0;top:0;">
					<?php if ( ! empty( $background_image['ID'] ) ) : ?>
						<?php echo wp_get_attachment_image( $background_image['ID'], 'full' ); ?>
					<?php endif; ?>

					<?php
					$featured_image = get_the_post_thumbnail_url( get_the_ID() );
					if ( $featured_image ) {
						?>
						<?php echo '<img loading="lazy" src="' . esc_url( $featured_image ) . '" />'; ?>
					<?php } ?>
				</span>
			<?php endif; ?>


		</header>

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



/**
 * Landing Page Single Post
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_landing_page() {
	// Check if 'slug' is set in the URL parameters
	if ( isset( $_GET['landing_page'] ) ) {
		$page_slug = $_GET['landing_page'];

		// Query for the page by slug
		$args = array(
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
		$page = get_posts( $args );

		// If the page exists, redirect or load the page
		if ( $page ) {
			$page_id = $page[0]->ID;

			$parameter_page = $page_id;
		}
	}

	if ( isset( $parameter_page ) ) {
		$image_type = get_field( 'type_of_image', $parameter_page );
		?>
		<section class="ed_landing_hero">
			<div class="ed_landing_hero_container">
				<figure class="ed_landing_hero_container_figure <?php echo wp_kses_post( 'image_type_' . $image_type ); ?>">
					<?php
					// Get the medium-sized featured image URL
					$featured_img_url = get_the_post_thumbnail_url( $parameter_page, 'medium' );

					// Output the image HTML if available
					if ( $featured_img_url ) {
						echo '<img src="' . esc_url( $featured_img_url ) . '" alt="Featured Image" />';
					} else {
						echo 'No featured image available.';
					}

					?>
				</figure>
				<div class="ed_landing_hero_container_text">
					<h2 class="ed_landing_hero_container_text_heading">
						<div class="sub_title">Trusted by</div>
						<?php the_field( 'trusted_by_name', $parameter_page ); ?>
					</h2>
					<div class="copy">
						<?php
						$job_title = get_field( 'job_title', $parameter_page );
						the_field( 'job_title', $parameter_page );

						$company_name = get_field( 'company_name', $parameter_page );
						if ( $company_name && $job_title ) {
							echo ', ';
						}
						echo get_field( 'company_name', $parameter_page );
						?>
					</div>
					<?php
					$link_page = get_field( 'booking_link', $parameter_page );
					if ( $link_page ) :
						?>
					<div class="link">
						<a href="<?php the_field( 'booking_link', $parameter_page ); ?>" class="btn">
							Book Your Custom Student Loan Plan
						</a>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
	<?php } ?>


	<?php if ( ! empty( $parameter_page ) ) : ?>
		<section class="ed_landing_works
		<?php
		if ( empty( $parameter_page ) ) {
			echo 'ed_landing_works_empty'; } else {
			}
			?>
			">
			<div class="ed_landing_works_container">
				<div class="ed_landing_works_container_content">
					<h2 class="heading">
					<?php
					if ( empty( $parameter_page ) ) {
						the_field( 'heading' );
					} else {
						the_field( 'heading', $parameter_page );
					}
					?>

					</h2>

					<?php
					if ( empty( $parameter_page ) ) {
						the_field( 'how_does_the_consult_work' );
					} else {
						the_field( 'how_does_the_consult_work', $parameter_page );
					}
					?>
				</div>


				<?php
				if ( empty( $parameter_page ) ) {
					if ( get_field( 'how_does_the_consult_work_youtube_id' ) ) :
						?>
							<div class="ed_landing_works_container_media">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field( 'how_does_the_consult_work_youtube_id' ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
							</div>
							<?php
							endif;

				} elseif ( get_field( 'how_does_the_consult_work_youtube_id', $parameter_page ) ) {
					?>
							<div class="ed_landing_works_container_media">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php the_field( 'how_does_the_consult_work_youtube_id', $parameter_page ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
							</div>
								<?php

				}
				?>
			</div>
		</section>
	<?php endif; ?>

	<?php
}

add_action( 'tha_content_top', 'eqd_single_landing_page', 10 );
