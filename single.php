<?php
/**
 * Single Post
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

// Entry Header.
add_action( 'eqd_entry_title_after', 'eqd_entry_author', 12 );
add_action( 'eqd_entry_title_after', 'eqd_entry_date', 12 );

/**
 * After Entry
 */
function eqd_single_after_entry() {
	echo '<div class="after-entry">';

	// Publish date.
	eqd_entry_date();

	// Author Box.
	eqd_author_box();

	// Newsletter signup.
	$form_id = get_option( 'options_eqd_newsletter_form' );
	if ( $form_id && function_exists( 'wpforms_display' ) ) {
		wpforms_display( $form_id, true, true );
	}

	// Related Posts.
	if ( function_exists( 'cultivate_pro' ) ) {
		$args = array(
			'layout'     => 'gamma',
			'title'      => 'You May Also Like',
			'query_args' => array(
				'post__not_in' => array( get_the_ID() ),
				'cat'          => eqd_first_term( array( 'field' => 'term_id' ) ),
			),
		);
		cultivate_pro()->blocks->post_listing->display( $args );
	}

	echo '</div>';
}
// add_action( 'tha_content_while_after', 'eqd_single_after_entry', 8 );


/**
 * Refinance student loans, single section
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_after_entry_content() {
	$hide_section_per_category = false;
	$categories                = get_the_category();
	foreach ( $categories as $_category ) {
		$hide_section_per_category = get_field( 'hide_student_loans_section', 'category_' . $_category->term_id );
		if ( $hide_section_per_category ) {
			break;
		}
	}
	if ( $hide_section_per_category ) {
		return;
	}
	$hide_section_per_page = get_field( 'hide_student_loans_section', get_the_ID() );
	if ( $hide_section_per_page ) {
		return;
	}
	?>
	<?php if ( have_rows( 'build_refinance_student_loans_section', 'option' ) ) : ?>
<section class="refinance_lender_section">
	<header class="title">
		<?php
		$current_year = date( 'Y' );
		?>
		<h2 class="title">Refinance student loans, get a bonus in <?php echo $current_year; ?></h2>
	</header>
	<div class="lender_info">
	<table>
	<tr class="header">
		<th class="sr-only" scope="col">Lender Name</th>
		<th scope="col">Lender</th>
		<th scope="col">Offer</th>
		<th scope="col">Learn more</th>
	</tr>

		<?php
		while ( have_rows( 'build_refinance_student_loans_section', 'option' ) ) :
			the_row();
			$logo_image = get_sub_field( 'logo_image' );
			$link       = get_sub_field( 'learn_more_link' );
			?>

			<tr class="data-tr">
				<th class="sr-only" scope="row"><?php the_sub_field( 'lender_name' ); ?></th>
				<td>
					<div class="td_content">
						<img src="<?php echo $logo_image['url']; ?>" alt="<?php echo $logo_image['alt']; ?>">
						<button class="btn-text modal-btn" data-modal="modal_disclosure_<?php echo get_row_index(); ?>" aria-label="Disclosures for <?php echo get_sub_field( 'lender_name' ); ?>">Disclosures<sup><?php echo get_row_index(); ?></sup></button>
					</div>
				</td>
				<td>
					<div class="td_content">
						<div class="td_title">
							<?php the_sub_field( 'offer' ); ?>
						</div>
						<div class="td_text">
							<?php the_sub_field( 'offer_text' ); ?>
						</div>
					</div>
				</td>
				<td>
					<div class="td_content">
						<?php
						if ( isset( $link['url'] ) ) :
							?>
							<div class="td_title">
								<?php
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a href="<?php echo $link['url']; ?>"
								class="btn"
								target="<?php echo esc_attr( $link_target ); ?>">
									<?php echo $link['title']; ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="td_text">
							<?php the_sub_field( 'learn_more_subtext' ); ?>
						</div>
					</div>
				</td>
			</tr>

		<?php endwhile; ?>
	
	</table>
	</div>
</section>

<?php endif; ?>


	<?php
}
add_action( 'tha_content_while_after', 'eqd_single_after_entry_content', 7 );

function eqd_single_after_entry_modals() {
	?>
	<?php if ( have_rows( 'build_refinance_student_loans_section', 'option' ) ) : ?>
		<?php
		while ( have_rows( 'build_refinance_student_loans_section', 'option' ) ) :
			the_row();
			$lender_disclosure = get_sub_field( 'lender_disclosure', 'option' );
			?>
			<div id="modal_disclosure_<?php echo get_row_index(); ?>" class="modal" aria-hidden="true" role="dialog" aria-modal="true">
				<div class="modal-content" >
				<button class="close-btn">
					<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
				</button>
				<div class="content">
					<?php echo wp_kses_post( $lender_disclosure ); ?>
				</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>


	<?php
}
add_action( 'tha_content_after', 'eqd_single_after_entry_modals', 7 );


function advertising_disclosure() {
	?>
	<?php
	$disclosure_content = get_field( 'advertising_disclosure', 'option' );
	?>
	<div id="modal_disclosure" class="modal team-hightlight-block-modal" aria-hidden="true" role="dialog" aria-modal="true">
		<div class="modal-content" >
		<button class="close-btn">
			<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
		</button>
			<div class="modal_copy">
				<div class="modal_copy_text">
					<span class="modal_copy_title">
						<?php echo wp_kses_post( $disclosure_content['title'] ); ?>
					</span>
					<span class="modal_copy_content">
						<?php echo wp_kses_post( $disclosure_content['copy'] ); ?>
					</span>
				</div>
			</div>
		</div>
		</div>
	</div>
	<?php
}
add_action( 'tha_content_after', 'advertising_disclosure', 7 );


/**
 * Refinance student loans, single category section
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_after_entry_primary_category() {
	$post_id             = get_the_ID(); 
	$primary_category_id = yoast_get_primary_term_id( 'category', $post_id );
	if ( $primary_category_id ) {
		$primary_category = get_term( $primary_category_id );
		$category_id      = 'category_' . $primary_category->term_id;
		$icon             = get_field( 'icon', $category_id );
		$title            = get_field( 'heading', $category_id );
		$paragraph        = get_field( 'paragraph', $category_id );
		$link             = get_field( 'link', $category_id );
		if ( ! empty( $title ) ) :
			?>

		<div class="single_post_questionnaire">
			<?php if(!empty($icon['url'])): ?>
			<div class="single_post_questionnaire__icon">
				<img aria-hidden="true" src="<?php echo wp_kses_post( $icon['url'] ); ?>" alt="<?php echo wp_kses_post( $icon['alt'] ); ?>">
			</div>
			<?php endif; ?>
			<div class="single_post_questionnaire__title">
				<h2><?php echo wp_kses_post( $title ); ?></h2>
			</div>
			<div class="single_post_questionnaire__text"><?php echo wp_kses_post( $paragraph ); ?></div>
			<div class="single_post_questionnaire__link">
				<?php if ( ! empty( $link['url'] ) ) : ?>
				<a href="<?php echo wp_kses_post( $link['url'] ); ?>" class="btn white-focus btn-dark-bg"><?php echo wp_kses_post( $link['title'] ); ?></a>
				<?php endif; ?>
			</div>
		</div>

			<?php
		endif;
	}
}

add_action( 'tha_content_while_after', 'eqd_single_after_entry_primary_category', 7 );

add_action( 'tha_content_while_after', 'eqd_single_after_entry_author_info', 7 );

/**
 * Refinance student loans, single author section
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_after_entry_author_info() {
	global $post;

	$id             = get_the_author_meta( 'ID' );
	$id_post_editor = get_field( 'post_editor', get_the_ID() );
	$author_url     = get_author_posts_url( get_the_author_meta( 'ID' ) );

	$author_name    = get_the_author_meta( 'display_name', $id_post_editor['ID'] );
	$user_info      = get_userdata( $id_post_editor['ID'] );
	$first_name     = $user_info->first_name;
	$last_name      = $user_info->last_name;
	$nickname       = $user_info->nickname;
	

	?>

	<div class="article_footer_data">

		<div class="article_footer_data_author">

			<span class="article_footer_data_author_entry-author">
				<div class="article_footer_data_author_entry-author_titles">
						<?php echo get_avatar( $id,64  ); ?>
					<div class="author_name">
					<?php echo  get_the_author($id); ?>
					</div>
					<ul class="author_socials">
						<?php
						if ( ! empty( get_user_meta( $id, 'twitter', true ) ) ) {
							?>
							<li>
							<a href="<?php echo wp_kses_post( get_user_meta( $id, 'twitter', true ) ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
									<path d="M16 2.13735C15.4138 2.37735 14.7777 2.54075 14.1141 2.61224C14.7943 2.23948 15.3142 1.64203 15.5576 0.937348C14.9215 1.28458 14.2191 1.53479 13.4725 1.67267C12.8752 1.08543 12.0235 0.717773 11.0778 0.717773C9.26374 0.717773 7.79813 2.07607 7.79813 3.74586C7.79813 3.98586 7.82579 4.21565 7.88109 4.43522C5.15451 4.30756 2.73211 3.10245 1.11718 1.26926C0.835119 1.71862 0.674732 2.23948 0.674732 2.79096C0.674732 3.84288 1.25544 4.77224 2.13481 5.31352C1.59834 5.2982 1.08953 5.16033 0.647079 4.93565C0.647079 4.94586 0.647079 4.96118 0.647079 4.97139C0.647079 6.44203 1.78085 7.66245 3.27964 7.94331C3.00311 8.01479 2.71552 8.05054 2.41687 8.05054C2.20671 8.05054 2.00207 8.03011 1.79744 7.99437C2.21777 9.19948 3.42897 10.0727 4.86139 10.0982C3.73868 10.9101 2.32285 11.3952 0.785344 11.3952C0.519876 11.3952 0.259938 11.3799 0 11.3544C1.45455 12.2122 3.18009 12.7178 5.03284 12.7178C11.0722 12.7178 14.3685 8.1016 14.3685 4.09309C14.3685 3.96033 14.3685 3.83267 14.3574 3.6999C14.999 3.27097 15.5576 2.7399 15.9945 2.13224L16 2.13735Z" fill="black"/>
								</svg>
							</a>
							</li>
							<?php
						}
						?>
						<?php
						if ( ! empty( get_user_meta( $id, 'linkedin', true ) ) ) {
							?>
							<li>
							<a href="<?php echo wp_kses_post( get_user_meta( $id, 'linkedin', true ) ); ?>">
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

				<span class="article_footer_data_author_entry-info">
					<span class="article_footer_data_author_entry-data">
						<?php the_author_meta( 'user_description', $id ); ?> </br>
					</span>
					<div class="article_footer_data_author_entry-inf__link">
						<a href="<?php echo $author_url; ?>">
							Read More from 
							<?php
							echo get_the_author($id);
							?>
						<span class="arrow">
						<svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
						<path d="M10.3536 4.35355C10.5488 4.15829 10.5488 3.84171 10.3536 3.64645L7.17157 0.464465C6.97631 0.269203 6.65973 0.269203 6.46447 0.464466C6.2692 0.659728 6.2692 0.97631 6.46447 1.17157L9.29289 4L6.46447 6.82843C6.2692 7.02369 6.2692 7.34027 6.46447 7.53553C6.65973 7.7308 6.97631 7.7308 7.17157 7.53553L10.3536 4.35355ZM4.37114e-08 4.5L10 4.5L10 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#82BC46"/>
						</svg>
						</span>
						</a>
					</div>
				</span>

			</span>
		</div>

		<?php
			$review_by_auth_id = get_field( 'post_reviewed_by', get_the_ID() );

			$profile_picture = get_avatar( $review_by_auth_id, 64 );
			$user_info       = get_userdata( $review_by_auth_id );
			$first_name      = $user_info->first_name;
			$last_name       = $user_info->last_name;
			$nickname        = $user_info->nickname;
		?>
			<?php if ( $review_by_auth_id ) : ?>

			<div class="article_footer_data_author_reviewed_author">
				<div class="article_footer_data_author_profile">
					<?php echo $profile_picture; ?>
				</div>
				<div class="article_footer_data_author_author_info">
					Reviewed By
					<span class="name">
					<?php  echo get_author_posts_link_by_id($review_by_auth_id); ?>
					</span>
				</div>

				<ul class="article_footer_data_author_socials">
					<?php if ( ! empty( get_user_meta( $review_by_auth_id, 'twitter', true ) ) ) { ?>
					<li>
					<a href="<?php echo wp_kses_post( get_user_meta( $review_by_auth_id, 'twitter', true ) ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
							<path d="M16 2.13735C15.4138 2.37735 14.7777 2.54075 14.1141 2.61224C14.7943 2.23948 15.3142 1.64203 15.5576 0.937348C14.9215 1.28458 14.2191 1.53479 13.4725 1.67267C12.8752 1.08543 12.0235 0.717773 11.0778 0.717773C9.26374 0.717773 7.79813 2.07607 7.79813 3.74586C7.79813 3.98586 7.82579 4.21565 7.88109 4.43522C5.15451 4.30756 2.73211 3.10245 1.11718 1.26926C0.835119 1.71862 0.674732 2.23948 0.674732 2.79096C0.674732 3.84288 1.25544 4.77224 2.13481 5.31352C1.59834 5.2982 1.08953 5.16033 0.647079 4.93565C0.647079 4.94586 0.647079 4.96118 0.647079 4.97139C0.647079 6.44203 1.78085 7.66245 3.27964 7.94331C3.00311 8.01479 2.71552 8.05054 2.41687 8.05054C2.20671 8.05054 2.00207 8.03011 1.79744 7.99437C2.21777 9.19948 3.42897 10.0727 4.86139 10.0982C3.73868 10.9101 2.32285 11.3952 0.785344 11.3952C0.519876 11.3952 0.259938 11.3799 0 11.3544C1.45455 12.2122 3.18009 12.7178 5.03284 12.7178C11.0722 12.7178 14.3685 8.1016 14.3685 4.09309C14.3685 3.96033 14.3685 3.83267 14.3574 3.6999C14.999 3.27097 15.5576 2.7399 15.9945 2.13224L16 2.13735Z" fill="black"/>
						</svg>
					</a>
					</li>
					<?php } ?>
					<?php if ( ! empty( get_user_meta( $review_by_auth_id, 'linkedin', true ) ) ) { ?>
					<li>
					<a href="<?php echo wp_kses_post( get_user_meta( $review_by_auth_id, 'linkedin', true ) ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
							<path d="M0.45864 5.32922H3.75985V16.0553H0.45864V5.32922ZM2.11092 0C3.16784 0 4.02408 0.865112 4.02408 1.93298C4.02408 3.00086 3.16784 3.86597 2.11092 3.86597C1.054 3.86597 0.197754 3.00086 0.197754 1.93298C0.197754 0.865112 1.054 0 2.11092 0Z" fill="black"/>
							<path d="M5.83008 5.32993H8.99082V6.79656H9.05102C9.69655 5.68138 10.894 5.01903 12.1716 5.06634C15.5163 5.06634 16.1284 7.28657 16.1284 10.1725V16.056H12.8305V10.8416C12.8305 9.59804 12.8105 7.99623 11.118 7.99623C9.42562 7.99623 9.13799 9.34797 9.13799 10.7504V16.056H5.84346L5.83008 5.32993Z" fill="black"/>
						</svg>
					</a>
					</li>
					<?php } ?>
					</ul>
			</div>

		<?php endif; ?>
		<?php


		
			$post_editor_by_auth_id = get_field( 'post_editor', get_the_ID() );
			
			$profile_picture = get_avatar( $post_editor_by_auth_id, 64 );
			$user_info       = get_userdata( $post_editor_by_auth_id );

		?>
			<?php if ( !empty($post_editor_by_auth_id) ) : ?>

			<div class="article_footer_data_author_reviewed_author editedby">
				<div class="article_footer_data_author_profile">
					<?php echo $profile_picture; ?>
				</div>
				<div class="article_footer_data_author_author_info">
				Edited By
					<span class="name">
					<?php  
					echo get_author_posts_link_by_id($post_editor_by_auth_id['ID']); 
					
					
					?>
					</span>
				</div>

				<ul class="article_footer_data_author_socials">
					<?php if ( ! empty( get_user_meta( $post_editor_by_auth_id['ID'], 'twitter', true ) ) ) { ?>
					<li>
					<a href="<?php echo wp_kses_post( get_user_meta( $post_editor_by_auth_id['ID'], 'twitter', true ) ); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="13" viewBox="0 0 16 13" fill="none">
							<path d="M16 2.13735C15.4138 2.37735 14.7777 2.54075 14.1141 2.61224C14.7943 2.23948 15.3142 1.64203 15.5576 0.937348C14.9215 1.28458 14.2191 1.53479 13.4725 1.67267C12.8752 1.08543 12.0235 0.717773 11.0778 0.717773C9.26374 0.717773 7.79813 2.07607 7.79813 3.74586C7.79813 3.98586 7.82579 4.21565 7.88109 4.43522C5.15451 4.30756 2.73211 3.10245 1.11718 1.26926C0.835119 1.71862 0.674732 2.23948 0.674732 2.79096C0.674732 3.84288 1.25544 4.77224 2.13481 5.31352C1.59834 5.2982 1.08953 5.16033 0.647079 4.93565C0.647079 4.94586 0.647079 4.96118 0.647079 4.97139C0.647079 6.44203 1.78085 7.66245 3.27964 7.94331C3.00311 8.01479 2.71552 8.05054 2.41687 8.05054C2.20671 8.05054 2.00207 8.03011 1.79744 7.99437C2.21777 9.19948 3.42897 10.0727 4.86139 10.0982C3.73868 10.9101 2.32285 11.3952 0.785344 11.3952C0.519876 11.3952 0.259938 11.3799 0 11.3544C1.45455 12.2122 3.18009 12.7178 5.03284 12.7178C11.0722 12.7178 14.3685 8.1016 14.3685 4.09309C14.3685 3.96033 14.3685 3.83267 14.3574 3.6999C14.999 3.27097 15.5576 2.7399 15.9945 2.13224L16 2.13735Z" fill="black"/>
						</svg>
					</a>
					</li>
					<?php } ?>
					<?php if ( ! empty( get_user_meta( $post_editor_by_auth_id['ID'], 'linkedin', true ) ) ) { ?>
					<li>
						<a href="<?php echo wp_kses_post( get_user_meta( $post_editor_by_auth_id['ID'], 'linkedin', true ) ); ?>">
							<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
								<path d="M0.45864 5.32922H3.75985V16.0553H0.45864V5.32922ZM2.11092 0C3.16784 0 4.02408 0.865112 4.02408 1.93298C4.02408 3.00086 3.16784 3.86597 2.11092 3.86597C1.054 3.86597 0.197754 3.00086 0.197754 1.93298C0.197754 0.865112 1.054 0 2.11092 0Z" fill="black"/>
								<path d="M5.83008 5.32993H8.99082V6.79656H9.05102C9.69655 5.68138 10.894 5.01903 12.1716 5.06634C15.5163 5.06634 16.1284 7.28657 16.1284 10.1725V16.056H12.8305V10.8416C12.8305 9.59804 12.8105 7.99623 11.118 7.99623C9.42562 7.99623 9.13799 9.34797 9.13799 10.7504V16.056H5.84346L5.83008 5.32993Z" fill="black"/>
							</svg>
						</a>
					</li>
					<?php } ?>
					</ul>
			</div>

		<?php endif; ?>

	</div>
	
	<?php
}

add_action( 'tha_content_while_after', 'eqd_single_after_entry_block_disclosure', 7 );

/**
 * Block Disclosure
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_after_entry_block_disclosure() {
	if ( has_block( 'acf/vendor-repeater' ) ) {
		?>
			<section class="vendor_disclosure">
				<h2 class="vendor_disclosure_title">Disclosures</h2>
				<ol class="vendor_disclosure_ol">
				<?php
				if ( have_rows( 'vendors', 'option' ) ) :
					while ( have_rows( 'vendors', 'option' ) ) :
						the_row();
						$company_title      = get_sub_field( 'company_title' );
						$disclosure_content = get_sub_field( 'disclosure_content' );
						// $company_title
						$result = preg_replace( '/<p>/', '<p><b>' . $company_title . ':</b> ', $disclosure_content, 1 );
						?>
								<li class="vendor_disclosure_ol_li" id="sup_disclosure_<?php echo get_row_index(); ?>">
								<?php echo wp_kses_post( $result ); ?>
								</li>
							<?php
						endwhile;
					endif;
				?>

				</ol>
			</section>
			<?php
	}
}



add_action( 'tha_single_page_end', 'eqd_single_after_related_post', 10 );

/**
 * Refinance student loans, single author section
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/
function eqd_single_after_related_post() {
	$term    = get_queried_object();
	$post_id = get_the_ID(); // Assuming you're in the loop

	$primary_category = get_primary_category_id( $post_id );

	$show_related_posts       = get_field( 'show_related_posts', 'category_' . $primary_category );
	$select_posts_to_showcase = get_field( 'select_posts_to_showcase', 'category_' . $primary_category );
	$disable_related_posts    =  get_field( 'disable_related_posts' ,$post_id);
	
	if ( $show_related_posts ):
	 if ( !$disable_related_posts ) :
	 

		?>
	<section class="single_related_posts">
		<div class="single_related_posts_container">
			<header class="single_related_posts_header">
				<h2 class="title">More on <?php echo get_cat_name( $primary_category ); ?></h2>
				<div class="single_related_posts_header_link">
					<a href="<?php echo get_category_link( $primary_category ); ?>" class="btn" aria-label="More <?php echo get_cat_name( $primary_category ); ?> posts">More Posts</a>
				</div>
			</header>
			<div class="single_related_posts_loop">
			<!-- select three posts manually -->

			<?php
			if ( ! empty( $select_posts_to_showcase ) ) {
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'post__in'       => $select_posts_to_showcase,
					'orderby'        => 'post__in',
					'order'          => 'DESC',
				);
			} else {
				$args = array(
					'post_type'      => 'post',
					'posts_per_page' => 3,
					'cat'            => $primary_category,  // Category ID
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
			}

				$query = new WP_Query( $args );

				$posts_array = array();
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$author_email = get_the_author_meta( 'user_email' );
					?>
						<a class="single_related_posts_loop_item" href="<?php echo get_the_permalink(); ?>">
							<div class="single_related_posts_loop_item_image">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'large' );  // 'full' will display the full image. You can use other sizes like 'thumbnail', 'medium', 'large', etc.
							}
							?>
							</div>
							<h3 class="single_related_posts_loop_item_title"><?php the_title(); ?></h3>
							<div class="single_related_posts_loop_item_info">
								<div class="single_related_posts_loop_item_info_profile_image">
								<?php echo get_avatar( $author_email, 96 ); ?>
								</div>
								<div class="single_related_posts_loop_item_info_author">
								<?php echo get_the_author(); ?>
								</div>
							</div>
						</a>
						<?php

				}
				wp_reset_postdata();
			}
			?>

			</div>
		</div>
	</section>
		<?php
		endif;
	endif;
}
// Build the page.
require get_template_directory() . '/index.php';
