<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage UCI_Seventeen
 * @since 0.1
 */

ini_set('display_errors', false);

@define('UCI_SEVENTEEN_VERSION', '0.1');

/**
 * register custom uci-bootstrap nav walker for main menu
 */
require_once 'wp-uci-bootstrap-navwalker.php';

/**
 * register custom bootstrap comments walker
 */
require_once 'wp-uci-comments-walker.php';

/**
 * Bootstrap pagination output
 */


/**
 * include our custom sitorigin pagebuilder widgets
 * if the plugin is available
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('so-widgets-bundle/so-widgets-bundle.php')) {
    require_once 'widgets/parallax-headline.php';
}

/**
 * let user know that there is a pagebuilder dependency (optional)
 */
function uciseventeen_so_notices()
{
    if (!is_plugin_active('so-widgets-bundle/so-widgets-bundle.php') ||
        !is_plugin_active_for_network('so-widgets-bundle/so-widgets-bundle.php')
    ) {
        ?>
        <div class="update-nag notice">
            <p>
                <?php _e('Please, install SiteOrigin Widgets Bundle!', 'uciseventeen'); ?>
                <a href="https://siteorigin.com/widgets-bundle/">Available here.</a>
            </p>
        </div>
        <?php
    }

    if (!is_plugin_active('siteorigin-panels/siteorigin-panels.php') ||
        !is_plugin_active_for_network('siteorigin-panels/siteorigin-panels.php')
    ) {
        ?>
        <div class="error notice">
            <p>
                <?php _e('SiteOrigin Page Builder is a preferred plugin. Install it!'); ?>
                <a href="https://siteorigin.com/page-builder/">Available here.</a>
            </p>
        </div>
        <?php
    }
}

add_action('admin_notices', 'uciseventeen_so_notices');


/**
 * require custom widget output classes
 */
require_once 'widgets/uci-wp-recent-posts.php';
require_once 'widgets/uci-wp-recent-comments.php';
require_once 'widgets/uci-wp-archives.php';
require_once 'widgets/uci-wp-meta.php';
require_once 'widgets/uci-wp-categories.php';

/**
 * category walker for list items
 */
require_once 'wp-uci-category-walker.php';

function uciseventeen_setup()
{
    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
    add_theme_support('post-thumbnails');

    //add_image_size( 'uciseventeen-featured-image', 2000, 1200, true );

    //add_image_size( 'uciseventeen-thumbnail-avatar', 100, 100, true );

    register_nav_menus(array(
        'main' => __('Main menu', 'uciseventeen')
    ));

    /*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    // Add theme support for Custom Logo.
    /*add_theme_support( 'custom-logo', array(
        'width'       => 250,
        'height'      => 250,
        'flex-width'  => true,
    ) );*/
}

add_action('after_setup_theme', 'uciseventeen_setup');


/**
 * Enqueue scripts and styles
 */
function uciseventeen_scripts()
{
    wp_enqueue_style('bootstrap-uci', '//web.communications.uci.edu/assets/2015/css/bootstrap3-uci-cascade.css');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('uciseventeen', get_stylesheet_directory_uri() . '/style.css', array(), UCI_SEVENTEEN_VERSION);
    wp_enqueue_script('jquery-2.1.4', '//code.jquery.com/jquery-2.1.4.min.js', array(), UCI_SEVENTEEN_VERSION, true);
    wp_enqueue_script('bootstrap-3.3.4', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), UCI_SEVENTEEN_VERSION, true);
    wp_enqueue_script('bootstrap-uci', '//web.communications.uci.edu/assets/2015/js/bootstrap-uci-extensions.js', array(), UCI_SEVENTEEN_VERSION, true);
}

