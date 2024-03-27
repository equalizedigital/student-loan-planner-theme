<?php

/**
 * query loop block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'query-loop-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block query-loop-block';
if ( ! empty( $block['className'] ) ) :
	$className .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title   = get_field( 'title' );
$link    = get_field( 'link' );
$authors = get_field( 'authors' );

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="query-loop-container">
		<header class="query-loop-container-header">
			<h2 class="title"><?php echo $title; ?></h2>
			<?php if ( $link ) : ?>
				<div class="link">
					<a href="<?php echo $link['url']; ?>" class="btn"><?php echo $link['title']; ?></a>
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
							
							// Get title
							$title = get_the_title();

							$link = get_the_permalink();

							// Get author image (assuming you're using Gravatar)
							$author_email     = get_the_author_meta( 'user_email' );
							$author_image_url = get_avatar_url( $author_email, array( 'size' => 96 ) );

							// Get author name
							$author_name = get_the_author();

							$featured_image_url = get_the_post_thumbnail_url(); // gets the featured image URL

							// If there's no featured image, use a default image
							if ( empty( $featured_image_url ) ) {
								$featured_image_url = get_template_directory_uri() . '/assets/images/placeholder-post.png';
							}

							?>
							<a class="query-loop-container-loop-item" href="<?php echo $link; ?>">
								<figure>
									<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Post Featured Image">
								</figure>
								<h3 class="title"><?php echo $title; ?></h3>
								<div class="author">
									<figure>
									<?php echo '<img src="' . esc_url( $author_image_url ) . '" alt="' . esc_attr( $author_name ) . '">'; ?>
									</figure>
									<div class="author_data">
										By <?php echo $author_name; ?>
									</div>
								</div>
							</a>

							<?php
						}
						
						// Reset post data after each author.
						wp_reset_postdata();
					}
				}





				 
				?>


		</div>
	</div>
</section>
