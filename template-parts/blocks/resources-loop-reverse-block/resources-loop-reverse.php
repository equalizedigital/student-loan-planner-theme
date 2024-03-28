<?php

/**
 * resources-loop-reverse-reverse block Block Template.
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
$id = 'resources-loop-reverse-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block resources-loop-reverse-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$title         = get_field( 'title' );
$featured_post = get_field( 'featured_post' );

$featured_image_url = get_the_post_thumbnail_url( $featured_post->ID, 'full' ); // gets the featured image URL

// If there's no featured image, use a default image
if ( ! $featured_image_url ) {
	$featured_image_url = get_template_directory_uri() . '/assets/images/placeholder-post.png';
}

?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="resources-loop-reverse-block-container">
		<header class="resources-loop-reverse-block-container-header">
			<h2 class="title"><?php echo $title; ?></h2>
		</header>
		<div class="resources-loop-reverse-block-container-content">
			<div class="resources-loop-reverse-block-container-content-featured">
				<a href="<?php echo get_the_permalink( $featured_post->ID ); ?>" class="resources-loop-reverse-block-container-content-featured-link">
					<figure>
						<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Post Featured Image">
					</figure>
					<h3 class="title"><?php echo get_the_title( $featured_post->ID ); ?></h3>
				</a>
			</div>

			<div class="resources-loop-reverse-block-container-content-loop">

				<?php
				$args = array(
					'post_type'      => 'post', 
					'posts_per_page' => 3, 
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						
						// Get categories
						$categories = get_the_category();
						if ( $categories ) {
							$category = $categories[0]->name; // Assuming you want only the first category if there are multiple
						} else {
							$category = '';
						}
						
						// Get title
						$title = get_the_title();

						$link = get_the_permalink();
						
						// Get author image (assuming you're using Gravatar)
						$author_email     = get_the_author_meta( 'user_email' );
						$author_image_url = get_avatar_url( $author_email, array( 'size' => 96 ) );
						
						// Get author name
						$author_name = get_the_author();

						?>
							<a class="resources-loop-reverse-block-container-content-loop-item" href="<?php echo $link; ?>">
								<div class="category"><?php echo $category; ?></div>
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
					wp_reset_postdata(); // Reset post data to ensure there's no interference with other loops
				} else {
					echo 'No posts found for this custom post type.';
				}
				?>




			</div>

		</div>
	</div>
</section>