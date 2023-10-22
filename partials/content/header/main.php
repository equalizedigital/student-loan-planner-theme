<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$logo_tag = ( apply_filters( 'eqd_h1_site_title', false ) || ( is_front_page() && is_home() ) ) ? 'h1' : 'p';
?>

<div id="main-navigation">
	<button type="button" id="nav-icon" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
	</button>

	<div class="left-side">
		<div class="main-logo">
			<?php has_custom_logo() ? the_custom_logo() : '<a href="' . esc_url( home_url() ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>' ?>
		</div>
		<nav class="primary-navigation" id="primary-navigation" aria-label="Primary Navigation">
			<ul>

			<?php
				$menu_items = get_field('primary_header', 'option');

				if( $menu_items and is_array( $menu_items ) ) :
				foreach( $menu_items as $item ) {
					$link = $item['link'];
					$columns = $item['columns'];
					$number_of_columns = $item['number_of_columns'];
					$current_url = home_url( $_SERVER['REQUEST_URI'] );
					?>

					<li class="main-nav-link-li <?php echo $columns ? 'has-submenus' : ''; echo " submenu-column__$number_of_columns"; ?>">
					
						<?php if('#' === $link['url']) { ?>
							<button aria-label="<?php echo $link['title']; ?>" type="button" class="menu-item-main-link <?php if( empty($columns) ) { _e('menu-item-no-drop'); } ?>" data-toggle="<?php echo $link['title']; ?>" aria-expanded="false">
								<?php _e($link['title']); ?>
								<span class="chevron">
									<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</button>
							
						<?php } else { ?>
							
							<a href="<?php echo $link['url']; ?>" <?php if ( $link['url'] == $current_url ) {echo 'aria-current="page"';} ?> target="<?php echo $link['target']; ?>" class="menu-item-main-link <?php if( empty($columns) ) { _e('menu-item-no-drop'); } ?>">
								<?php _e($link['title']); ?>
								<span class="chevron">
									<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/arrow-up-green.svg" alt="chevron arrow">
								</span>
							</a>
							
						<?php } ?>
						
						<?php if( is_array( $columns ) && 0 < count( $columns ) ) { ?>
							<div class="sub_menu" id="<?php echo $link['title'] . '-submenu'; ?>">
								<button class="sub_menu_back" aria-label="Back to Menu">
									<span class="sub_menu_back__icon"></span>
									<span class="sub_menu_back__text"><?php _e('Back to All'); ?></span>
								</button>
								<button type="button" class="nav-icon open" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>

								<div class="sub_menu_dropdown__title">
									<?php _e($link['title']); ?>
								</div>
								
							<?php foreach( $columns as $column ) {
								$sub_menu_id = $column['sub_menu'];
								$hide_menu_title = $column['hide_menu_title'];
								if ( ! $sub_menu_id ) {
									continue;
								}
								?>
								<?php $sub_menu = wp_get_nav_menu_object( $sub_menu_id ); ?>

								<div class="menu-column">
									<h3 class="menu-column_title <?php echo $hide_menu_title?'menu-column-hidden':''; ?>"><?php echo $sub_menu->name; ?></h3>
									<?php
									wp_nav_menu( array(
										'menu' => $sub_menu_id,
										'container' => false,
										'menu_class' => 'sub-menu',
										'echo' => true,
										'fallback_cb' => 'wp_page_menu',
										'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth' => 0,
									) );
									?>
								</div> 
								<?php } ?>
							</div>
						<?php } ?>
					</li>

					<?php
				} 
				endif; ?>            
			</ul>

			<div class="search-popup" id="search-modal" role="dialog" aria-modal="true">
				<form action="/" method="get">
					<div class="under_line">
						<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search.svg" alt="search" aria-hidden="true">
						<div class="input-group">
							<input type="text" name="s" id="modal_search" value="<?php the_search_query(); ?>" />
							<label for="modal_search">Search for tools, occupations, resources, etc....</label>
						</div>
					</div>
					<button class="btn" type="submit">Search</button>
				</form>
				<button class="close" id="close-search"> 
					<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility/'; ?>close-cross.svg" alt="close search">
				</button>
			</div>

			<div class="menu_desktop">
				<button class="menu_search_btn " id="menu_search_btn" aria-haspopup="dialog" aria-controls="search-modal" aria-expanded="false">
					<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search.svg" alt="search">
				</button>
				<a href="<?php echo esc_url( get_site_url( null, '/hire-student-loan-help/' ) ); ?>" class="btn br-ten">Get Help</a>
			</div>

			<div class="menu_bottom">
				<div class="mobile_search">
					<form action="/" method="get">
						<img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search-white.svg" alt="search">
						<input type="text" name="s" placeholder="" id="search" value="<?php the_search_query(); ?>" />
						<label for="search">Search for tools, occupations, resources, etc....</label>
					</form>
				</div>
				<div class="mobile_help_btn">
					<a href="#" class="btn">Get Help</a>
				</div>
			</div>

		</nav>
	</div>
</div>
