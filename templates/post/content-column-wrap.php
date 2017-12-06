<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 clearfix">
	            <?php if(has_post_thumbnail()): ?>
                <?php the_post_thumbnail('full', array('class' => 'portrait-header')); ?>
                <div class="caption"><?php the_post_thumbnail_caption(); ?></div>
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