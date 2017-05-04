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
            <li>
            <?php
            $category = get_the_category();
            $category_title = $category[0]->cat_name;
            $category_link = get_category_link($category[0]->cat_ID);
            ?>
            <?php if (is_category()): ?>
                <?php echo $category_title; ?>
            <?php else: ?>
                <a href="<?php echo $category_link; ?>"><?php echo $category_title; ?></a>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (is_single()): ?>
            </li>
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
            Archive for <?php the_time('F jS, Y'); ?>
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
