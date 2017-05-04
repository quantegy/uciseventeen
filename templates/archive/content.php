<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/13/17
 * Time: 2:01 PM
 */
?>
<div class="widget col-xs-12 col-md-3">
    <div class="widget-bucket clearfix">
        <h3 class="widget-heading">
            <span><?php the_title(); ?></span>
        </h3>
        <?php if(has_post_thumbnail()): ?>
        <div class="bucket-image bucket-image-center">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
        <?php endif; ?>
        <p><?php the_excerpt(); ?></p>
    </div>
</div>
