<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 7/5/17
 * Time: 11:25 AM
 */
$template = get_post_meta(get_the_ID(), UCISEVENTEEN_POST_FORMAT_KEY, true);
?>
<?php if(is_single()): ?>
<div class="container post-container">
    <?php get_template_part('templates/post/content', (empty($template)) ? 'style-left': $template); ?>
</div>
<?php else: ?>
<div>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
</div>
<?php endif;
