<?php
/**
 * Featured Post Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Featured Post
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'featured-post-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block featured-post';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$post_select = get_field( 'post' );

$featured_img_url = get_the_post_thumbnail_url( $post_select->ID, 'full' ); // 'full' indicates the original image size
$category_ids     = wp_get_post_categories( $post_select->ID );


$dateObject    = new DateTime( $post_select->post_date );
$formattedDate = $dateObject->format( 'M d, Y' );

// Get the author ID from the post ID
$author_id = get_post_field( 'post_author', $post_select->ID );

// Get the author's display name
$author_name = get_the_author_meta( 'display_name', $author_id );

// Get the author's avatar. You can adjust the size (e.g., 96 here) as needed.
$author_avatar = get_avatar( $author_id, 96 );

?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<a class="featured-post-container" href="<?php the_permalink( $post_select->ID ); ?>">
		<div class="featured-post-container-content">
			<div class="featured-post-container-info">
				<div class="cat">
					<?php
					if ( ! empty( $category_ids ) ) {
						$category = get_category( $category_ids[0] );
						echo $category->name . ' ';
					}
					?>
				</div>
				<div class="date"><?php echo wp_kses_post( $formattedDate ); ?></div>
			</div>
			<h2 class="title"><?php echo wp_kses_post( $post_select->post_title ); ?></h2>
			<div class="author">
			<?php echo wp_kses_post( $author_avatar ); ?>
				<?php echo wp_kses_post( $author_name ); ?>
			</div>
		</div>
		<div class="featured-post-container-image">
		<?php
		if ( $featured_img_url ) {
			echo '<img src="' . esc_url( $featured_img_url ) . '" alt="">';
		}
		?>
		</div>
	</a>
</section>
