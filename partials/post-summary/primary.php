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
eqd_post_summary_image();

echo '<div class="post-summary__content">';
eqd_entry_category();
eqd_post_summary_title();
echo '</div>';

echo '</article>';
