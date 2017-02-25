<?php
/**
 * AnnySuper functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AnnySuper
 */

if ( ! function_exists( 'annysuper_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function annysuper_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on AnnySuper, use a find and replace
	 * to change 'annysuper' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'annysuper', get_template_directory() . '/languages' );

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
			'top' => __( 'Top Menu', 'annysuper' ),
			'header' => __( 'Header Menu', 'annysuper' ),
			'footer' => __( 'Footer Menu', 'annysuper' ), 
		) );

	// add post formats
	add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'annysuper_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size( 'annysuper-thumb', 500, 450, true );
}
endif;
add_action( 'after_setup_theme', 'annysuper_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function annysuper_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'annysuper_content_width', 1280 );
}
add_action( 'after_setup_theme', 'annysuper_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function annysuper_widgets_init() {
		register_sidebar( array( 
			'name' => __('Front Page Up', 'annysuper'),
			'id' => 'front-page-up',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Front Page Down', 'annysuper'),
			'id' => 'front-page-down',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Sidebar Right', 'annysuper'),
			'id' => 'sidebar-right',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Sidebar Left', 'annysuper'),
			'id' => 'sidebar-left',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Footer One', 'annysuper'),
			'id' => 'footer-one',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Footer Two', 'annysuper'),
			'id' => 'footer-two',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Footer Three', 'annysuper'),
			'id' => 'footer-three',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));

		register_sidebar( array( 
			'name' => __('Footer Four', 'annysuper'),
			'id' => 'footer-four',
			'before_widget' => '<aside id="%1$s class="widget %2$s">',
			'after_widger' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>', 
			));
}
add_action( 'widgets_init', 'annysuper_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function annysuper_scripts() {
	wp_enqueue_style( 'annysuper-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() - 'css/font-awesome.min.css', array(), '4.6.3', 'all');
	wp_enqueue_style('swipe', get_template_directory_uri() . '/css/swiper.css', array(), '3.0.7', 'all');

	wp_enqueue_script( 'bootraps-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', 'all' );

	wp_enqueue_script( 'annysuper-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'annysuper-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('annysuper-custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true);

	wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.jquery.js', array(), '1.0', 'all');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'annysuper_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapWalkerNavMenu.php';

/*
 * Woocommerce support theme
 */
require get_template_directory() . '/inc/woocommerce.php';

/*
 * Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/*
 * Theme Add Functionalities
 */
require get_template_directory() . '/inc/theme-functions.php';
