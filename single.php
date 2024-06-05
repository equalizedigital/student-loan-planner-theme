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
 * After Entry.
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
				'post__not_in' => array( get_the_ID() ), // phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in -- This is a valid use case.
				'cat'          => eqd_first_term( array( 'field' => 'term_id' ) ),
			),
		);
		cultivate_pro()->blocks->post_listing->display( $args );
	}

	echo '</div>';
}
// add_action( 'tha_content_while_after', 'eqd_single_after_entry', 8 ); phpcs:ignore Squiz.PHP.CommentedOutCode.Found -- Uncomment when ready to use.


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

	// hide option.
	foreach ( $categories as $_category ) {
		$hide_section_per_category = get_field( 'hide_student_loans_section', 'category_' . $_category->term_id );
		if ( $hide_section_per_category ) {
			break;
		}
	}

	// hide option.
	if ( $hide_section_per_category ) {
		return;
	}

	// hide option.
	$hide_section_per_page = get_field( 'hide_student_loans_section', get_the_ID() );
	if ( $hide_section_per_page ) {
		return;
	}

	$post_id = get_the_ID();
	if ( function_exists( 'yoast_get_primary_term_id' ) ) {
		$primary_category_id = yoast_get_primary_term_id( 'category', $post_id );
	}

	$heading_override = get_field( 'heading_override', 'option' );

	?>

	<?php if ( have_rows( 'vendors', 'option' ) ) : ?>

		<section class="refinance_lender_section
		<?php
		if ( get_field( 'show_private_student_loans_table_instead_of_refinance_table', 'category_' . $primary_category_id ) ) {
			echo 'refinance_lender_section_private'; }
		?>
		">

			<header class="title">
				<?php $current_year = gmdate( 'Y' ); ?>
				<?php
				if ( get_field( 'show_private_student_loans_table_instead_of_refinance_table', 'category_' . $primary_category_id ) ) {
					?>
					<h2 class="title">
						<?php echo wp_kses_post( $heading_override ); ?>
					</h2>
				<?php } else { ?>
					<h2 class="title">Refinance student loans, get a bonus in <?php echo wp_kses_post( $current_year ); ?></h2>
				<?php } ?>
			</header>

			<?php
			if ( get_field( 'show_private_student_loans_table_instead_of_refinance_table', 'category_' . $primary_category_id ) ) {
				?>
				<div class="lender_info">
					<table id="refinance_lender_options">
						<tr class="header screen-reader-text">
							<th class="sr-only" scope="col">Lender Name</th>
							<th scope="col">Lender</th>
							<th scope="col">Offer</th>
							<th scope="col">Learn more</th>
						</tr>
						<!-- TR -->

						<?php
						$number_of_items = 0;
						// Check if the flexible content field has rows of data.
						if ( have_rows( 'private_student_loans_section', 'option' ) ) :

							// Loop through the rows of data.
							while ( have_rows( 'private_student_loans_section', 'option' ) ) :
								the_row();


								$company_name    = get_sub_field( 'company_name' );
								$logo            = get_sub_field( 'logo' );
								$offer_amount    = get_sub_field( 'offer_amount' );
								$offer_text      = get_sub_field( 'offer_text' );
								$url             = get_sub_field( 'url' );
								$fixed_rates     = get_sub_field( 'fixed_rates' );
								$variable_rates  = get_sub_field( 'variable_rates' );
								$disclosure_text = get_sub_field( 'disclosure_text' ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
								?>

								<tr class="data-tr
										<?php
										if ( get_row_index() > 3 ) {
											echo 'hidden';
										}
										?>
										">
									<th class="sr-only" scope="row"><?php echo esc_html( get_sub_field( 'company_name' ) ); ?></th>
									<td>
										<div class="td_content">
											<img src="<?php echo wp_kses_post( $logo['url'] ); ?>" alt="<?php echo wp_kses_post( $logo['alt'] ); ?>">
											<button class="btn-text modal-btn" data-modal="modal_disclosure_<?php echo wp_kses_post( get_row_index() ); ?>" aria-label="Disclosures for <?php echo wp_kses_post( $company_name ); ?>">Disclosures</button>
										</div>
									</td>
									<td>
										<div class="td_content">
											<div class="td_title">
												<?php echo wp_kses_post( $offer_amount ); ?>
											</div>
											<div class="td_text">
												<?php echo wp_kses_post( $offer_text ); ?>
											</div>
										</div>
									</td>
									<td>
										<div class="td_title">
											<?php
											if ( ! empty( $url['url'] ) ) :
												?>
												<?php $url_target = $url['target'] ? $url['target'] : '_self'; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use. ?>
												<a href="<?php echo wp_kses_post( $url['url'] ); ?>" class="btn" <?php echo ! empty( $url['target'] ) ? wp_kses_post( "target='" . $url['target'] . "'" ) : ''; ?>>
													<?php echo wp_kses_post( $url['title'] ); ?>
													<?php if ( empty( $url['target'] ) ) : ?>
														<span class="svg">
															<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M12 8.96667V11C12 11.5523 11.5523 12 11 12H2C1.44771 12 1 11.5523 1 11V2C1 1.44771 1.44772 1 2 1H4.03333" stroke="black" stroke-linecap="round"></path>
																<path d="M3.64132 8.71334C3.44606 8.9086 3.44606 9.22519 3.64132 9.42045C3.83658 9.61571 4.15316 9.61571 4.34843 9.42045L3.64132 8.71334ZM12.5615 1.00023C12.5615 0.724085 12.3377 0.500228 12.0615 0.500228L7.56154 0.500228C7.2854 0.500228 7.06154 0.724086 7.06154 1.00023C7.06154 1.27637 7.2854 1.50023 7.56154 1.50023L11.5615 1.50023L11.5615 5.50023C11.5615 5.77637 11.7854 6.00023 12.0615 6.00023C12.3377 6.00023 12.5615 5.77637 12.5615 5.50023L12.5615 1.00023ZM4.34843 9.42045L12.4151 1.35378L11.708 0.646675L3.64132 8.71334L4.34843 9.42045Z" fill="black"></path>
															</svg>
														</span>
													<?php endif; ?>
												</a>
											<?php endif; ?>
										</div>
										<div class="td_content">
											<div class="td_text">
												<div>Fixed <?php echo wp_kses_post( $fixed_rates ); ?></div>
												Variable <?php echo wp_kses_post( $variable_rates ); ?>
												<div><?php echo wp_kses_post( get_sub_field( 'learn_more_subtext' ) ); ?></div>
											</div>
										</div>
									</td>
								</tr>

								<?php

								++$number_of_items;
							endwhile;

						endif;
						?>




						<!-- TR -->
					</table>
				</div>

				<?php
			} else {
				?>
				<div class="lender_info">
					<table id="refinance_lender_options">
						<tr class="header">
							<th class="sr-only" scope="col">Lender Name</th>
							<th scope="col">Lender</th>
							<th scope="col">Offer</th>
							<th scope="col">Learn more</th>
						</tr>

						<?php
						$number_of_items = 0;
						while ( have_rows( 'vendors', 'option' ) ) :
							the_row();
							$company_title   = get_sub_field( 'company_title' );
							$company_logo    = get_sub_field( 'company_logo' );
							$cashback_amount = get_sub_field( 'cashback_amount' );
							$variable        = get_sub_field( 'variable' );
							?>

							<tr class="data-tr
							<?php
							if ( get_row_index() > 3 ) {
								echo 'hidden';
							}
							?>
							">
								<th class="sr-only" scope="row"><?php echo esc_html( get_sub_field( 'lender_name' ) ); ?></th>
								<td>
									<div class="td_content">
										<img src="<?php echo esc_url( $company_logo['url'] ); ?>" alt="<?php echo esc_attr( $company_logo['alt'] ); ?>">
										<button class="btn-text modal-btn" data-modal="modal_disclosure_<?php echo esc_attr( get_row_index() ); ?>" aria-label="Disclosures for <?php echo esc_attr( $company_title ); ?>">Disclosures</button>
									</div>
								</td>
								<td>
									<div class="td_content">
										<div class="td_title">
											<?php
											$cashback_amount = get_sub_field( 'cashback_amount' );
											echo wp_kses_post( $cashback_amount );
											?>
											Bonus
										</div>
										<div class="td_text">
											<?php $amount = get_sub_field( 'amount' ); ?>
											<?php echo wp_kses_post( $amount ); ?>
										</div>
									</div>
								</td>
								<td>
									<div class="td_title">
										<?php
										$link = get_sub_field( 'link' );
										if ( ! empty( $link['url'] ) ) :
											?>
											<?php $link_target = $link['target'] ? $link['target'] : '_self'; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use. ?>
											<a href="<?php echo wp_kses_post( $link['url'] ); ?>" class="btn" <?php echo ! empty( $link['target'] ) ? wp_kses_post( "target='" . $link['target'] . "'" ) : ''; ?>>
												<?php echo wp_kses_post( $link['title'] ); ?>
												<?php if ( empty( $link['target'] ) ) : ?>
													<span class="svg">
														<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M12 8.96667V11C12 11.5523 11.5523 12 11 12H2C1.44771 12 1 11.5523 1 11V2C1 1.44771 1.44772 1 2 1H4.03333" stroke="black" stroke-linecap="round"></path>
															<path d="M3.64132 8.71334C3.44606 8.9086 3.44606 9.22519 3.64132 9.42045C3.83658 9.61571 4.15316 9.61571 4.34843 9.42045L3.64132 8.71334ZM12.5615 1.00023C12.5615 0.724085 12.3377 0.500228 12.0615 0.500228L7.56154 0.500228C7.2854 0.500228 7.06154 0.724086 7.06154 1.00023C7.06154 1.27637 7.2854 1.50023 7.56154 1.50023L11.5615 1.50023L11.5615 5.50023C11.5615 5.77637 11.7854 6.00023 12.0615 6.00023C12.3377 6.00023 12.5615 5.77637 12.5615 5.50023L12.5615 1.00023ZM4.34843 9.42045L12.4151 1.35378L11.708 0.646675L3.64132 8.71334L4.34843 9.42045Z" fill="black"></path>
														</svg>
													</span>
												<?php endif; ?>
											</a>
										<?php endif; ?>
									</div>
									<div class="td_content">
										<div class="td_text">
											<?php $fixed = get_sub_field( 'fixed' ); ?>
											<div>Fixed <?php echo wp_kses_post( $fixed ); ?></div>

											<?php $variable = get_sub_field( 'variable' ); ?>
											Variable <?php echo wp_kses_post( $variable ); ?>
											<div><?php echo wp_kses_post( get_sub_field( 'learn_more_subtext' ) ); ?></div>
										</div>
									</div>
								</td>
							</tr>

							<?php
							++$number_of_items;

						endwhile;

						?>

					</table>
				</div>
			<?php } ?>

			<?php
			if ( $number_of_items >= 3 ) :
				?>
				<div class="refinance_lender_section__load_more">
					<button class="load" aria-label="Show All Consultants" aria-expanded="false" aria-controls="refinance_lender_options">
						<div class="text">Show All <?php echo wp_kses_post( $number_of_items ); ?> lenders</div>
						<span class="arrow">
							<svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
								<path d="M1 1L6.50008 6.50008L12.0002 1" stroke="#82BC46" />
							</svg>
						</span>
					</button>
				</div>

				<?php
			endif;
			?>

		</section>

	<?php endif; ?>

	<?php
}
add_action( 'tha_content_while_after', 'eqd_single_after_entry_content', 7 );

