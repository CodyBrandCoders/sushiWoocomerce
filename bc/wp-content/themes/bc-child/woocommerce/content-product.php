<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<div id="sushi-bookable-item" <?php post_class(); ?>>
	<div class="sushi-bookable-item-wrapper">
		<li <?php post_class(); ?> data-id="<?php echo $product->id ?>">
			<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );

			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );

			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' ); 
			echo '<div class="addon-content-wrapper">';
      		
			echo '<div class="content-addon">' . get_field('product_description') . '</div>';
			echo '<div class="sub-title-addon">' . get_field('product_sub_title') . '</div>'; 

			echo '</div>';
			
			/**
			 * woocommerce_after_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
			

			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 * @hooked woocommerce_template_loop_add_to_cart - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
			//Modifications to user count/price stroed vars 
			$this_product_price = $product->get_price(); 
		
			echo '<div class="addon-price-wrapper">';
			echo '<h2 class="price-bookable-item">$' . $this_product_price . ' <span>Per Order</span></h2>';
			echo '<i class="fas add-addon-circle fa-plus-circle"></i>';
			echo '<i class="fas minus-addon-circle fa-minus-circle"></i>';
			echo woocommerce_quantity_input( array(
				'input_id'    => uniqid( 'quantity_' ),
				'input_name'  => 'quantity',
				'input_value' => '1',
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
				'step'        => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
				'pattern'     => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
				'inputmode'   => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
			), $product, false );
			
			echo '</div>';
	?>
			<!-- PARTY INPUT --> 
			<!-- <div class="sushi-party-size"> 
			<span>Party Size: </span> 
			<input class="sushi-value force-select-all" onClick="this.select();" type="number" name="pnumber" value="1"> 
			</div> --> 

		</li>
	</div>

	
	

</div>


