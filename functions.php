<?php
/**
 * divergent Wordpress theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package divergent_Wordpress_theme
 *
 *
 * TODO: fix submenus
 */

if ( ! function_exists( 'divergent_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function divergent_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Menü', 'divergent' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'divergent_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function divergent_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'divergent' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'divergent' ),
		'before_widget' => '<div class="box">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="boxTitle">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'divergent_widgets_init' );

add_theme_support( 'post-thumbnails' );
the_post_thumbnail( array( 287, 191 ) );
add_image_size( 'archive-thumbnail', 287, 191, true );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Codestar framework
 */
require get_template_directory() . '/inc/framework/codestar-framework.php';

/**
 * Admin panel things
 */
require get_template_directory() . '/inc/divergent-admin.php';

/**
 * Enqueue scripts and styles.
 */
function divergent_scripts() {
	$divergent_options = get_option( 'divergent' );

	if ( 'dark' == $divergent_options['theme-color'] ) {
		wp_enqueue_style( 'divergent-bootstrap', get_template_directory_uri() . '/dist/css/bootstrap-dark.min.css' );
		wp_enqueue_style( 'divergent-style', get_template_directory_uri() . '/dist/css/style-dark.css' );
	} elseif ( 'grey' == $divergent_options['theme-color'] ) {
		wp_enqueue_style( 'divergent-bootstrap', get_template_directory_uri() . '/dist/css/bootstrap-blue.min.css' );
		wp_enqueue_style( 'divergent-style', get_template_directory_uri() . '/dist/css/style-blue.css' );
	}
	wp_enqueue_style( 'divergent-featherlight', get_template_directory_uri() . '/dist/css/featherlight.css' );

	wp_enqueue_script( 'divergent-bootstrap-bundle', get_template_directory_uri() . '/dist/js/bootstrap.bundle.min.js', array(), '20151215', true );
	wp_enqueue_script( 'divergent-featherlight-js', get_template_directory_uri() . '/dist/js/featherlight.js', array(), '20151215', true );
}

add_action( 'wp_enqueue_scripts', 'divergent_scripts' );
