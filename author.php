<?php
/**
 * Single Author
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Entry Header.
add_action( 'eqd_entry_title_after', 'eqd_entry_author', 12 );
add_action( 'eqd_entry_title_after', 'eqd_entry_date', 12 );


$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug', $author_name ) : get_userdata( intval( $author ) );

$idf = get_user_meta( $curauth->ID );

// Build the page.
get_header();

tha_content_before();

	echo '<div class="' . esc_attr( eqd_class( 'content-area', 'container-fluid', apply_filters( 'eqd_content_area_wrap', true ) ) ) . '">';
		tha_content_wrap_before();

		echo '<main class="site-main" role="main">'; ?>

			<header class="contact-hero hero-author">
				<div class="contact-hero-container">
					<figure class="contact-hero-container__image">
						<?php $avatar_url = get_avatar_url($curauth->ID, array("size"=>360)); ?>
						<img src="<?php echo $avatar_url; ?>" alt="<?php echo wp_kses_post( $curauth->display_name ); ?>">
					</figure>
					<div class="contact-hero-container__content">
						<h1 class="entry-title">
							<?php echo wp_kses_post( $curauth->display_name ); ?>
						</h1>
						<span class="info">
							<?php the_field( 'job_title', 'user_' . $curauth->ID ); ?>
						</span>
						<?php
						if ( ! empty( get_field( 'consult_link', 'user_' . $curauth->ID ) ) ) :
							$link = get_field( 'consult_link', 'user_' . $curauth->ID );
							?>
						<div class="info_link">
						<a href="<?php echo wp_kses_post( $link['url'] ); ?>" class="btn btn-dark-bg"><?php echo wp_kses_post( $link['title'] ); ?></a>
						</div>
						<?php endif; ?>
						
					</div>
				</div>
			</header>

			<?php
			echo '<div class="site-main-article-content">';
				tha_content_top();
			?>
				<div class="slp-contact-info author-info">
					
					<div class="slp-contact-info-details">
						<?php if(!empty( get_user_meta( $curauth->ID, 'twitter', true ) ) || !empty( get_user_meta( $curauth->ID, 'linkedin', true )) ): ?>
						<div class="author-info_entry-author_titles">
							<ul class="author_socials">
								<?php
								if ( ! empty( get_user_meta( $curauth->ID, 'twitter', true ) ) ) { ?>
									<li>
										<a href="https://twitter.com/<?php echo wp_kses_post( get_user_meta( $curauth->ID, 'twitter', true ) ); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
												<path d="M16 2.13735C15.4138 2.37735 14.7777 2.54075 14.1141 2.61224C14.7943 2.23948 15.3142 1.64203 15.5576 0.937348C14.9215 1.28458 14.2191 1.53479 13.4725 1.67267C12.8752 1.08543 12.0235 0.717773 11.0778 0.717773C9.26374 0.717773 7.79813 2.07607 7.79813 3.74586C7.79813 3.98586 7.82579 4.21565 7.88109 4.43522C5.15451 4.30756 2.73211 3.10245 1.11718 1.26926C0.835119 1.71862 0.674732 2.23948 0.674732 2.79096C0.674732 3.84288 1.25544 4.77224 2.13481 5.31352C1.59834 5.2982 1.08953 5.16033 0.647079 4.93565C0.647079 4.94586 0.647079 4.96118 0.647079 4.97139C0.647079 6.44203 1.78085 7.66245 3.27964 7.94331C3.00311 8.01479 2.71552 8.05054 2.41687 8.05054C2.20671 8.05054 2.00207 8.03011 1.79744 7.99437C2.21777 9.19948 3.42897 10.0727 4.86139 10.0982C3.73868 10.9101 2.32285 11.3952 0.785344 11.3952C0.519876 11.3952 0.259938 11.3799 0 11.3544C1.45455 12.2122 3.18009 12.7178 5.03284 12.7178C11.0722 12.7178 14.3685 8.1016 14.3685 4.09309C14.3685 3.96033 14.3685 3.83267 14.3574 3.6999C14.999 3.27097 15.5576 2.7399 15.9945 2.13224L16 2.13735Z" fill="black"/>
											</svg>
										</a>
									</li>
									<?php
								}
								?>
								<?php
								if ( ! empty( get_user_meta( $curauth->ID, 'linkedin', true ) ) ) {
									?>
									<li>
										<a href="<?php echo wp_kses_post( get_user_meta( $curauth->ID, 'linkedin', true ) ); ?>">
											<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
												<path d="M0.45864 5.32922H3.75985V16.0553H0.45864V5.32922ZM2.11092 0C3.16784 0 4.02408 0.865112 4.02408 1.93298C4.02408 3.00086 3.16784 3.86597 2.11092 3.86597C1.054 3.86597 0.197754 3.00086 0.197754 1.93298C0.197754 0.865112 1.054 0 2.11092 0Z" fill="black"/>
												<path d="M5.83008 5.32993H8.99082V6.79656H9.05102C9.69655 5.68138 10.894 5.01903 12.1716 5.06634C15.5163 5.06634 16.1284 7.28657 16.1284 10.1725V16.056H12.8305V10.8416C12.8305 9.59804 12.8105 7.99623 11.118 7.99623C9.42562 7.99623 9.13799 9.34797 9.13799 10.7504V16.056H5.84346L5.83008 5.32993Z" fill="black"/>
											</svg>
										</a>
									</li>
									<?php
								}
								?>
							</ul>
						</div>
						<?php endif; ?>


					<?php if ( get_field( 'expertise', 'user_' . $curauth->ID ) ) : ?>
						<h2 class="title">Expertise</h2>
						<div class="detail"><?php the_field( 'expertise', 'user_' . $curauth->ID ); ?></div>
					<?php endif; ?>

					<?php if ( get_field( 'education', 'user_' . $curauth->ID ) ) : ?>
						<h2 class="title">Education</h2>
						<div class="detail"><?php the_field( 'education', 'user_' . $curauth->ID ); ?></div>
						<?php endif; ?>

						<?php if ( get_field( 'certifications', 'user_' . $curauth->ID ) ) : ?>
						<h2 class="title">Certifications</h2>
						<div class="detail"><?php the_field( 'certifications', 'user_' . $curauth->ID ); ?></div>
						<?php endif; ?>

						<?php if ( get_field( 'media_mentions', 'user_' . $curauth->ID ) ) : ?>
						<h2 class="title">Media Mentions</h2>
						
						<div class="detail">
							<?php
							// Check rows existexists.
							$mentions = 0;
							if ( have_rows( 'media_mentions', 'user_' . $curauth->ID ) ) :
								while ( have_rows( 'media_mentions', 'user_' . $curauth->ID ) ) :
									the_row();
									$press_post    = get_sub_field( 'press_post' );
									$press_company = get_sub_field( 'press_company' );
									if($mentions > 2) {
										continue;
									}
									?>
								<div class="detail_link_content">
									<a href="<?php echo wp_kses_post( $press_post['url'] ); ?>" class="detail_link">
										<?php
										echo wp_kses_post( $press_post['title'] );
										?>
									</a>
									<span class="press-company"> - <?php echo wp_kses_post( $press_company ); ?>
								</span>
								</div>
									<?php

									++$mentions;
									// End loop.
								endwhile;

							endif;

							?>
						</div>
						
						<?php if($mentions > 2): ?>
						<div class="detail_end_link">
							<div class="td_content">
								<button class="btn-text modal-btn link" data-modal="modal_media_mentions" aria-label="Disclosures for Media Mentions">
									View All
									<span class="svg">
										<svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path d="M10.3536 4.35355C10.5488 4.15829 10.5488 3.84171 10.3536 3.64645L7.17157 0.464465C6.97631 0.269203 6.65973 0.269203 6.46447 0.464466C6.2692 0.659728 6.2692 0.97631 6.46447 1.17157L9.29289 4L6.46447 6.82843C6.2692 7.02369 6.2692 7.34027 6.46447 7.53553C6.65973 7.7308 6.97631 7.7308 7.17157 7.53553L10.3536 4.35355ZM4.37114e-08 4.5L10 4.5L10 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#82BC46"/>
										</svg>
									</span>
								</button>
							</div>
						</div>
						<?php endif; ?>

						<?php endif; ?>

						
					</div>
					<div class="slp-contact-info-loop">
						<h2 class="title">More About <?php 
						$words = explode(' ', $idf['nickname'][0]);
						$firstWord = $words[0];

						echo wp_kses_post( $firstWord ); ?></h2>
						<?php echo wpautop( $idf['custom_author_bio'][0] ); ?>
					</div>
				</div>

				<?php if ( have_rows( 'author_page_recommended_posts', 'user_' . $curauth->ID ) ) : ?>
				<div class="author_recommended_posts">
					<h2 class="author_recommended_posts_title"><?php echo wp_kses_post( $firstWord ); ?> recommends</h2>
					<div class="author_recommended_posts_loop">

					<?php
						// Check rows existexists.

					while ( have_rows( 'author_page_recommended_posts', 'user_' . $curauth->ID ) ) :
						the_row();
						$post = get_sub_field( 'post' );
						$id_post_editor = get_field( 'post_editor', $post->ID );
						$author_url     = get_author_posts_url( $post->ID );
						$author_name    = get_the_author_meta( 'display_name', $post->ID );

						?>
								<div class="author_recommended_posts_content">
									<a href="<?php the_permalink( $post->ID ); ?>" class="author_recommended_posts_content_post">
										<div class="category">Student Loan Forgiveness</div>
										<h3 class="title"><?php echo get_the_title( $post->ID ); ?></h3>
									</a>
									<div class="author">
										<span class="author_recommended_posts_content_post-data">
										<?php 
										$author_id = get_the_author_meta('ID');
										echo get_avatar( $author_id, 96 );  
										?>
										</span>
										<div class="author_recommended_posts_content_post-inf__link">
											<a href="<?php the_permalink( $post->ID ); ?>">
												By <?php echo ! empty( $id_post_editor ) ? $first_name . ' ' . $last_name : get_the_author(); ?>
											</a>
										</div>
										</div>
								</div>
							<?php
							endwhile;

					?>
					</div>

				</div>
				<?php endif; ?>

				<?php
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

				$args = array(
					'author'         => $curauth->ID,
					// 'posts_per_page' => 9,
					'paged'          => $paged,
					'ignore_sticky_posts' => 1
				);

				$author_query_page = new WP_Query( $args );
				?>

				<?php if ( $author_query_page->have_posts() ) : ?>

				<div class="author_latest_from" id="author_latest_from">
					<?php 
					$words = explode(' ', $curauth->display_name);
					$firstWord = $words[0];
					?>
					<h2 class="author_latest_from_title">The lastest from <?php echo wp_kses_post( $firstWord ); ?></h2>
					<div class="loop">
						<?php
						while ( $author_query_page->have_posts() ) :
							$author_query_page->the_post();
							$post_id = get_the_ID();
							$categories = get_the_category($post_id);
							?>
							<div class="post">
								<?php
								if (!empty($categories)) {
								$category_name = $categories[0]->name;
									?>
									<span class="post-tax-category">
										<a href="<?php echo esc_url( get_category_link( $category_name->term_id ) ); ?>">
											<?php echo esc_html( $category_name ); ?>
										</a>
									</span>
								<?php
								}
								?>
								<a class="post_link" href="<?php the_permalink(); ?>">
									<div class="featured-image">
										<?php the_post_thumbnail(); ?>
									</div>
									<h3 class="post_title"><?php the_title(); ?></h3>
								</a>
							</div>
						<?php endwhile; ?>
					</div>
					<div class="pagination">
					<?php
						// Pagination
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $author_query_page->max_num_pages,
						) );
						?>
						</div>
						
						<?php wp_reset_postdata(); ?>
				</div>

					<script>
						document.addEventListener("DOMContentLoaded", function() {
							var paginationLinks = document.querySelectorAll('.pagination a');

							paginationLinks.forEach(function(link) {
								link.addEventListener('click', function(e) {
									e.preventDefault();
									var newUrl = link.getAttribute('href') + '#author_latest_from';
									window.location.href = newUrl;
								});
							});
						});

					</script>
				<?php endif; ?>

				<div id="modal_media_mentions" class="modal" aria-hidden="true" role="dialog" aria-modal="true">
					<div class="modal-content" >
						<button class="close-btn">
							<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
						</button>
						<div class="content">
						<h2 class="title">Media Mentions</h2>
						<?php
							// Check rows existexists.
							$mentions = 0;
							if ( have_rows( 'media_mentions', 'user_' . $curauth->ID ) ) :
								while ( have_rows( 'media_mentions', 'user_' . $curauth->ID ) ) :
									the_row();
									$press_post    = get_sub_field( 'press_post' );
									$press_company = get_sub_field( 'press_company' );
									?>
								<div class="detail_link_content">
									<a href="<?php echo wp_kses_post( $press_post['url'] ); ?>" class="detail_link">
										<?php
										echo wp_kses_post( $press_post['title'] );
										?>
									</a>
									<span class="press-company"> - <?php echo wp_kses_post( $press_company ); ?>
								</span>
								</div>
									<?php

									++$mentions;
									// End loop.
								endwhile;

							endif;

							?>
					</div>
				</div>

			</div>


			
			<?php
				tha_content_bottom();
			echo '</div>';

			get_sidebar();
			echo '</main>';

			tha_content_wrap_after();
			echo '</div>';

			tha_content_after();

			get_footer();


			