<?php
/**
 * Affiliate Landing block Block Template.
 *
 * @param    array $block The block settings and attributes.
 * @param    string $content The block inner HTML (empty).
 * @param    bool $is_preview True during AJAX preview.
 * @param    (int|string) $post_id The post ID this block is saved to.
 * @package EQD SLP
 */

if ( isset( $block['data']['preview_image_help'] ) ) :
	echo esc_html( Loader_Gutenberg::get_preview_image( $block['data']['preview_image_help'], $block['name'] ) );
	return;
endif;

// Create id attribute allowing for custom 'anchor' value.
$blockid = 'affiliate-landing-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$blockid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block affiliate-landing-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Check if 'slug' is set in the URL parameters.
if ( isset( $_GET['landing_page'] ) ) {  //phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$landing_page = sanitize_text_field( $_GET['landing_page'] );  //phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable, WordPress.Security.NonceVerification.Recommended

	// Query for the page by slug.
	$args       = array(
		'post_type'   => 'slp_landing',
		'post_status' => 'publish',
		'numberposts' => 1,
		'meta_query'  => array(  //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			array(
				'key'     => 'landing_page_url_text',
				'value'   => $page_slug,
				'compare' => '=',
			),
		),
	);
	$page_posts = get_posts( $args );

	// If the page exists, redirect or load the page.
	if ( $page_posts ) {
		$page_id = $page_posts[0]->ID;

		$parameter_page = $page_id;
	}
}

if ( ! isset( $parameter_page ) ) {

	?>
<section id="<?php echo esc_attr( $blockid ); ?>" class="ed_landing_works_editor
						<?php
						if ( empty( $parameter_page ) ) {
							echo 'ed_landing_works_editor_empty'; }
						?>
	<?php echo esc_attr( $class_name ); ?>">
	<div class="ed_landing_works_editor_container">
		<div class="ed_landing_works_editor_container_content">
			<h2 class="heading"><?php echo esc_html( get_field( 'heading' ) ); ?></h2>
			<?php
				echo esc_html( get_field( 'how_does_the_consult_work' ) );
			?>
		</div>


		<?php
		if ( get_field( 'how_does_the_consult_work_youtube_id' ) ) :
			?>
					<div class="ed_landing_works_editor_container_media">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_html( get_field( 'how_does_the_consult_work_youtube_id' ) ); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
					<?php
					endif;
		?>
	</div>
</section>

<?php } ?>
