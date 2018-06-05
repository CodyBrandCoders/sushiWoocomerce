<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

the_title( '<h2 class="product_title entry-title">', '</h2>' );

//Custom Fields
echo '<div class="sub-title-bookable-item">' . get_field('product_sub_title') . '</div>';
echo '<div class="content-bookable-item">' . get_field('product_description') . '</div>';
//Modifications to user count/price stroed vars
$this_product_price = $product->get_price();

echo '<h2 class="price-bookable-item">$' . $this_product_price . ' Per Person</h2>'; ?>

