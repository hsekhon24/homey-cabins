<?php
/**
 * Homey Cabins functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Homey_Cabins
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'homey_cabins_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function homey_cabins_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Homey Cabins, use a find and replace
		 * to change 'homey-cabins' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'homey-cabins', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'header' => esc_html__( 'Header Menu Location', 'homey-cabins' ),
				'footer' => esc_html__( 'Footer Menu Location', 'homey-cabins' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'homey_cabins_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'homey_cabins_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function homey_cabins_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'homey_cabins_content_width', 640 );
}
add_action( 'after_setup_theme', 'homey_cabins_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDPtiGPuG3DNrtbPcLo-jSt4DiAFBdF7kI');
}

add_action('acf/init', 'my_acf_init');

/**
 * Enqueue scripts and styles.
 */
function homey_cabins_scripts() {
	wp_enqueue_style( 'homey-cabins-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'homey-cabins-style', 'rtl', 'replace' );

	wp_enqueue_script( 'homey-cabins-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Load Lightbox gallery only on home page
	if ( is_front_page( ) ) {

		// JS files
		wp_enqueue_script( 'hc-lightgallery', get_template_directory_uri().'/js/lightgallery.min.js', array('jquery'), '20210225', true ); // 20210225 defines version, its set to the date when we last used it

		wp_enqueue_script( 'hc-lightgallery-settings', get_template_directory_uri().'/js/lightbox-settings.js', array('jquery', 'hc-lightgallery'), '20210225', true );

		// CSS files
	
		wp_enqueue_style( 'hc-gallery', get_template_directory_uri() . '/css/lightgallery.css' );

	}
}
add_action( 'wp_enqueue_scripts', 'homey_cabins_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Post types
 */
require get_template_directory() . '/inc/cpt.php';

/**

