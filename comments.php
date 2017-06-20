<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 5/9/17
 * Time: 9:47 AM
 */
if (post_password_required()) {
    return;
}
?>
<div class="container" id="comments">
    <?php if (have_comments()): ?>
        <div class="row top-buffer">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php uciseventeen_comments_title(get_comments_number(), get_the_title()); ?></h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        wp_list_comments(array(
                            'walker' => new UCI_Comment_Walker(),
                            /*'callback' => 'uciseventeen_bootstrap_comment',*/
                            'style'  => 'div',
                            'avatar_size' => 82
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if(!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php _e('Comments are closed', 'uciseventeen'); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="container">
        <div class="row">
            <div class="widget col-xs-12 col-md-12"><?php comment_form(); ?></div>
        </div>
    </div>
</div>
