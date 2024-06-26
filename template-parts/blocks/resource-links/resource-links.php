<?php
/**
 * Resource Links Block Template.
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
$block_id = 'resource-links-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block resource-links-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$block_title = get_field( 'title' );

?>
<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="resource-links-container">
		<h2 class="resource-links-container__title">
			<?php echo esc_html( $block_title ); ?>
		</h2>

		<div class="resource-links-container-links" role="tablist">
		<div class="dropdown">
				<button id="resource-links-dropdown" class="dropdown-select">
				<?php
				$links = get_field( 'links' );
				if ( $links ) {
					foreach ( $links as $key => $row ) {
						if ( ! empty( $row['link'] ) ) {
							$resource_select_link = esc_html( $row['link'] );
						}
						if ( ! empty( $row['icon'] ) ) {
							$icon = esc_url( $row['icon']['url'] );
						}
						if ( 0 !== $key ) {
							continue;
						}
						?>
						<img src="<?php echo esc_url( $icon ); ?>" alt="" aria-hidden="true" />
						<?php echo esc_html( $resource_select_link ); ?>
						<?php
					}
				}
				?>

				</button>
				<ul class="resource-links-dropdown-list" role="tablist">
					<?php
					$links = get_field( 'links' );
					if ( $links ) {
						foreach ( $links as $key => $row ) {
							if ( ! empty( $row['link'] ) ) {
								$resource_list_link = $row['link'];
							}
							if ( ! empty( $row['icon'] ) ) {
								$icon = $row['icon']['url'];
							}
							if ( ! empty( $row['manual_link'] ) ) {
								$manual_link      = $row['manual_link'];
								$manual_link_text = $manual_link['title'];
								$manual_link_url  = $manual_link['url'];
							}
							?>

							<?php if ( $row['manual_link'] ) : ?>
							<li class="dropdown-li">
							<a  href="<?php echo esc_url( $manual_link_url ); ?>">
								<?php
								echo $icon ? '<img src="' . esc_url( $icon ) . '" aria-hidden="true" alt="" />' : '';
								echo $manual_link_text ? '<span class="text">' . esc_html( $manual_link_text ) . '</span>' : '';
								?>
							</a>
							</li>
							<?php else : ?>
								<li class="dropdown-li" role="tab" id="button-tab-<?php echo esc_attr( $key ); ?>" data-resourcelink="resource-link-<?php echo esc_attr( $key ); ?>" tabindex="0">
									<img src="<?php echo esc_url( $icon ); ?>" alt="" aria-hidden="true" />
									<?php echo esc_html( $resource_list_link ); ?>
								</li>
							<?php endif; ?>


							<?php
						}
					}
					?>
				</ul>
			</div>

			<?php
			$links = get_field( 'links' );
			if ( $links ) {
				foreach ( $links as $key => $row ) {
					if ( ! empty( $row['icon'] ) ) {
						$icon = $row['icon']['url'];
					}

					if ( ! empty( $row['manual_link'] ) ) {
						$manual_link      = $row['manual_link'];
						$manual_link_text = $manual_link['title'];
						$manual_link_url  = $manual_link['url'];
					}

					?>
					<div class="resource-links-container-links-link ">
						<?php if ( $row['manual_link'] ) : ?>
							<a class="resource-links-container-links-link-button" href="<?php echo esc_url( $manual_link_url ); ?>">
								<?php
								echo $icon ? '<img src="' . esc_url( $icon ) . '" aria-hidden="true" alt="" />' : '';
								echo $manual_link_text ? '<span class="text">' . esc_html( $manual_link_text ) . '</span>' : '';
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


	<div class="resource-links-loop-container">

		<?php
		$links = get_field( 'links' );
		if ( $links ) {
			foreach ( $links as $key => $row ) {
				if ( ! empty( $row['link'] ) ) {
					$loop_container_link = $row['link'];
				}
				if ( ! empty( $row['featured_image'] ) ) {
					$featured_image = $row['featured_image']['url'];
				}

				if ( ! empty( $row['category'] ) ) {
					$category = $row['category'];
				}
				if ( ! empty( $row['selected_posts'] ) ) {
					$selected_posts = $row['selected_posts'];
				}
				if ( 'link' === $row['type_of_button'] ) {
					continue;
				}
				?>
					<div
						id="resource-link-<?php echo esc_attr( $key ); ?>"
						role="tabpanel"
						aria-labelledby="button-tab-<?php echo esc_attr( $key ); ?>"
						class="resource-links-loop-container-item <?php echo 0 === $key ? 'resource-links-loop-container-item--active' : ''; ?>"
					>

						<div class="resource-links-loop-container-content">
							<div class="resource-links-loop-container-content-featured">
								<div class="resource-links-loop-container-content-featured-link">
									<figure>
									<?php if ( ! empty( $featured_image ) ) : ?>
											<img src="<?php echo esc_url( $featured_image ); ?>" alt="Post Featured Image">
										<?php endif; ?>
									</figure>
								</div>
							</div>

							<div class="resource-links-loop-container-content-loop">
								<header class="resource-links-loop-container-header">
									<h3 class="title" tabindex="0"><?php echo esc_html( $loop_container_link ); ?></h3>
								</header>
								<ul class="resource-links-loop-container-content-loop-ul">
							<?php

							if ( $selected_posts ) {

								$args = array(
									'post_type' => 'post',
									'post__in'  => $selected_posts,
									'orderby'   => 'post__in',
								);

							} else {
								$args = array(
									'post_type'      => 'post',
									'posts_per_page' => 3,
									'cat'            => $category,
								);
							}

								$query = new WP_Query( $args );

							if ( $query->have_posts() ) {
								while ( $query->have_posts() ) {
									$query->the_post();

									// Get categories.
									$categories = get_the_category();
									if ( $categories ) {
										$category = $categories[0]->name; // Assuming you want only the first category if there are multiple.
									} else {
										$category = '';
									}

									$post_title       = get_the_title();
									$post_link        = get_the_permalink();
									$author_email     = get_the_author_meta( 'user_email' );
									$author_image_url = get_avatar_url( $author_email, array( 'size' => 96 ) );
									$author_name      = get_the_author();

									?>
											<li class="resource-links-loop-container-content-loop-ul-li">

												<a class="resource-links-loop-container-content-loop-item" href="<?php echo esc_url( $post_link ); ?>">
													<p class="title"><?php echo esc_html( $post_title ); ?></p>
													<div class="author">
														<figure>
													<?php echo '<img src="' . esc_url( $author_image_url ) . '" alt="' . esc_attr( $author_name ) . '">'; ?>
														</figure>
														<div class="author_data">
															By <?php echo esc_html( $author_name ); ?>
														</div>
													</div>
												</a>
											</li>
									<?php
								}
									wp_reset_postdata(); // Reset post data to ensure there's no interference with other loops.
							} else {
								echo 'No posts found for this custom post type.';
							}
							?>
								</ul>
							</div>
						</div>
					</div>
				<?php
			}
		}
		?>
	</div>
</section>
