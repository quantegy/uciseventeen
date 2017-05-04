<?php
class UCI_Categories_Widget extends WP_Widget_Categories {
    public function widget($args, $instance)
    {
        static $first_dropdown = true;

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Categories' ) : $instance['title'], $instance, $this->id_base );

        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';

        echo $args['before_widget'];

        if($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo $args['after_widget'];
    }
}