<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                <?php the_post_thumbnail('full', array('class' => 'portrait-header')); ?>
                <h1><?php the_title(); ?></h1>
                <p><?php the_content(); ?></p>
            </div>
            <aside class="col-md-12">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>