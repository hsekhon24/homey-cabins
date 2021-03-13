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
				'social' => esc_html__( 'Social Menu Location', 'homey-cabins' ),
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

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyCIKMOtFacMI_MLIJz8eIZ9LklBA_B846E';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
/**
 * Enqueue scripts and styles.
 */
function homey_cabins_scripts() {
	wp_enqueue_style(
		'hc-googlefonts', 
		'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto+Slab:wght@600&display=swap',
		array(),
		null
);

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

		//for animated gallery
		wp_enqueue_script( 'hc-lightgallery-thumbnail', get_template_directory_uri().'/js/lg-fullscreen.min.js', array('jquery'), '20210225', true );

		wp_enqueue_script( 'hc-lightgallery-full-screen', get_template_directory_uri().'/js/lg-thumbnail.min.js', array('jquery'), '20210225', true );

		// CSS files
		wp_enqueue_style( 'hc-gallery', get_template_directory_uri() . '/css/lightgallery.css' );

		wp_enqueue_style( 'hc-gallery-transitions', get_template_directory_uri() . '/css/lightgallery.css' );

	}

	//Google map
	wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCIKMOtFacMI_MLIJz8eIZ9LklBA_B846E' );
	wp_enqueue_script( 'google-map-init', get_template_directory_uri().'/js/google-map.js', array('jquery', 'google-map'), '20210305', true );
	
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

 * Lower Yoast SEO Metabox location
 */
function yoast_to_bottom(){
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom' );



//Remove Dashboard Widgets
function wporg_remove_all_dashboard_metaboxes() {
// Remove Welcome panel
remove_action( 'welcome_panel', 'wp_welcome_panel' );
// Remove the rest of the dashboard widgets
remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );



//Add Dashboard Widgets (Welcome and client tutorial videos)
// This function is hooked into the 'wp_dashboard_setup' action below.
function hc_add_dashboard_widgets() {
wp_add_dashboard_widget(
'homeycabins_welcome_widget', // Widget slug.
esc_html__( 'Welcome Widget', 'hc' ), // Title.
'hc_add_widget_function' // Display function.
);
}
add_action( 'wp_dashboard_setup', 'hc_add_dashboard_widgets' );
// Create the function to output the content of your Dashboard Widget.
function hc_add_widget_function() {
// Display whatever you want to show.
echo '<p>Hello there! This is a Homey Cabins Dashboard Widget. Please see tutorial videos on how to add content to website.
		</p>
		<p>
		Client-tutorial 1 <ul> <li> How to add content on all pages? </li>
								<li> How to add testimonials? </li>
								<li> How to make changes to the Single cabin? </li> </ul> </p>
	<p>	Client-tutorial 2 <ul> <li> How to make changes to Single cabin? (contd.) </li>
								<li> How to manage bookings? </li> </ul> </p>
	<p>	<a href="  ' . wp_get_attachment_url( 394 )  .'" target="_blank">Client Tutorial 1</a>
		<a href="  ' . wp_get_attachment_url( 395 )  .' " target="_blank">Client Tutorial 2</a></</p>';
}


//Remove admin menu items
function wd_admin_menu_remove() {
	remove_menu_page( 'edit.php' );

	}
	add_action( 'admin_menu', 'wd_admin_menu_remove' );

//Remove Menu Items for non-admin users
function wd_admin_menu_remove_client() {
	if (!current_user_can('administrator') && !is_admin()){
remove_menu_page( 'edit-comments.php' );
	}
}
add_action( 'admin_menu', 'wd_admin_menu_remove_client' );

// Add theme styles to block editor
add_editor_style();
add_theme_support( 'editor-styles' );

function prefix_block_styles() {
	wp_enqueue_style( 'prefix-editor-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&family=Roboto+Slab:wght@600&display=swap');
	}
	add_action( 'enqueue_block_editor_assets', 'prefix_block_styles' );
	

// Customise Wordpress login page

//Change logo
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png);
		height:65px;
		width:320px;
		background-size: contain;
		background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Link logo to home page
function my_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

//Add styles to WP login page
function my_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.css' );
    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/css/style-login.js' );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );




// Modifying WYSIWIG Toolbar
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Homey Cabins Toolbar' ] = array();
	$toolbars['Homey Cabins Toolbar' ][1] = array('formatselect', 'bold' , 'italic' , 'underline');

	// return $toolbars - IMPORTANT!
	return $toolbars;
}

function ms_post_filter( $use_block_editor, $post ) {
	if ( 24 === $post->ID || 28 === $post->ID || 22 === $post->ID ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'ms_post_filter', 10, 2 );

