<main>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php if(has_post_thumbnail() && !uciseventeen_has_featured_video()): ?>
				<?php the_post_thumbnail( 'full', [ 'class' => 'img-responsive' ] ); ?>
                <div class="caption"><?php the_post_thumbnail_caption(); ?></div>
                <?php elseif(has_post_thumbnail() && uciseventeen_has_featured_video()): ?>
	                <?php echo wp_oembed_get(uciseventeen_get_featured_video_url()); ?>
                <?php endif; ?>
                <h1 class="page-heading"><?php the_title(); ?></h1>
	            <?php the_date(); ?>
                <p><?php the_content(); ?></p>
            </div>
            <aside class="col-md-4">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>