<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/13/17
 * Time: 12:30 PM
 */
get_header();
?>

    <div class="container category">
		<?php if ( have_posts() ): $i = 1; ?>
            <div class="row">
			<?php the_archive_title( '<div class="col-xs-12"><h1>', '</h1></div>' ); ?>
			<?php //the_archive_description('<p>', '</p>'); ?>
			<?php while ( have_posts() ): the_post(); ?>
				<?php get_template_part( 'templates/archive/content', get_post_format() ); ?>
				<?php if ( $i % 3 === 0 ): // rows are 3 columns each ?>
                    </div>
                    <div class="row">
				<?php endif;
				$i ++; ?>
			<?php endwhile; ?>
            </div>
            <div class="row"><?php wp_bootstrap_pagination(); ?></div>
		<?php else: ?>
		<?php endif; ?>
    </div>
<?php
get_footer();
