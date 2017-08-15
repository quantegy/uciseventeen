<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/13/17
 * Time: 2:01 PM
 */
?>
<div class="col-md-4">
    <?php if(has_post_thumbnail()): ?>
    <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
    <?php endif; ?>
    <h2><?php the_title(); ?></h2>
    <p><?php the_excerpt(); ?></p>
</div>
