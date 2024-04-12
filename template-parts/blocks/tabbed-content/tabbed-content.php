<?php
/**
 * Tabbed-content block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package slp
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo wp_kses_post( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = 'tabbed-content-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block tabbed-content-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
?>

<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
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
								data-link="tab-<?php echo esc_attr( $key ); ?>"
								class="
								<?php
								if ( 0 === $key ) {
									echo 'active'; }
								?>
								"
								type="button"
								role="tab"
								tabindex="
								<?php
								if ( 0 === $key ) {
									echo '';
								} else {
									echo '-1';}
								?>
								"
								aria-selected="
								<?php
								if ( 0 === $key ) {
									echo 'true';
								} else {
									echo 'false';}
								?>
								"
								aria-controls="tab-<?php echo esc_attr( $key ); ?>">
									<span class="icon">
										<?php
										if ( $row['tab_icon'] ) :
											?>
											<img src="<?php echo esc_url( $row['tab_icon'] ); ?>" alt="<?php echo esc_attr( $row['tab_title'] ); ?> icon" aria-hidden="true">
											<img src="<?php echo esc_url( $row['tab_icon_hover_state'] ); ?>" alt="<?php echo esc_attr( $row['tab_title'] ); ?> hover state" aria-hidden="true">
										<?php endif; ?>
									</span>
									<div class="text"><?php echo wp_kses_post( $row['tab_title'] ); ?></div>
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
							$tab_link = $row['link'];
							?>
							<div
								role="tabpanel"
								aria-labelledby="tab-<?php echo esc_attr( $key ); ?>"
								id="tab-<?php echo esc_attr( $key ); ?>"
								class="tabbed-content__content__pane
								<?php
								if ( 0 === $key ) {
									echo 'tabbed-content__content__pane--active'; }
								?>
								">

								<span class="tabbed-content__content__text">
									<h2>
										<?php echo wp_kses_post( $row['title'] ); ?>
									</h2>

									<?php echo wp_kses_post( $row['text'] ); ?>

									<div class="link">
										<?php if ( ! empty( $tab_link ) ) : ?>
											<a href="<?php echo esc_url( $tab_link['url'] ); ?>" class=" btn "><?php echo wp_kses_post( $tab_link['title'] ); ?></a>
										<?php endif; ?>
									</div>
									<div class="review">
										<?php
										if ( ! empty( $row['rating']['url'] ) ) {
											echo wp_kses_post( '<a href="' . $row['rating']['url'] . '">' );
										}
										?>
										<?php
										if ( ! empty( $row['rating']['title'] ) ) {
											echo wp_kses_post( $row['rating']['title'] );
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
											<img src="<?php echo esc_url( $row['image']['url'] ); ?>" class="tabbed-content__content__image_img" alt="<?php echo esc_attr( $row['title'] ); ?>">
										<?php endif; ?>
									</figure>

									<div class="image_info">
										<?php
										$ctas = $row['ctas'];
										if ( $ctas ) {
											foreach ( $ctas as $key => $row ) {
												if ( 0 !== $key ) {
													continue;
												}
												?>
												<div class="image_info_item">
													<div class="image_info_item_icon">
														<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/icons/utility/icon-checkmark.svg" alt="check">
													</div>
													<div class="image_info_item_text">
														<?php if ( ! empty( $row['link'] ) ) : ?>
															<a href="<?php echo esc_url( $row['link'] ); ?>">
														<?php endif; ?>

														<?php echo wp_kses_post( $row['text'] ); ?>

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
