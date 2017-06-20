<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 5/8/17
 * Time: 2:15 PM
 */
class UCI_Recent_Comments_Widget extends WP_Widget_Recent_Comments {
    public function widget($args, $instance) {
        $output = '';

        $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Comments') : $instance['title'], $instance, $this->id_base);

        if(empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 5;
        }

        $c = get_comments(apply_filters('widget_comments_args', array(
            'number' => $number,
            'status' => 'approve',
            'post_status' => 'publish'
        )));

        $output .= $args['before_widget'];

        if($title) {
            $output .= $args['before_title'] . $title . $args['after_title'];
        }

        if(is_array($c) && $c) {
            $output .= '<ul class="list-group">';

            foreach((array) $c as $comment) {
                $output .= '<li class="list-group-item">';

                $output .= '<span>' . get_comment_author_link($comment) . '</span> on ';
                $output .= '<a href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a>';

                $output .= '</li>';
            }

            $output .= '</ul>';
        }

        $output .= $args['after_widget'];

        echo $output;
    }
}