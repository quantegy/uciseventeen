<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 5/15/17
 * Time: 9:58 AM
 */
class WP_UCI_Category_Walker extends Walker_Category {
    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
    {

        $cat_name = esc_attr($category->name);
        $cat_name = apply_filters('list_cats', $cat_name, $category);

        $link = '<a href="' . esc_url(get_term_link($category)) . '" ';

        if($args['use_desc_for_title'] == 0 || empty($category->description)) {
            $link .= 'title="' . esc_attr(sprintf(__('View all posts filed under %s'), $cat_name)) . '"';
        } else {
            $link .= 'title="' . esc_attr(strip_tags(apply_filters('category_description', $category->description, $category))) . '"';
        }

        $link .= '>' . $cat_name . '</a>';

        if(!empty($args['feed_image']) || !empty($args['feed'])) {
            $link .= ' ';

            if(empty($args['feed_image'])) {
                $link .= '(';
            }

            $link .= '<a href="' . esc_url(get_term_feed_link($category->term_id, $category->taxonomy, $args['feed_type'])) . '">';

            if(empty($args['feed'])) {
                $alt = ' alt="' . sprintf(__('Feed for all posts filed under %s'), $cat_name) . '"';
            } else {
                $title = ' title="' . $args['feed'] . '"';
                $alt = ' alt="' . $args['feed'] . '"';
                $name = $args['feed'];
                $link .= $title;
            }

            $link .= '>';

            if(empty($args['feed_image'])) {
                $link .= $name;
            } else {
                $link .= '<img src="' . $args['feed_image'] . $alt . $title . '">';
            }

            $link .= '</a>';

            if(empty($args['feed_image'])) {
                $link .= ')';
            }
        }

        if(!empty($args['show_count'])) {
            $link .= ' (' . intval($category->count) . ')';
        }

        if($args['style'] === 'list') {
            $output .= "\t" . '<li';

            $class = 'list-group-item cat-item cat-item-' . $category->term_id;

            if($depth) {
                $class .= ' sub-list-group-item sub-' . sanitize_title_with_dashes($category->name);
            }

            if(!empty($args['current_category'])) {
                $_current_category = get_term($args['current_category'], $category->taxonomy);

                if($category->term_id == $args['current_category']) {
                    $class .= ' current-cat';
                } else if($category->term_id == $_current_category->parent) {
                    $class .= ' current-cat-parent';
                }
            }

            $output .= ' class="' . $class . '"';
            $output .= '>' . $link . "\n";
        } else {
            $output .= "\t" . $link . '<br>' . "\n";
        }
    }
}