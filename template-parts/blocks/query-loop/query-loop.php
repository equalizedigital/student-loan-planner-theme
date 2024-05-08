<?php
/**
 * Query Loop Block.
 * 
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'query-loop-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block query-loop-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title = get_field( 'title' );
$block_link  = get_field( 'link' );
$authors     = get_field( 'authors' ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="query-loop-container">
		<header class="query-loop-container-header">
			<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
			<?php if ( $block_link ) : ?>
				<div class="link">
					<a href="<?php echo esc_url( $block_link['url'] ); ?>" class="btn"><?php echo esc_html( $block_link['title'] ); ?></a>
				</div>
			<?php endif; ?>
		</header>

		<div class="query-loop-container-loop">

				<?php

				if ( have_rows( 'authors' ) ) :

					// Initialize an empty array for authors.
					$authors_array = array();
  
					// Loop through each row in the repeater.
					while ( have_rows( 'authors' ) ) :
						the_row();
  
						// Get the value of the subfield 'author'.
						$author = get_sub_field( 'author' );
  
						// Push the author to the authors array.
						$authors_array[] = $author;
  
					endwhile;
endif;

				// Loop through each author.
				foreach ( $authors_array as $author_id ) {
					// Set up the query arguments.
					$args = array(
						'author'         => $author_id, 
						'posts_per_page' => 1, // Only retrieve one post.
					);
					
					// Perform the query.
					$author_query = new WP_Query( $args );
					
					// If there's a post, display it.
					if ( $author_query->have_posts() ) {
						while ( $author_query->have_posts() ) {
							$author_query->the_post();
							
							$post_title         = get_the_title();
							$post_link          = get_the_permalink();
							$author_email       = get_the_author_meta( 'user_email' );
							$author_image_url   = get_avatar_url( $author_email, array( 'size' => 96 ) );
							$author_name        = get_the_author();
							$featured_image_url = get_the_post_thumbnail_url();

							if ( empty( $featured_image_url ) ) {
								$featured_image_url = get_template_directory_uri() . '/assets/images/placeholder-post.png';
							}

							?>
							<a class="query-loop-container-loop-item" href="<?php echo esc_url( $post_link ); ?>">
								<figure>
									<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Post Featured Image">
								</figure>
								<h3 class="title"><?php echo esc_html( $post_title ); ?></h3>
								<div class="author">
									<figure>
									<?php echo '<img src="' . esc_url( $author_image_url ) . '" alt="' . esc_attr( $author_name ) . '">'; ?>
									</figure>
									<div class="author_data">
										By <?php echo esc_html( $author_name ); ?>
									</div>
								</div>
							</a>

							<?php
						}
						wp_reset_postdata();
					}
				}
				?>
		</div>
	</div>
</section>
