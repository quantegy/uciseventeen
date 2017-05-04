<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/27/17
 * Time: 1:18 PM
 */
?>

<?php if(has_post_thumbnail()): // show media object ?>
    <div class="row search-heading">
        <div class="col-xs-12">
            <h2 class="text-left">
                <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="widget col-xs-12 col-md-8">
            <div class="widget-bucket clearfix">
                <p class="lead"><?php the_excerpt(); ?></p>
            </div>
        </div>
        <div class="widget col-xs-12 col-md-4">
            <div class="widget-bucket clearfix">
                <div class="bucket-image bucket-image-center">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>

<?php endif; ?>

