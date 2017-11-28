<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 clearfix">
                <?php the_post_thumbnail('full', array('class' => 'portrait-header')); ?>
                <div class="caption"><?php the_post_thumbnail_caption(); ?></div>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
            </div>
            <aside class="col-md-4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>