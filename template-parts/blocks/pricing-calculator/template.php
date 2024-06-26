<?php
/**
 * Pricing Calculator Template.
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

$block_name = 'pricing_calculator_template';

if ( isset( $block['data']['preview_image_help'] ) ) :
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$block_id = $block_name . '-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$block_id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block ' . $block_name;
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
$cta_link   = get_field( 'cta_link' );
?>


	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="pricing_calculator_template_container">
			<!--  -->
			<div id="accordionGroup" class="pricing_calculator_accordion">

			<?php if ( have_rows( 'services' ) ) : ?>
				<?php
				while ( have_rows( 'services' ) ) :
					the_row();
					$row_index      = get_row_index();
					$service_title  = get_sub_field( 'title' );
					$description    = get_sub_field( 'description' );
					$video          = get_sub_field( 'video' );
					$price          = get_sub_field( 'price' );
					$enrollment_fee = get_sub_field( 'enrollment_fee' );
					$disclaimer     = esc_html( get_sub_field( 'disclaimer' ) );
					$benefits       = get_sub_field( 'benefits', false, false );
					if ( 1 === $row_index ) :
						?>
						<h3 class="screen-reader-text">Financial Planning</h3>
						<div class="pricing_calculator_template_container_main" id="pricing_calculator_template_container_main_init">
							<div class="pricing_calculator_template_container_main_pricing"  >
								<div class="pricing_calculator_template_container_main_pricing_price" >
									<div class="large_set">$<span class="price"><?php echo wp_kses_post( $price ); ?></span></div>
									<span>/month <sup aria-hidden="true">1</sup></span>
								</div>
								<div class="pricing_calculator_template_container_main_pricing_plus">+</div>
								<div class="pricing_calculator_template_container_main_pricing_info">
									<span class="info_set">$<span class="info_set_number"><?php echo wp_kses_post( $enrollment_fee ); ?></span></span> enrollment fee
								</div>
								<div class="pricing_calculator_template_container_main_pricing_disclaimer"></div>
							</div>
							<div class="pricing_calculator_template_container_main_info">
								<div class="pricing_calculator_template_container_main_info_title">At this pricing, you’re getting:</div>
								<div class="pricing_calculator_template_container_main_info_ul">
										<?php
										if ( $benefits ) {
											// Split the content by line breaks into an array.
											$lines = explode( "\n", strip_tags( $benefits, '<br><li><ul><ol>' ) ); // phpcs:ignore WordPressVIPMinimum.Functions.StripTags.StripTagsTwoParameters -- Allow tags in the content.

											echo '<ul>';
											foreach ( $lines as $line ) {
												// Trim the line to remove whitespace and then check if it's not empty.
												$line = trim( $line );
												if ( ! empty( $line ) ) {
													echo '<li>' . esc_html( $line ) . ' </li>';
												}
											}
											echo '</ul>';
										}
										?>
								</div>
								<div class="pricing_calculator_template_container_main_info_started">
									<?php
									$cta_link = get_field( 'cta_link' );
									if ( $cta_link ) :
										?>
										<a href="<?php echo esc_url( $cta_link['url'] ); ?>" class="btn btn-dark-bg"><?php echo esc_html( $cta_link['title'] ); ?></a>
									<?php endif; ?>

								</div>
							</div>
						</div>
						<!-- Screen Reader Announcements Div -->
						<div id="aria-read" aria-live="polite" aria-atomic="true" style="position: absolute; left: -9999px; width: 1px; height: 1px; overflow: hidden;">
							<!-- Dynamic content changes will be announced by screen readers when updated here -->
						</div>
						<h3 class="heading">Add Additional Services:</h3>

						<?php
				else :
					if ( $benefits ) {
						$old_benefits = $benefits;
						$benefits     = '';
						// Split the content by line breaks into an array.
						$lines = explode( "\n", strip_tags( $old_benefits, '<br><li><ul><ol>' ) ); // phpcs:ignore WordPressVIPMinimum.Functions.StripTags.StripTagsTwoParameters -- Allow tags in the content.

						foreach ( $lines as $line ) {
							// Trim the line to remove whitespace and then check if it's not empty.
							$line = trim( $line );
							if ( ! empty( $line ) ) {
								$benefits .= "<li data-unique-id='benefits_" . esc_attr( $block_id . '_' . $row_index ) . "'>" . esc_html( $line ) . '</li>';
							}
						}
					}
					?>

				<div class="pricing_calculator_accordion_item">
					<div class="pricing_calculator_accordion_item_title">
						<button
						class="pricing_calculator_accordion_add"
						data-price="<?php echo wp_kses_post( $price ); ?>"
						data-enrollment="<?php echo wp_kses_post( $enrollment_fee ); ?>"
						data-disclaimer="<?php echo esc_attr( $disclaimer ); ?>"
						data-benefits="<?php echo esc_attr( $benefits ); ?>"
						data-added="false"
						data-unique-id="benefits_<?php echo esc_attr( $block_id . '_' . $row_index ); ?>"
						aria-pressed="false"
						aria-label="Add Service <?php echo wp_kses_post( $service_title ); ?>">
							<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/'; ?>add.svg" alt="add">
						</button>
						<h4 class="pricing_calculator_accordion-trigger_heading">
							<button type="button" aria-expanded="<?php echo esc_attr( $row_index ) > 2 ? 'false' : 'true'; ?>" class="pricing_calculator_accordion-trigger" aria-controls="sect<?php echo esc_attr( get_row_index() ); ?>" id="pricing_calculator_accordion<?php echo esc_attr( get_row_index() ); ?>">
								<span class="pricing_calculator_accordion-title">
									<?php echo wp_kses_post( $service_title ); ?>
									<span class="pricing_calculator_accordion-icon">
									</span>
								</span>
							</button>
						</h4>
					</div>
					<div id="sect<?php echo esc_attr( get_row_index() ); ?>" role="region" aria-labelledby="pricing_calculator_accordion<?php echo esc_attr( get_row_index() ); ?>" class="pricing_calculator_accordion-panel" <?php echo $row_index > 2 ? 'hidden' : ''; ?>>
						<div class="pricing_calculator_accordion-panel_content <?php echo empty( $video ) ? 'no-video' : ''; ?>">
							<div class="pricing_calculator_accordion-panel_content_left">
								<div class="title">
									<?php echo wp_kses_post( $disclaimer ); ?>
								</div>
								<div class="content">
									<?php echo wp_kses_post( $description ); ?>
								</div>

								<button
								class="action btn"
								data-price="<?php echo wp_kses_post( $price ); ?>"
								data-enrollment="<?php echo wp_kses_post( $enrollment_fee ); ?>"
								data-disclaimer="<?php echo esc_attr( $disclaimer ); ?>"
								data-benefits="<?php echo esc_attr( $benefits ); ?>"
								data-added="false"
								data-unique-id="benefits_<?php echo esc_attr( $block_id . '_' . $row_index ); ?>"
								aria-pressed="false"
								aria-label="Add Service <?php echo wp_kses_post( $service_title ); ?>"
								>
									Add Service
								</button>

								<a href="#pricing_calculator_template_container_main_init" class="btn">
									Go to Pricing
								</a>
							</div>
							<div class="pricing_calculator_accordion-panel_content_right">
								<?php
								echo wp_kses_post( $video );
								?>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>


				<?php endwhile; ?>
			<?php endif; ?>
			</div>
		</div>
	</section>
