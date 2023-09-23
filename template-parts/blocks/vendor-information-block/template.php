<?php
/**
 * Vendor_information_block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block
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
// Load values and assing defaults.
$acf_title         = get_field( 'title' );
$company_name      = get_field( 'company_name' );
$logo              = get_field( 'logo' );
$rating            = get_field( 'rating' );
$review_url        = get_field( 'review_url' );
$heading           = get_field( 'heading' );
$features_list     = get_field( 'features_list' );
$website_url       = get_field( 'website_url' );
$button_subtext    = get_field( 'button_subtext' );
$accordion_content = get_field( 'accordion_content' );

?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="vendor_information_block_container">
		<div class="vendor_information_block_container_column_one">
			<div class="vendor_information_block_container_column_one_image">
				<img src="<?php echo $logo['url']; ?>" alt="">
			</div>
			<div class="vendor_information_block_container_column_one_rating">
				
				<div class="rating">
				<?php 
				$rating?$rating:$rating=0;
				?>
				<div class="rating-stars">
					<span class="star">
							<?php for ($i = 0; $i < 5; $i++): ?>
								<svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M7.77387 0.881322C8.07577 -0.034611 9.37143 -0.0346103 9.67334 0.881322L10.9884 4.8711C11.1236 5.28107 11.5065 5.55805 11.9382 5.55805H16.1631C17.1353 5.55805 17.5357 6.80498 16.7453 7.37105L13.3521 9.80121C12.9966 10.0558 12.8478 10.5119 12.9847 10.9273L14.2866 14.877C14.5894 15.7958 13.5411 16.5663 12.7546 16.003L9.30586 13.5331C8.95773 13.2838 8.48948 13.2838 8.14134 13.5331L4.69265 16.003C3.90614 16.5663 2.8578 15.7958 3.16065 14.877L4.46254 10.9273C4.59944 10.5119 4.4506 10.0558 4.09507 9.80121L0.701879 7.37105C-0.0885191 6.80498 0.311942 5.55805 1.28414 5.55805H5.50903C5.94069 5.55805 6.32363 5.28107 6.45876 4.8711L7.77387 0.881322Z" fill="#F19E3E"/>
								</svg>
							<?php endfor; ?>
							<div class="cover" style="width: calc(<?php echo 100 - ( $rating * 20 ); ?>% );"></div>
					</span>
				</div>
			</div>
			<div class="text">
				<?php  echo wp_kses_post($rating); ?> out of 5
			</div>
			</div>
			<div class="vendor_information_block_container_column_one_read_review">
				<a href="<?php echo wp_kses_post( $review_url ); ?>">
					Read Review 
				</a>
			</div>
		</div>
		<div class="vendor_information_block_container_column_two">
			<h4 class="vendor_information_block_container_column_two_title"><?php echo wp_kses_post( $heading ); ?></h4>
			<div class="vendor_information_block_container_column_two_text_repeater">
				<?php
				$features_list;
				if( $features_list ) {
					echo '<ul>';
					foreach( $features_list as $row ) {
						$text = $row['text'];
						echo '<li>';
							 echo wp_kses_post($text);
						echo '</li>';
					}
					echo '</ul>';
				}
				?>
			</div>
			<div class="vendor_information_block_container_column_two_link">
				<a href="<?php echo wp_kses_post( $website_url['url'] ); ?>" class="vendor_information_block_container_column_two_link btn">
					Visit SoFi
					<span class="svg">
					<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M12 8.96667V11C12 11.5523 11.5523 12 11 12H2C1.44771 12 1 11.5523 1 11V2C1 1.44771 1.44772 1 2 1H4.03333" stroke="black" stroke-linecap="round"/>
						<path d="M3.64132 8.71334C3.44606 8.9086 3.44606 9.22519 3.64132 9.42045C3.83658 9.61571 4.15316 9.61571 4.34843 9.42045L3.64132 8.71334ZM12.5615 1.00023C12.5615 0.724085 12.3377 0.500228 12.0615 0.500228L7.56154 0.500228C7.2854 0.500228 7.06154 0.724086 7.06154 1.00023C7.06154 1.27637 7.2854 1.50023 7.56154 1.50023L11.5615 1.50023L11.5615 5.50023C11.5615 5.77637 11.7854 6.00023 12.0615 6.00023C12.3377 6.00023 12.5615 5.77637 12.5615 5.50023L12.5615 1.00023ZM4.34843 9.42045L12.4151 1.35378L11.708 0.646675L3.64132 8.71334L4.34843 9.42045Z" fill="black"/>
					</svg>
					</span>
					<span class="subtext">
					<?php echo wp_kses_post( $button_subtext ); ?>
					</span>
				</a>
				<button 
				class="vendor_information_block_container_column_two_link_more_info"
				type="button"
				aria-expanded="true"
				aria-controls="vendor_information_block_container_column_two_link_more_info_btn_<?php echo time(); ?>"
				>
					More Information
					<span>
					<svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/>
					</svg>
					</span>
				</button>
			</div>
		</div>
		<div class="vendor_information_block_container_more_info" hidden id="vendor_information_block_container_column_two_link_more_info_btn_<?php echo time(); ?>">
			Payment flexibility and consistently low rates make Earnest a top lender Student Loan Planner® readers use when refinancing student loans. Earnest also services its own loans and has a Rate Match program that matches competitors' contractual interest rates. If you refinance $100,000 or more, you can get a $1000 bonus ($500 Earnest bonus + $500 from Student Loan Planner®). 
			<a href="">*See Earnest disclosures</a>
		</div>
	</div>

</section>