add_action('wp_enqueue_scripts', 'uciseventeen_scripts');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uciseventeen_widgets_init()
{
    register_sidebar(array(
        'name' => __('Main Sidebar', 'uciseventeen'),
        'id' => 'main-sidebar',
        'description' => __('Right side column for primary sidebar navigation', 'uciseventeen'),
        'before_widget' => '<section class="widget %2$s" id="$1$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));

    register_nav_menu('footer-1', __('Footer column one', 'uciseventeen'));
    register_nav_menu('footer-2', __('Footer column two', 'uciseventeen'));
    register_nav_menu('footer-3', __('Footer column three', 'uciseventeen'));

    /*register_sidebar(array(
        'name' => __('Footer Column 4', 'uciseventeen'),
        'id' => 'footer-4',
        'description' => 'Footer fourth column for additional content',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span class="sr-only">',
        'after_title' => '</span>'
    ));*/
}

add_action('widgets_init', 'uciseventeen_widgets_init');

/**
 * Filter out plugins that we have forked and will be maintining ourselves
 * @param $value
 * @return mixed
 */
function uciseventeen_filter_plugin_updates($value)
{
    //unset($value->response['siteorigin-panels/siteorigin-panels.php']);
    //unset($value->response['so-widgets-bundle/so-widgets-bundle.php']);

    return $value;
}

add_filter('site_transient_update_plugins', 'uciseventeen_filter_plugin_updates');

function uciseventeen_customize_register($wp_customize)
{
    require_once 'wp-uci-settings.php';

    $settings = new \UCI\Wordpress\Customize\Settings($wp_customize);
}

add_action('customize_register', 'uciseventeen_customize_register');

function uciseventeen_home_url($return = false)
{
    $url = home_url();

    if (site_url() !== home_url()) { // home_url is tied to wordpress instance, whereas site_url can be changed
        $url = site_url();
    }

    if ($return === true) {
        return $url;
    }

    echo $url;
}

function uciseventeen_wordmark($return = false)
{
    require_once 'wp-uci-settings.php';

    $mediaId = get_theme_mod(\UCI\Wordpress\Customize\Settings::WORDMARK_SETTING, '');

    $html = '<a href="' . uciseventeen_home_url(true) . '">';

    if (empty($mediaId)) {
        $html .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/uci-wordmark.png" alt="' . get_bloginfo('name') . '">';
    } else {
        $html .= wp_get_attachment_image($mediaId, 'full', false, array(
            'alt' => get_bloginfo('name')
        ));
    }

    $html .= '</a>';

    if ($return === true) {
        return $html;
    }

    echo $html;
}

function uciseventeen_get_siteowner() {
    require_once 'wp-uci-settings.php';

    $siteOwner = array(
        'site_owner' => get_theme_mod(\UCI\Wordpress\Customize\Settings::SITE_OWNER_SETTING),
        'site_owner_address_one' => get_theme_mod(\UCI\Wordpress\Customize\Settings::ADDRESS_ONE_SETTING),
        'site_owner_address_two' => get_theme_mod(\UCI\Wordpress\Customize\Settings::ADDRESS_TWO_SETTING),
        'site_owner_address_three' => get_theme_mod(\UCI\Wordpress\Customize\Settings::ADDRESS_THREE_SETTING),
        'site_owner_phone' => get_theme_mod(\UCI\Wordpress\Customize\Settings::PHONE_SETTING),
        'site_owner_email' => get_theme_mod(\UCI\Wordpress\Customize\Settings::EMAIL_SETTING)
    );

    $html = '';
    foreach($siteOwner as $key => $item) {
        if(!empty($item)) {
            $html .= '<span>' . $item . "</span><br>";
        }
    }

    echo $html;
}

function uciseventeen_get_search_form($form)
{
    require_once 'wp-uci-settings.php';

    $type = get_theme_mod(\UCI\Wordpress\Customize\Settings::SEARCH_FORM_SETTING, 'uci');

    if ($type === \UCI\Wordpress\Customize\Settings::SEARCH_FORM_UCI) {
        $form = template(get_stylesheet_directory() . '/templates/form/uci.php');
    } else {
        $form = template(get_stylesheet_directory() . '/templates/form/wp.php');
    }

    return $form;
}

add_filter('get_search_form', 'uciseventeen_get_search_form');

function uciseventeen_so_widgets_widget_folders($folders)
{
    $folders[] = get_stylesheet_directory() . '/widgets/';

    return $folders;
}

add_filter('siteorigin_widgets_widget_folders', 'uciseventeen_so_widgets_widget_folders');

/**
 * @param $file string - Path to PHP file that acts as template
 * @param $args array - Associative array of variables to pass to the template
 * @return string - Output of the template HTML
 */
function template($file, $args = array())
{
    // ensure file exists
    if (!file_exists($file)) {
        return '';
    }

    // make values in the array easier to access by extracting their index names as variables
    if (is_array($args)) {
        extract($args);
    }

    ob_start();
    include $file;

    return ob_get_clean();
}

/**
 * Generates breadcrumb menu
 * @param bool $echo
 * @return string
 */
function uciseventeen_breadcrumb($echo = true)
{
    $template = template(get_stylesheet_directory() . '/templates/breadcrumbs.php');

    if ($echo !== true) {
        return $template;
    }

    echo $template;
}

/**
 * Removes the title prefix from archive page headings
 * @param $title
 * @return null|string|void
 */
function uciseventeen_get_the_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    }

    return $title;
}