/**
 * Refinance student loans, single section.
 *
 * @return void
 */
function eqd_single_after_entry_modals() {
	$post_id = get_the_ID();
	if ( function_exists( 'yoast_get_primary_term_id' ) ) {
		$primary_category_id = yoast_get_primary_term_id( 'category', $post_id );
	}

	if ( have_rows( 'vendors', 'option' ) ) :
		?>

		<?php
		if ( get_field( 'show_private_student_loans_table_instead_of_refinance_table', 'category_' . $primary_category_id ) ) :

			if ( have_rows( 'private_student_loans_section', 'option' ) ) :

				// Loop through the rows of data.
				while ( have_rows( 'private_student_loans_section', 'option' ) ) :
					the_row();


					$disclosure_text = get_sub_field( 'disclosure_text' );
					?>

					<div id="modal_disclosure_<?php echo wp_kses_post( get_row_index() ); ?>" class="modal" aria-hidden="true" role="dialog" aria-modal="true">
						<div class="modal-content">
							<button class="close-btn">
								<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
							</button>
							<div class="content">
								<?php echo wp_kses_post( $disclosure_text ); ?>
							</div>
						</div>
					</div>

					<?php


				endwhile;

			endif;

		else :

			while ( have_rows( 'vendors', 'option' ) ) :
				the_row();
				$full_disclosure_content = get_sub_field( 'full_disclosure_content', 'option' );
				?>

				<div id="modal_disclosure_<?php echo esc_attr( get_row_index() ); ?>" class="modal" aria-hidden="true" role="dialog" aria-modal="true">
					<div class="modal-content">
						<button class="close-btn">
							<img src="<?php echo wp_kses_post( get_template_directory_uri() ) . '/assets/icons/utility/close-cross.svg'; ?>" alt="close modal">
						</button>
						<div class="content">
							<?php echo wp_kses_post( $full_disclosure_content ); ?>
						</div>
					</div>
				</div>

				<?php
			endwhile;

		endif;
	endif;
}
add_action( 'tha_content_after', 'eqd_single_after_entry_modals', 7 );

