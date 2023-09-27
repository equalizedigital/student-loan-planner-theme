<?php
/**
 * Recommended-posts-block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'recommended-posts-block-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block recommended-posts-block-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title = get_field( 'title' );
$recommended_posts  = get_field( 'recommended_posts' );


?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="recommended_posts_block_block_container">
		<header class="recommended_posts_block_block_container_header">
			<h2 class="recommended_posts_block_block_container_header__title"><?php echo esc_attr( $acf_title ); ?></h2>
		</header>

		<ul class="recommended_posts_block_block_container_loop">

		<?php 
		$args = array(
			'post_type' => 'post',
			'post__in'  => $recommended_posts,
			'orderby'   => 'post__in', // This ensures posts are returned in the order of the provided IDs.
		);
		
		$query = new WP_Query($args);
		
		if ($query->have_posts()) {
			while ($query->have_posts()) {
				$query->the_post();
				?>
				<li>
					<a class="recommended_posts_block_block_container_loop_item" href="<?php the_permalink(); ?>">
						<div class="recommended_posts_block_block_container_loop_item_image">
							<?php 
							if (has_post_thumbnail($post_id)) {
								$image_url = get_the_post_thumbnail_url($post_id);
								echo "<img src='$image_url' aria-hidden=\"true\" role=\"presentation\" />";
							}
							?>
						</div>
						<div class="recommended_posts_block_block_container_loop_item_text">
							<h2><?php echo get_the_title(); ?></h2>
						</div>
					</a>
				</li>
				<?php
				
			}
			wp_reset_postdata(); 
		} else {
			echo 'No posts found';
		}
		?>
		</ul>

	</div>
</section>