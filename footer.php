</main>
<footer>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
                    <?php if(has_nav_menu('footer-1')): ?>
                    <?php wp_nav_menu(array(
                            'theme_location' => 'footer-1',
                            'items_wrap' => '<ul id="%1$s">%3$s</ul>'
                        )); ?>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
                    <?php if(has_nav_menu('footer-2')): ?>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'footer-2',
                            'items_wrap' => '<ul id="%1$s">%3$s</ul>'
                        )); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0">
                    <?php if(has_nav_menu('footer-3')): ?>
                    <?php wp_nav_menu(array(
                            'theme_location' => 'footer-3',
                            'items_wrap' => '<ul id="%1$s">%3$s</ul>'
                        )); ?>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 pull-right">
                    <?php //if(is_active_sidebar('footer-4')): ?>
                    <?php //dynamic_sidebar('footer-4'); ?>
                    <?php //endif; ?>
                    <address>
                        <?php uciseventeen_get_siteowner(); ?>
                    </address>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 text-right">
            <a href="//uci.edu/copyright"><small>© <?php echo date('Y') ?> UC Regents</small></a>
        </div>
    </div>
</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>