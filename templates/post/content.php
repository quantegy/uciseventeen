<?php if(empty(siteorigin_panels_render())): // we are not using a SO panels post/page ?>
<div class="container post-container">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="row page-heading-row">
                <div class="col-xs-12">
                    <h1 class="page-heading text-left"><?php the_title((!is_single()) ? '<a href="' . get_the_permalink() . '">' : '', (!is_single()) ? '</a>' : ''); ?></h1>
                </div>
            </div>
            <section aria-labeled-by="section-1-heading">
                <h2 class="section-heading sr-only" id="section-1-heading">Article</h2>
                <div class="row">
                    <div class="widget col-xs-12 col-md-12">
                        <div class="widget-bucket clearfix">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </section>
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

        <?php if(is_single()): ?>
        <div class="col-xs-12 <?php echo $colright; ?>">
            <?php get_sidebar(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php else: ?>
    <div class="pb-container">
        <?php the_content(); ?>
    </div>
<?php endif;