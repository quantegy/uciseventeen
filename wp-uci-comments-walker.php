<?php

/**
 * Basic bootstrap HTML comment list class.
 *
 * @uses Walker
 */
class UCI_Comment_Walker extends Walker {


    public $tree_type = 'comment';


    public $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');

    /**
     * Start the list before the elements are added.
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of comment.
     * @param array $args Not use.
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output.="<!-- start_lvl: $depth -->"; //only for help purpose
    }

    /**
     * End the list of items after the elements are added.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of comment.
     * @param array  $args   Not use.
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $GLOBALS['comment_depth'] = $depth + 1;
        $output.="<!-- end_lvl: $depth -->"; //only for help purpose
    }

    /**
     * Traverse elements to create list from elements.
     *
     * This function is designed to enhance Walker::display_element() to
     * display children of higher nesting levels than selected inline on
     * the highest depth level displayed. This prevents them being orphaned
     * at the end of the comment list.
     *
     * @param object $element           Data object.
     * @param array  $children_elements List of elements to continue traversing.
     * @param int    $max_depth         Max depth to traverse.
     * @param int    $depth             Depth of current element.
     * @param array  $args              An array of arguments.
     * @param string $output            Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {

        if (!$element)
            return;

        $id_field = $this->db_fields['id'];
        $id = $element->$id_field;


        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

        // If we're at the max depth, and the current element still has children, loop over those and display them at this level
        // This is to prevent them being orphaned to the end of the list.
        if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
            foreach ($children_elements[$id] as $child)
                $this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);


            unset($children_elements[$id]);
        }
    }

    /**
     * Start the element output.
     *
     * @param string $output  Passed by reference. Used to append additional content.
     * @param object $comment Comment data object.
     * @param int    $depth   Depth of comment in reference to parents.
     * @param array  $args    An array of arguments.
     */
    public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;

        $output.="<!-- start_el: $depth -->";

        if (( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) && $args['short_ping']) {
            ob_start();
            $this->ping($comment, $depth, $args);
            $output .= ob_get_clean();
        } else {
            $output.="\n" . '<div class="media" >';
            ob_start();
            $this->comment($comment, $depth, $args);
            $output .= ob_get_clean();
        }
    }

    /**
     * Ends the element output, if needed.
     * @param string $output  Passed by reference. Used to append additional content.
     * @param object $comment The comment object. Default current comment.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    public function end_el(&$output, $comment, $depth = 0, $args = array()) {

        $output.="\n</div><!-- end_el: $depth -->";
        $output.="\n</div><!-- Extra end_el: $depth -->";
    }

    /**
     * Output a pingback comment.
     *
     * @param object $comment The comment object.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    protected function ping($comment, $depth, $args) {
        $tag = 'div';
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
        <div class="comment-body">
            <?php _e('Pingback:'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('Edit'), '<span class="edit-link">', '</span>'); ?>
        </div>
        <?php
    }

    /**
     * Output a single comment.
     *
     * @param object $comment Comment to display.
     * @param int    $depth   Depth of comment.
     * @param array  $args    An array of arguments.
     */
    protected function comment($comment, $depth, $args) {

        $add_below = 'comment';
        ?>

        <div class="media-left">
            <div class="comment-author vcard">
                <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>

            </div>
        </div>
        <div class="media-body">
        <h4 class="media-heading">

            <?php printf(__('<cite class="fn">%s</cite> <span class="says">'.__('says:','basico').'</span>'), get_comment_author_link()); ?>
        </h4>

        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.'); ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">

                <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time());
                ?></a><?php edit_comment_link(__('(Edit)'), '  ', '');
            ?>
        </div>

        <?php comment_text(); ?>
        <div class="reply">
            <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        </div>


        <?php
    }

}