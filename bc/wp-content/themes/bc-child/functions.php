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

	//ALSO EMPTY CART AS WERE SELECTING NEW MAIN PRODUCT
	global $woocommerce;
	$woocommerce->cart->empty_cart(true);

	//GATHER BOTH DATA SETS
	$shortcode_array = [];

	$shortcode_array['data_1'] = do_shortcode('[product_page id="' . $product_id . '"]');
	$shortcode_array['data_2'] = clear_cart();

	echo json_encode($shortcode_array);
	
    wp_die(); // this is required to terminate immediately and return a proper response
}

//RELOAD THE CHECKOUT ON PRODUCT ADD
add_action( 'wp_ajax_get_checkout_shortcode', 'get_checkout_shortcode' );
add_action( 'wp_ajax_nopriv_get_checkout_shortcode', 'get_checkout_shortcode' );

function get_checkout_shortcode() {

	echo do_shortcode('[woocommerce_checkout]');


    wp_die(); // this is required to terminate immediately and return a proper response
}

//PRODUCT TYPE ON CALCULATOR//RELOAD THE CHECKOUT ON PRODUCT ADD
add_action( 'wp_ajax_get_checkout_price', 'get_checkout_price' );
add_action( 'wp_ajax_nopriv_get_checkout_price', 'get_checkout_price' );

function get_checkout_price() {

    $product_id = $_REQUEST['prodID'];

    $_product = wc_get_product( $product_id );

    $return['price'] = $_product->get_price();
    $return['title'] = $_product->get_title();

    echo json_encode($return);

    wp_die(); // this is required to terminate immediately and return a proper response
}

//ADD PRODUCT ADDONS IN CALCULATOR
add_action( 'wp_ajax_get_addons', 'get_addons' );
add_action( 'wp_ajax_nopriv_get_addons', 'get_addons' );

function get_addons() {

	echo clear_cart();

    wp_die(); // this is required to terminate immediately and return a proper response
}

//REMOVE PRODUCT ADDONS IN CALCULATOR
add_action( 'wp_ajax_remove_addon', 'remove_addon' );
add_action( 'wp_ajax_nopriv_remove_addon', 'remove_addon' );

function remove_addon() {

	$addon_id = $_REQUEST['addonID'];

	global $woocommerce;
	foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {

		if ($cart_item['product_id'] == $addon_id) {
			//remove single product
			$woocommerce->cart->remove_cart_item($cart_item_key);
			$woocommerce->cart->empty_cart();
		}
	};

	echo clear_cart();

	wp_die(); // this is required to terminate immediately and return a proper response
	
}

function clear_cart() {

	global $woocommerce;
	$items = $woocommerce->cart->get_cart();

	foreach($items as $item => $values) { 
		$_product =  wc_get_product( $values['data']->get_id()); 
		$price = get_post_meta($values['product_id'] , '_price', true);

		echo '<div class="addon-item product-'. $_product->get_type() .'" data-price="'.$price.'">';
			echo '<a class="cart-remove-addon" href="#" data-id="' .$_product->id. '">X</a>';
			echo '<span class="package-title">'.$_product->get_title().'</span>';
			echo '<span class="package-price">$<span class="package-price-insert">'.$price.'</span></span>';
		echo '</div>';
	}   
}