<?php
/**
 * Base template
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

get_header();

$container_class = null;

if ( get_field( 'post_format_style' ) == 'full-width' ) {
	$container_class .= 'site-main-article-content__full-width';
}

tha_content_before();

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'wrap', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		tha_page_header();

		echo '<main class="site-main" role="main">';
			tha_single_header();

			echo "<div class='side-main-article-container'>";
				echo "<div class=\"site-main-article-content $container_class\">";
					tha_content_top();

					if ( get_field( 'post_format_style' ) != 'full-width' ) :
					?>
			
					<span class="hero_featured_image">
						<?php
						$featured_image = get_the_post_thumbnail_url( get_the_ID() );
						if ( $featured_image ) {
							?>
							<?php echo '<img src="' . esc_url( $featured_image ) . '" />'; ?>
						<?php } ?>
						<div class="hero_featured_image_data">
							<?php 
							if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
								$output .= 'Updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
							}
							$post_data = get_the_content(get_the_ID());
							$time_read = estimateReadingTime(esc_html($post_data));

							?>

							<?php echo ($time_read['minutes']); ?> Min Read |  <?php  echo wp_kses_post($output); ?>
						</div>
					</span>

					<div class="site-main-article__author-data">
						<div class="article_author">
							<?php
							$id = get_field( 'post_reviewed_by', get_the_ID() );

							$author_info = get_field( 'job_title' , "user_$id" );

							?>
							<span class="entry-author">
								<a href="<?php echo esc_url( get_author_posts_url( $id ) ); ?>" aria-hidden="true" tabindex="-1">
									<?php echo get_avatar( $id, 40 ); ?>
								</a>
								<span class="entry-info">
									<span>
										Written By <a href="<?php echo wp_kses_post( esc_url( get_author_posts_url( $id ) ) ); ?>">
										<?php echo get_the_author(); ?></a>
									</span>
									<span class="entry-data">
										<?php
										echo wp_kses_post( $author_info );
										?>
									</span>
								</span>
							</span>
						</div>
						<div class="reviewed_author">
							<?php
							$review_by_auth_id = get_field( 'post_reviewed_by', get_the_ID() );
							$profile_picture   = get_avatar( $review_by_auth_id, 64 );
							$user_info         = get_userdata( $review_by_auth_id );
							$first_name        = $user_info->first_name;
							$last_name         = $user_info->last_name;
							$nickname          = $user_info->nickname;
							?>
							<div class="profile">
								<?php echo $profile_picture; ?>
							</div>
							<div class="author_info">
							<?php
							if ( $first_name && $last_name ) {
								echo $first_name . ' ' . $last_name;
							} else {
								echo $nickname;
							}
							?>
							</div>
						</div>
					</div>

					<section class="site-main-article__author-data-editorial_statement">
						<div class="site-main-article__author-data-editorial_statement-container">
							<div class="site-main-article__author-data-editorial_statement-container__title"><h2>Editorial Ethics at Student Loan Planner</h2></div>
							<div class="site-main-article__author-data-editorial_statement-container__copy">
								<p>
								At Student Loan Planner, we follow a strict <a href="">editorial ethics policy</a>. This post may contain references to products from our partners within the guidelines of this policy. Read our 
								<button class="modal-btn btn-style-link" data-modal="modal_disclosure" aria-label="Open Modal">advertising disclosure</button> to learn more.
								</p>
							</div>
						</div>
					</section>
			
					<?php
					endif;

					tha_content_loop();
					tha_content_bottom();
				echo '</div>';

				// Standard Format.
				if ( get_field( 'post_format_style' ) != 'full-width' ) :
					// get_sidebar();
					echo "Share: ". do_shortcode('[shared_counts]');
				endif;
			echo '</div>';

		echo '</main>';

		tha_content_wrap_after();
	echo '</div>';



tha_content_after();

?>

<?php 
$disclosure_content = get_field('advertising_disclosure', 'option');
?>
<div id="modal_disclosure" class="modal team-hightlight-block-modal" role="dialog" aria-modal="true">
	<div class="modal-content" >
	<button class="close-btn">
		<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
	</button>
		<div class="modal_copy">
			<div class="modal_copy_text">
				<span class="modal_copy_title">
				<?php   echo wp_kses_post($disclosure_content['title']); ?>
				</span>
				<span class="modal_copy_content">
				<?php   echo wp_kses_post($disclosure_content['copy']); ?>
				</span>
			</div>
		</div>
	</div>
	</div>
</div>
<?php

get_footer();
