<?php
/**
 * Site Footer
 *
 * @package      Equalize Digital Base Theme
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

tha_footer_cta();

echo '</div>'; // .site-inner

tha_footer_before();
echo '<footer class="site-footer" role="contentinfo"><h2 class="screen-reader-text">' . esc_html( get_bloginfo() ) . ' Footer</h2><div class="wrap">';
tha_footer_top();
tha_footer_bottom();
echo '</div></footer>';
tha_footer_after();

echo '</div>';
tha_body_bottom();
wp_footer();

echo '</body></html>';
