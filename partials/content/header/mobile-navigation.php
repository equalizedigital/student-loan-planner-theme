<section class="mobile-navigation">
    <button type="button" id="nav-icon" title="Mobile Menu" aria-controls="primary-navigation" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="mobile-cta-button">
        <?php get_template_part('partials/content/header/green-cta-button'); ?>
    </div>

    <nav class="primary-navigation" id="primary-navigation" aria-label="Mobile Primary Navigation">
        <?php get_template_part('partials/content/header/primary-navigation'); ?>

        <div class="mobile-navigation-footer">
            <div class="mobile-search">
                <form action="/" method="get">
                    <img src="<?php echo get_template_directory_uri() . '/assets/icons/utility'; ?>/search-white.svg" alt="search">
                    <input type="text" name="s" placeholder="" id="search" value="<?php the_search_query(); ?>" required/>
                    <label for="search">Search for tools, occupations, resources, etc....</label>
                </form>
            </div>

            <div id="mobile-help-button" class="mobile-help-button">
                <?php get_template_part('partials/content/header/green-cta-button'); ?>
            </div>
        </div>
    </nav>
</section>