<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/20/17
 * Time: 2:27 PM
 */
if(!is_active_sidebar('main-sidebar')) {
    return;
}
?>


<?php dynamic_sidebar('main-sidebar');