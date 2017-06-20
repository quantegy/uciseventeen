<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 5/9/17
 * Time: 4:40 PM
 */
class UCI_Archives_Widget extends WP_Widget_Archives {
    public function widget($args, $instance)
    {
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives' ) : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];
        if ( $title ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        /**
         * if we have a dropdown archive
         */
        if($d) {
            $dropdownId = $this->id_base . '-dropdown-' . $this->number;

            ?>
            <div class="form-group">
                <label for="<?php echo esc_attr($dropdownId); ?>" class="sr-only"><?php echo $title; ?></label>
                <select class="form-control" id="<?php echo $dropdownId; ?>" name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
                    <?php
                    /**
                     * Filters the arguments for the Archives widget drop-down.
                     *
                     * @since 2.8.0
                     *
                     * @see wp_get_archives()
                     *
                     * @param array $args An array of Archives widget drop-down arguments.
                     */
                    $dropdown_args = apply_filters( 'widget_archives_dropdown_args', array(
                        'type'            => 'monthly',
                        'format'          => 'option',
                        'show_post_count' => $c
                    ) );

                    switch ( $dropdown_args['type'] ) {
                        case 'yearly':
                            $label = __( 'Select Year' );
                            break;
                        case 'monthly':
                            $label = __( 'Select Month' );
                            break;
                        case 'daily':
                            $label = __( 'Select Day' );
                            break;
                        case 'weekly':
                            $label = __( 'Select Week' );
                            break;
                        default:
                            $label = __( 'Select Post' );
                            break;
                    }
                    ?>
                    <option value=""><?php echo esc_attr($label); ?></option>
                    <?php wp_get_archives($dropdown_args); ?>
                </select>
            </div>
            <?php
        } else {
            ?>
            <ul class="list-group">
            <?php wp_get_archives(apply_filters('widget_archives_args', array(
                'type' => 'monthly',
                'format' => 'bootstrap',
                'show_post_content' => $c
            ))); ?>
            </ul>
            <?php
        }

        echo $args['after_widget'];
    }
}