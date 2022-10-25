<?php
/**
 * Search form
 *
 * @package      Mainspring
 * @author       Equalize Digital
 * @since        1.0.0
 * @license      GPL-2.0+
 **/

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text">Search for</span>
		<input type="search" class="search-field" placeholder="Search&hellip;" value="<?php echo get_search_query(); ?>" name="s" title="Search for" />
	</label>
	<button type="submit" aria-label="Submit" class="search-submit"><?php echo mst_icon( array( 'icon' => 'search-fat' ) ); ?></button>
</form>
