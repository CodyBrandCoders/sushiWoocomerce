<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'multiStep', get_stylesheet_directory_uri() . '/css/multi-step.css' );
	wp_enqueue_style( 'wooStyles', get_stylesheet_directory_uri() . '/css/main.css' );
}
function theme_js() {
	
	wp_register_script( 'script_steps', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.js', false, false, false );
	wp_register_script( 'script_sensor', 'https://cdnjs.cloudflare.com/ajax/libs/css-element-queries/1.0.2/ResizeSensor.min.js', false, false, false );

	wp_enqueue_script( 'script_steps' );
	wp_enqueue_script( 'script_sensor' );
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

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
/* change check out text*/
add_filter( 'woocommerce_order_button_text', 'woo_custom_order_button_text' ); function woo_custom_order_button_text() { return __( 'Book Your Event & Complete Payment', 'woocommerce' ); }

//EMPTY CART
add_action( 'wp_ajax_empty_cart', 'empty_cart' );
add_action( 'wp_ajax_nopriv_empty_cart', 'empty_cart' );

add_action('woocommerce_before_cart', 'fs_check_category_in_cart');
function empty_cart() {

	global $woocommerce;

	foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {

		$product = $cart_item['data'];

		if ( has_term( 'bookable', 'product_cat', $product->get_id() ) ) {
			$woocommerce->cart->remove_cart_item($cart_item_key);
			echo clear_cart();
		}
	};
	

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

    $addon_id = $_REQUEST['addonID'];
    $addonAmmount = $_REQUEST['addonAmmount'];

    echo clear_cart();

    add_action('woocommerce_before_calculate_totals', 'change_cart_item_quantities', 20, 1 );
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    // HERE below define your specific products IDs
    $specific_ids = array($addon_id);
    $new_qty = $addonAmmount; // New quantity

    // Checking cart items
    global $woocommerce;
	foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
    //foreach( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['data']->get_id();
        // Check for specific product IDs and change quantity
        if( in_array( $product_id, $specific_ids ) && $cart_item['quantity'] != $new_qty ){
            $woocommerce->cart->set_quantity( $cart_item_key, $new_qty ); // Change quantity
        }
    }

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
			//$woocommerce->cart->empty_cart();
		}
	};

	echo clear_cart();

	wp_die(); // this is required to terminate immediately and return a proper response
	
}

//ADD PRODUCT TO CART
add_action( 'wp_ajax_custom_add_to_cart', 'custom_add_to_cart' );
add_action( 'wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart' );

function custom_add_to_cart() {

	
    //$form_data = $_REQUEST['formData'];
    $product_id = $_POST['add-to-cart'];
    
    $product = wc_get_product( $product_id );
    //print_r($product);

    if ( ! is_wc_booking_product( $product ) ) {
        wp_die();
    }

    $booking_form                       = new WC_Booking_Form( $product );
    $cart_item_meta['booking']          = $booking_form->get_posted_data( $_POST );
    $cart_item_meta['booking']['_cost'] = $booking_form->calculate_booking_cost( $_POST );

    $cart_manager = new WC_Booking_Cart_Manager();
    // Create the new booking
    $new_booking_data = array(
        'product_id'    => $product_id, // Booking ID
        //'cost'          => $cart_item_meta['booking']['_cost'],
        'start_date'    => $cart_item_meta['booking']['_start_date'],
        'end_date'      => $cart_item_meta['booking']['_end_date'],
        'all_day'       => $cart_item_meta['booking']['_all_day'],
    );

    // Check if the booking has resources
    if ( isset( $cart_item_meta['booking']['_resource_id'] ) ) {
        $new_booking_data['resource_id'] = $cart_item_meta['booking']['_resource_id']; // ID of the resource
    }

    // Checks if the booking allows persons
    if ( isset( $cart_item_meta['booking']['_persons'] ) ) {
        $new_booking_data['persons'] = $cart_item_meta['booking']['_persons']; // Count of persons making booking
    }

    print_r($new_booking_data);
    $new_booking = get_wc_booking( $new_booking_data );
       $new_booking->create( 'in-cart' );

    // Schedule this item to be removed from the cart if the user is inactive.
    $cart_manager->schedule_cart_removal( $new_booking->get_id() );
    

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

function update_addon_quantity() {
    add_action('woocommerce_before_calculate_totals', 'change_cart_item_quantities', 20, 1 );
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    // HERE below define your specific products IDs
    $specific_ids = array($addon_id);
    $new_qty = 40; // New quantity

    // Checking cart items
    global $woocommerce;
	foreach ($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
    //foreach( $cart->get_cart() as $cart_item_key => $cart_item ) {
        $product_id = $cart_item['data']->get_id();
        // Check for specific product IDs and change quantity
        if( in_array( $product_id, $specific_ids ) && $cart_item['quantity'] != $new_qty ){
            $woocommerce->cart->set_quantity( $cart_item_key, $new_qty ); // Change quantity
        }
    }
}
