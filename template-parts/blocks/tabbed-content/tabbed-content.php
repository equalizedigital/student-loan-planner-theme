<?php

/**
 * tabbed-content block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$id = 'tabbed-content-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$className = 'block tabbed-content-block';
if ( ! empty( $block['className'] ) ) :
	$className .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$className .= ' align' . $block['align'];
endif;

$className = apply_filters( 'loader_block_class', $className, $block, $post_id );
?>

<section id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="tabbed-content__container">
		<div class="tabbed-content__tabs">
			<div class="tabbed-content__row">
				<div class="tabbed-content__row_container">
					<?php
					$rows = get_field( 'tab_content' );
					if ( $rows ) {
						echo '<ul class="tabbed-content__nav-list" role="tablist" aria-label="Tab List">';
						foreach ( $rows as $key => $row ) {
								echo '<li class="tabbed-content__nav-item">';
							?>
								<button 
								data-link="tab-<?php echo $key; ?>" 
								class="
								<?php
								if ( $key === 0 ) {
									echo 'active'; }
								?>
								" 
								type="button" 
								role="tab" 
								tabindex="
								<?php
								if ( $key === 0 ) {
									echo '';
								} else {
									echo '-1';}
								?>
								"
								aria-selected="
								<?php
								if ( $key === 0 ) {
									echo 'true';
								} else {
									echo 'false';}
								?>
								" 
								aria-controls="tab-<?php echo $key; ?>">
									<span class="icon">
										<?php
										if ( $row['tab_icon'] ) :
											?>
											<img src="<?php echo $row['tab_icon']; ?>" alt="<?php echo $row['tab_title']; ?> icon" aria-hidden="true">
											<img src="<?php echo $row['tab_icon_hover_state']; ?>" alt="<?php echo $row['tab_title']; ?> hover state" aria-hidden="true">
										<?php endif; ?>
									</span>
									<div class="text"><?php echo $row['tab_title']; ?></div>
								</button>
								<?php
								echo '</li>';
						}
						echo '</ul>';
					}
					?>
					<button class="tablet_chevron">
					<svg xmlns="http://www.w3.org/2000/svg" width="97" height="91" viewBox="0 0 97 91" fill="none">
						<rect x="97" y="91" width="97" height="91" transform="rotate(-180 97 91)" fill="url(#paint0_linear_1229_724)"/>
						<path d="M76.6211 53.2427L84.2424 45.6213L76.6211 38" stroke="white" stroke-linecap="round"/>
						<defs>
						<linearGradient id="paint0_linear_1229_724" x1="133" y1="117.731" x2="167.5" y2="117.731" gradientUnits="userSpaceOnUse">
							<stop stop-color="#625089"/>
							<stop offset="1" stop-color="#625089" stop-opacity="0"/>
						</linearGradient>
						</defs>
					</svg>
					</button>
				</div>
				
				<div class="tabbed-content__content">

					<?php
					$tabbed_content = get_field( 'tab_content' );
					if ( $tabbed_content ) {
						foreach ( $tabbed_content as $key => $row ) {
							$link = $row['link'];
							?>
							<div 
								role="tabpanel" 
								aria-labelledby="tab-<?php echo $key; ?>" 
								id="tab-<?php echo $key; ?>" 
								class="tabbed-content__content__pane 
								<?php
								if ( $key === 0 ) {
									echo 'tabbed-content__content__pane--active'; }
								?>
								">

								<span class="tabbed-content__content__text">
									<h2>
										<?php echo $row['title']; ?>
									</h2>

									<?php echo $row['text']; ?>

									<div class="link">
										<?php if ( ! empty( $link ) ) : ?>
											<a href="<?php echo $link['url']; ?>" class=" btn "><?php echo $link['title']; ?></a>
										<?php endif; ?>
									</div>
									<div class="review">
										<?php
										if ( ! empty( $row['rating']['url'] ) ) {
											echo '<a href="' . $row['rating']['url'] . '">';
										}
										?>
										<?php 
										if ( ! empty( $row['rating']['title'] ) ) {
											echo $row['rating']['title']; 
										}
										?>
										<?php
										if ( ! empty( $row['rating']['url'] ) ) {
											echo '</a>';
										}
										?>
									</div>
								</span>
								<div class="tabbed-content__content__image">
									<figure>
										<?php if ( ! empty( $row['image'] ) ) : ?>
											<img src="<?php echo $row['image']['url']; ?>" class="tabbed-content__content__image_img" alt="<?php echo $row['title']; ?>">
										<?php endif; ?>
									</figure>
									
									<div class="image_info">
										<?php
										$ctas = $row['ctas'];
										if ( $ctas ) {
											foreach ( $ctas as $key => $row ) {
												if ( $key !== 0 ) {
													continue;}
												?>
												<div class="image_info_item">
													<div class="image_info_item_icon">
														<img src="<?php echo get_template_directory_uri(); ?>/assets/icons/utility/icon-checkmark.svg" alt="check">
													</div>
													<div class="image_info_item_text">
														<?php if ( ! empty( $row['link'] ) ) : ?>
															<a href="<?php echo $row['link']; ?>">
														<?php endif; ?>

														<?php echo $row['text']; ?>

														<?php if ( ! empty( $row['link'] ) ) : ?>
															</a>
														<?php endif; ?>
													</div>
												</div>
												<?php
											}
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
			</div>
		</div>
	</div>
</section>
