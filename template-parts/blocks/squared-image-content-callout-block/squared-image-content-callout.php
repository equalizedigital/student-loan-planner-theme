<?php

/**
 * squared-image-content-callout-block Block Template.
 *
 * @param  array  $block  The block settings and attributes.
 * @param  string  $content  The block inner HTML (empty).
 * @param  bool  $is_preview  True during AJAX preview.
 * @param  (int|string)  $post_id  The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );

	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'squared-image-content-callout-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block squared-image-content-callout-block';
if ( ! empty( $block['className'] ) ) :
	$className .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field( 'title' );
$copy = get_field( 'copy' );
if ( get_field( 'image' ) ) {
	$image = get_field( 'image' );
}
$link = get_field( 'link' );
?>
<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
    <div class="squared-image-content-callout-container">
        <figure class="squared-image-content-callout-container-image">
			<?php if ( ! empty( $image ) ) : ?>
				<?php echo wp_get_attachment_image( $image['id'], 'squared-image-content-callout-thumbnail' ); ?>
			<?php endif; ?>
        </figure>

        <div class="squared-image-content-callout-container-content">
            <div>
                <h2 class="title"><?php echo $title; ?></h2>
				<?php
				if ( ! empty( $link ) ) {
					$url = $link['url'];
					$title = $link['title'];
					echo '<span class="content">';
					echo "<a href=\"$url\" class=\"btn btn-dark-bg\">";
					echo $title;
					echo '</a>';
					echo '</span>';
				}
				?>
				<?php
				$list = get_field( 'list' );
				if ( $list ) {
					echo '<div class="squared-image-content-callout-container-content-list">';
					foreach ( $list as $row ) {
						if ( ! empty( $row['image'] ) ) {
							$image = $row['image']['url'];
						}
						if ( ! empty( $row['image'] ) ) {
							$imageAlt = $row['image']['alt'];
						}
						$title = $row['title'];
						$context = $row['context'];


						echo '<div class="squared-image-content-callout-container-content-list-item">';
						if ( ! empty( $image ) ) {
							echo "<img src='$image' alt='$imageAlt'>";
						}
						echo '<div class="squared-image-content-callout-container-content-list-item-content">';
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
    </div>
</section>
