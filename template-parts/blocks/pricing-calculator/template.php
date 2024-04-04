<?php
/**
 * Pricing Calculator Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package Block Title Template
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

$class_name         = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
?>


	<section id="<?php echo esc_attr( $block_id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
		<div class="pricing_calculator_template_container">
			<!--  -->
			<div id="accordionGroup" class="pricing_calculator_accordion">

			<?php if ( have_rows( 'services' ) ) : ?>
				<?php while ( have_rows( 'services' ) ) :
					the_row();
					$row_index = get_row_index();
					$title = get_sub_field( 'title' );
					$description = get_sub_field( 'description' );
					$video =	get_sub_field( 'video' );
					$price = get_sub_field( 'price' );
					$enrollment_fee = get_sub_field( 'enrollment_fee' );
					$disclaimer = esc_html( get_sub_field( 'disclaimer' ) );
					$benefits = get_sub_field( 'benefits' );




					if($row_index === 1): ?>
						<h3 class="screen-reader-text">Financial Planning</h3>
						<div class="pricing_calculator_template_container_main" aria-live="polite" aria-atomic="true" aria-relevant="additions text">
							<div class="pricing_calculator_template_container_main_pricing">
								<div class="pricing_calculator_template_container_main_pricing_price">
									<div class="large_set">$<span class="price"><?php  echo wp_kses_post($price); ?></span></div> <span>/month <sup>1</sup></span>
								</div>
								<div class="pricing_calculator_template_container_main_pricing_plus">+</div>
								<div class="pricing_calculator_template_container_main_pricing_info">
									<span class="info_set">$<span class="info_set_number"><?php  echo wp_kses_post($enrollment_fee); ?></span></span> enrollment fee
								</div>
								<div class="pricing_calculator_template_container_main_pricing_disclaimer"></div>
							</div>
							<div class="pricing_calculator_template_container_main_info">
								<div class="pricing_calculator_template_container_main_info_title">At this pricing, you’re getting:</div>
								<div class="pricing_calculator_template_container_main_info_ul">
									<?php  echo wp_kses_post($benefits); ?>
								</div>
								<div class="pricing_calculator_template_container_main_info_started">
									<a class="btn btn-dark-bg" href="calendly.com" target="_blank">Get Started</a>
								</div>
							</div>
						</div>
						<div class="heading">Add Additional Services:</div>

				<?php else : ?>

				<div class="pricing_calculator_accordion_item">
					<div class="pricing_calculator_accordion_item_title">
						<button
						class="pricing_calculator_accordion_add"
						data-price="<?php echo wp_kses_post($price); ?>"
						data-enrollment="<?php echo wp_kses_post($enrollment_fee); ?>"
						data-disclaimer="<?php echo esc_attr($disclaimer); ?>"
						data-benefits="<?php echo esc_attr($benefits); ?>"
						data-added="false"
						data-unique-id="benefits_<?php echo esc_attr( $block_id . '_' . $row_index ); ?>"
						aria-pressed="false"
						aria-label="add service">
							<img src="<?php echo get_template_directory_uri() . '/assets/images/'; ?>add.svg" alt="add">
						</button>
						<button type="button" aria-expanded="<?php echo$row_index>2? 'false':'true'; ?>" class="pricing_calculator_accordion-trigger" aria-controls="sect<?php echo get_row_index(); ?>" id="pricing_calculator_accordion<?php echo get_row_index(); ?>">
							<span class="pricing_calculator_accordion-title">
								<?php  echo wp_kses_post($title); ?>
								<span class="pricing_calculator_accordion-icon">
								</span>
							</span>
						</button>
					</div>
					<div id="sect<?php echo get_row_index(); ?>" role="region" aria-labelledby="pricing_calculator_accordion<?php echo get_row_index(); ?>" class="pricing_calculator_accordion-panel" <?php echo$row_index>2? 'hidden':''; ?>>
						<div class="pricing_calculator_accordion-panel_content <?php echo empty($video)? "no-video":''; ?>">
							<div class="pricing_calculator_accordion-panel_content_left">
								<div class="title">
									<?php echo wp_kses_post($disclaimer); ?>
								</div>
								<div class="content">
									<?php  echo wp_kses_post($description); ?>
								</div>

								<button
								class="action btn"
								data-price="<?php echo wp_kses_post($price); ?>"
								data-enrollment="<?php echo wp_kses_post($enrollment_fee); ?>"
								data-disclaimer="<?php echo esc_attr($disclaimer); ?>"
								data-benefits="<?php echo esc_attr($benefits); ?>"
								data-added="false"
								data-unique-id="benefits_<?php echo esc_attr( $block_id . '_' . $row_index ); ?>"
								aria-pressed="false"
								aria-label="Add Service <?php echo wp_kses_post($title); ?>"
								>
									Add Service
								</button>
							</div>
							<div class="pricing_calculator_accordion-panel_content_right">
								<?php
								echo ($video); ?>
							</div>
						</div>
					</div>
				</div>

				<?php endif; ?>


				<?php endwhile; ?>
			<?php endif; ?>
			</div>
			<!--  -->
		</div>
	</section>



<script>
	/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *
 *   Simple accordion pattern example
 */

