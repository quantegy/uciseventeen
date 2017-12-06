<?php
/**
 * Created by Chris Walsh.
 * User: walshcj
 * Date: 4/12/17
 * Time: 12:41 PM
 */
?>
<ol class="breadcrumb">
    <?php if (!is_home() && !is_front_page()): ?>
        <li>
            <a href="<?php echo get_option('home'); ?>">Home</a>
        </li>
        <?php if (is_category() || is_single()): ?>
		    <?php
		    $category = $_SESSION[UCISEVENTEEN_BREADCRUMB_CAT];

		    $ancestors = get_ancestors($category->term_id, 'category');
		    array_walk($ancestors, function(&$item) {
			    $link = get_category_link($item);

			    /**
			     * @var \WP_Term
			     */
			    $item = get_category($item);
			    $item->link = $link;
		    });
		    $ancestors = array_reverse($ancestors);

		    if(!empty($ancestors)) {
		        $catLinks = [];

		        foreach ($ancestors as $ancestor) {
                    echo '<li><a href="' . $ancestor->link . '">' . $ancestor->cat_name . '</a></li>';
                }
            }

		    $category_title = $category->cat_name;
		    $category_link = get_category_link($category->term_id);
		    ?>

            <?php if (is_category()): ?>
                <li><?php echo $category_title; ?></li>
            <?php elseif(!is_null($category)): ?>
                <li><a href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (is_single()): ?>
            <li>
                <?php the_title(); ?>
            </li>
        <?php elseif (is_page()): ?>
            <li><?php the_title(); ?></li>
        <?php endif; ?>
    <?php elseif (is_tag()): ?>
        <?php single_tag_title(); ?>
    <?php elseif (is_day()): ?>
        <li>
          </li>
    <?php elseif (is_month()): ?>

    <?php elseif (is_year()): ?>

    <?php elseif (is_author()): ?>

    <?php elseif (isset($_GET['paged']) && !empty($_GET['paged'])): ?>
        <li>
            Blog Archives
        </li>
    <?php elseif (is_search()): ?>
        <li>
            Search results
        </li>
    <?php endif; ?>
</ol>
