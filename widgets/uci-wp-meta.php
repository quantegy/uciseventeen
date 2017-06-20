<?php
/**
 * Created by PhpStorm.
 * User: walshcj
 * Date: 5/10/17
 * Time: 2:31 PM
 */
class UCI_Meta_Widget extends WP_Widget_Meta {
    public function widget($args, $instance)
    {
        $title = apply_filters( 'widget_title', empty($instance['title']) ? __( 'Meta' ) : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        ?>
        <ul class="list-group">
            <?php wp_register('<li class="list-group-item">', '</li>') ?>
            <li class="list-group-item">
                <?php wp_loginout(); ?>
            </li>
            <li class="list-group-item">
                <a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
            </li>
            <li class="list-group-item">
                <a href="<?php echo esc_url(get_bloginfo('comments_rss2_url')); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a>
            </li>
            <?php
            echo apply_filters('widget_meta_poweredby', sprintf('<li class="list-group-item"><a href="%s" title="%s">%s</a></li>', esc_url(__('https://wordpress.org/')), esc_attr('Powered by WordPress, state-of-the-art semantic personal publishing platform'), _x('WordPress.org', 'meta widget link text')));
            ?>
            <?php wp_meta(); ?>
        </ul>
        <?php

        echo $args['after_widget'];
    }
}