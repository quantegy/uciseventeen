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

ini_set('display_errors', 1);

@define('UCI_SEVENTEEN_VERSION', '0.1');

@define('UCI_SEVENTEEN_WORDMARK_SETTING', 'wordmark_image');

@define('UCI_SEVENTEEN_SEARCH_FORM_SETTING', 'search_form');
@define('UCI_SEVENTEEN_SERACH_FORM_UCI', 'uci');
@define('UCI_SEVENTEEN_SEARCH_FORM_WP', 'wp');

/**
 * register custom uci-bootstrap nav walker for main menu
 */
require_once 'wp-uci-bootstrap-navwalker.php';

/**
 * Bootstrap pagination output
 */


/**
 *
 */
require_once 'widgets/parallax-headline.php';

/**
 * require custom widget output classes
 */
require_once 'widgets/uci-wp-recent-posts.php';

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

    register_sidebar(array(
        'name' => __('Footer Column 4', 'uciseventeen'),
        'id' => 'footer-4',
        'description' => 'Footer fourth column for additional content',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<span class="sr-only">',
        'after_title' => '</span>'
    ));
}

add_action('widgets_init', 'uciseventeen_widgets_init');

/**
 * Filter out plugins that we have forked and will be maintining ourselves
 * @param $value
 * @return mixed
 */
function uciseventeen_filter_plugin_updates($value)
{
    unset($value->response['siteorigin-panels/siteorigin-panels.php']);
    unset($value->response['so-widgets-bundle/so-widgets-bundle.php']);

    return $value;
}

add_filter('site_transient_update_plugins', 'uciseventeen_filter_plugin_updates');

function uciseventeen_customize_register($wp_customize)
{
    $wp_customize->add_section('uciseventeen_settings', array(
        'title' => __('UCI Settings', 'uciseventeen'),
        'priority' => 100,
        'capability' => 'edit_theme_options',
        'description' => __('Change options here.', 'uciseventeen')
    ));

    /**
     * Give user the ability to uplaod a branding logo
     */
    $wp_customize->add_setting(UCI_SEVENTEEN_WORDMARK_SETTING, array(
        'default' => '',
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, UCI_SEVENTEEN_WORDMARK_SETTING, array(
        'label' => __('Wordmark image', 'uciseventeen'),
        'section' => 'uciseventeen_settings',
        'mime_type' => 'image'
    )));

    /**
     * Switch between site search and UCI search
     */
    $wp_customize->add_setting(UCI_SEVENTEEN_SEARCH_FORM_SETTING, array(
        'default' => UCI_SEVENTEEN_SERACH_FORM_UCI,
        'transport' => 'postMessage'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, UCI_SEVENTEEN_SEARCH_FORM_SETTING, array(
        'label' => __('Search Type'),
        'section' => 'uciseventeen_settings',
        'settings' => UCI_SEVENTEEN_SEARCH_FORM_SETTING,
        'type' => 'select',
        'choices' => array(
            UCI_SEVENTEEN_SERACH_FORM_UCI => __('UCI', 'uciseventeen'),
            UCI_SEVENTEEN_SEARCH_FORM_WP => __('Wordpress', 'uciseventeen')
        )
    )));
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
    $mediaId = get_theme_mod(UCI_SEVENTEEN_WORDMARK_SETTING, '');

    $html = '<a href="' . uciseventeen_home_url(true) . '">';

    if (empty($mediaId)) {
        $html .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/uci-wordmark.png" alt="' . get_bloginfo('name') . '">';
    } else {
        $html .= wp_get_attachment_image($mediaId, 'full');
    }

    $html .= '</a>';

    if ($return === true) {
        return $html;
    }

    echo $html;
}

function uciseventeen_get_search_form($form)
{
    $type = get_theme_mod(UCI_SEVENTEEN_SEARCH_FORM_SETTING, 'uci');

    if($type === UCI_SEVENTEEN_SERACH_FORM_UCI) {
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

function uciseventeen_post_thumbnail_html($html, $post_id, $post_thumbnail_id, $size, $attr) {
    $src = wp_get_attachment_image_src($post_thumbnail_id, $size);
    $alt = get_the_title($post_id);
    $class = 'img-responsive';

    return '<img src="' . $src[0] . '" alt="' . $alt . '" class="' . $class . '">';
}
add_filter('post_thumbnail_html', 'uciseventeen_post_thumbnail_html', 10, 5);

function uciseventeen_get_image_tag_class($class) {
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

    if(!is_single()) {
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
function get_image_sizes() {
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
            $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
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
function get_image_size( $size ) {
    $sizes = get_image_sizes();

    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
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
function get_image_width( $size ) {
    if ( ! $size = get_image_size( $size ) ) {
        return false;
    }

    if ( isset( $size['width'] ) ) {
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
function get_image_height( $size ) {
    if ( ! $size = get_image_size( $size ) ) {
        return false;
    }

    if ( isset( $size['height'] ) ) {
        return $size['height'];
    }

    return false;
}

/**
 * boostrapify widgets output
 */
function uciseventeen_recent_posts_widget_registration() {
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('UCI_Recent_Posts_Widget');
}
add_action('widgets_init', 'uciseventeen_recent_posts_widget_registration');


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

