<?php get_header(); ?>

<?php if (is_home() && !is_front_page()): ?>
Homepage
<?php else: ?>

    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('templates/post/content', get_post_format()); ?>
        <?php endwhile; ?>

        <?php wp_bootstrap_pagination(); ?>
    <?php else: ?>
        <?php get_template_part('templates/post/content', 'none'); ?>
    <?php endif; ?>

<?php endif; // end homepage check ?>

<?php get_footer();
