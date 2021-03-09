<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Homey_Cabins
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function homey_cabins_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
//	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'homey_cabins_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function homey_cabins_woocommerce_scripts() {
	wp_enqueue_style( 'homey-cabins-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'homey-cabins-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'homey_cabins_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function homey_cabins_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'homey_cabins_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function homey_cabins_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'homey_cabins_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'homey_cabins_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function homey_cabins_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'homey_cabins_woocommerce_wrapper_before' );

if ( ! function_exists( 'homey_cabins_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function homey_cabins_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'homey_cabins_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'homey_cabins_woocommerce_header_cart' ) ) {
			homey_cabins_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'homey_cabins_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function homey_cabins_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		homey_cabins_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'homey_cabins_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'homey_cabins_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function homey_cabins_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'homey-cabins' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'homey-cabins' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'homey_cabins_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function homey_cabins_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php homey_cabins_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
		
	}
}

function homey_cabins_product_short_description() {
      
    the_excerpt();
      
}
add_action( 'woocommerce_after_shop_loop_item', 'homey_cabins_product_short_description', 7 );

function homey_cabins_display_surrounding_activities() {

	if ( is_shop() )
	{
	//Uses the template part to display surrounding activities
	 get_template_part('template-parts/surrounding', 'activities');
	}
	 
}
add_action( 'woocommerce_after_main_content', 'homey_cabins_display_surrounding_activities', 11 );


/**
 * Exclude Gift Certificates from shop(cabins) page
 */
function homey_cabins_custom_pre_get_posts_query( $q ) {

    $tax_query = (array) $q->get( 'tax_query' );

    $tax_query[] = array(
           'taxonomy' => 'product_cat',
           'field' => 'slug',
           'terms' => array( 'gift-certificate' ), // Don't display products in the gift-certificate category on the shop page.
           'operator' => 'NOT IN'
    );


    $q->set( 'tax_query', $tax_query );

}
add_action( 'woocommerce_product_query', 'homey_cabins_custom_pre_get_posts_query' ); 

//Don't display price on all cabins page

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

// Remove result count from cabins page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 ); 

// Remove catalog ordering dropdown from cabins page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 ); 

//Remove cabin image from top
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 ); 

//Add cabin image again after the title
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_product_thumbnail', 15);


// To change 'Read More' text to 'More info' on shop page
add_filter( 'woocommerce_product_add_to_cart_text', function( $text ) {
    if ( 'Read more' == $text ) {
        $text = __( 'More Info', 'woocommerce' );
    }

    return $text;
} );


// Don't display Related products on Single Cabin Page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// Remove product thumbnail gallery from Single Products page
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 ); 

// Re-add product thumbnail gallery at bottom on Single Products page
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_show_product_thumbnails', 25 );


// Remove product title from Single Products page
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); 

// Re-add product title on top on Single Products page
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 15 );

/* Remove Categories from Single Products */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/* Remove Product image from Single Products */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

/*Add product image after description on single product page */
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_images', 25 );



/*Add product price on single product page */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

/*Add product price after description on single product page */
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 28 );

/* Remove sidebar from shop page */

function homey_cabins_remove_sidebar_shop_product_page() {

    if ( is_shop() || is_product() ) {

    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

   }

}

add_action( 'wp', 'homey_cabins_remove_sidebar_shop_product_page' );


/* Add random testimonial on single product page */
function homey_cabins_display_random_testimonial() {

		if ( is_product() )
		{
			//Uses the template part to display random testimonial
		get_template_part('template-parts/testimonials', 'random');
		}
		 
	}
add_action( 'woocommerce_after_single_product_summary', 'homey_cabins_display_random_testimonial', 25 );


/* Remove tabs from single cabin page */
// Remove
function remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );
    unset( $tabs['additional_information'] );
	unset( $tabs['accommodation_booking_time'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 98, 1 );

// Tabs callback function after single content.
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_description_tab' );
//add_action( 'woocommerce_after_single_product_summary', 'woocommerce_product_additional_information_tab' );
//add_action('woocommerce_after_single_product_summary', 'add_time_tab_content');


function hc_arrive_depart_time() {
	$check_in  = WC_Product_Accommodation_Booking::get_check_times( 'in' );
	$check_out = WC_Product_Accommodation_Booking::get_check_times( 'out' );
	?>
	<h2><?php echo esc_html( apply_filters( 'woocommerce_accommodation_booking_time_tab_heading', __( 'Arriving/leaving', 'woocommerce-accommodation-bookings' ) ) ); ?></h2>
	<ul>
		<li><?php esc_html_e( 'Check-in time', 'woocommerce-accommodation-bookings' ); ?> <?php echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( "Today " . $check_in ) ) ); ?></li>
		<li><?php esc_html_e( 'Check-out time', 'woocommerce-accommodation-bookings' ); ?> <?php echo esc_html( date_i18n( get_option( 'time_format' ), strtotime( "Today " . $check_out ) ) ); ?></li>
	</ul>
<?php }
add_action('woocommerce_after_single_product_summary', 'hc_arrive_depart_time');