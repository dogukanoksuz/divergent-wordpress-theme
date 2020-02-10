<?php
/**
 * divergent Wordpress theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package divergent_Wordpress_theme
 */

if (!function_exists('divergent_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function divergent_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on divergent Wordpress theme, use a find and replace
         * to change 'divergent' to the name of your theme in all the template files.
         */
        load_theme_textdomain('divergent', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

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

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'divergent'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('divergent_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
    }
endif;
add_action('after_setup_theme', 'divergent_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function divergent_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('divergent_content_width', 640);
}

add_action('after_setup_theme', 'divergent_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function divergent_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'divergent'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'divergent'),
        'before_widget' => '<div class="box">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="boxTitle">',
        'after_title' => '</h4>',
    ));
}

add_action('widgets_init', 'divergent_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function divergent_scripts()
{
    wp_enqueue_style('divergent-bootstrap', get_template_directory_uri() . '/dist/css/bootstrap.min.css');
    wp_enqueue_style('divergent-featherlight', get_template_directory_uri() . '/dist/css/featherlight.css');
    wp_enqueue_style('divergent-style', get_template_directory_uri() . '/dist/css/style.css');

    wp_enqueue_script('divergent-bootstrap-bundle', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), '20151215', true);
    wp_enqueue_script('divergent-featherlight-js', get_template_directory_uri() . '/dist/js/featherlight.js', array(), '20151215', true);
}

add_action('wp_enqueue_scripts', 'divergent_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
