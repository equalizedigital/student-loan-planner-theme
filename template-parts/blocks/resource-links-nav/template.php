<?php

/**
 * Taxonomy Select Block Template.
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
$id = 'taxonomy-select-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block taxonomy-select-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

$taxonomy  = get_field( 'select_taxonomy' );
$terms     = ( $taxonomy ) ? get_field( 'select_' . $taxonomy ) : null;
$more_link = get_field( 'more_link' );

/*
select_category
select_post_tag
select_slp_occupation
more_link

taxonomy-select-block
*/

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">

	<?php 
	//var_dump( $taxonomy );
	//var_dump( $terms );
	if ( $terms ) {
		echo '<ul>';
		foreach ($terms as $term ) {
			//var_dump( $term );

			$icon = get_field( 'taxonomy_icon', $taxonomy . '_' . $term );
			$icon_url = ( $icon ) ? $icon['url'] : null;
			
			$term_object = get_term( $term, $taxonomy );
			//var_dump( $term_object );

			if( isset( $term_object->name ) ) {
				?>
				<li>
					<a href="<?php echo get_term_link( $term_object ); ?>">
						<?php echo ( $icon_url ) ? '<img src="' . $icon_url . '" />' : null; ?>
						<?php echo $term_object->name; ?>
					</a>
				</li>
				<?php
			}
			?>

			<?php
		}

		if( $more_link ) {
			?>
			<li>
				<a href="<?php echo $more_link; ?>">
					More
				</a>
			</li>
			<?php
		}

		echo '</ul>';
	}
	?>


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
