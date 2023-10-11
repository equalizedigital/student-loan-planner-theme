<?php
/**
 * Template Tags
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Entry Category
 */
function eqd_entry_category() {
	$term = eqd_first_term();
	if ( empty( $term ) || is_wp_error( $term ) ) {
		return;
	}

	echo '<p class="entry-category">' . esc_html( $term->name ) . '</p>';
}

/**
 * Post Summary Title
 */
function eqd_post_summary_title() {
	global $wp_query, $cp_loop;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	if ( isset( $cp_loop->cp_no_title ) ) {
		$tag = 'h2';
	}
	echo '<' . esc_attr( $tag ) . ' class="post-summary__title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></' . esc_attr( $tag ) . '>';
}

/**
 * Post Summary Title
 */
function eqd_post_author() {
	?>
		<div class="author_info">
			<?php
			$author_id = get_the_author_meta( 'ID' );
			echo get_avatar( $author_id, 96 );
			?>
			<div class="author_name">
				<?php echo get_the_author(); ?>
			</div>
		</div>
	<?php
}

/**
 * Post Summary Image
 *
 * @param array $size Image size.
 */
function eqd_post_summary_image( $size = 'thumbnail' ) {
	echo '<div class="post-summary__image"><a href="' . esc_url( get_permalink() ) . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( eqd_entry_image_id(), $size ) . '</a></div>';
}


/**
 * Entry Image ID
 */
function eqd_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_eqd_default_image' );
}

/**
 * Entry Author
 */
function eqd_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . esc_url( get_author_posts_url( $id ) ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . esc_url( get_author_posts_url( $id ) ) . '">' . get_the_author() . '</a></p>';
}

/**
 * Entry Date
 */
function eqd_entry_date() {
	$output = 'Published on <time datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date( 'F j, Y' ) . '</time>';
	if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
		$output .= ' / Last updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
	}
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo '<p class="entry-date">' . $output . '</p>';
}


/**
 * Footer CTA
 */

