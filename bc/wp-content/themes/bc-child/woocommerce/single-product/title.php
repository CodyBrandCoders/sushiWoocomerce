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


echo '<div class="content-bookable-item">' . get_field('product_description') . '</div>';
echo '<a target="_blank" href="../bc/wp-content/uploads/The-Sushi-Experience-Menu.pdf" class="content-bookable-pdf">View Full Menu PDF For Ingredients<i class="fas fa-angle-double-right ml10"></i></a>';


