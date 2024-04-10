<?php
/**
 * Vendor Information Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'vendor-information-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block vendor-information-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// fields.
$company_name     = get_field( 'company_name' );
$logo             = get_field( 'logo' );
$rating           = get_field( 'rating' );
$review_url       = get_field( 'review_url' );
$heading          = get_field( 'heading' );
$features         = get_field( 'features' );
$button_url       = get_field( 'button_url' );
$button_subtext   = get_field( 'button_subtext' );
$more_information = get_field( 'more_information' );
$time_stamp       = time() . wp_rand( 0, 23 );
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">

	<div class="vendor-information-block-container">

		<div class="vendor-information-block-container-column-one">

			<?php if ( $company_name ) { ?>
				<h3 class="screen-reader-text"><?php echo esc_html( $company_name ); ?></h3>
			<?php } ?>

			<div class="vendor-information-block-container-column-one-image">
				<?php
				if ( $logo ) {
					echo wp_get_attachment_image( $logo, 'full' );
				}
				?>
			</div>

			<?php if ( ! empty( $rating ) ) : ?>

			<div class="vendor-information-block-container-column-one-rating">
				<div class="rating">
					<?php $rating ? $rating : $rating = 0; ?>
					<div class="rating-stars">
						<span class="star">
								<?php for ( $i = 0; $i < 5; $i++ ) : ?>
									<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
									</svg>
								<?php endfor; ?>
							<div class="cover" style="width: calc(<?php echo 100 - ( $rating * 20 ); ?>% );"></div>
						</span>
					</div>
				</div>

				<div class="text">
					<?php echo wp_kses_post( $rating ); ?> out of 5
				</div>

			</div>
			<?php endif; ?>

			<?php if ( ! empty( $review_url ) ) : ?>
			<div class="vendor-information-block-container-column-one-read-review">
				<a href="<?php echo wp_kses_post( $review_url ); ?>">
					Read Review
				</a>
			</div>
			<?php endif; ?>
		</div>

		<div class="vendor-information-block-container-column-two">

			<?php if ( $features ) : ?>
			<h4 class="vendor-information-block-container-column-two-title"><?php echo wp_kses_post( $heading ); ?></h4>
			<div class="vendor-information-block-container-column-two-text-repeater">
				<?php
				if ( $features ) {
					echo '<ul>';
					foreach ( $features as $row ) {
						$text = $row['feature'];
						echo '<li>';
							echo wp_kses_post( $text );
						echo '</li>';
					}
					echo '</ul>';
				}
				?>
			</div>
			<?php endif; ?>

			<div class="vendor-information-block-container-column-two-link">
				<?php
				if ( $button_url ) :
					$target = '_blank';
					$title  = ( $company_name ) ? 'Visit ' . $company_name : 'Visit';
					?>
					<a href="<?php echo esc_url( $button_url ); ?>" class="vendor-information-block-container-column-two-link btn" target="<?php echo esc_attr( $target ); ?>">
						<?php
						if ( ! empty( $title ) ) {
							echo wp_kses_post( $title );
						}
						if ( ! empty( $button_subtext ) ) :
							?>
							<span class="subtext">
								<?php echo wp_kses_post( $button_subtext ); ?>
							</span>
						<?php endif; ?>
					</a>
				<?php endif; ?>
				<?php if ( $more_information ) : ?>

					<button
					class="vendor_information_block_container_column_two_link_more_info"
					aria-label="More Information about <?php echo $company_name; ?>"
					aria-expanded="false"
					aria-controls="vendor_information_block_container_column_two_link_more_info-btn-<?php echo $time_stamp; ?>"
					>
						More Information
						<span>
							<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg>
						</span>
					</button>

				<?php endif; ?>
			</div>
		</div>

		<div class="vendor-information-block-container-more-info" hidden id="vendor_information_block_container_column_two_link_more_info-btn-<?php echo $time_stamp; ?>">
			<?php echo wp_kses_post( $more_information ); ?>
		</div>
	</div>
</section>
