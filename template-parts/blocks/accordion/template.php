<?php
/**
 * Accordion Block Template.
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
$classid = 'accordion-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block accordion-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="accordion-block-container">
		<div class="accordion-block-container-accordion">
		<?php
		if ( have_rows( 'accordion' ) ) :
			while ( have_rows( 'accordion' ) ) :
				the_row();
				// Get sub-field values.
				$button_title = get_sub_field( 'button_title' );
				$content      = get_sub_field( 'content' );
				?>

				<h3 class="accordion-block-container-accordion__heading">
					<button
					type="button"
					class="accordion-block-container-accordion__button"
					aria-expanded="false"
					aria-controls="a<?php echo wp_kses_post( get_row_index() ); ?>"
					>
					<?php echo wp_kses_post( $button_title ); ?>
					<span class="chevron">
						<svg width="13" height="7" viewBox="0 0 13 7" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M1 0.5L6.50008 6.00008L12.0002 0.5" stroke="#82BC46"/>
						</svg>
					</span>
					</button>
				</h3>
				<div id="a<?php echo wp_kses_post( get_row_index() ); ?>" class="accordion-block-container-accordion__content accordion-block-container-prose">
					<?php echo wp_kses_post( $content ); ?>
				</div>

				<?php
			endwhile;
		endif;
		?>
		</div>
		
	</div>
</section>

<?php
if ( get_field( 'use_schema_data' ) ) : 

	?>
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [
			<?php
			
			$count = count( get_field( 'accordion' ) ); 

			if ( have_rows( 'accordion' ) ) :
				while ( have_rows( 'accordion' ) ) :
					the_row();
					// Get sub-field values.
					$button_title = get_sub_field( 'button_title' );
					$content      = esc_attr( get_sub_field( 'content' ) );

					if ( get_row_index() === $count ) {
						$data_string = "{
							\"@type\": \"Question\",
							\"name\": \"$button_title\",
							\"acceptedAnswer\": {
								\"@type\": \"Answer\",
								\"text\": \"$content\"
							}
						}";
					} else {
						$data_string = "{
						\"@type\": \"Question\",
						\"name\": \"$button_title\",
						\"acceptedAnswer\": {
							\"@type\": \"Answer\",
							\"text\": \"$content\"
						}
				  	},";
					}

					echo wp_kses_post( $data_string );

				
				endwhile;
			endif;
			
			?>
		]
	}
	</script>

<?php endif; ?>
