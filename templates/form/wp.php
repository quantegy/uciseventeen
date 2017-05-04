<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/24/17
 * Time: 5:03 PM
 */
?>
<form role="search" method="get" id="searchform" class="form-inline" action="<?php bloginfo('url'); ?>">
    <label class="sr-only" for="search-text">Search</label>
    <input class="form-control" id="search-text" value="" name="s" id="s">
    <div class="btn-group">
        <button class="btn btn-default" type="submit">Search</button>
    </div>
</form>