<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/6/17
 * Time: 11:41 AM
 */
?>
<form action="//web.communications.uci.edu/php/searchgate.php" class="form-inline" method="get">
    <input name="collection" type="hidden" value="uci_full">
    <label class="sr-only" for="search-text">Search</label>
    <input class="form-control" id="search-text" name="q" placeholder="Search..." type="text">
    <div class="btn-group">
        <button class="btn btn-default" name="type" type="submit" value="Web">Web</button>
        <button class="btn btn-default" name="type" type="submit" value="People">People</button>
    </div>
</form>
