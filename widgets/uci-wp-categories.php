<?php

/**
 * Class UCI_Categories_Widget
 * @todo fix dropdown selection
 */
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

        $cat_args = array(
            'orderby'      => 'name',
            'show_count'   => $c,
            'hierarchical' => $h
        );

        if($d) {
            $dropdown_id = ($first_dropdown) ? 'cat' : $this->id_base . '-dropdown-' . $this->number;
            $first_dropdown = false;

            echo '<label class="sr-only" for="' . esc_attr($dropdown_id) . '">' . $title . '</label>';

            $cat_args['show_option_none'] = __('Select category');
            $cat_args['id'] = $dropdown_id;
            $cat_args['class'] = 'form-control';
            $cat_args['hide_if_empty'] = true;

            echo '<div class="form-group">';
            wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));
            echo '</div>';

            ?>
            <script type="text/javascript">
                (function() {
                    var dropdown = document.getElementById('<?php echo esc_js($dropdown_id); ?>');
                    function onCatChange() {
                        if(dropdown.options[dropdown.selectedIndex].value > 0) {
                            location.href = '<?php echo home_url('/'); ?>?cat=' + dropdown.options[dropdown.selectedIndex].value;
                        }
                    }
                    dropdown.onchange = onCatChange;
                })();
            </script>
            <?php
        } else {
            echo '<ul class="list-group">';

            wp_list_categories(array(
                'title_li' => '',
                'use_desc_for_title' => true,
                'walker' => new WP_UCI_Category_Walker()
            ));
            echo '</ul>';
        }

        echo $args['after_widget'];
    }
}