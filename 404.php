<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/12/17
 * Time: 6:22 PM
 */
get_header(); ?>

<div class="container">
    <div class="row page-heading-row">
        <div class="col-xs-12">
            <h1 class="page-heading text-left">Page not found</h1>
        </div>
    </div>
</div>

<section aria-labelledby="section-1-heading" class="container" id="section-1">
    <h2 class="section-heading sr-only" id="section-1-heading">Something went wrong</h2>
    <div class="row">
        <div class="widget col-xs-12 col-md-12">
            <div class="widget-bucket clearfix">
                <p>The requested URL was not found. If you entered the address manually, please check your spelling and try again.</p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
