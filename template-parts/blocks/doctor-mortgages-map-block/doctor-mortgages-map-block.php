<?php

/**
 * Doctor mortgages map block
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
$id = 'doctor-mortgages-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$id = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block doctor-mortgages-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;
if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name     = apply_filters( 'loader_block_class', $class_name, $block, $post_id );
$coalition_map = new RqD_Doctor_Map();

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="doctor-mortgages-block-wrap">
		<div class="doctor-mortgages-block-main">
			<h2>
			<?php _e( 'Doctor Mortgages by State', 'eqd' ); ?>
			</h2>
			<p class="doctor-mortgages-block-text">
			Click on your state in the map below to see which bankers offer special doctor mortgage programs for your MD, DO, DDS, or DMD degree. Some banks might offer programs for PharmD, DC, DPM and DVM degree holders as well. Send them an email to get the details about their programs so you can get pre-approved for your next mortgage to buy the house of your dreams.
			</p>
			<?php echo $coalition_map->map(); ?>
		</div>
		<div class="doctor-mortgages-block-sidebar">
			<?php echo $coalition_map->states_select(); ?>
			<div class="doctor-mortgages-block-results-container" aria-live="polite"></div>
		</div>
	</div>

</div>