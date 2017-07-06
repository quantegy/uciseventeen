<?php // @todo consider what to do without siteorigin stuff ?>

<?php if (is_plugin_active('siteorigin-panels/siteorigin-panels.php')): ?>
    <?php if (empty(siteorigin_panels_render())): // show normal WP page/post content ?>
    <?php get_template_part('templates/primary-content'); ?>
    <?php else: // show pagebuilder content ?>
        <div class="pb-container">
            <?php the_content(); ?>
        </div>
    <?php endif; ?>
    <?php else: ?>
    <?php get_template_part('templates/primary-content'); ?>
<?php endif;