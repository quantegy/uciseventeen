<?php get_header(); ?>

<?php if (is_home() && !is_front_page()): ?>
Homepage
<?php else: ?>
<div class="container category">
    <?php if (have_posts()): $i = 1; ?>
        <div class="row"> <!-- begin row -->
            <h1><?php echo get_bloginfo('name'); ?></h1>
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('templates/post/content', 'homepage'); ?>
            <?php if($i % 3 === 0): // rows are 3 columns each ?>
                </div> <!-- end row -->
                <div class="row"> <!-- begin row -->
            <?php endif; $i++; ?>
        <?php endwhile; ?>
        </div> <!-- end row -->
        <div class="row"><?php wp_bootstrap_pagination(); ?></div>
    <?php else: ?>
        <?php get_template_part('templates/post/content', 'none'); ?>
    <?php endif; ?>
</div> <!-- end container -->
<?php endif; // end homepage check ?>

<?php get_footer();