add_filter('get_the_archive_title', 'uciseventeen_get_the_archive_title');

function uciseventeen_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr)
{
    $src = wp_get_attachment_image_src($post_thumbnail_id, $size);
    $alt = get_the_title($post_id);
    $class = 'img-responsive';

    return '<img src="' . $src[0] . '" alt="' . $alt . '" class="' . $class . '">';
}

add_filter('post_thumbnail_html', 'uciseventeen_post_thumbnail_html', 10, 5);

function uciseventeen_get_image_tag_class($class)
{
    $class .= ' img-responsive';

    return $class;
}

add_filter('get_image_tag_class', 'uciseventeen_get_image_tag_class', 0, 1);

/*function uciseventeen_bootstrap_responsive_images($html) {
    global $post;

    $pattern = "/<img(.*?)(class=\"(.*?)\")?(.*?)?>/i";

    $replacement = '<img class="img-responsive $2"$4>';
    $html = preg_replace($pattern, $replacement, $html);

    return $html;
}*/

//add_filter('the_content', 'uciseventeen_bootstrap_responsive_images', 10);

/*function uciseventeen_image_send_to_editor($html, $id, $caption, $title, $align, $url, $size, $alt) {
    $width = get_image_width($size);

    $aurl = wp_get_attachment_url($id);

    $html = '';
    $html .= '<img src="' . $aurl . '" alt="' . $alt . '" class="img-responsive">';
    $html .= '<div>' . $caption .'</div>';

    return $html;
}
add_filter('image_send_to_editor', 'uciseventeen_image_send_to_editor', 10, 9);*/

function uciseventeen_get_the_excerpt($output)
{
    $html = '';

    if (has_excerpt()) {
        $html .= get_post()->post_excerpt;
    }

    if (!is_single() && !is_page()) {
        $html .= ' <a href="' . get_the_permalink() . '">Read more</a>';
    }

    return $html;
}

add_filter('get_the_excerpt', 'uciseventeen_get_the_excerpt');


// Bootstrap pagination function
function wp_bootstrap_pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;
    global $paged;

    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;

        $pages = $wp_query->max_num_pages;

        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo '<div class="text-center">';
        echo '<nav><ul class="pagination"><li class="disabled hidden-xs"><span><span aria-hidden="true">Page ' . $paged . ' of ' . $pages . '</span></span></li>';

        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link(1) . "' aria-label='First'>&laquo;<span class='hidden-xs'> First</span></a></li>";

        if ($paged > 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($paged - 1) . "' aria-label='Previous'>&lsaquo;<span class='hidden-xs'> Previous</span></a></li>";

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<li class=\"active\"><span>" . $i . " <span class=\"sr-only\">(current)</span></span>
    </li>" : "<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"" . get_pagenum_link($paged + 1) . "\"  aria-label='Next'><span class='hidden-xs'>Next </span>&rsaquo;</a></li>";

        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($pages) . "' aria-label='Last'><span class='hidden-xs'>Last </span>&raquo;</a></li>";
        echo "</ul></nav>";
        echo "</div>";
    }
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function get_image_sizes()
{
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach (get_intermediate_image_sizes() as $_size) {
        if (in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
            $sizes[$_size]['width'] = get_option("{$_size}_size_w");
            $sizes[$_size]['height'] = get_option("{$_size}_size_h");
            $sizes[$_size]['crop'] = (bool)get_option("{$_size}_crop");
        } elseif (isset($_wp_additional_image_sizes[$_size])) {
            $sizes[$_size] = array(
                'width' => $_wp_additional_image_sizes[$_size]['width'],
                'height' => $_wp_additional_image_sizes[$_size]['height'],
                'crop' => $_wp_additional_image_sizes[$_size]['crop'],
            );
        }
    }

    return $sizes;
}

