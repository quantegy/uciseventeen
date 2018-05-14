<?php
	$image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "medium_large" );
	$image_width = $image_data[1];
	$image_height = $image_data[2];
	$article_class = '';
	if ($image_width > $image_height) {
		$article_class = 'article-column-full';
	} else {
		$article_class = 'article-column-wrap';
	}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 clearfix <?php echo $article_class; ?>">
            <div class="portrait-header">
	            <?php if(has_post_thumbnail() && !uciseventeen_has_featured_video()): ?>
	            <?php the_post_thumbnail('medium_large'); ?>
				<?php if (get_the_post_thumbnail_caption() != ''): ?>
						<div class="caption"><?php the_post_thumbnail_caption(); ?></div>
				<?php endif; ?>
	            <?php elseif(has_post_thumbnail() && uciseventeen_has_featured_video()): ?>
	                <?php echo wp_oembed_get(uciseventeen_get_featured_video_url()); ?>
	            <?php endif; ?>
            </div>
            <h1 class="page-heading"><?php the_title(); ?></h1>
            <?php the_date(); ?>
            <p><?php the_content(); ?></p>
        </div>
        <aside class="col-md-4">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>
