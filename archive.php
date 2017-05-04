<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/13/17
 * Time: 12:30 PM
 */
get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12" id="content-body">
                <?php if (have_posts()): ?>
                    <div class="row page-heading-row">
                        <div class="col-xs-12">
                            <?php the_archive_title('<h1 class="page-heading text-left">', '</h1>'); ?>
                        </div>
                    </div>
                    <section aria-labelledby="section-1-heading" id="section-1">
                        <h2 class="section-heading sr-only" id="section-1-heading">Archive listing</h2>
                        <?php if (!empty(get_the_archive_description())): ?>
                            <div class="row">
                                <div class="widget col-xs-12 col-md-12">
                                    <div class="widget-bucket clearfix">
                                        <?php the_archive_description('<p>', '</p>'); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; $i = 1; ?>
                        <div class="row">
                            <?php while (have_posts()):
                            the_post(); ?>
                            <?php get_template_part('templates/archive/content', get_post_format()); ?>
                            <?php if ($i % 4 === 0): ?>
                        </div>
                        <div class="row">
                            <?php endif; ?>
                            <?php $i++; endwhile; ?>
                        </div>
                        <div class="row">
                            <?php wp_bootstrap_pagination(); ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
get_footer();
