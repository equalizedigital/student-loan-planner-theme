<?php
/**
 * Team Hightlight Block Template.
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
$classid = 'team-hightlight-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) :
	$classid = $block['anchor'];
endif;

// Create class attribute allowing for custom 'className' and 'align' values.
$class_name = 'block team-hightlight-block';
if ( ! empty( $block['className'] ) ) :
	$class_name .= ' ' . $block['className'];
endif;

if ( ! empty( $block['align'] ) ) :
	$class_name .= ' align' . $block['align'];
endif;

$class_name = apply_filters( 'loader_block_class', $class_name, $block, $post_id );

// Load values and assing defaults.
$acf_title                   = get_field( 'title' );
$acf_use_alternative_styling = get_field( 'use_alternative_styling' );

if ( ! empty( $acf_use_alternative_styling ) ) :
	$class_name .= ' team-hightlight-block-styling-' . $acf_use_alternative_styling;
endif;
?>
<section id="<?php echo esc_attr( $classid ); ?>" class="<?php echo esc_attr( $class_name ); ?>">
	<div class="team-hightlight-block-container">

		<header class="team-hightlight-block-container-header">
			<h2 class="team-hightlight-block-container-header__title"><?php echo esc_attr( $acf_title ); ?></h2>
		</header>

		<ul class="team-hightlight-block-container-team-hightlight">
			<?php
			$number_of_items = 0;
			if ( have_rows( 'team' ) ) :

				// Loop through rows.
				while ( have_rows( 'team' ) ) :
					the_row();
					$member = get_sub_field( 'member' );
					$author = get_field('post_author',$member->ID);
					$author_id  =$author->ID;
					?>
					<li class="team-hightlight-block-container-team-hightlight-member 
					<?php
					if ( get_row_index() > 4 ) {
						echo 'hidden'; }
					?>
					" 
					>

					
						<?php if ( ! empty( $acf_use_alternative_styling ) ) : ?>
							<?php if ( ! empty( $author_id ) ) : ?>
								<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" class="team-hightlight-block-container-team-hightlight-member__button">
							<?php else: ?>
								<button class="team-hightlight-block-container-team-hightlight-member__button modal-btn" data-modal="modal<?php echo get_row_index(); ?>" aria-label="Open Video">
							<?php endif; ?>
						<?php endif; ?>
						
							<figure class="team-hightlight-block-container-team-hightlight-member__photo">
								<?php
								$thumbnail_id = get_post_thumbnail_id( $member->ID );
								if ( $thumbnail_id ) {
									$image_url          = wp_get_attachment_image_src( $thumbnail_id, 'full' );
									$featured_image_url = $image_url[0];
									echo wp_kses_post( '<img src="' . $featured_image_url . '" alt="' . get_the_title( $member->ID ) . '">' );
								}
								?>
							</figure>
							<div class="team-hightlight-block-container-team-hightlight-member__content">
								<span class="title"><?php echo wp_kses_post( get_the_title( $member->ID ) ); ?></span>
								<span class="job"><?php the_field( 'job_title', $member->ID ); ?></span>
							</div>

							<?php if ( ! empty( $acf_use_alternative_styling ) ) : ?>
								<?php if ( ! empty( $author_id ) ) : ?>
									</a>
								<?php else: ?>
									</button>
								<?php endif; ?>
							<?php endif; ?>
					</li>
					<?php
					// End loop.
					++$number_of_items;
				endwhile;

			endif;
			?>
		</ul>
		<?php if ( empty( $acf_use_alternative_styling ) ) : ?>
		<div class="team-hightlight-block-container-team-hightlight__load_more">
			<button class="load">
				<div class="text">Show All <?php echo wp_kses_post( $number_of_items ); ?></div>
				<span class="arrow">
					<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
						<path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46"/>
					</svg>
				</span>
			</button>
		</div>
		<?php endif; ?>
		
	</div>
</section>


<?php
if ( have_rows( 'team' ) ) :

	// Loop through rows.
	while ( have_rows( 'team' ) ) :
		the_row();
		$member = get_sub_field( 'member' );
		?>
		<div id="modal<?php echo wp_kses_post( get_row_index() ); ?>" class="modal team-hightlight-block-modal" role="dialog" aria-modal="true">
			<div class="modal-content" >
			<button class="close-btn">
				<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
			</button>
				<div class="modal_content">
					<div class="modal_image">
						<figure>
							<?php
								$thumbnail_id = get_post_thumbnail_id( $member->ID );
								if ( $thumbnail_id ) {
									$image_url          = wp_get_attachment_image_src( $thumbnail_id, 'full' );
									$featured_image_url = $image_url[0];
									echo wp_kses_post( '<img src="' . $featured_image_url . '" alt="' . get_the_title( $member->ID ) . '">' );
								}
								?>
						</figure>
					</div>
					<div class="modal_text">
						<span class="title">
							<?php echo wp_kses_post( $member->post_title ); ?>
						</span>
						<span class="job">
							<?php the_field( 'job_title', $member->ID ); ?>
						</span>
						<span class="content">
							<?php echo wp_kses_post( $member->post_content ); ?>
						</span>
					</div>
				</div>
			</div>
			</div>
		</div>

		<?php
	endwhile;
endif;
?>