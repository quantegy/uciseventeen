<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/6/17
 * Time: 6:49 PM
 */
/*print '<pre>';
var_dump($instance);
print '</pre>';*/
?>
<div class="media-overlay overlay-medium">
    <div class="media-overlay-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <p class="h1">
                        <?php echo wp_kses_post($instance['headline']); ?>
                    </p>
                    <p class="h3">
                        <?php if (empty($instance['subheadline']['url'])): ?>
                            <?php echo wp_kses_post($instance['subheadline']['label']); ?>
                        <?php else: ?>
                            <a href="<?php echo wp_kses_post($instance['subheadline']['url']); ?>"><?php echo wp_kses_post($instance['subheadline']['label']); ?></a>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
