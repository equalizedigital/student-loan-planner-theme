<?php
/**
 * Archive partial
 *
 * @package      Mainspring
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

echo '<article class="post-summary post-summary--primary">';
mst_post_summary_image();

echo '<div class="post-summary__content">';
mst_entry_category();
mst_post_summary_title();
echo '</div>';

echo '</article>';
