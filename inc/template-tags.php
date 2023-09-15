<?php
/**
 * Template Tags
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/**
 * Entry Category
 */
function eqd_entry_category() {
	$term = eqd_first_term();
	if ( empty( $term ) || is_wp_error( $term ) ) {
		return;
	}

	echo '<p class="entry-category">' . esc_html( $term->name ) . '</p>';
}

/**
 * Post Summary Title
 */
function eqd_post_summary_title() {
	global $wp_query, $cp_loop;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	if ( isset( $cp_loop->cp_no_title ) ) {
		$tag = 'h2';
	}
	echo '<' . esc_attr( $tag ) . ' class="post-summary__title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></' . esc_attr( $tag ) . '>';
}

/**
 * Post Summary Image
 *
 * @param array $size Image size.
 */
function eqd_post_summary_image( $size = 'thumbnail' ) {
	echo '<div class="post-summary__image"><a href="' . esc_url( get_permalink() ) . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( eqd_entry_image_id(), $size ) . '</a></div>';
}


/**
 * Entry Image ID
 */
function eqd_entry_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_eqd_default_image' );
}

/**
 * Entry Author
 */
function eqd_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<p class="entry-author"><a href="' . esc_url( get_author_posts_url( $id ) ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 40 ) . '</a><em>by</em> <a href="' . esc_url( get_author_posts_url( $id ) ) . '">' . get_the_author() . '</a></p>';
}

/**
 * Entry Date
 */
function eqd_entry_date() {
	$output = 'Published on <time datetime="' . get_the_date( 'Y-m-d' ) . '">' . get_the_date( 'F j, Y' ) . '</time>';
	if ( get_the_date( 'U' ) < ( get_the_modified_date( 'U' ) - WEEK_IN_SECONDS ) ) {
		$output .= ' / Last updated on <time datetime="' . get_the_modified_date( 'Y-m-d' ) . '">' . get_the_modified_date( 'F j, Y' ) . '</time>';
	}
	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Value is hardcoded and safe, not set via input.
	echo '<p class="entry-date">' . $output . '</p>';
}


/**
 * Single Title
 */

function eqd_tha_footer_cta() {
	// Load values and assing defaults.
	$enable = get_field( 'enable' );
	$title  = get_field( 'title' );
	$copy   = get_field( 'copy' );
	if ( get_field( 'image' ) ) {
		$image = get_field( 'image' );
	}
	if ( $enable ) :
		?>

<section class="block calculator-signup-block">
	<div class="calculator-signup-container">
		<figure class="calculator-signup-container-image">
			<?php if ( ! empty( $image ) ) : ?>
			<img src="<?php echo $image['url']; ?>" alt="signup image">
			<?php endif; ?>
		</figure>

		<div class="calculator-signup-container-content">
			<h2 class="title"><?php echo $title; ?></h2>
			<div class="text"><?php echo $copy; ?></div>

			<?php
			$list = get_field( 'list' );
			if ( $list ) {
				echo '<div class="calculator-signup-container-content-list">';
				foreach ( $list as $row ) {
					if ( ! empty( $row['image'] ) ) {
						$image = $row['image']['url'];
					}
					if ( ! empty( $row['image'] ) ) {
						$imageAlt = $row['image']['alt'];
					}
					$title   = $row['title'];
					$context = $row['context'];

					echo '<div class="calculator-signup-container-content-list-item">';
					if ( ! empty( $image ) ) {
						echo "<img src='$image' alt='$imageAlt'></img>";
					}
					echo '<div class="calculator-signup-container-content-list-item-content">';
					if ( ! empty( $title ) ) {
						echo '<h3>';
							echo $title;
						echo '</h3>';
					}
					if ( ! empty( $context ) ) {
						echo '<span class="content">';
							echo $context;
						echo '</span>';
					}
					echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			}
			?>
		</div>
	</div>
</section>

		<?php
	endif;
}
add_action( 'tha_footer_cta', 'eqd_tha_footer_cta' );


