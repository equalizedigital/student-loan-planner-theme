<?php
/**
 * Primary Navigation
 *
 * @package Equalize Digital Base Theme
 */

$menu_items              = get_field( 'primary_header', 'option' );
$arrow_up_green_svg_path = get_template_directory_uri() . '/assets/icons/utility/arrow-up-green.svg';
?>

<ul>
	<?php
	if ( $menu_items && is_array( $menu_items ) ) :
		foreach ( $menu_items as $item ) {
			$link_item               = $item['link'];
			$columns                 = $item['columns'];
			$number_of_columns       = $item['number_of_columns'];
			$current_url             = home_url( $_SERVER['REQUEST_URI'] );
			$menu_item_no_drop_class = empty( $columns ) ? 'menu-item-no-drop' : '';
			$aria_current_page       = $link_item['url'] === $current_url ? 'aria-current="page"' : ''
			?>

			<li class="main-nav-link-li
			<?php
			echo esc_attr( $columns ) ? 'has-submenus' : '';
			echo esc_attr( " submenu-column__$number_of_columns" );
			?>
			">
				<?php if ( '#' === $link_item['url'] ) { ?>
					<button
						aria-label="<?php echo esc_attr( $link_item['title'] ); ?>"
						type="button"
						class="menu-item-main-link <?php echo esc_attr( $menu_item_no_drop_class ); ?>"
						data-toggle="<?php echo esc_attr( $link_item['title'] ); ?>"
						aria-expanded="false">
						<?php esc_html_e( $link_item['title'], 'eqd' ); ?>
						<span class="chevron">
							<img src="<?php echo esc_url( $arrow_up_green_svg_path ); ?>" alt="chevron arrow">
						</span>
					</button>
				<?php } else { ?>
					<a
						href="<?php echo esc_url( $link_item['url'] ); ?>" <?php echo esc_attr( $aria_current_page ); ?>
						target="<?php echo esc_attr( $link_item['target'] ); ?>"
						class="menu-item-main-link <?php echo esc_attr( $menu_item_no_drop_class ); ?>">
						<?php esc_html_e( $link_item['title'], 'eqd' ); ?>
						<span class="chevron">
							<img src="<?php echo esc_url( $arrow_up_green_svg_path ); ?>" alt="chevron arrow">
						</span>
					</a>
				<?php } ?>

				<?php if ( is_array( $columns ) && 0 < count( $columns ) ) { ?>
					<div class="sub_menu" id="<?php echo esc_attr( $link_item['title'] ) . '-submenu'; ?>">
						<button class="sub_menu_back" aria-label="Back to Menu">
							<span class="sub_menu_back__icon"></span>
							<span class="sub_menu_back__text">
								<?php esc_html_e( 'Back to All', 'eqd' ); ?>
							</span>
						</button>
						<div class="sub_menu_dropdown__title">
							<?php esc_html( $link_item['title'] ); ?>
						</div>

						<?php
						foreach ( $columns as $column ) {
							$sub_menu_id     = $column['sub_menu'];
							$hide_menu_title = $column['hide_menu_title'];
							if ( ! $sub_menu_id ) {
								continue;
							}
							?>

							<?php $sub_menu = wp_get_nav_menu_object( $sub_menu_id ); ?>

							<div class="menu-column">
								<h3 class="menu-column_title <?php echo esc_attr( $hide_menu_title ) ? 'menu-column-hidden' : ''; ?>">
									<?php echo esc_html( $sub_menu->name ); ?>
								</h3>
								<?php
								wp_nav_menu(
									array(
										'menu'        => $sub_menu_id,
										'container'   => false,
										'menu_class'  => 'sub-menu',
										'echo'        => true,
										'fallback_cb' => 'wp_page_menu',
										'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth'       => 0,
									)
								);
								?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</li>
			<?php
		}
	endif;
	?>
</ul>
