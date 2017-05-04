<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/20/17
 * Time: 4:41 PM
 */
?>
<div class="jumbotron" data-aspect-ratio="1440:450" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
    <div class="media-overlay overlay-transparent">
        <div id="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8" id="wordmark">
                        <?php uciseventeen_wordmark(); ?>
                    </div>
                    <div class="col-sm-12 col-md-4" id="search">
                        <?php echo get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
