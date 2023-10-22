<?php
/**
 * tab-block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

// if ( isset( $block['example']['attributes']['data']['preview_image_help'] ) ) :
// esc_attr( Loader_Gutenberg::get_preview_image( $block['example']['attributes']['data']['preview_image_help'], $block['name'] ) );
// return;
// endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'tab-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block tab-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

?>

<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="tab-block-container">
		<div class="tab-block-container-tab-block">

			<div class="tab-block-container-tab-block_header-buttons" role="tablist">
				<?php
				if ( have_rows( 'accordion' ) ) :
					while ( have_rows( 'accordion' ) ) :
						the_row();
						$button_title = get_sub_field( 'button_title' );
						$content      = get_sub_field( 'content' );
						?>

							<button
							type="button"
							class="tab-block-container__heading__button "
							aria-selected="<?php echo get_row_index() === 1? "true":'false'; ?>"
							aria-controls="tab_list_<?php echo wp_kses_post( get_row_index() ); ?>"
							role="tab"
							<?php echo get_row_index() > 1 ? 'tabindex="-1"' : ''; ?>
							>
								<?php echo wp_kses_post( $button_title ); ?>
							</button>

						<?php
					endwhile;
				endif;
				?>
			</div>
			<div class="tab-block-container-tab-block_header-buttons_mobile">
				<select class="tab-block-container-tab-block_header-buttons_mobile_select">
					<?php
					if ( have_rows( 'accordion' ) ) :
						while ( have_rows( 'accordion' ) ) :
							the_row();
							$button_title = get_sub_field( 'button_title' );
							$content      = get_sub_field( 'content' );
							?>

								<option
								class="tab-block-container__heading__button "
								aria-selected="<?php echo get_row_index() === 1? "true":'false'; ?>"
								aria-controls="tab_list_<?php echo wp_kses_post( get_row_index() ); ?>"
								role="tab"
								>
									<?php echo wp_kses_post( $button_title ); ?>
								</option>

							<?php
						endwhile;
					endif;
					?>
				</select>
			</div>
		
			<div class="tab-block-container-tab-block_content">
				<div class="tab-block-container-tab-block_content_items">

				<?php
				if ( have_rows( 'accordion' ) ) :
					while ( have_rows( 'accordion' ) ) :
						the_row();
						?>
						<div
						aria-labelledby="tab_list_<?php echo wp_kses_post( get_row_index() ); ?>"
						role="tabpanel"
						class="tab-block-container-tab-block_content_items_item <?php echo get_row_index() === 1? "active-content":''; ?>"
						id="tab_list_<?php echo wp_kses_post( get_row_index() ); ?>">

							<?php
							if ( have_rows( 'category' ) ) :
								while ( have_rows( 'category' ) ) :
									the_row();
									?>
									<div class="tab-block-container-tab-block_content_items_item_category">
									<?php

									if( get_sub_field( 'title' ) ) {
										echo '<h3 class="tab-block-container-tab-block_content_items_item_category_title">';
											$icon  = get_sub_field( 'icon' );
											if( ! empty( $icon ) ): ?>
												<img src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" aria-hidden="true" />
											<?php endif;
											the_sub_field( 'title' );
										echo '</h3>';
									}

									if ( have_rows( 'podcast_content' ) ) :
										while ( have_rows( 'podcast_content' ) ) :
											the_row();
											$date  = get_sub_field( 'date' );
											$title = get_sub_field( 'title' );
											$url   = get_sub_field( 'url' );
											?>
											<div class="tab-block-container-tab-block_content_items_item_container">
												<a class="tab-block-container-tab-block_content_items_item_container_heading" href="<?php  echo wp_kses_post($url); ?>" aria-label="Listen now to <?php  echo wp_kses_post($title); ?>">
													<div class="tab-block-container-tab-block_content_items_item_container_heading_date">
														<?php  echo wp_kses_post($date); ?>
													</div>
													<div class="tab-block-container-tab-block_content_items_item_container_heading_title">
														<?php  echo wp_kses_post($title); ?>
													</div>
												</a>
												<div class="tab-block-container-tab-block_content_items_item_container_heading_link">
													<a href="<?php  echo wp_kses_post($url); ?>" aria-label="Listen now to <?php  echo wp_kses_post($title); ?>" class="link btn btn-dark-bg">
														Listen Now
													</a>
												</div>
											</div>
											<?php
										endwhile;
									endif;

									?>
									</div>
									<?php
		
								endwhile;
							endif;
							?>
							</div>
						<?php
					endwhile;
				endif;
				?>
				</div>

			</div>

		</div>
	</div>
</section>
