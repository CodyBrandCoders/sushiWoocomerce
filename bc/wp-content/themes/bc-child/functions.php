<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'multiStep', get_stylesheet_directory_uri() . '/css/multi-step.css' );
	wp_enqueue_style( 'wooStyles', get_stylesheet_directory_uri() . '/css/main.css' );
}
function theme_js() {
	
	wp_register_script( 'script_modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js', false, false, false );
	wp_enqueue_script( 'script_modernizr' );
	wp_enqueue_script( 'theme_js', get_stylesheet_directory_uri() . '/js/woocommerce-child.js', array( 'jquery' ), '1.0', true );

}

add_action('wp_enqueue_scripts', 'theme_js');


//AJAX URL
add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

//INJECT THE CORRECT PRODUCT INTO THE FORM
add_action( 'wp_ajax_get_product_shortcode', 'get_product_shortcode' );
add_action( 'wp_ajax_nopriv_get_product_shortcode', 'get_product_shortcode' );

function get_product_shortcode() {

	$product_id = $_REQUEST['prodID'];

	echo do_shortcode('[product_page id="' . $product_id . '"]');


    wp_die(); // this is required to terminate immediately and return a proper response
}

//RELOAD THE CHECKOUT ON PRODUCT ADD
add_action( 'wp_ajax_get_checkout_shortcode', 'get_checkout_shortcode' );
add_action( 'wp_ajax_nopriv_get_checkout_shortcode', 'get_checkout_shortcode' );

function get_checkout_shortcode() {

	echo do_shortcode('[woocommerce_checkout]');


    wp_die(); // this is required to terminate immediately and return a proper response
}

//RELOAD THE CART ON PRODUCT ADD
add_action( 'wp_ajax_get_cart_shortcode', 'get_cart_shortcode' );
add_action( 'wp_ajax_nopriv_get_cart_shortcode', 'get_cart_shortcode' );

function get_cart_shortcode() {

	echo do_shortcode('[woocommerce_cart]');

    wp_die(); // this is required to terminate immediately and return a proper response
}