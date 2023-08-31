<?php

/**
 * resource-links Block Template.
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
$id = 'resource-links-block-' . $block['id'];
if (!empty($block['anchor'])) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block resource-links-block';
if (!empty($block['className'])) :
	$className .= ' ' . $block['className'];
endif;

if (!empty($block['align'])) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );

// Load values and assing defaults.
$title = get_field('title');

// Load values and assing defaults.
$title = get_field('title');
?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<div class="resource-links-container">
		<h2 class="resource-links-container__title">
			<?php echo $title; ?>
		</h2>

		<div class="resource-links-container-links">
			<?php 
			$links = get_field('links');
			if( $links ) {
				foreach( $links as $key => $row ) {
					if(!empty($row['link'])){
						$link 		= $row['link'];
					}
					if(!empty($row['icon'])){
					$icon 		= $row['icon']['url'];
					}
					?>
					<div class="resource-links-container-links-link ">
						<button data-link="tab-<?php echo $key; ?>" class="resource-links-container-links-button <?php echo $key==0?'active':''; ?>">
							<?php
							echo "<img src='$icon'></img>";
							echo "<span class=\"text\">$link</span>";
							?>
						</button>
					</div>
					<?php
				}
			}
			?>
			

			<div class="dropdown">
				<button id="resource-links-dropdown" class="dropdown-select">
					
				<?php 
					$links = get_field('links');
					if( $links ) {
						foreach( $links as $key => $row ) {
							if(!empty($row['link'])){
								$link = $row['link'];
							}
							if(!empty($row['icon'])){
								$icon = $row['icon']['url'];
							}
							if($key != 0 )continue;
							?>
								<img src="<?php echo $icon; ?>" />
								<?php _e($link); ?>
							<?php
						}
					}
					?>

				</button>
				<ul class="resource-links-dropdown-list">
					<?php 
					$links = get_field('links');
					if( $links ) {
						foreach( $links as $key => $row ) {
							if(!empty($row['link'])){
								$link = $row['link'];
							}
							if(!empty($row['icon'])){
								$icon = $row['icon']['url'];
							}
							?>
								<li class="dropdown-li" data-link="tab-<?php echo $key; ?>">
									<img src="<?php echo $icon; ?>" />
									<?php _e($link); ?>
								</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
			
		</div>

	</div>


	<div class="resource-links-loop-container">

		<?php 
			$links = get_field('links');
			if( $links ) {
				foreach( $links as $key => $row ) {
					if(!empty($row['link'])){
						$link 		= $row['link'];
					}
					if(!empty($row['featured_image'])){
						$featured_image = $row['featured_image']['url'];
					}
				
					if(!empty($row['category'])){
						$category = $row['category'];
					}
					?>
					<div id="tab-<?php echo $key; ?>" class="resource-links-loop-container-item <?php echo $key==0?'resource-links-loop-container-item--active':''; ?>">
						<header class="resource-links-loop-container-header">
							<h2 class="title"><?php echo $link; ?></h2>
						</header>
						<div class="resource-links-loop-container-content">
							<div class="resource-links-loop-container-content-featured">
								<div class="resource-links-loop-container-content-featured-link">
									<figure>
										<img src="<?php echo esc_url($featured_image); ?>" alt="Post Featured Image">
									</figure>
									<h3 class="title"><?php echo $link; ?></h3>
								</div>
							</div>

							<div class="resource-links-loop-container-content-loop">

								<?php
								$args = array(
									'post_type' => 'post', 
									'posts_per_page' => 3, 
									'cat' => $category,
								);

								$query = new WP_Query($args);

								if ($query->have_posts()) {
									while ($query->have_posts()) {
										$query->the_post();
										
										// Get categories
										$categories = get_the_category();
										if ($categories) {
											$category = $categories[0]->name; // Assuming you want only the first category if there are multiple
										} else {
											$category = '';
										}
										
										// Get title
										$title = get_the_title();

										$link = get_the_permalink();
										
										// Get author image (assuming you're using Gravatar)
										$author_email = get_the_author_meta('user_email');
										$author_image_url = get_avatar_url($author_email, array('size' => 96));
										
										// Get author name
										$author_name = get_the_author();

										?>
											<a class="resource-links-loop-container-content-loop-item" href="<?php echo $link; ?>">
												<div class="category"><?php echo $category; ?></div>
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
					</div>
					<?php
				}
			}
			?>
	</div>
</section>
