<?php
class UCI_Recent_Posts_Widget extends WP_Widget_Recent_Posts {
    function widget($args, $instance) {

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

        if(empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 10;
        }

        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page' => $number, 
            'no_found_rows' => true,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true
        )));

        if($r->have_posts()) {
            echo $args['before_widget'];

            if($title) {
                echo $args['before_title'] . $title . $args['after_title'];
                ?>
                <ul class="list-group">
                    <?php while($r->have_posts()): $r->the_post(); ?>
                    <li class="list-group-item">
                        <?php the_time('F d'); ?> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php
            }

            echo $args['after_widget'];
        }
    }
}