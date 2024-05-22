<?php
/**
 * Resources loop block Block Template.
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
$block_id = 'resources-loop-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block resources-loop-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title    = get_field( 'title' );
$featured_post  = get_field( 'featured_post' );
$selected_posts = get_field( 'selected_posts' );

$featured_image_url = get_the_post_thumbnail_url( $featured_post->ID, 'full' );

// If there's no featured image, use a default image.
if ( ! $featured_image_url ) {
	$featured_image_url = get_template_directory_uri() . '/assets/images/placeholder-post.png';
}

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="resources-loop-block-container">
		<header class="resources-loop-block-container-header">
			<h2 class="title"><?php echo esc_html( $block_title ); ?></h2>
		</header>
		<div class="resources-loop-block-container-content">
			<div class="resources-loop-block-container-content-featured">
				<a href="<?php echo esc_url( get_the_permalink( $featured_post->ID ) ); ?>" class="resources-loop-block-container-content-featured-link">
					<figure>
						<img src="<?php echo esc_url( $featured_image_url ); ?>" alt="Post Featured Image">
					</figure>
					<h3 class="title"><?php echo esc_html( get_the_title( $featured_post->ID ) ); ?></h3>
				</a>
			</div>

			<div class="resources-loop-block-container-content-loop">

				<?php
				$args = array(
					'post_type'      => 'post', 
					'posts_per_page' => 3, 
					'post__in'       => $selected_posts,
					'orderby'        => 'post__in',
				);

				$query = new WP_Query( $args );

				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						
						$categories = get_the_category();
						if ( $categories ) {
							$category = $categories[0]->name; // Get the first category name.
						} else {
							$category = '';
						}
						
						$post_title       = get_the_title();
						$post_link        = get_the_permalink();
						$author_email     = get_the_author_meta( 'user_email' );
						$author_image_url = get_avatar_url( $author_email, array( 'size' => 96 ) );
						$author_name      = get_the_author();

						?>
							<a class="resources-loop-block-container-content-loop-item" href="<?php echo esc_url( $post_link ); ?>">
								<div class="category"><?php echo esc_html( $category ); ?></div>
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
				} else {
					echo 'No posts found for this custom post type.';
				}
				?>
			</div>
		</div>
	</div>
</section>
