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
?>

<?php tha_comments_before(); ?>
<div id="comments" class="entry-comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h3 class="comments-title"><?php esc_html_e( 'Comments', 'mainspring' ); ?></h3>
		<?php eqd_comment_navigation( 'before' ); ?>
		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'style' => 'ol',
						'type' => 'comment',
					)
				);
			?>
		</ol><!-- .comment-list -->
		<?php
		eqd_comment_navigation( 'after' );

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'mainspring' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
<?php tha_comments_after(); ?>
