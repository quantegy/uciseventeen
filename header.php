<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until main content
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage UCI_Seventeen
 * @since 0.1
 * @version 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link rel="icon" type="image/x-icon" href="//web.communications.uci.edu/assets/2015/img/favicon.ico">
    <link rel="apple-touch-icon" href="//web.communications.uci.edu/assets/2015/img/webclip-icon.png">

    <?php wp_head(); ?>
</head>
<body class="<?php uciseventeen_styling_namespace(); ?>">

<!-- skip to main nav -->
<nav aria-label="Skip to" id="skip-to">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <a class="sr-only sr-only-focusable" href="#content-main">Skip to main content</a>
            </div>
        </div>
    </div>
</nav>

<!-- primary nav -->
<nav aria-label="Primary navigation" class="navbar navbar-inverse" id="nav-primary">
    <div class="container-fluid">
        <div class="navbar-header">
            <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#nav-primary-items"
                    data-toggle="collapse" type="button">
                <span class="sr-only">Toggle primary navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://uci.edu/">UCI <span class="sr-only">homepage</span></a>
        </div>
        <?php
        wp_nav_menu(array(
            'menu' => 'main',
            'theme_location' => 'main',
            'depth' => 2,
            'container' => 'div',
            'container_class' => 'collapse navbar-collapse',
            'container_id' => 'nav-primary-items',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'WP_UCI_Bootstrap_Navwalker::fallback',
            'walker' => new WP_UCI_Bootstrap_Navwalker()
        ));
        ?>
    </div>
</nav>

<header>
    <?php if(is_single() && uciseventeen_has_jumbotron()): ?>
    <?php get_template_part('templates/header/jumbotron'); ?>
    <?php else: ?>
    <?php get_template_part('templates/header/masthead'); ?>
    <?php endif; ?>
</header>

<hr>

<nav aria-label="breadcrumbs" id="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php uciseventeen_breadcrumb(); ?>
            </div>
        </div>
    </div>
</nav>

<main id="content">