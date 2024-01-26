<section class="desktop-navigation">
    <nav class="primary-navigation" id="primary-navigation" aria-label="Primary Navigation">
        <?php get_template_part('partials/content/header/primary-navigation'); ?>

        <div class="search-popup" id="search-modal" role="dialog" aria-modal="true">
            <form action="/" method="get">
                <div class="under_line">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search-white.svg" alt="search" aria-hidden="true">
                    <div class="input-group">
                        <input type="text" name="s" id="modal_search" value="<?php the_search_query(); ?>" />
                        <label for="modal_search">Search for tools, occupations, resources, etc....</label>
                    </div>
                </div>
                <button class="btn" type="submit">Search</button>
            </form>
            <button class="close" id="close-search">
                <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility/'; ?>close-cross-white.svg" alt="close search">
            </button>
        </div>

        <div class="menu_desktop">
            <button class="menu_search_btn " id="menu_search_btn" aria-haspopup="dialog" aria-controls="search-modal" aria-expanded="false">
                <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search-white.svg" alt="search">
            </button>
            <?php get_template_part('partials/content/header/green-cta-button'); ?>
        </div>
    </nav>
</section>