/**
 * Advertising Disclosure.
 *
 * @return void
 */
function advertising_disclosure() {
	?>
	<?php
	$disclosure_content = get_field( 'advertising_disclosure', 'option' );
	?>
	<div id="modal_disclosure" class="modal team-hightlight-block-modal" aria-hidden="true" role="dialog" aria-modal="true">
		<div class="modal-content">
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
	$post_id = get_the_ID();
	if ( function_exists( 'yoast_get_primary_term_id' ) ) {
		$primary_category_id = yoast_get_primary_term_id( 'category', $post_id );
	} else {
		return;
	}

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
				<?php if ( ! empty( $icon['url'] ) ) : ?>
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
	global $post; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.

	$id             = get_the_author_meta( 'ID' );
	$id_post_editor = get_field( 'post_editor', get_the_ID() );
	$user_info_id   = get_userdata( $id );
	$author_url_id  = get_author_posts_url( $id );

	if ( ! empty( $id_post_editor ) ) {
		$author_url  = get_author_posts_url( get_the_author_meta( 'ID' ) ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
		$author_name = get_the_author_meta( 'display_name', $id_post_editor['ID'] ); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
		$user_info   = get_userdata( $id_post_editor['ID'] );
		$first_name  = $user_info->first_name; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
		$last_name   = $user_info->last_name; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
		$nickname    = $user_info->nickname; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
	}

	if ( is_singular( 'slp_profession' ) ) {
		return;}
	?>

	<div class="article_footer_data">
		<div class="article_footer_data_author">
			<span class="article_footer_data_author_entry-author">
				<div class="article_footer_data_author_entry-author_titles">
					<?php echo get_avatar( $id, 80 ); ?>
					<div class="author_name">
						<?php echo esc_html( get_the_author() ); ?>
					</div>
				</div>

				<span class="article_footer_data_author_entry-info">
					<span class="article_footer_data_author_entry-data">
						<?php
						$yoast_meta_description = get_user_meta( $id );
						echo wp_kses_post( $yoast_meta_description['wpseo_metadesc'][0] );
						?>
					</span>
					<div class="article_footer_data_author_entry-inf__link">
						<a href="<?php echo esc_url( $author_url_id ); ?>">
							Read More from
							<?php
							echo esc_html( $user_info_id->first_name );
							?>
							<span class="arrow" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="11" height="8" viewBox="0 0 11 8" fill="none">
									<path d="M10.3536 4.35355C10.5488 4.15829 10.5488 3.84171 10.3536 3.64645L7.17157 0.464465C6.97631 0.269203 6.65973 0.269203 6.46447 0.464466C6.2692 0.659728 6.2692 0.97631 6.46447 1.17157L9.29289 4L6.46447 6.82843C6.2692 7.02369 6.2692 7.34027 6.46447 7.53553C6.65973 7.7308 6.97631 7.7308 7.17157 7.53553L10.3536 4.35355ZM4.37114e-08 4.5L10 4.5L10 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="#82BC46" />
								</svg>
							</span>
						</a>
					</div>
				</span>

			</span>
		</div>

		<?php
		$review_by_auth_id = get_field( 'post_reviewed_by', get_the_ID() );

		$profile_picture = get_avatar( $review_by_auth_id, 80 );
		if ( false !== $review_by_auth_id ) {
			$user_info  = get_userdata( $review_by_auth_id );
			$first_name = $user_info->first_name; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
			$last_name  = $user_info->last_name; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
			$nickname   = $user_info->nickname; // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
		}
		?>
		<?php if ( $review_by_auth_id ) : ?>

			<div class="article_footer_data_author_reviewed_author">
				<div class="article_footer_data_author_profile">
					<?php echo wp_kses_post( $profile_picture ); ?>
				</div>
				<div class="article_footer_data_author_author_info">
					Reviewed By
					<span class="name">
						<?php echo wp_kses_post( get_author_posts_link_by_id( $review_by_auth_id ) ); ?>
					</span>
				</div>


			</div>

		<?php endif; ?>
		<?php
		$post_editor_by_auth_id_footer = get_field( 'post_editor', get_the_ID() );

		$profile_picture = get_avatar( $post_editor_by_auth_id_footer['ID'], 80 );
		$user_info       = get_userdata( $post_editor_by_auth_id_footer['ID'] );

		?>
		<?php if ( ! empty( $post_editor_by_auth_id_footer['ID'] ) ) : ?>

			<div class="article_footer_data_author_reviewed_author editedby">
				<div class="article_footer_data_author_profile">
					<?php echo wp_kses_post( $profile_picture ); ?>
				</div>
				<div class="article_footer_data_author_author_info">
					Edited By
					<span class="name">
						<?php echo wp_kses_post( get_author_posts_link_by_id( $post_editor_by_auth_id_footer['ID'] ) ); ?>
					</span>
				</div>

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
		$hide_table_section_only = get_field( 'hide_table_section_only', get_the_ID() );
		if ( $hide_table_section_only ) {
			return;
		}
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
						<li class="vendor_disclosure_ol_li" id="sup_disclosure_<?php echo esc_attr( get_row_index() ); ?>">
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
	$term    = get_queried_object(); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
	$post_id = get_the_ID(); // Assuming you're in the loop.

	$primary_category = get_primary_category_id( $post_id );

	$show_related_posts       = get_field( 'show_related_posts', 'category_' . $primary_category );
	$select_posts_to_showcase = get_field( 'select_posts_to_showcase', 'category_' . $primary_category );
	$disable_related_posts    = get_field( 'disable_related_posts', $post_id );

	if ( $show_related_posts ) :
		if ( ! $disable_related_posts ) :

			?>
			<section class="single_related_posts">
				<div class="single_related_posts_container">
					<header class="single_related_posts_header">
						<h2 class="title">More on <?php echo esc_html( get_cat_name( $primary_category ) ); ?></h2>
						<div class="single_related_posts_header_link">
							<a href="<?php echo esc_url( get_category_link( $primary_category ) ); ?>" class="btn" aria-label="More <?php echo esc_html( get_cat_name( $primary_category ) ); ?> posts">More Posts</a>
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
								'cat'            => $primary_category,  // Category ID.
								'orderby'        => 'date',
								'order'          => 'DESC',
							);
						}

						$query = new WP_Query( $args );

						$posts_array = array(); // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- Leaving this here for future use.
						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								$author_email = get_the_author_meta( 'user_email' );
								?>
								<a class="single_related_posts_loop_item" href="<?php echo esc_url( get_the_permalink() ); ?>">
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
