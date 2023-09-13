<?php

/**
 * query loop block Block Template.
 *
 * @param	 array $block The block settings and attributes.
 * @param	 string $content The block inner HTML (empty).
 * @param	 bool $is_preview True during AJAX preview.
 * @param	 (int|string) $post_id The post ID this block is saved to.
 */

if( isset( $block['data']['preview_image_help'] )  ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'query-loop-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block query-loop-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;
if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');
$link = get_field('link');

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="query-loop-container">
		<header class="query-loop-container-header">
			<h2 class="title"><?php echo $title; ?></h2>
			<?php if($link): ?>
				<div class="link">
					<a href="<?php echo $link['url']; ?>" class="btn"><?php echo $link['title']; ?></a>
				</div>
			<?php endif; ?>
		</header>
		<div class="query-loop-container-loop">

				<?php
				$args = array(
					'post_type' => 'post', 
					'posts_per_page' => 3, 
				);

				$query = new WP_Query($args);

				if ($query->have_posts()) {
					while ($query->have_posts()) {
						$query->the_post();
						
						// Get title
						$title = get_the_title();

						$link = get_the_permalink();
						
						// Get author image (assuming you're using Gravatar)
						$author_email = get_the_author_meta('user_email');
						$author_image_url = get_avatar_url($author_email, array('size' => 96));
						
						// Get author name
						$author_name = get_the_author();

						$featured_image_url = get_the_post_thumbnail_url('full'); // gets the featured image URL

						// If there's no featured image, use a default image
						if (!$featured_image_url) {
							$featured_image_url = get_template_directory_uri() . '/assets/images/placeholder-post.png';
						}

						?>
							<a class="query-loop-container-loop-item" href="<?php echo $link; ?>">
								<figure>
									<img src="<?php echo esc_url($featured_image_url); ?>" alt="Post Featured Image">
								</figure>
								<h3 class="title"><?php echo $title; ?></h3>
								<div class="author">
									<figure>
									<?php echo '<img src="' . esc_url($author_image_url) . '" alt="' . esc_attr($author_name) . '">'; ?>
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
</section>