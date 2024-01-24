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

		if(is_single( )){

			// Assuming you have the post ID
			$post_id = get_the_ID();

			// Get the post categories
			$categories = get_the_category($post_id);

			// Check if categories exist for the post
			if (!empty($categories)) {
				// Retrieve the name of the first category
				$category_id = $categories[0]->term_id;
				$hide_footer_cta = get_field( 'hide_footer_cta',  'category_' . $category_id );
						if ( $hide_footer_cta ) {
						return;
					}
			}
		}


		if ( ! $disable ) :
			if ( ( ! is_author() && ! is_archive() && ! is_category() && ! is_tax() ) || is_archive( 'eqd-featured-press' ) ) :
				?>

	<section class="block calculator-signup-block calculator-signup-container-footer">
		<div class="calculator-signup-container">
			<figure class="calculator-signup-container-image">
				<?php if ( ! empty( $image ) ) : ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>">
				<?php endif; ?>
			</figure>

			<div class="calculator-signup-container-content">
				<h2 class="title"><?php echo $cta_title; ?></h2>
				<div class="text"><?php echo $copy; ?></div>

				<?php if ( ! empty( $link['url'] ) ) : ?>
				<div class="link">
					<a class="btn btn-dark-bg" href="<?php echo wp_kses_post( $link['url'] ); ?>">
						<?php echo wp_kses_post( $link['title'] ); ?>
					</a>
				</div>
				<?php endif; ?>

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
	if ( ! is_single() ) {

		if ( is_category() ) {
			$category = get_the_category()[0];
			$cat_id   = $category->term_id;

			$alternative_title       = get_field( 'alternative_title', 'category_' . $cat_id );
			$sub_heading             = get_field( 'sub_heading', 'category_' . $cat_id );
			$subtitle                = get_field( 'subtitle', 'category_' . $cat_id );
			$title_max_width_desktop = get_field( 'title_max_width_desktop', 'category_' . $cat_id );
			$heading_link            = get_field( 'heading_link', 'category_' . $cat_id );
			$background_image        = get_field( 'background_image', 'category_' . $cat_id );
			if ( ! empty( $background_image['url'] ) ) {
				$bg_url = $background_image['url'];
			}
		} elseif ( is_tax() ) {
			$term    = get_queried_object();
			$term_id = $term->term_id;

			$alternative_title       = get_field( 'alternative_title', 'category_' . $term_id );
			$sub_heading             = get_field( 'sub_heading', 'category_' . $term_id );
			$subtitle                = get_field( 'subtitle', 'category_' . $term_id );
			$title_max_width_desktop = get_field( 'title_max_width_desktop', 'category_' . $term_id );
			$heading_link            = get_field( 'heading_link', 'category_' . $term_id );
			$background_image        = get_field( 'background_image', 'category_' . $term_id );
			if ( ! empty( $background_image['url'] ) ) {
				$bg_url = $background_image['url'];
			}
		} else {
			// Load values and assing defaults.
			$page_id                 = get_the_ID();
			$alternative_title       = get_field( 'alternative_title', $page_id );
			$sub_heading             = get_field( 'sub_heading', $page_id );
			$subtitle                = get_field( 'subtitle', $page_id );
			$title_max_width_desktop = get_field( 'title_max_width_desktop', $page_id );
			$center_text             = get_field( 'center_text', $page_id );
			$heading_link            = get_field( 'heading_link' );
			$padding_size            = get_field( 'padding_size', $page_id );
			$container_class         = null;

			if ( is_archive() ) {
				$term             = get_queried_object();
				$background_image = get_field( 'background_image', $term );
				if ( ! empty( $background_image['url'] ) ) {
					$bg_url = $background_image['url'];
				}
			} else {
				$image = get_the_post_thumbnail_url($page_id);
				if ( $image ) {
					$background_image = $image;
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

		$alternate_header_style = get_field( 'alternate_header_style' );
		if ( $alternate_header_style ) {
			$container_class .= 'inner-hero-alternate-style';
		}

		$current_term = get_queried_object();
		?>
		<header class="inner-hero <?php echo wp_kses_post( $container_class );  echo "taxonomy-".wp_kses_post($current_term->slug); ?>">
			<div class="inner-hero-container">
					
				<h1 class="title" style="<?php echo wp_kses_post( ! empty( $title_max_width_desktop ) ? 'max-width:' . $title_max_width_desktop . '%;' : '' ); ?>">
					
					<?php
					if ( is_search() ) :
						// Search
						$search_term = get_search_query();
						?>
						Search: <?php echo wp_kses_post( $search_term ); ?>
					<?php else : ?>

						<?php if ( ! empty( $sub_heading ) ) : ?>
							<div class="sub_heading"><?php echo wp_kses_post( $sub_heading ); ?></div>
						<?php endif; ?>

						<?php
						if ( is_tax() ) {
							$current_term = get_queried_object();
							if ( $current_term->taxonomy !== 'occupation' ) {
								echo 'Resources for ';
							}
						}
						if ( ! empty( $alternative_title ) ) {
							echo wp_kses_post( $alternative_title );
						} else {
							if ( is_page() ) {
								echo wp_kses_post( get_the_title() );
							}
							if ( is_archive() ) {
								echo wp_kses_post( get_the_archive_title() );
							}
							if ( is_404() ) {
								echo 'Not found, error 404';
							}
						}

						?>
					<?php endif; ?>
				</h1>
				
					<span class="subtitle">
						<?php
						if ( ! is_search() ) {
							if ( ! empty( $subtitle ) ) {
								echo wp_kses_post( $subtitle );
							} else {
								echo wp_kses_post( get_field( 'title_copy', 'option' ) );
							}
						}
						?>
					</span>
				
				<?php if ( !$alternate_header_style ): ?>

					<?php if ( ! empty( $heading_link ) ) : ?>
						<span class="link">
							<a href="<?php echo $heading_link['url'] ? $heading_link['url'] : ''; ?>" class="btn btn-dark-bg"><?php echo $heading_link['title'] ? $heading_link['title'] : ''; ?></a>
						</span>
					<?php endif; ?>

				<?php endif; ?>

			</div>

			<?php if ( !$alternate_header_style ): ?>
				<?php
				if ( ! is_search() ) {
					if ( ! empty( $bg_url ) ) :
						?>
						<span class="hero_image">
							<img src="<?php echo $bg_url; ?>" alt="<?php the_title(); ?>" />
						</span>
						<?php
					endif;
				}
				?>
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
		$layout_style = get_field( 'post_format_style' );
		$header_main_link = get_field( 'header_main_link', 'option' );
		if( empty( $layout_style ) ) {
			$layout_style = 'standard';
		}
		if ( get_field( 'post_format_style' ) == 'standard' || $layout_style == true && get_field( 'post_format_style' ) != 'full-width' ) :
			?>
			<div class="sidebar_container">
				<div class="sidebar_social">
					<?php echo '<span>Share:</span> ' . do_shortcode( '[shared_counts]' ); ?>
				</div>
					<div class="toc_content_load_point_sidebar">
						<h2 class="toc_content_load_point_sidebar__title">Table of Contents</h2>
						<div class="toc_content_load_point"></div>
					</div>
			</div>
			<?php 
			// echo has_block( 'acf/table-of-contents' );
			if ( !has_block( 'acf/table-of-contents' ) ) : ?>
				
			<?php 
			// placeholder.
			 ?>
			<div class="toc-nav placeholder"></div>
			<?php // mobile nav ?>
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
			<?php endif; ?>
			<?php
		endif;
	}
}


function prevent_auto_tag_scroll_delayed(){

	$layout_style_check = get_field( 'post_format_style' );

	if( empty( $layout_style_check ) ) {
		$layout_style_check = 'standard';
	}
	
	if($layout_style_check != 'standard'){
		return;
	}

?>

<script>
	document.addEventListener('DOMContentLoaded', function () {
	let hashStore;

    if (window.location.hash) {
		hashStore = window.location.hash;
		// window.location.hash = '';
		// history.replaceState(null, null, window.location.pathname + window.location.search);
		window.scrollTo(0, 0);
		observeH2Elements();
	}

	function allH2HaveIds() {
		setTimeout(() => {
			const urlWithoutHash = hashStore.replace('#', '');
			var element = document.getElementById(urlWithoutHash);
			location.hash = hashStore;
			// element.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}, 900);
	}

	// Set up a MutationObserver to watch for changes in ID attributes on h2 elements
	function observeH2Elements() {
		const h2Elements = document.querySelectorAll('.post_type_layout_standard .entry-content > h2');
		let observedElementsCount = 0;
		let elementsWithIdCount = 0;

		// Callback function to execute when mutations are observed
		const callback = function(mutationsList, observer) {
			for (const mutation of mutationsList) {
			if (mutation.type === 'attributes' && mutation.attributeName === 'id') {
				const target = mutation.target;
				if (target.id) {
					console.log(`An ID was added to: `, target);
					elementsWithIdCount++;
					// Check if all h2 elements have an ID
					if (elementsWithIdCount === observedElementsCount) {
						allH2HaveIds();
						observer.disconnect(); // Optionally stop observing if no further changes are needed
					}
				}
			}
			}
		};

		// Create an observer instance linked to the callback function
		const observer = new MutationObserver(callback);

		// Options for the observer (which mutations to observe)
		const config = { attributes: true };

		// Start observing each h2 element for configured mutations
		h2Elements.forEach((h2) => {
			if (!h2.id) { // Only observe h2 elements without an ID
			observedElementsCount++;
			observer.observe(h2, config);
			} else {
			// Element already has an ID
			elementsWithIdCount++;
			}
		});

		// If all h2 elements already have an ID, we call the function directly
		if (elementsWithIdCount === observedElementsCount) {
			allH2HaveIds();
		}
	}
});

</script>

<?php
}

add_action( 'tha_page_header', 'prevent_auto_tag_scroll_delayed', 10 );