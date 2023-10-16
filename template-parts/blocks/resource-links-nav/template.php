<?php

/**
 * resource-links-nav Block Template.
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
$id = 'resource-links-nav-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block resource-links-nav-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="resource-links-nav-container">

		<div class="resource-links-nav-container-links">
			<?php 
			$links = get_field('links');

			if( $links ) {
				foreach( $links as $key => $row ) {
					// icon
					if(!empty($row['icon'])){
						$icon = $row['icon']['url'];
					}	

					// term
					if(!empty($row['category'])){
						$term = get_term($row['category']);
					}
					if(!empty($row['tags'])){
						$term = get_term($row['tags']);
					}
					if(!empty($row['occupations'])){
						$term = get_term($row['occupations']);
					}
					if(!empty($row['state'])){
						$term = get_term($row['state']);
					}
					if(!empty($row['press_category'])){
						$term = get_term($row['press_category']);
					}

					$link = get_term_link($term->term_id);

					if(!empty($row['manual_link'])){
						$link = $row['manual_link'];
						$link_title =$link['title'];
					}
					
					$name = $term->name;
					?>
					<div class="resource-links-nav-container-links-link ">
						<?php if(!empty($row['manual_link'])): ?>
							<a class="resource-links-nav-container-links-link-button" href="<?php echo $link['url']; ?>">
								<?php
									echo $icon?"<img aria-hidden=\"true\" role=\"presentation\" src='$icon' aria-hidden='true'></img>":'';
									echo "<span class=\"text\">$link_title</span>";
								?>
							</a>
						<?php else: ?>
						<a class="resource-links-nav-container-links-link-button" href="<?php echo $link; ?>">
							<?php
								echo $icon?"<img aria-hidden=\"true\" role=\"presentation\" src='$icon' aria-hidden='true'></img>":'';
								echo "<span class=\"text\">$name</span>";
							?>
						</a>
						<?php endif; ?>

					</div>

					<?php
				}
			}
			?>
		</div>
	</div>
</section>
