<?php
$menu_items = get_field( 'primary_header', 'option' );
?>

<ul>
    <?php
    if ( $menu_items && is_array( $menu_items ) ) :
        foreach ( $menu_items as $item ) {
            $link = $item['link'];
            $columns = $item['columns'];
            $number_of_columns = $item['number_of_columns'];
            $current_url = home_url( $_SERVER['REQUEST_URI'] );
            ?>

            <li class="main-nav-link-li <?php echo $columns ? 'has-submenus' : ''; echo " submenu-column__$number_of_columns"; ?>">

                <?php if ( '#' === $link['url'] ) { ?>
                    <button aria-label="<?php echo $link['title']; ?>" type="button" class="menu-item-main-link
                                <?php
                    if ( empty( $columns ) ) {
                        _e( 'menu-item-no-drop' );
                    }
                    ?>
                            " data-toggle="<?php echo $link['title']; ?>" aria-expanded="false">
                        <?php _e( $link['title'] ); ?>
                        <span class="chevron">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/arrow-up-green.svg"
                                         alt="chevron arrow">
                                </span>
                    </button>

                <?php } else { ?>

                    <a href="<?php echo $link['url']; ?>"
                        <?php
                        if ( $link['url'] === $current_url ) {
                            echo 'aria-current="page"';
                        }
                        ?>
                       target="<?php echo $link['target']; ?>" class="menu-item-main-link
                                <?php
                    if ( empty( $columns ) ) {
                        _e( 'menu-item-no-drop' );
                    }
                    ?>">
                        <?php _e( $link['title'] ); ?>
                        <span class="chevron">
                                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/arrow-up-green.svg"
                                         alt="chevron arrow">
                                </span>
                    </a>

                <?php } ?>

                <?php if ( is_array( $columns ) && 0 < count( $columns ) ) { ?>
                    <div class="sub_menu" id="<?php echo $link['title'] . '-submenu'; ?>">
                        <button class="sub_menu_back" aria-label="Back to Menu">
                            <span class="sub_menu_back__icon"></span>
                            <span class="sub_menu_back__text"><?php _e( 'Back to All' ); ?></span>
                        </button>

                        <div class="sub_menu_dropdown__title">
                            <?php _e( $link['title'] ); ?>
                        </div>

                        <?php
                        foreach ( $columns as $column ) {
                            $sub_menu_id = $column['sub_menu'];
                            $hide_menu_title = $column['hide_menu_title'];
                            if ( ! $sub_menu_id ) {
                                continue;
                            }
                            ?>
                            <?php $sub_menu = wp_get_nav_menu_object( $sub_menu_id ); ?>

                            <div class="menu-column">
                                <h3 class="menu-column_title <?php echo $hide_menu_title ? 'menu-column-hidden' : ''; ?>"><?php echo $sub_menu->name; ?></h3>
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
