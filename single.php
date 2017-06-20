<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 5/8/17
 * Time: 5:03 PM
 */
get_header();
?>
<?php while (have_posts()): the_post(); ?>
    <?php get_template_part('templates/post/content', get_post_format()); ?>

    <?php if (comments_open() || get_comments_number()): ?>
        <?php comments_template(); ?>
    <?php endif; ?>

    <?php wp_bootstrap_pagination(); ?>
<?php endwhile; ?>
<?php get_footer();
