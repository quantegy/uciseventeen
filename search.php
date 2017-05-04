<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/24/17
 * Time: 1:25 PM
 */
get_header(); ?>

<div class="container">
    <div class="row">
        <?php if (have_posts()) : ?>
            <h1 class="page-title"><?php printf(__('Search Results for: %s', 'uciseventeen'), '<span>' . get_search_query() . '</span>'); ?></h1>
        <?php else : ?>
            <h1 class="page-title"><?php _e('Nothing Found', 'uciseventeen'); ?></h1>
        <?php endif; ?>
    </div><!-- .page-header -->
</div>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <?php
                if (have_posts()) :
                    /* Start the Loop */
                    while (have_posts()) : the_post();
                        /**
                         * Run the loop for the search to output the results.
                         * If you want to overload this in a child theme then include a file
                         * called content-search.php and that will be used instead.
                         */
                        get_template_part('templates/post/content', 'excerpt');
                    endwhile; // End of the loop.

                    wp_bootstrap_pagination();

                else : ?>

                    <?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen'); ?>
                    <?php
                    get_search_form();

                endif;
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php //get_sidebar(); ?>

<?php get_footer();