'use strict';

class Accordion {
  constructor(domNode) {
    this.rootEl = domNode;
    this.buttonEl = this.rootEl.querySelector('button[aria-expanded]');

    const controlsId = this.buttonEl.getAttribute('aria-controls');
    this.contentEl = document.getElementById(controlsId);

    this.open = this.buttonEl.getAttribute('aria-expanded') === 'true';

    // add event listeners
    this.buttonEl.addEventListener('click', this.onButtonClick.bind(this));
  }

  onButtonClick() {
    this.toggle(!this.open);
  }

  toggle(open) {
    // don't do anything if the open state doesn't change
    if (open === this.open) {
      return;
    }

    // update the internal state
    this.open = open;

    // handle DOM updates
    this.buttonEl.setAttribute('aria-expanded', `${open}`);
    if (open) {
      this.contentEl.removeAttribute('hidden');
    } else {
      this.contentEl.setAttribute('hidden', '');
    }
  }

  // Add public open and close methods for convenience
  open() {
    this.toggle(true);
  }

  close() {
    this.toggle(false);
  }
}

// init accordions
const accordions = document.querySelectorAll('.pricing_calculator_accordion .pricing_calculator_accordion_item_title');
accordions.forEach((accordionEl) => {
  new Accordion(accordionEl);
});

</script>

<script>

function addData($this) {
    var dataprice = parseInt($this.data('price'), 10);
    var dataenrollment = parseInt($this.data('enrollment'), 10);
    var dataBenefits = $this.data('benefits');
    var dataDisclaimer = $this.data('disclaimer');
	var uniqueId = $this.data('unique-id');

    var $targetPrice = jQuery('.large_set .price');
    var $targetenrollment = jQuery('.info_set_number');
    var benefitsData = jQuery('.pricing_calculator_template_container_main_info_ul');
    var disclaimerData = jQuery('.pricing_calculator_template_container_main_pricing_disclaimer');

    var currentPrice = parseInt($targetPrice.text(), 10);
    var currentEnrollment = parseInt($targetenrollment.text(), 10);

    $targetPrice.text(currentPrice + dataprice);
    $targetenrollment.text(currentEnrollment + dataenrollment);
	benefitsData.append('<span data-unique-id="' + uniqueId + '">' + dataBenefits + '</span>');
	disclaimerData.append('<span data-unique-id="' + uniqueId + '">' + dataDisclaimer + '</span>');
}

function removeData($this) {
    var dataprice = parseInt($this.data('price'), 10);
    var dataenrollment = parseInt($this.data('enrollment'), 10);
    var dataBenefits = $this.data('benefits');
    var dataDisclaimer = $this.data('disclaimer');
	var uniqueId = $this.data('unique-id');

    var $targetPrice = jQuery('.large_set .price');
    var $targetenrollment = jQuery('.info_set_number');
    var benefitsData = jQuery('.pricing_calculator_template_container_main_info_ul');
    var disclaimerData = jQuery('.pricing_calculator_template_container_main_pricing_disclaimer');

    var currentPrice = parseInt($targetPrice.text(), 10);
    var currentEnrollment = parseInt($targetenrollment.text(), 10);

    $targetPrice.text(currentPrice - dataprice);
    $targetenrollment.text(currentEnrollment - dataenrollment);

	benefitsData.find('[data-unique-id="' + uniqueId + '"]').remove();
	disclaimerData.find('[data-unique-id="' + uniqueId + '"]').remove();
}

jQuery('.action, .pricing_calculator_accordion_add').on('click', function() {
    var $this = jQuery(this);
    var dataAdded = $this.data('added');
	var pricing_calculator_accordion_item = $this.closest('.pricing_calculator_accordion_item');

    if (dataAdded) {
        $this.data('added', false).attr('data-added', 'false');
		jQuery(pricing_calculator_accordion_item).removeClass('pricing_calculator_accordion_add_active');
        removeData($this);

		$this.closest('.pricing_calculator_accordion_item').find('.action').text('Add Service');
    } else {
        $this.data('added', true).attr('data-added', 'true');
        addData($this);
		jQuery(pricing_calculator_accordion_item).addClass('pricing_calculator_accordion_add_active');
		$this.closest('.pricing_calculator_accordion_item').find('.action').text('Remove Service');
    }

    // Toggle 'pressed' state for visual feedback or other uses
    $this.attr('pressed', !$this.attr('pressed'));
});


</script>
