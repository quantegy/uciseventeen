<div class="container">
    <div class="row">
        <div class="col-md-12 article-row-full">
	        <div class="portrait-header">
	            <?php if(has_post_thumbnail() && !uciseventeen_has_featured_video()): ?>
	            <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
				<?php if (get_the_post_thumbnail_caption() != ''): ?>
						<div class="caption"><?php the_post_thumbnail_caption(); ?></div>
				<?php endif; ?>
	            <?php elseif(has_post_thumbnail() && uciseventeen_has_featured_video()): ?>
		            <?php echo wp_oembed_get(uciseventeen_get_featured_video_url()); ?>
	            <?php endif; ?>
	        </div>
            <h1 class="page-heading"><?php the_title(); ?></h1>
            <p><?php the_content(); ?></p>
        </div>
        <aside class="col-md-12">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>