/**
 * Get size information for a specific image size.
 *
 * @uses   get_image_sizes()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|array $size Size data about an image size or false if the size doesn't exist.
 */
function get_image_size($size)
{
    $sizes = get_image_sizes();

    if (isset($sizes[$size])) {
        return $sizes[$size];
    }

    return false;
}

/**
 * Get the width of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Width of an image size or false if the size doesn't exist.
 */
function get_image_width($size)
{
    if (!$size = get_image_size($size)) {
        return false;
    }

    if (isset($size['width'])) {
        return $size['width'];
    }

    return false;
}

/**
 * Get the height of a specific image size.
 *
 * @uses   get_image_size()
 * @param  string $size The image size for which to retrieve data.
 * @return bool|string $size Height of an image size or false if the size doesn't exist.
 */
function get_image_height($size)
{
    if (!$size = get_image_size($size)) {
        return false;
    }

    if (isset($size['height'])) {
        return $size['height'];
    }

    return false;
}

/**
 * boostrapify widgets output
 */
function uciseventeen_custom_widget_registration()
{
    // recent posts
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('UCI_Recent_Posts_Widget');

    // recent comments
    unregister_widget('WP_Widget_Recent_Comments');
    register_widget('UCI_Recent_Comments_Widget');

    // archives
    unregister_widget('WP_Widget_Archives');
    register_widget('UCI_Archives_Widget');

    // meta widget
    unregister_widget('WP_Widget_Meta');
    register_widget('UCI_Meta_Widget');

    // categories widget
    unregister_widget('WP_Widget_Categories');
    register_widget('UCI_Categories_Widget');
}

add_action('widgets_init', 'uciseventeen_custom_widget_registration');

function uciseventeen_comments_title($comments_number, $title)
{
    if ($comments_number === '1') {
        printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments_title', 'uciseventeen'), $title);
    } else {
        printf(_nx(
            '%1$s Reply to &ldquo;%2$s&rdquo;',
            '%1$s Replies to &ldquo;%2$s&rdquo;',
            $comments_number,
            'comments_title',
            'uciseventeen'
        ), number_format($comments_number), $title);
    }
}

/**
 * enqueue comments reply script
 */
function uciseventeen_enqueue_comment_reply_script()
{
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

/**
 * bootstrap support for comments_form output
 */
function uciseventeen_comment_form_fields($fields)
{
    $author = wp_get_current_commenter();

    $required = get_option('require_name_email');
    $ariaRequired = ($required ? 'aria-required="true"' : '');
    $html5 = current_theme_supports('html5', 'comment-form') ? 1 : 0;

    $fields = array(
        'author' => '<div class="form-group comment-form-author">' .
            '<label for="author">' . __('Name', 'uciseventeen') . ($required ? '<span class="required">*</span>' : '') . '</label>' .
            '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($author['comment_author']) . '" size="30"' . $ariaRequired . '>' .
            '</div>',
        'email' => '<div class="fomr-group comment-form-email">' .
            '<label for="email">' . __('Email', 'uciseventeen') . ($required ? '<span class="required">*</span>' : '') . '</label>' .
            '<input class="form-control" id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($author['comment_author_email']) . '" size="30" ' . $ariaRequired . '>' .
            '</div>',
        'url' => '<div class="fomr-group comment-form-url">' .
            '<label for="url">' . __('Website', 'uciseventeen') . ($required ? '<span class="required">*</span>' : '') . '</label>' .
            '<input class="form-control" id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($author['comment_author_url']) . '" size="30">' .
            '</div>'
    );

    return $fields;
}

add_filter('comment_form_default_fields', 'uciseventeen_comment_form_fields');

/**
 * bootstrap support for comments_form textarea output
 */
function uciseventeen_comment_form_defaults($args)
{
    $args['comment_field'] = '<div class="form-group comment-form-comment">' .
        '<label for="comment">' . _x('Comment', 'uciseventeen') . '</label>' .
        '<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
        '</div>';
    $args['class_submit'] = 'btn btn-default';

    return $args;
}

add_filter('comment_form_defaults', 'uciseventeen_comment_form_defaults', 10, 1);

function uciseventeen_bootstrap_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;

    ?>
    <?php if ($comment->comment_type === 'pingback' || $comment->comment_type === 'trackback'): ?>
    <li class="list-group-item" id="comment-<?php comment_ID(); ?>">
        <p>
            <?php _e('Pingback', 'uciseventeen'); ?>
            <?php get_comment_author_link(); ?>
            <?php edit_comment_link(__('(Edit)', 'uciseventeen'), '', ''); ?>
        </p>
    </li>
<?php else: ?>
    <?php global $post; ?>
    <li class="list-group-item" id="li-comment-<?php comment_ID(); ?>">

        <h4 class="list-group-item-heading">
            <cite>
                <?php echo get_comment_author_link(); ?>
                <?php echo ($comment->user_id === $post->post_author) ? '<span>' . __('Post author', 'uciseventeen') . '</span>' : ''; ?>
            </cite>
            <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                <time datetime="<?php echo get_comment_time('c'); ?>">
                    <?php echo get_comment_date() ?> at <?php echo get_comment_time(); ?>
                </time>
            </a>
        </h4>


        <div class="list-group-item-text">
            <?php if ($comment->comment_approved == '0'): ?>
                <div class="alert alert-warning"><?php _e('Your comment is awaiting moderation.', 'uciseventeen'); ?></div>
            <?php endif; ?>
            <div>
                <?php echo comment_text(); ?>
                <a class="btn btn-default btn-xs"
                   href="<?php echo get_edit_comment_link($comment); ?>"><?php _e('Edit', 'uciseventeen'); ?></a>
                <?php comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply', 'uciseventeen') . ' <span class="glyphicon glyphicon-arrow-down"></span>',
                    'after' => '',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth']
                ))); ?>
            </div>
        </div>
    </li>
