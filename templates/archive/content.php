<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/13/17
 * Time: 2:01 PM
 */
$classes = ['img-responsive'];
if(uciseventeen_has_featured_video()) {
	$classes[] = 'featured-video';
}
?>
<div class="col-md-4">
	<?php if(has_post_thumbnail()): ?>
    <a href="<?php the_permalink(); ?>">
		<?php
        the_post_thumbnail('large', array('class' => implode(' ', $classes)));
        ?>
    </a>
	<?php endif; ?>
    <a href="<?php the_permalink(); ?>">
	    <?php the_title('<h2>', '</h2>'); ?>
    </a>
	<?php the_date('F j, Y', '<div class="post-meta">', '</div>'); ?>
    <?php the_excerpt(); ?>
</div>
