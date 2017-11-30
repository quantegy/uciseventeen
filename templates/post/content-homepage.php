<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 8/21/17
 * Time: 9:55 AM
 */
?>
<div class="col-md-4">
	<?php if(has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>">
	    <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
    </a>
	<?php endif; ?>
	<?php the_date('F j, Y', '<div class="post-meta">', '</div>'); ?>
    <a href="<?php the_permalink(); ?>"><?php the_title('<h2>', '</h2>'); ?></a>
	<p><?php the_excerpt(); ?></p>
</div>