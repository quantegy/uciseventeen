<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 7/5/17
 * Time: 11:25 AM
 */
?>
<div class="container post-container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="row page-heading-row">
                <div class="col-xs-12">
                    <h1 class="page-heading text-left"><?php the_title((!is_single()) ? '<a href="' . get_the_permalink() . '">' : '', (!is_single()) ? '</a>' : ''); ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?php if(is_plugin_active('cj-authorship/cj-authorship.php')): ?>
            <?php cj_authorship_output_authors(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <?php
        /**
         * if no sidebar fill out whole page
         */
        $colleft = (is_single()) ? 'col-md-8' : 'col-md-12';
        $colright = (is_single()) ? 'col-md-4' : 'col-md-12';
        ?>
        <div class="col-xs-12 <?php echo $colleft; ?>">
            <?php the_content(); ?>
        </div>

        <?php if (is_single()): ?>
            <div class="col-xs-12 <?php echo $colright; ?>">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>