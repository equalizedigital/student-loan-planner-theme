<?php
/**
 * Comments
 *
 * @package      Mainspring
 * @author       Road Warrior Creative
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
		<h3 class="comments-title"><?php esc_html_e( 'Comments', 'cultivate_textdomain' ); ?></h3>
		<?php mst_comment_navigation( 'before' ); ?>
		<ol class="comment-list">
			<?php
				wp_list_comments( [ 'style' => 'ol', 'type' => 'comment' ] );
			?>
		</ol><!-- .comment-list -->
		<?php
		mst_comment_navigation( 'after' );

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cultivate_textdomain' ); ?></p>
		<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
<?php tha_comments_after(); ?>
