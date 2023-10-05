<?php
/**
 * vendor-repeater Block Template.
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
$classid = 'vendor-repeater-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block vendor-repeater-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="vendor_repeater_block_container">
		<div class="vendor_repeater_block_container_items">

		<table class="vendor_repeater_block_container_items_table">
			<thead>
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$company_title = get_sub_field( 'company_title' );
							?>
							<th>
								<?php  echo wp_kses_post($company_title); ?>
							</th>
							<?php
						endwhile;
					endif;
					?>
				</tr>
			</thead>
					
			<tbody>


				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$company_logo = get_sub_field( 'company_logo' );
							?>
							<td>
								<h3><img src="<?php  echo wp_kses_post($company_logo['url']); ?>" alt="<?php  echo wp_kses_post($company_logo['alt']); ?>"></h3>
							</td>
							<?php
						endwhile;
					endif;
					?>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$cashback_amount = get_sub_field( 'cashback_amount' );
							?>
							<td>
								<div class="cashback_dollar"><?php echo wp_kses_post($cashback_amount); ?></div>
								<span class="cashback">
								Cashback<a href="#sup_disclosure_<?php echo get_row_index(); ?>" aria-label="Disclosure"><sup><?php echo get_row_index(); ?></sup></a>
								</span>
							</td>
							<?php
						endwhile;
					endif;
					?>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$variable = get_sub_field( 'variable' );
							?>
							<td>
								<div class="title">Variable</div>
								<div class="text"><?php  echo wp_kses_post($variable); ?><a href="#sup_disclosure_<?php echo get_row_index(); ?>"><sup><?php echo get_row_index(); ?></sup></a></div>
							</td>
							<?php
						endwhile;
					endif;
					?>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$fixed = get_sub_field( 'fixed' );
							?>
							<td>
								<div class="title">Fixed</div>
								<div class="text"><?php  echo wp_kses_post($fixed); ?><a href="#sup_disclosure_<?php echo get_row_index(); ?>"><sup><?php echo get_row_index(); ?></sup></a></div>
							</td>
							<?php
						endwhile;
					endif;
					?>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$amount = get_sub_field( 'amount' );
							?>
							<td>
								<div class="text"><?php  echo wp_kses_post($amount); ?><a href="#sup_disclosure_<?php echo get_row_index(); ?>"><sup><?php echo get_row_index(); ?></sup></a></div>
							</td>
							<?php
						endwhile;
					endif;
					?>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					if ( have_rows( 'vendors','option' ) ) :
						while ( have_rows( 'vendors','option' ) ) :
							the_row();
							$link = get_sub_field( 'link' );
							if(!empty($link['url'])):
							?>
							<td>
								<a href="<?php  echo wp_kses_post($link['url']); ?>" class="btn">
								<?php  echo wp_kses_post($link['title']); ?>
							<span class="svg">
							<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M12 8.96667V11C12 11.5523 11.5523 12 11 12H2C1.44771 12 1 11.5523 1 11V2C1 1.44771 1.44772 1 2 1H4.03333" stroke="black" stroke-linecap="round"></path>
											<path d="M3.64132 8.71334C3.44606 8.9086 3.44606 9.22519 3.64132 9.42045C3.83658 9.61571 4.15316 9.61571 4.34843 9.42045L3.64132 8.71334ZM12.5615 1.00023C12.5615 0.724085 12.3377 0.500228 12.0615 0.500228L7.56154 0.500228C7.2854 0.500228 7.06154 0.724086 7.06154 1.00023C7.06154 1.27637 7.2854 1.50023 7.56154 1.50023L11.5615 1.50023L11.5615 5.50023C11.5615 5.77637 11.7854 6.00023 12.0615 6.00023C12.3377 6.00023 12.5615 5.77637 12.5615 5.50023L12.5615 1.00023ZM4.34843 9.42045L12.4151 1.35378L11.708 0.646675L3.64132 8.71334L4.34843 9.42045Z" fill="black"></path>
										</svg>

							</span>
								</a>
							</td>
							<?php
							endif;
						endwhile;
					endif;
					?>
				</tr>

			</tbody>
		</table>


		<?php
		if ( have_rows( 'vendors','option' ) ) :
			while ( have_rows( 'vendors','option' ) ) :
				the_row();
				$company_title = get_sub_field( 'company_title' );
				$company_logo = get_sub_field( 'company_logo' );
				$cashback_amount = get_sub_field( 'cashback_amount' );
				$variable = get_sub_field( 'variable' );

				?>

		<table class="vendor_repeater_block_container_items_table_mobile">
			<thead>
				<tr>
					<th>
						<?php  echo wp_kses_post($company_title); ?>
					</th>
				</tr>
			</thead>
					
			<tbody>
				<!-- tr -->
				<tr>
					<td>
						<h3><img src="<?php  echo wp_kses_post($company_logo['url']); ?>" alt="<?php  echo wp_kses_post($company_logo['alt']); ?>"></h3>
					</td>
				</tr>
				<tr>
					<td>
						<div class="td_container">
						<div class="cashback_dollar"><?php echo wp_kses_post($cashback_amount); ?></div>
						<span class="cashback">
						Cashback<a href="#sup_disclosure_<?php echo get_row_index(); ?>"><sup><?php echo get_row_index(); ?></sup></a>
						</span>
						</div>
					</td>
				</tr>
				

				<!-- tr -->
				<tr>
					<?php
					$fixed = get_sub_field( 'fixed' );
					?>
					<td>
					<div class="td_container">
					<div class="title">Fixed</div>
						<div class="text"><?php  echo wp_kses_post($fixed); ?></div>
					</div>
					</td>
				</tr>
				<!-- tr -->
				<tr>
					<?php
					$amount = get_sub_field( 'amount' );
					?>
					<td>
						<div class="text"><?php  echo wp_kses_post($amount); ?></div>
					</td>
				</tr>
				<!-- tr -->
				<tr>
					<?php $link = get_sub_field( 'link' ); 
					if(!empty($link['url'])):
					?>

					<td>
						<a href="<?php  echo wp_kses_post($link['url']); ?>" class="btn">
							<?php  echo wp_kses_post($link['title']); ?>
							<span class="svg">
							<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 8.96667V11C12 11.5523 11.5523 12 11 12H2C1.44771 12 1 11.5523 1 11V2C1 1.44771 1.44772 1 2 1H4.03333" stroke="black" stroke-linecap="round"></path>
								<path d="M3.64132 8.71334C3.44606 8.9086 3.44606 9.22519 3.64132 9.42045C3.83658 9.61571 4.15316 9.61571 4.34843 9.42045L3.64132 8.71334ZM12.5615 1.00023C12.5615 0.724085 12.3377 0.500228 12.0615 0.500228L7.56154 0.500228C7.2854 0.500228 7.06154 0.724086 7.06154 1.00023C7.06154 1.27637 7.2854 1.50023 7.56154 1.50023L11.5615 1.50023L11.5615 5.50023C11.5615 5.77637 11.7854 6.00023 12.0615 6.00023C12.3377 6.00023 12.5615 5.77637 12.5615 5.50023L12.5615 1.00023ZM4.34843 9.42045L12.4151 1.35378L11.708 0.646675L3.64132 8.71334L4.34843 9.42045Z" fill="black"></path>
							</svg>
							</span>
						</a>
					</td>
					<?php endif; ?>
				</tr>
			</tbody>
		</table>

		<?php
			endwhile;
		endif;
		?>

		</div>
	</div>
</section>
