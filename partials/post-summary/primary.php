<?php
/**
 * Archive partial
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<article class="post-summary post-summary--primary">';
	echo '<div class="post-summary__content">';
		eqd_post_summary_title();
		eqd_post_author();
	echo '</div>';
echo '</article>';
