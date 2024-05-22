<?php
/**
 * Comments
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
 * Has children.
 *
 * @param int $comment_id The comment ID.
 * @return boolean
 */
function has_children( $comment_id ) {
	$children = get_comments( array( 'parent' => $comment_id ) );
	return ! empty( $children );
}

/**
 * Add class to comment with children.
 *
 * @param array $classes The comment classes.
 * @return array
 */
function add_class_to_comment_with_children( $classes ) {
	global $comment;
	if ( has_children( $comment->comment_ID ) ) {
		$classes[] = 'has-children';
	}
	return $classes;
}
add_filter( 'comment_class', 'add_class_to_comment_with_children' );

if ( ! function_exists( 'comments_callback' ) ) :
	
	/**
	 * Comments callback.
	 *
	 * @param string $comment The comment.
	 * @param array  $args The arguments.
	 * @param int    $depth The depth.
	 * @return void
	 */
	function comments_callback( $comment, $args, $depth ) {
		?>

		<li <?php comment_class(); ?> id="div-comment-<?php comment_ID(); ?>">

			<div class="comment-container">
				<div class="comment-author">
					<div class="comment-authorimg">
						<img src="<?php echo esc_url( get_avatar_url( $comment->user_id, 32 ) ); ?>" alt="">
					</div>
					<div class="author-info">
					<strong><?php echo esc_html( get_comment_author() ); ?></strong>
					<span class="date align-right">
							<?php 
							/* translators: 1: comment date, 2: comment time */
							printf( esc_html__( '%1$s at %2$s', 'eqd' ), esc_html( get_comment_date() ), esc_html( get_comment_time( 'g:i A' ) ) ); 
							?>
					</span>
					</div>
				</div>

				<div class="comment-block">
						<?php if ( '0' === $comment->comment_approved ) : ?>
						<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'eqd' ); ?></em>
					<?php endif; ?>

					<span class="comment-by">
						<a href="#">
								<?php
								comment_reply_link(
									array_merge(
										$args,
										array(
											'depth'     => $depth,
											'max_depth' => $args['max_depth'],
										)
									)
								);
								?>
						</a>
					</span>

					<div class="comment-text">
						<?php comment_text(); ?>
					</div>
				</div>
			</div>

		</li>

		<?php
	}
endif;
?>

<?php tha_comments_before(); ?>
	<div id="comments" class="entry-comments">
		<?php if ( have_comments() ) : ?>
			<h3 class="comments-title"><?php esc_html_e( 'Comments', 'eqd' ); ?></h3>

			<?php
			eqd_comment_navigation( 'before' );
			?>

			<ol class="comment-list">
				<?php
					wp_list_comments(
						array(
							'callback' => 'comments_callback',
						)
					);
				?>
			</ol>

			<?php
			eqd_comment_navigation( 'after' );
		endif;

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'eqd' ); ?></p>
			<?php
		endif;

		comment_form();
		?>

	</div>
	<!-- #comments -->
<?php tha_comments_after(); ?>