function eqd_tha_footer_cta() {
	if ( get_post_type() != 'slp_contacts' ) {
		// Load values and assing defaults.

		$cta_title = get_field( 'field_6504bca294980', 'option' );
		$copy      = get_field( 'copy', 'option' );

		if ( get_field( 'image', 'option' ) ) {
			$image = get_field( 'image', 'option' );
		}
		if ( get_field( 'link', 'option' ) ) {
			$link = get_field( 'link', 'option' );
		}

		// Override.
		if ( get_field( 'field_6504bca294980', get_the_ID() ) ) {
			$cta_title = get_field( 'cta_title', get_the_ID() );
		}
		if ( get_field( 'copy' ) ) {
			$copy = get_field( 'copy' );
		}
		if ( get_field( 'link' ) ) {
			$link = get_field( 'link' );
		}
		if ( get_field( 'image' ) ) {
			$image = get_field( 'image' );
		}
		// Individual page.
		$disable = get_field( 'disable' );

		if ( ! $disable ) :
			if ( ! is_author() && ! is_archive() && ! is_category() && ! is_tax() ) :
				?>

	<section class="block calculator-signup-block">
		<div class="calculator-signup-container">
			<figure class="calculator-signup-container-image">
				<?php if ( ! empty( $image ) ) : ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
				<?php endif; ?>
			</figure>

			<div class="calculator-signup-container-content">
				<h2 class="title"><?php echo $cta_title; ?></h2>
				<div class="text"><?php echo $copy; ?></div>
				<div class="link">
					<a class="btn btn-dark-bg" href="<?php echo wp_kses_post( $link['url'] ); ?>"><?php echo wp_kses_post( $link['title'] ); ?></a>
				</div>

				<?php
				$list = get_field( 'list', 'option' );
				// $list = get_field( 'list' );
				if ( $list ) {
					echo '<div class="calculator-signup-container-content-list">';
					foreach ( $list as $row ) {
						if ( ! empty( $row['image'] ) ) {
							$image = $row['image']['url'];
						}
						if ( ! empty( $row['image'] ) ) {
							$imageAlt = $row['image']['alt'];
						}
						$title   = $row['title'];
						$context = $row['context'];

						echo '<div class="calculator-signup-container-content-list-item">';
						if ( ! empty( $image ) ) {
							echo "<img src='$image' alt='$imageAlt'></img>";
						}
						echo '<div class="calculator-signup-container-content-list-item-content">';
						if ( ! empty( $title ) ) {
							echo '<h3>';
								echo $title;
							echo '</h3>';
						}
						if ( ! empty( $context ) ) {
							echo '<span class="content">';
								echo $context;
							echo '</span>';
						}

						echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				}
				?>
			</div>
		</div>
	</section>

				<?php
		endif;
	endif;
	}
}
add_action( 'tha_footer_cta', 'eqd_tha_footer_cta' );



/**
 * Page Header
 */

function eqd_tha_page_header() {
	if ( ! is_single() && ! is_front_page() ) {

		if ( is_category() ) {
			$category = get_the_category()[0];
			$cat_id   = $category->term_id;

			$sub_heading             = get_field( 'sub_heading', 'category_' . $cat_id );
			$subtitle                = get_field( 'subtitle', 'category_' . $cat_id );
			$title_max_width_desktop = get_field( 'title_max_width_desktop', 'category_' . $cat_id );
			$link                    = get_field( 'link', 'category_' . $cat_id );
			$background_image        = get_field( 'background_image', 'category_' . $cat_id );
			if ( ! empty( $background_image['url'] ) ) {
				$bg_url = $background_image['url'];
			}
		} else {

			// Load values and assing defaults.
			$page_id                 = get_the_ID();
			$sub_heading             = get_field( 'sub_heading', $page_id );
			$subtitle                = get_field( 'subtitle', $page_id );
			$title_max_width_desktop = get_field( 'title_max_width_desktop', $page_id );
			$center_text             = get_field( 'center_text', $page_id );
			$link                    = get_field( 'link' );
			$padding_size            = get_field( 'padding_size', $page_id );

			$container_class = null;

			if ( is_archive() ) {
				$term             = get_queried_object();
				$background_image = get_field( 'background_image', $term );
				if ( ! empty( $background_image['url'] ) ) {
					$bg_url = $background_image['url'];
				}
			} else {
				$background_image    = get_field( 'background_image', $page_id );
				$thumbnail_id        = get_post_thumbnail_id( $page_id );
				$thumbnail_url_array = wp_get_attachment_image_src( $thumbnail_id, 'full' );
				if ( isset( $thumbnail_url_array[0] ) ) {
					$background_image = $thumbnail_url_array[0];
				}
				$bg_url = $background_image;
			}
		}

		switch ( $padding_size ) {
			case 'small':
				$container_class .= ' inner-hero-small';
				break;
			case 'medium':
				$container_class .= ' inner-hero-medium';
				break;
			case 'large':
				$container_class .= ' inner-hero-large';
				break;

			default:
				break;
		}
		if ( $center_text ) {
			$container_class .= ' inner-hero-center-text';
		}

		?>
		<header class="inner-hero <?php echo wp_kses_post( $container_class ); ?>">
			<div class="inner-hero-container">
					
				<h1 class="title" style="max-width:<?php echo wp_kses_post( ! empty( $title_max_width_desktop ) ? $title_max_width_desktop . '%' : 'none' ); ?>;">
					
					<?php if ( ! empty( $sub_heading ) ) : ?>
						<div class="sub_heading"><?php echo wp_kses_post( $sub_heading ); ?></div>
					<?php endif; ?>

					<?php
					if ( is_page() ) {
						echo wp_kses_post( get_the_title() );
					}
					if ( is_archive() ) {
						echo wp_kses_post( get_the_archive_title() );
					}
					if ( is_404() ) {
						echo 'Not found, error 404';
					}
					?>
				</h1>
				
				<span class="subtitle">
					<?php
					if(!empty($subtitle)){
						echo wp_kses_post( $subtitle );
					} else {
						echo wp_kses_post( get_field( 'title_copy', 'option' ) );
					}
					 
					?>
				</span>

				<?php if ( ! empty( $link ) ) : ?>
					<span class="link">
						<a href="<?php echo $link['url'] ? $link['url'] : ''; ?>" class="btn btn-dark-bg"><?php echo $link['title'] ? $link['title'] : ''; ?></a>
					</span>
				<?php endif; ?>

			</div>
			<?php if ( ! empty( $bg_url ) ) : ?>
				<span class="hero_image">
					<img src="<?php echo $bg_url; ?>" alt="<?php the_title(); ?>" />
				</span>
			<?php endif; ?>

		</header>

		<?php
	}
}
add_action( 'tha_page_header', 'eqd_tha_page_header' );

/**
 * Single Sar Bar
 */
add_action( 'tha_single_sidebar', 'eqd_single_sidebar' );

function eqd_single_sidebar() {
	// Standard Format.
	if ( is_single() && get_post_type() == 'post' ) {
		if ( get_field( 'post_format_style' ) != 'full-width' ) :
			?>
			<div class="sidebar_container">
				<div class="sidebar_social">
					<?php echo '<span>Share:</span> ' . do_shortcode( '[shared_counts]' ); ?>
				</div>
				<?php if ( has_block( 'acf/table-of-contents' ) ) { ?>
					<div class="toc_content_load_point_sidebar">
						<h2 class="toc_content_load_point_sidebar__title">Table of Contents</h2>
						<div class="toc_content_load_point"></div>
					</div>
				<?php } ?>
			</div>
			<?php
		endif;
	}
}
