<?php
/**
 * Archive
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Full width.
add_filter( 'eqd_page_layout', 'eqd_return_full_width_content' );

/**
 * Body Class
 *
 * @param array $classes Body classes.
 */
function eqd_archive_body_class( $classes ) {
	$classes[] = 'archive';
	return $classes;
}
add_filter( 'body_class', 'eqd_archive_body_class' );

/**
 * Archive Header
 */
function eqd_archive_header() {

	$title       = false;
	$subtitle    = false;
	$description = false;

	if ( is_author() ) {
		eqd_author_box( get_queried_object_id(), 'author-archive' );
		return;
	}

	if ( is_home() && get_option( 'page_for_posts' ) ) {
		$title = get_the_title( get_option( 'page_for_posts' ) );

	} elseif ( is_search() ) {
		$title = 'Search Results';

	} elseif ( is_archive() ) {
		$title = false;
		if ( is_category() || is_tag() ) {
			$title = get_term_meta( get_queried_object_id(), 'eqd_archive_headline', true );
		}
		if ( empty( $title ) ) {
			$title = get_the_archive_title();
		}
		if ( ! get_query_var( 'paged' ) ) {
			$description = get_the_archive_description();
		}
	}

	if ( empty( $title ) && empty( $description ) ) {
		return;
	}

	$classes = array( 'archive-description' );
	if ( is_author() ) {
		$classes[] = 'author-archive-description';
	}

	echo '<header class="' . esc_attr( join( ' ', $classes ) ) . '">';
	do_action( 'eqd_archive_header_before' );

	if ( ! is_search() ) {
		echo '<h2 class="archive-title">Latest articles</h2>';
	}
	echo wp_kses_post( apply_filters( 'eqd_the_content', $description ) );
	do_action( 'eqd_archive_header_after' );
	echo '</header>';
}
add_action( 'tha_content_while_before', 'eqd_archive_header' );


/**
 * Archive Recommended Posts
 */
function eqd_archive_recommended_post() {
	$term            = get_queried_object();
	$post_recommened = get_field( 'recommendedfeatured_posts', $term ); 

	if ( ! empty( $post_recommened ) ) :
		if ( ! is_paged() ) :
			?>
	<section class="archive_template_recommended_post">
		<div class="archive_template_recommended_post_header">
			<h2 class="archive_template_recommended_post_header_title">
				
				<?php 
				if ( is_tax() ) {
					echo 'Recommended Resources for ' . $term->name;
				} else {
					echo 'Featured articles';
				}
				?>
			</h2>
		</div>
		<div class="archive_template_recommended_post_loop">
			<?php
			$args = array(
				'post__in'       => $post_recommened,
				'post_type'      => 'post',
				'orderby'        => 'post__in', // This will preserve the order of IDs as you provided
				'posts_per_page' => -1, // Get all posts matching the criteria
			);

			$the_query = new WP_Query( $args );

			// The Loop
			if ( $the_query->have_posts() ) {
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					?>
					<a class="archive_template_recommended_post_loop_item" href="<?php the_permalink(); ?>">
						<figure>
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();  // This will output the featured image with default settings
							}
							?>
							<?php 
							if ( is_tax( 'slp_occupation' ) ) {
								$categories = get_the_category();
								if ( ! empty( $categories ) ) {
									?>
								<div class="categories"><?php echo wp_kses_post( $categories[0]->name ); ?></div>
									<?php
								}
							}
							?>
						</figure>
						<div class="date">
							<?php echo get_the_date();  // This will output the date the post was published ?>
						</div>
						<h3 class="title"><?php echo wp_kses_post( get_the_title() ); ?></h3>
						<div class="author">
							<?php
							$author_id = get_the_author_meta( 'ID' );
							echo get_avatar( $author_id, 96 );  
							?>
							<div class="author_name">
								<?php echo get_the_author(); ?>
							</div>
						</div>
						</a>
					
					<?php
				}
				/* Restore original Post Data */
				wp_reset_postdata();
			} else {
				// No posts found
				echo 'No posts found';
			}
			?>
		</div>
	</section>
			<?php
	endif;
	endif;
}
add_action( 'tha_content_before_container', 'eqd_archive_recommended_post' );

function eqd_archive_recommended_cta() {
	$term = get_queried_object();
	$cta  = get_field( 'cta', $term ); 

	if ( $cta ) :
		if ( ! is_paged() ) :
			?>
<section class="archive_cta">
	<div class="archive_cta_container">
			<?php if ( ! empty( $cta['image'] ) ) : ?>
		<div class="archive_cta_container_figure">
			<img src="<?php echo wp_kses_post( $cta['image']['url'] ); ?>" alt="<?php echo wp_kses_post( $cta['title'] ); ?>">
		</div>
		<?php endif; ?>
			<?php if ( ! empty( $cta['title'] ) ) : ?>
		<div class="archive_cta_container_copy">
			<h2 class="title"><?php echo wp_kses_post( $cta['title'] ); ?></h2>
			<div class="copy">
				<?php echo wp_kses_post( $cta['copy'] ); ?>
			</div>
			<div class="form">
				<?php echo do_shortcode( $cta['form_code'] ); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>
			<?php
endif;
endif;
}
add_action( 'tha_content_before_container', 'eqd_archive_recommended_cta' );

// Build the page.
require get_template_directory() . '/index.php';