<?php endif; ?>
    <?php
}

/**
 * replace class for comment reply link for bootstrap buttons
 */
function uciseventeen_reply_link_class($content)
{
    $content = str_replace('comment-reply-link', 'comment-reply-link btn btn-primary btn-xs', $content);

    return $content;
}

add_filter('comment_reply_link', 'uciseventeen_reply_link_class');

/**
 * Format archive widget for bootstrap list-group
 * @param $link_html
 * @param $url
 * @param $text
 * @param $format
 * @param $before
 * @param $after
 * @return string
 */
function uciseventeen_get_archives_link($link_html, $url, $text, $format, $before, $after)
{
    if ($format === 'bootstrap') {
        $link_html = "\t" . '<li class="list-group-item">' . $before . '<a href="' . $url . '">' . $text . '</a>' . $after . '</li>' . "\n";
    }

    return $link_html;
}

/**
 * Add a dynamic meta description to each post/page
 */

function uciseventeen_meta_description()
{
    $html = '';

    $desc = get_bloginfo('description');

    /**
     * single post instance
     */
    if(is_single() || is_page()) {
        $desc = strip_tags(get_the_excerpt());
    }

    if(is_category()) {
        $catId = get_query_var('cat');
        $desc = strip_tags(category_description($catId));
    }

    $html .= '<meta name="description" content="' . $desc . '">' . "\n";

    echo $html;
}
add_action('wp_head', 'uciseventeen_meta_description');

add_filter('get_archives_link', 'uciseventeen_get_archives_link', 10, 6);

/**
 * force excerpts for pages
 */
function uciseventeen_page_excerpts() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'uciseventeen_page_excerpts');

/*function uciseventeen_so_before_content($stuff) {
    return $stuff;
}
add_filter('siteorigin_panels_before_content', 'uciseventeen_so_before_content');

function uciseventeen_so_after_content($stuff) {
    return $stuff;
}
add_filter('siteorigin_panels_after_content', 'uciseventeen_so_after_content');

function uciseventeen_so_before_row($stuff) {
    return $stuff;
}
add_filter('siteorigin_panels_before_row', 'uciseventeen_so_before_row');

function uciseventeen_so_after_row($stuff) {
    return $stuff;
}
add_filter('siteorigin_panels_after_row', 'uciseventeen_so_after_row');

function uciseventeen_so_row_cell_attributes($attributes, $grid) {

}
add_filter('siteorigin_panels_row_cell_attributes', 'uciseventeen_so_row_cell_attributes', 10, 2);*/

