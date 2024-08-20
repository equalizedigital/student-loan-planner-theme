<?php
/**
 * Vendor_information_block Block Template.
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
	esc_attr( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$classid = 'vendor_information_block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block vendor_information_block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$select_institutional_contact = get_field( 'select_institutional_contact' );
$institution_name             = get_field( 'institution_name', $select_institutional_contact );
$logo                         = get_field( 'company_logo', $select_institutional_contact );
$rating                       = get_field( 'rating', $select_institutional_contact );
$review_url                   = get_field( 'review_url', $select_institutional_contact ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.
$heading                      = get_field( 'heading', $select_institutional_contact );
$website                      = get_field( 'website', $select_institutional_contact ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.
$button_subtext               = get_field( 'button_subtext', $select_institutional_contact ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.
$features_list                = get_field( 'features_list', $select_institutional_contact );
$about                        = get_field( 'about', $select_institutional_contact );
$contact_info                 = get_field( 'contact_info', $select_institutional_contact ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving for future use.
$more_info_content            = get_field( 'more_info_content', $select_institutional_contact );
$show_about                   = get_field( 'show_about' );
$degrees_that_qualify         = get_field( 'degrees_that_qualify', $select_institutional_contact );
$show_states                  = get_field( 'show_states' );
$show_degrees                 = get_field( 'show_degrees' );
$show_contact                 = get_field( 'show_contact' );
$show_feature_list            = get_field( 'show_feature_list' );
$block_id                     = get_field( 'block_id' );
$time_stamp                   = my_acf_block_unique_id() . wp_rand( 0, 23 );

?>
<section id="<?php echo ! empty( $block_id ) ? esc_attr( $block_id ) : esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="vendor_information_block_container">

		<div class="vendor_information_block_container_column_one">

			<div class="vendor_information_block_container_column_one_image">
				<?php if ( ! empty( $logo['url'] ) ) : ?>
				<img src="<?php echo esc_url( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo['alt'] ); ?>">
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $rating ) ) : ?>

			<div class="vendor_information_block_container_column_one_rating">
				<div class="rating">
					<?php $rating ? $rating : $rating = 0; ?>
					<div class="rating-stars">
						<span class="star">
								<?php for ( $i = 0; $i < 5; $i++ ) : ?>
									<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
									</svg>
								<?php endfor; ?>
							<div class="cover" style="width: calc(<?php echo 100 - ( esc_attr( $rating ) * 20 ); ?>% );"></div>
						</span>
					</div>
				</div>

				<div class="text">
					<?php echo wp_kses_post( $rating ); ?> out of 5
				</div>

			</div>
			<?php endif; ?>
		</div>

			<div class="vendor_information_block_container_column_two">
				<h3 class="vendor_information_block_container_column_two_institution_name">
					<?php echo esc_html( $institution_name ); ?>
				</h3>

				<?php if ( $show_about ) : ?>
					<h4 class="vendor_information_block_container_column_two_title">About:</h4>
					<div class="vendor_information_block_container_column_two_text_repeater">
						<?php echo wp_kses_post( $about ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_degrees ) : ?>
					<h4 class="vendor_information_block_container_column_two_title">Degrees that qualify:</h4>
					<div class="vendor_information_block_container_column_two_text_repeater">
						<?php echo wp_kses_post( $degrees_that_qualify ); ?>
						<p>
						<?php
						$post_terms = get_the_terms( $select_institutional_contact, 'slp_eligible_professions' );
						if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
							$num_items = count( $post_terms );
							$i         = 0;
							foreach ( $post_terms as $post_term ) {

								if ( ++$i === $num_items ) {
									echo esc_html( $post_term->name ) . '';
								} else {
									echo esc_html( $post_term->name ) . '<span>,</span> ';
								}
							}
						}
						?>
						</p>
					</div>
				<?php endif; ?>

				<?php if ( $show_states ) : ?>
					<h4 class="vendor_information_block_container_column_two_title">Eligible states:</h4>
					<div class="vendor_information_block_container_column_two_text_repeater">
					<p>
					<?php
						$post_terms = get_the_terms( $select_institutional_contact, 'slp_state' );
					if ( ! empty( $post_terms ) && is_array( $post_terms ) ) {
						$num_items = count( $post_terms );
						$i         = 0;
						foreach ( $post_terms as $post_term ) {
							if ( ++$i === $num_items ) {
								echo '<span>' . esc_html( $post_term->name ) . '</span> ';
							} else {
								echo '<span>' . esc_html( $post_term->name ) . ',</span> ';
							}
						}
					}
					?>
					</p>
					</div>
				<?php endif; ?>

				<?php
				$vendor_title   = get_field( 'title' );
				$vendor_content = get_field( 'content' );
				if ( $vendor_title ) :
					?>
					<h4 class="vendor_information_block_container_column_two_title">
						<?php echo wp_kses_post( $vendor_title ); ?>
					</h4>
					<div class="vendor_information_block_container_column_two_text_repeater">
						<?php echo wp_kses_post( $vendor_content ); ?>
					</div>
				<?php endif; ?>

				<?php if ( $show_contact ) : ?>
					<h4 class="vendor_information_block_container_column_two_title">Contact:</h4>
					<div class="vendor_information_block_container_column_two_text_repeater">
						<a href="<?php echo esc_url( get_the_permalink( $select_institutional_contact ) ); ?>"><?php echo esc_html( get_the_title( $select_institutional_contact ) ); ?></a>
					</div>
				<?php endif; ?>

				<?php if ( $show_feature_list ) : ?>
				<h4 class="vendor_information_block_container_column_two_title"><?php echo wp_kses_post( $heading ); ?></h4>
				<div class="vendor_information_block_container_column_two_text_repeater">
					<?php
					$features_list;
					if ( $features_list ) {
						echo '<ul>';
						foreach ( $features_list as $row ) {
							$text = $row['text'];
							echo '<li>';
								echo wp_kses_post( $text );
							echo '</li>';
						}
						echo '</ul>';
					}
					?>
				</div>
				<?php endif; ?>



				<?php if ( have_rows( 'eligible_states', $select_institutional_contact ) ) : ?>
					<?php
					while ( have_rows( 'eligible_states', $select_institutional_contact ) ) :
						the_row();
						?>
						<h4 class="vendor_information_block_container_column_two_title">
							<?php echo wp_kses_post( get_sub_field( 'heading' ) ); ?>
						</h4>
						<div class="vendor_information_block_container_column_two_text_repeater">
							<?php echo wp_kses_post( get_sub_field( 'content' ) ); ?>
						</div>

					<?php endwhile; ?>
				<?php endif; ?>



				<div class="vendor_information_block_container_column_two_link">

					<?php
					if ( ! empty( get_field( 'review_url', $select_institutional_contact ) ) ) :
						?>
						<a href="<?php echo esc_url( get_field( 'review_url', $select_institutional_contact ) ); ?>" class="vendor_information_block_container_column_two_link btn">
							<?php echo 'Full ' . esc_attr( get_field( 'institution_name', $select_institutional_contact ) ) . ' Review'; ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $more_info_content ) ) : ?>

						<button
						class="vendor_information_block_container_column_two_link_more_info"
						type="button"
						aria-label="More Information about <?php echo esc_attr( get_the_title( $select_institutional_contact ) ); ?>"
						aria-expanded="false"
						aria-controls="vendor_information_block_container_column_two_link_more_info_btn_<?php echo esc_attr( $time_stamp ); ?>"
						>More Information<span>
								<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/></svg>
							</span>
						</button>

					<?php endif; ?>

				</div>
			</div>

			<div class="vendor_information_block_container_more_info" hidden id="vendor_information_block_container_column_two_link_more_info_btn_<?php echo esc_attr( $time_stamp ); ?>">
				<?php echo wp_kses_post( $more_info_content ); ?>
			</div>
	</div>
</section>
