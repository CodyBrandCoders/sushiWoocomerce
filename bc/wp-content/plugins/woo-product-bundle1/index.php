<?php
/*
Plugin Name: WooCommerce Product Bundles
Plugin URI: https://wpclever.net/
Description: WooCommerce Product Bundles is a plugin help you bundle a few products with pre-defined quantity, offer them at a discount and watch the sales go up!
Version: 2.8.7
Author: WPclever.net
Author URI: https://wpclever.net
Text Domain: woosb
Domain Path: /languages/
WC requires at least: 3.0
WC tested up to: 3.3.5
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WOOSB_VERSION', '2.8.7' );
define( 'WOOSB_URI', plugin_dir_url( __FILE__ ) );
define( 'WOOSB_REVIEWS', 'https://wordpress.org/support/plugin/woo-product-bundle/reviews/?filter=5' );
define( 'WOOSB_CHANGELOGS', 'https://wordpress.org/plugins/woo-product-bundle/#developers' );
define( 'WOOSB_DISCUSSION', 'https://wordpress.org/support/plugin/woo-product-bundle' );
if ( ! defined( 'WPC_URI' ) ) {
	define( 'WPC_URI', WOOSB_URI );
}

include( 'includes/wpc-menu.php' );
include( 'includes/wpc-dashboard.php' );

if ( ! class_exists( 'WPcleverWoosb' ) ) {
	add_action( 'plugins_loaded', 'woosb_register_product_type' );

	function woosb_register_product_type() {
		if ( class_exists( 'WC_Product' ) ) {
			class WC_Product_Woosb extends WC_Product {
				public function __construct( $product = 0 ) {
					$this->supports[] = 'ajax_add_to_cart';
					parent::__construct( $product );
				}

				public function get_type() {
					return 'woosb';
				}

				public function add_to_cart_url() {
					$product_id = $this->id;
					if ( $this->is_purchasable() && $this->is_in_stock() && ! $this->has_variables() ) {
						$url = remove_query_arg( 'added-to-cart', add_query_arg( 'add-to-cart', $product_id ) );
					} else {
						$url = get_permalink( $product_id );
					}

					return apply_filters( 'woocommerce_product_add_to_cart_url', $url, $this );
				}

				public function add_to_cart_text() {
					if ( $this->is_purchasable() && $this->is_in_stock() ) {
						if ( ! $this->has_variables() ) {
							$text = get_option( '_woosb_archive_button_add', esc_html__( 'Add to cart', 'woosb' ) );
						} else {
							$text = get_option( '_woosb_archive_button_select', esc_html__( 'Select options', 'woosb' ) );
						}
					} else {
						$text = get_option( '_woosb_archive_button_read', esc_html__( 'Read more', 'woosb' ) );
					}

					return apply_filters( 'woosb_product_add_to_cart_text', $text, $this );
				}

				public function single_add_to_cart_text() {
					$text = get_option( '_woosb_single_button_add', esc_html__( 'Add to cart', 'woosb' ) );

					return apply_filters( 'woosb_product_single_add_to_cart_text', $text, $this );
				}

				public function is_purchasable() {
					$product_id = $this->id;

					return apply_filters( 'woocommerce_is_purchasable', $this->exists() && ( 'publish' === $this->get_status() || current_user_can( 'edit_post', $this->get_id() ) ) && ( '' !== $this->get_price() || is_numeric( get_post_meta( $product_id, 'woosb_price_percent', true ) ) ), $this );
				}

				public function is_virtual() {
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_item_product = wc_get_product( $woosb_item['id'] );
							if ( $woosb_item_product ) {
								if ( $woosb_item_product->is_type( 'variable' ) ) {
									$childs = $woosb_item_product->get_children();
									if ( is_array( $childs ) && count( $childs ) > 0 ) {
										foreach ( $childs as $child ) {
											$product_child = wc_get_product( $child );
											if ( ! $product_child->is_virtual() ) {
												return false;
											}
										}
									}
								} else {
									if ( ! $woosb_item_product->is_virtual() ) {
										return false;
									}
								}
							}
						}
					}

					return true;
				}

				public function get_manage_stock( $context = 'view' ) {
					$manage_stock = false;
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_product = wc_get_product( $woosb_item['id'] );
							if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) ) {
								continue;
							}
							if ( $woosb_product->get_manage_stock( $context ) == true ) {
								return true;
							}
						}
					}

					return $manage_stock;
				}

				public function get_stock_quantity( $context = 'view' ) {
					$available_qty = array();
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_product = wc_get_product( $woosb_item['id'] );
							if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) || ! $woosb_product->get_stock_quantity() ) {
								continue;
							}
							$available_qty[] = floor( $woosb_product->get_stock_quantity() / $woosb_item['qty'] );
						}
					}
					if ( count( $available_qty ) > 0 ) {
						sort( $available_qty );

						return intval( $available_qty[0] );
					}

					return parent::get_stock_quantity( $context );
				}

				public function get_backorders( $context = 'view' ) {
					$backorders = 'yes';
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_product = wc_get_product( $woosb_item['id'] );
							if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) ) {
								continue;
							}
							if ( $woosb_product->get_backorders( $context ) == 'no' ) {
								return 'no';
							} elseif ( $woosb_product->get_backorders( $context ) == 'notify' ) {
								$backorders = 'notify';
							}
						}
					}

					return $backorders;
				}

				public function get_stock_status( $context = 'view' ) {
					$stock_status = 'instock';
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_product = wc_get_product( $woosb_item['id'] );
							if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) ) {
								continue;
							}
							if ( ( $woosb_product->get_stock_status( $context ) == 'outofstock' ) || ( ! $woosb_product->has_enough_stock( $woosb_item['qty'] ) ) ) {
								return 'outofstock';
							} elseif ( $woosb_product->get_stock_status( $context ) == 'onbackorder' ) {
								$stock_status = 'onbackorder';
							}
						}
					}

					return $stock_status;
				}

				public function get_regular_price( $context = 'view' ) {
					$product_id = $this->id;
					if ( ( $context === 'view' ) && ( get_post_meta( $product_id, 'woosb_disable_auto_price', true ) != 'on' ) && ( $woosb_items = self::get_items() ) ) {
						$regular_price = 0;
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_product = wc_get_product( $woosb_item['id'] );
							if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) ) {
								continue;
							}
							$regular_price += $woosb_product->get_price( $context ) * $woosb_item['qty'];
						}

						return $regular_price;
					}

					return parent::get_regular_price( $context );
				}

				public function get_sale_price( $context = 'view' ) {
					$product_id = $this->id;
					if ( ( $context === 'view' ) && ( $woosb_price_percent = get_post_meta( $product_id, 'woosb_price_percent', true ) ) && is_numeric( $woosb_price_percent ) && ( intval( $woosb_price_percent ) < 100 ) && ( intval( $woosb_price_percent ) > 0 ) ) {
						$sale_price = $this->get_regular_price( $context ) * $woosb_price_percent / 100;
						$this->set_price( $sale_price );

						return $sale_price;
					}

					return parent::get_sale_price( $context );
				}

				// extra functions

				public function has_variables() {
					if ( $woosb_items = self::get_items() ) {
						foreach ( $woosb_items as $woosb_item ) {
							$woosb_item_product = wc_get_product( $woosb_item['id'] );
							if ( $woosb_item_product && $woosb_item_product->is_type( 'variable' ) ) {
								return true;
							}
						}
					}

					return false;
				}

				public function get_items() {
					$product_id = $this->id;
					$woosb_arr  = array();
					if ( ( $woosb_ids = get_post_meta( $product_id, 'woosb_ids', true ) ) ) {
						$woosb_items = explode( ',', $woosb_ids );
						if ( is_array( $woosb_items ) && count( $woosb_items ) > 0 ) {
							foreach ( $woosb_items as $woosb_item ) {
								$woosb_item_arr = explode( '/', $woosb_item );
								$woosb_arr[]    = array(
									'id'  => absint( $woosb_item_arr[0] ? $woosb_item_arr[0] : 0 ),
									'qty' => absint( $woosb_item_arr[1] ? $woosb_item_arr[1] : 1 )
								);
							}
						}
					}
					if ( count( $woosb_arr ) > 0 ) {
						return $woosb_arr;
					} else {
						return false;
					}
				}
			}
		}
	}

	class WPcleverWoosb {
		function __construct() {
			// Load textdomain
			add_action( 'plugins_loaded', array( $this, 'woosb_load_textdomain' ) );

			// Menu
			add_action( 'admin_menu', array( $this, 'woosb_admin_menu' ) );

			// Enqueue frontend scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'woosb_wp_enqueue_scripts' ) );

			// Enqueue backend scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'woosb_admin_enqueue_scripts' ) );

			// Backend AJAX search
			add_action( 'wp_ajax_woosb_get_search_results', array( $this, 'woosb_get_search_results' ) );

			// Add to selector
			add_filter( 'product_type_selector', array( $this, 'woosb_product_type_selector' ) );

			// Product data tabs
			add_filter( 'woocommerce_product_data_tabs', array( $this, 'woosb_product_data_tabs' ), 10, 1 );

			// Product filters
			add_filter( 'woocommerce_product_filters', array( $this, 'woosb_product_filters' ) );

			// Product data panels
			add_action( 'woocommerce_product_data_panels', array( $this, 'woosb_product_data_panels' ) );
			add_action( 'woocommerce_process_product_meta_woosb', array( $this, 'woosb_save_option_field' ) );

			// Add to cart form & button
			add_action( 'woocommerce_woosb_add_to_cart', array( $this, 'woosb_add_to_cart_form' ) );
			add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'woosb_add_to_cart_button' ) );

			// Add to cart
			add_action( 'woocommerce_add_to_cart', array( $this, 'woosb_add_to_cart' ), 10, 6 );
			add_filter( 'woocommerce_add_cart_item', array( $this, 'woosb_add_cart_item' ), 10, 1 );
			add_filter( 'woocommerce_add_cart_item_data', array( $this, 'woosb_add_cart_item_data' ), 10, 2 );
			add_filter( 'woocommerce_get_cart_item_from_session', array(
				$this,
				'woosb_get_cart_item_from_session'
			), 10, 2 );

			// Cart item
			add_filter( 'woocommerce_cart_item_name', array( $this, 'woosb_cart_item_name' ), 10, 2 );
			add_filter( 'woocommerce_cart_item_price', array( $this, 'woosb_cart_item_price' ), 10, 3 );
			add_filter( 'woocommerce_cart_item_quantity', array( $this, 'woosb_cart_item_quantity' ), 1, 2 );
			add_filter( 'woocommerce_cart_item_subtotal', array( $this, 'woosb_cart_item_subtotal' ), 10, 3 );
			add_filter( 'woocommerce_cart_item_remove_link', array( $this, 'woosb_cart_item_remove_link' ), 10, 3 );
			add_filter( 'woocommerce_cart_contents_count', array( $this, 'woosb_cart_contents_count' ) );
			add_action( 'woocommerce_after_cart_item_quantity_update', array(
				$this,
				'woosb_update_cart_item_quantity'
			), 1, 2 );
			add_action( 'woocommerce_before_cart_item_quantity_zero', array(
				$this,
				'woosb_update_cart_item_quantity'
			), 1 );
			add_action( 'woocommerce_cart_item_removed', array( $this, 'woosb_cart_item_removed' ), 10, 2 );

			// Checkout item
			add_filter( 'woocommerce_checkout_item_subtotal', array( $this, 'woosb_cart_item_subtotal' ), 10, 3 );

			// Hide on cart & checkout page
			if ( get_option( '_woosb_hide_bundled', 'no' ) == 'yes' ) {
				add_filter( 'woocommerce_cart_item_visible', array( $this, 'woosb_item_visible' ), 10, 2 );
				add_filter( 'woocommerce_order_item_visible', array( $this, 'woosb_item_visible' ), 10, 2 );
				add_filter( 'woocommerce_checkout_cart_item_visible', array( $this, 'woosb_item_visible' ), 10, 2 );
			}

			// Hide on mini-cart
			if ( get_option( '_woosb_hide_bundled_mini_cart', 'no' ) == 'yes' ) {
				add_filter( 'woocommerce_widget_cart_item_visible', array( $this, 'woosb_item_visible' ), 10, 2 );
			}

			// Item class
			add_filter( 'woocommerce_cart_item_class', array( $this, 'woosb_item_class' ), 10, 2 );
			add_filter( 'woocommerce_mini_cart_item_class', array( $this, 'woosb_item_class' ), 10, 2 );

			// Hide item meta
			add_filter( 'woocommerce_display_item_meta', array( $this, 'woosb_display_item_meta' ), 10, 2 );
			add_filter( 'woocommerce_order_items_meta_get_formatted', array(
				$this,
				'woosb_order_items_meta_get_formatted'
			), 10, 1 );

			// Order item
			add_action( 'woocommerce_checkout_create_order_line_item', array(
				$this,
				'woosb_add_order_item_meta'
			), 10, 3 );
			add_filter( 'woocommerce_order_item_name', array( $this, 'woosb_order_item_name' ), 10, 2 );

			// Admin order
			add_filter( 'woocommerce_hidden_order_itemmeta', array( $this, 'woosb_hidden_order_item_meta' ), 10, 1 );
			add_action( 'woocommerce_before_order_itemmeta', array( $this, 'woosb_before_order_item_meta' ), 10, 1 );

			// Add settings link
			add_filter( 'plugin_action_links', array( $this, 'woosb_action_links' ), 10, 2 );
			add_filter( 'plugin_row_meta', array( $this, 'woosb_row_meta' ), 10, 2 );

			// Add custom data
			add_action( 'wp_ajax_woosb_custom_data', array( $this, 'woosb_custom_data_callback' ) );
			add_action( 'wp_ajax_nopriv_woosb_custom_data', array( $this, 'woosb_custom_data_callback' ) );

			// Loop add-to-cart
			add_filter( 'woocommerce_loop_add_to_cart_link', array( $this, 'woosb_loop_add_to_cart_link' ), 10, 2 );

			// Calculate totals
			add_action( 'woocommerce_before_calculate_totals', array( $this, 'woosb_before_calculate_totals' ), 99, 1 );

			// Shipping
			add_filter( 'woocommerce_cart_shipping_packages', array( $this, 'woosb_cart_shipping_packages' ) );

			// Search filters
			if ( get_option( '_woosb_search_sku', 'no' ) == 'yes' ) {
				add_filter( 'pre_get_posts', array( $this, 'woosb_search_sku' ), 99 );
			}
			if ( get_option( '_woosb_search_exact', 'no' ) == 'yes' ) {
				add_action( 'pre_get_posts', array( $this, 'woosb_search_exact' ), 99 );
			}
			if ( get_option( '_woosb_search_sentence', 'no' ) == 'yes' ) {
				add_action( 'pre_get_posts', array( $this, 'woosb_search_sentence' ), 99 );
			}
		}

		function woosb_load_textdomain() {
			load_plugin_textdomain( 'woosb', false, basename( dirname( __FILE__ ) ) . '/languages/' );
		}

		function woosb_admin_menu() {
			add_submenu_page( 'wpclever', esc_html__( 'Woo Product Bundles', 'woosb' ), esc_html__( 'Woo Product Bundles', 'woosb' ), 'manage_options', 'wpclever-woosb', array(
				&$this,
				'woosb_admin_menu_content'
			) );
		}

		function woosb_admin_menu_content() {
			$page_slug  = 'wpclever-woosb';
			$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'how';
			?>
			<div class="wpclever_settings_page wrap">
				<h1 class="wpclever_settings_page_title"><?php echo esc_html__( 'Woo Product Bundles', 'woosb' ) . ' ' . WOOSB_VERSION; ?></h1>
				<div class="wpclever_settings_page_desc about-text">
					<p>
						<?php printf( esc_html__( 'Thank you for using our plugin! If you are satisfied, please reward it a full five-star %s rating.', 'woosb' ), '<span style="color:#ffb900">&#9733;&#9733;&#9733;&#9733;&#9733;</span>' ); ?>
						<br/>
						<a href="<?php echo esc_url( WOOSB_REVIEWS ); ?>"
						   target="_blank"><?php esc_html_e( 'Reviews', 'woosb' ); ?></a> | <a
							href="<?php echo esc_url( WOOSB_CHANGELOGS ); ?>"
							target="_blank"><?php esc_html_e( 'Changelogs', 'woosb' ); ?></a>
						| <a href="<?php echo esc_url( WOOSB_DISCUSSION ); ?>"
						     target="_blank"><?php esc_html_e( 'Discussion', 'woosb' ); ?></a>
					</p>
				</div>
				<div class="wpclever_settings_page_nav">
					<h2 class="nav-tab-wrapper">
						<a href="?page=<?php echo $page_slug; ?>&amp;tab=how"
						   class="nav-tab <?php echo $active_tab == 'how' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'How to use?', 'woosb' ); ?></a>
						<a href="?page=<?php echo $page_slug; ?>&amp;tab=settings"
						   class="nav-tab <?php echo $active_tab == 'settings' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Settings', 'woosb' ); ?></a>
						<a href="?page=<?php echo $page_slug; ?>&amp;tab=premium"
						   class="nav-tab <?php echo $active_tab == 'premium' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Premium Version', 'woosb' ); ?></a>
						</a>
					</h2>
				</div>
				<div class="wpclever_settings_page_content">
					<?php if ( $active_tab == 'how' ) { ?>
						<p>
							<?php esc_html_e( 'When creating the product, please choose product data is "Smart Bundle" then you can see the search field to start search and add products to the bundle.', 'woosb' ); ?>
						</p>
						<p>
							<img src="<?php echo WOOSB_URI; ?>assets/images/how-01.jpg"/>
						</p>
					<?php } elseif ( $active_tab == 'settings' ) { ?>
						<form method="post" action="options.php">
							<?php wp_nonce_field( 'update-options' ) ?>
							<h2><?php esc_html_e( 'General', 'woosb' ); ?></h2>
							<table class="form-table">
								<tr>
									<th><?php esc_html_e( 'Show thumbnail', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_bundled_thumb">
											<option
												value="yes" <?php echo( get_option( '_woosb_bundled_thumb', 'yes' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_bundled_thumb', 'yes' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Show quantity', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_bundled_qty">
											<option
												value="yes" <?php echo( get_option( '_woosb_bundled_qty', 'yes' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_bundled_qty', 'yes' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Show short description', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_bundled_description">
											<option
												value="yes" <?php echo( get_option( '_woosb_bundled_description', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_bundled_description', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Show price', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_bundled_price">
											<option
												value="price" <?php echo( get_option( '_woosb_bundled_price', 'html' ) == 'price' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Price', 'woosb' ); ?>
											</option>
											<option
												value="html" <?php echo( get_option( '_woosb_bundled_price', 'html' ) == 'html' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Price HTML', 'woosb' ); ?>
											</option>
											<option
												value="subtotal" <?php echo( get_option( '_woosb_bundled_price', 'html' ) == 'subtotal' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Subtotal', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_bundled_price', 'html' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Hide products in the bundle on cart & checkout page', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_hide_bundled">
											<option
												value="yes" <?php echo( get_option( '_woosb_hide_bundled', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_hide_bundled', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
										<span class="description">
											<?php esc_html_e( 'Hide products in the bundle, just show the main product on the cart & checkout page.', 'woosb' ); ?>
										</span>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Hide products in the bundle on mini-cart', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_hide_bundled_mini_cart">
											<option
												value="yes" <?php echo( get_option( '_woosb_hide_bundled_mini_cart', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_hide_bundled_mini_cart', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
										<span class="description">
											<?php esc_html_e( 'Hide products in the bundle, just show the main product on mini-cart.', 'woosb' ); ?>
										</span>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Bundle price text', 'woosb' ); ?></th>
									<td>
										<input type="text" name="_woosb_bundle_price_text"
										       value="<?php echo get_option( '_woosb_bundle_price_text', esc_html__( 'Bundle price:', 'woosb' ) ); ?>"/>
										<span class="description">
											<?php esc_html_e( 'The text before price when choosing variation in the bundle.', 'woosb' ); ?>
										</span>
									</td>
								</tr>
							</table>
							<h2><?php esc_html_e( '"Add to Cart" button labels', 'woosb' ); ?></h2>
							<table class="form-table">
								<tr>
									<th><?php esc_html_e( 'Archive/shop page', 'woosb' ); ?></th>
									<td>
										<input type="text" name="_woosb_archive_button_add"
										       value="<?php echo get_option( '_woosb_archive_button_add', esc_html__( 'Add to cart', 'woosb' ) ); ?>"/>
										<span class="description">
											<?php esc_html_e( 'For purchasable bundle.', 'woosb' ); ?>
										</span><br/>
										<input type="text" name="_woosb_archive_button_select"
										       value="<?php echo get_option( '_woosb_archive_button_select', esc_html__( 'Select options', 'woosb' ) ); ?>"/>
										<span class="description">
											<?php esc_html_e( 'For purchasable bundle and has variable product(s).', 'woosb' ); ?>
										</span><br/>
										<input type="text" name="_woosb_archive_button_read"
										       value="<?php echo get_option( '_woosb_archive_button_read', esc_html__( 'Read more', 'woosb' ) ); ?>"/>
										<span class="description">
											<?php esc_html_e( 'For unpurchasable bundle.', 'woosb' ); ?>
										</span>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Single product page', 'woosb' ); ?></th>
									<td>
										<input type="text" name="_woosb_single_button_add"
										       value="<?php echo get_option( '_woosb_single_button_add', esc_html__( 'Add to cart', 'woosb' ) ); ?>"/>
									</td>
								</tr>
							</table>
							<h2 id="search"><?php esc_html_e( 'Search', 'woosb' ); ?></h2>
							<table class="form-table">
								<tr>
									<th><?php esc_html_e( 'Search limit', 'woosb' ); ?></th>
									<td>
										<input name="_woosb_search_limit" type="number" min="1"
										       max="500"
										       value="<?php echo get_option( '_woosb_search_limit', '5' ); ?>"/>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Search by SKU', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_search_sku">
											<option
												value="yes" <?php echo( get_option( '_woosb_search_sku', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_search_sku', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Search exact', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_search_exact">
											<option
												value="yes" <?php echo( get_option( '_woosb_search_exact', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_search_exact', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select> <span
											class="description"><?php esc_html_e( 'Match whole product title or content?', 'woosb' ); ?></span>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Search sentence', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_search_sentence">
											<option
												value="yes" <?php echo( get_option( '_woosb_search_sentence', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_search_sentence', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select> <span
											class="description"><?php esc_html_e( 'Do a phrase search?', 'woosb' ); ?></span>
									</td>
								</tr>
								<tr>
									<th><?php esc_html_e( 'Accept same products', 'woosb' ); ?></th>
									<td>
										<select name="_woosb_search_same">
											<option
												value="yes" <?php echo( get_option( '_woosb_search_same', 'no' ) == 'yes' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'Yes', 'woosb' ); ?>
											</option>
											<option
												value="no" <?php echo( get_option( '_woosb_search_same', 'no' ) == 'no' ? 'selected' : '' ); ?>>
												<?php esc_html_e( 'No', 'woosb' ); ?>
											</option>
										</select> <span
											class="description"><?php esc_html_e( 'If yes, a product can be added many times.', 'woosb' ); ?></span>
									</td>
								</tr>
							</table>
							<table class="form-table">
								<tr>
									<th>
										<input type="submit" name="submit" class="button button-primary"
										       value="<?php esc_html_e( 'Update Options', 'woosb' ); ?>"/>
										<input type="hidden" name="action" value="update"/>
										<input type="hidden" name="page_options"
										       value="_woosb_bundled_thumb,_woosb_bundled_qty,_woosb_bundled_description,_woosb_bundled_price,_woosb_hide_bundled,_woosb_hide_bundled_mini_cart,_woosb_bundle_price_text,_woosb_archive_button_add,_woosb_archive_button_select,_woosb_archive_button_read,_woosb_single_button_add,_woosb_search_limit,_woosb_search_sku,_woosb_search_exact,_woosb_search_sentence,_woosb_search_same"/>
									</th>
									<td>&nbsp;</td>
								</tr>
							</table>
						</form>
					<?php } elseif ( $active_tab == 'premium' ) { ?>
						Get the Premium Version just $29! <a
							href="https://wpclever.net/downloads/woocommerce-product-bundle" target="_blank">https://wpclever.net/downloads/woocommerce-product-bundle</a>
						<br/>
						<br/>
						<strong>Extra features for Premium Version</strong>
						<ul>
							<li>- Add more than 3 products to the bundle</li>
							<li>- Get the lifetime update & premium support</li>
						</ul>
					<?php } ?>
				</div>
			</div>
			<?php
		}

		function woosb_wp_enqueue_scripts() {
			wp_enqueue_style( 'woosb-frontend', WOOSB_URI . 'assets/css/frontend.css' );
			wp_enqueue_script( 'woosb-frontend', WOOSB_URI . 'assets/js/frontend.js', array( 'jquery' ), WOOSB_VERSION, true );
			wp_localize_script( 'woosb-frontend', 'woosb_vars', array(
					'ajax_url'                 => admin_url( 'admin-ajax.php' ),
					'alert_text'               => esc_html__( 'Please select some product options before adding this product to your cart.', 'woosb' ),
					'bundle_price_text'        => get_option( '_woosb_bundle_price_text', '' ),
					'price_format'             => get_woocommerce_price_format(),
					'price_decimals'           => wc_get_price_decimals(),
					'price_thousand_separator' => wc_get_price_thousand_separator(),
					'price_decimal_separator'  => wc_get_price_decimal_separator(),
					'currency_symbol'          => get_woocommerce_currency_symbol(),
					'woosb_nonce'              => wp_create_nonce( 'woosb_nonce' )
				)
			);
		}

		function woosb_admin_enqueue_scripts() {
			wp_enqueue_style( 'woosb-backend', WOOSB_URI . 'assets/css/backend.css' );
			wp_enqueue_script( 'dragarrange', WOOSB_URI . 'assets/js/drag-arrange.js', array( 'jquery' ), WOOSB_VERSION, true );
			wp_enqueue_script( 'woosb-backend', WOOSB_URI . 'assets/js/backend.js', array( 'jquery' ), WOOSB_VERSION, true );
			wp_localize_script( 'woosb-backend', 'woosb_vars', array(
					'woosb_nonce'    => wp_create_nonce( 'woosb_nonce' ),
					'price_decimals' => wc_get_price_decimals()
				)
			);
		}

		function woosb_custom_data_callback() {
			if ( isset( $_POST['woosb_ids'] ) ) {
				if ( ! isset( $_POST['woosb_nonce'] ) || ! wp_verify_nonce( $_POST['woosb_nonce'], 'woosb_nonce' ) ) {
					die( 'Permissions check failed' );
				}
				if ( ! isset( $_SESSION ) ) {
					session_start();
				}
				$_SESSION['woosb_ids'] = self::woosb_clean_ids( $_POST['woosb_ids'] );
			}
			die();
		}

		function woosb_action_links( $links, $file ) {
			static $plugin;
			if ( ! isset( $plugin ) ) {
				$plugin = plugin_basename( __FILE__ );
			}
			if ( $plugin == $file ) {
				$settings_link = '<a href="' . admin_url( 'admin.php?page=wpclever-woosb&tab=settings' ) . '">' . esc_html__( 'Settings', 'woosb' ) . '</a>';
				$links[]       = '<a href="' . admin_url( 'admin.php?page=wpclever-woosb&tab=premium' ) . '">' . esc_html__( 'Premium Version', 'woosb' ) . '</a>';
				array_unshift( $links, $settings_link );
			}

			return (array) $links;
		}

		function woosb_row_meta( $links, $file ) {
			static $plugin;
			if ( ! isset( $plugin ) ) {
				$plugin = plugin_basename( __FILE__ );
			}
			if ( $plugin == $file ) {
				$row_meta = array(
					'support' => '<a href="https://wpclever.net/contact" target="_blank">' . esc_html__( 'Premium support', 'woosb' ) . '</a>',
				);

				return array_merge( $links, $row_meta );
			}

			return (array) $links;
		}

		function woosb_cart_contents_count( $count ) {
			$cart_contents = WC()->cart->cart_contents;
			$bundled_items = 0;
			foreach ( $cart_contents as $cart_item_key => $cart_item ) {
				if ( ! empty( $cart_item['woosb_parent_id'] ) ) {
					$bundled_items += $cart_item['quantity'];
				}
			}

			return intval( $count - $bundled_items );
		}

		function woosb_cart_item_name( $name, $item ) {
			if ( isset( $item['woosb_parent_id'] ) && ! empty( $item['woosb_parent_id'] ) ) {
				if ( strpos( $name, '</a>' ) !== false ) {
					return '<a href="' . get_permalink( $item['woosb_parent_id'] ) . '">' . get_the_title( $item['woosb_parent_id'] ) . '</a> &rarr; ' . $name;
				} else {
					return get_the_title( $item['woosb_parent_id'] ) . ' &rarr; ' . $name;
				}
			} else {
				return $name;
			}
		}

		function woosb_order_item_name( $name, $item ) {
			if ( isset( $item['woosb_parent_id'] ) && ! empty( $item['woosb_parent_id'] ) ) {
				if ( strpos( $name, '</a>' ) !== false ) {
					return '<a href="' . get_permalink( $item['woosb_parent_id'] ) . '">' . get_the_title( $item['woosb_parent_id'] ) . '</a> &rarr; ' . $name;
				} else {
					return get_the_title( $item['woosb_parent_id'] ) . ' &rarr; ' . $name;
				}
			} else {
				return $name;
			}
		}

		function woosb_update_cart_item_quantity( $cart_item_key, $quantity = 0 ) {
			if ( ! empty( WC()->cart->cart_contents[ $cart_item_key ] ) && ( isset( WC()->cart->cart_contents[ $cart_item_key ]['woosb_keys'] ) ) ) {
				if ( $quantity <= 0 ) {
					$quantity = 0;
				} else {
					$quantity = WC()->cart->cart_contents[ $cart_item_key ]['quantity'];
				}
				foreach ( WC()->cart->cart_contents[ $cart_item_key ]['woosb_keys'] as $woosb_key ) {
					WC()->cart->set_quantity( $woosb_key, $quantity * ( WC()->cart->cart_contents[ $woosb_key ]['woosb_qty'] ? WC()->cart->cart_contents[ $woosb_key ]['woosb_qty'] : 1 ), false );
				}
			}
		}

		function woosb_cart_item_removed( $cart_item_key, $cart ) {
			if ( isset( $cart->removed_cart_contents[ $cart_item_key ]['woosb_keys'] ) ) {
				$woosb_keys = $cart->removed_cart_contents[ $cart_item_key ]['woosb_keys'];
				foreach ( $woosb_keys as $woosb_key ) {
					unset( $cart->cart_contents[ $woosb_key ] );
				}
			}
		}

		function woosb_add_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
			if ( isset( $cart_item_data['woosb_ids'] ) && ( $cart_item_data['woosb_ids'] != '' ) ) {
				$items = explode( ',', $cart_item_data['woosb_ids'] );
				if ( is_array( $items ) && ( count( $items ) > 0 ) ) {
					// add child products
					foreach ( $items as $item ) {
						$woosb_item              = explode( '/', $item );
						$woosb_item_id           = absint( $woosb_item[0] ? $woosb_item[0] : 0 );
						$woosb_item_qty          = absint( $woosb_item[1] ? $woosb_item[1] : 1 );
						$woosb_item_variation_id = 0;
						$woosb_item_variation    = array();
						// ensure we don't add a variation to the cart directly by variation ID
						if ( 'product_variation' === get_post_type( $woosb_item_id ) ) {
							$woosb_item_variation_id      = $woosb_item_id;
							$woosb_item_id                = wp_get_post_parent_id( $woosb_item_variation_id );
							$woosb_item_variation_product = wc_get_product( $woosb_item_variation_id );
							$woosb_item_variation         = $woosb_item_variation_product->get_attributes();
						}
						$woosb_product = wc_get_product( $woosb_item_id );
						if ( $woosb_product ) {
							// set price zero for child product
							$woosb_product->set_price( 0 );
							// add to cart
							$woosb_product_qty = $woosb_item_qty * $quantity;
							$woosb_cart_id     = WC()->cart->generate_cart_id( $woosb_item_id, $woosb_item_variation_id, $woosb_item_variation, array(
								'woosb_parent_id'  => $product_id,
								'woosb_parent_key' => $cart_item_key,
								'woosb_qty'        => $woosb_item_qty
							) );
							$woosb_item_key    = WC()->cart->find_product_in_cart( $woosb_cart_id );
							if ( ! $woosb_item_key ) {
								$woosb_item_key                              = $woosb_cart_id;
								WC()->cart->cart_contents[ $woosb_item_key ] = array(
									'product_id'       => $woosb_item_id,
									'variation_id'     => $woosb_item_variation_id,
									'variation'        => $woosb_item_variation,
									'quantity'         => $woosb_product_qty,
									'data'             => $woosb_product,
									'woosb_parent_id'  => $product_id,
									'woosb_parent_key' => $cart_item_key,
									'woosb_qty'        => $woosb_item_qty,
								);
							}
							WC()->cart->cart_contents[ $cart_item_key ]['woosb_keys'][] = $woosb_item_key;
						}
					}
				}
			}
		}

		function woosb_add_cart_item( $cart_item ) {
			if ( isset( $cart_item['woosb_parent_key'] ) ) {
				$cart_item['data']->price = 0;
			}

			return $cart_item;
		}

		function woosb_add_cart_item_data( $cart_item_data, $product_id ) {
			if ( ! isset( $_SESSION ) ) {
				session_start();
			}
			$terms        = get_the_terms( $product_id, 'product_type' );
			$product_type = ! empty( $terms ) && isset( current( $terms )->name ) ? sanitize_title( current( $terms )->name ) : 'simple';
			if ( $product_type == 'woosb' ) {
				if ( isset( $_SESSION['woosb_ids'] ) ) {
					$cart_item_data['woosb_ids'] = $_SESSION['woosb_ids'];
					unset( $_SESSION['woosb_ids'] );
				} else {
					$cart_item_data['woosb_ids'] = get_post_meta( $product_id, 'woosb_ids', true );
				}
			}

			return $cart_item_data;
		}

		function woosb_item_visible( $visible, $item ) {
			if ( isset( $item['woosb_parent_id'] ) ) {
				return false;
			} else {
				return $visible;
			}
		}

		function woosb_item_class( $class, $item ) {
			if ( isset( $item['woosb_parent_id'] ) ) {
				$class .= ' woosb-cart-item woosb-cart-child';
			} elseif ( isset( $item['woosb_ids'] ) ) {
				$class .= ' woosb-cart-item woosb-cart-parent';
			}

			return $class;
		}

		function woosb_display_item_meta( $html, $item ) {
			if ( isset( $item['woosb_ids'] ) || isset( $item['woosb_parent_id'] ) ) {
				return '';
			} else {
				return $html;
			}
		}

		function woosb_order_items_meta_get_formatted( $formatted_meta ) {
			foreach ( $formatted_meta as $key => $meta ) {
				if ( ( $meta['key'] == 'woosb_ids' ) || ( $meta['key'] == 'woosb_parent_id' ) ) {
					unset( $formatted_meta[ $key ] );
				}
			}

			return $formatted_meta;
		}

		function woosb_add_order_item_meta( $item, $cart_item_key, $values ) {
			if ( isset( $values['woosb_parent_id'] ) ) {
				$item->update_meta_data( 'woosb_parent_id', $values['woosb_parent_id'] );
			}
			if ( isset( $values['woosb_ids'] ) ) {
				$item->update_meta_data( 'woosb_ids', $values['woosb_ids'] );
			}
		}

		function woosb_hidden_order_item_meta( $hidden ) {
			return array_merge( $hidden, array( 'woosb_parent_id', 'woosb_ids' ) );
		}

		function woosb_before_order_item_meta( $item_id ) {
			if ( ( $woosb_parent_id = wc_get_order_item_meta( $item_id, 'woosb_parent_id', true ) ) ) {
				echo sprintf( esc_html__( '(bundled in %s)', 'woosb' ), get_the_title( $woosb_parent_id ) );
			}
		}

		function woosb_get_cart_item_from_session( $cart_item, $item_session_values ) {
			if ( isset( $item_session_values['woosb_ids'] ) && ! empty( $item_session_values['woosb_ids'] ) ) {
				$cart_item['woosb_ids'] = $item_session_values['woosb_ids'];
			}
			if ( isset( $item_session_values['woosb_parent_id'] ) ) {
				$cart_item['woosb_parent_id']  = $item_session_values['woosb_parent_id'];
				$cart_item['woosb_parent_key'] = $item_session_values['woosb_parent_key'];
				$cart_item['woosb_qty']        = $item_session_values['woosb_qty'];
				if ( isset( $cart_item['data']->subscription_sign_up_fee ) ) {
					$cart_item['data']->subscription_sign_up_fee = 0;
				}
			}

			return $cart_item;
		}

		function woosb_cart_item_subtotal( $subtotal, $cart_item, $cart_item_key ) {
			if ( isset( WC()->cart->cart_contents[ $cart_item_key ]['woosb_parent_id'] ) ) {
				return '';
			}

			return $subtotal;
		}

		function woosb_cart_item_remove_link( $link, $cart_item_key ) {
			if ( isset( WC()->cart->cart_contents[ $cart_item_key ]['woosb_parent_id'] ) ) {
				return '';
			}

			return $link;
		}

		function woosb_cart_item_quantity( $quantity, $cart_item_key ) {
			if ( isset( WC()->cart->cart_contents[ $cart_item_key ]['woosb_parent_id'] ) ) {
				return WC()->cart->cart_contents[ $cart_item_key ]['quantity'];
			}

			return $quantity;
		}

		function woosb_cart_item_price( $price, $cart_item, $cart_item_key ) {
			if ( isset( WC()->cart->cart_contents[ $cart_item_key ]['woosb_parent_id'] ) ) {
				return '';
			}

			return $price;
		}

		function woosb_get_search_results() {
			if ( ! isset( $_POST['woosb_nonce'] ) || ! wp_verify_nonce( $_POST['woosb_nonce'], 'woosb_nonce' ) ) {
				die( 'Permissions check failed' );
			}
			$keyword     = sanitize_text_field( $_POST['woosb_keyword'] );
			$ids         = self::woosb_clean_ids( $_POST['woosb_ids'] );
			$exclude_ids = array();
			$ids_arrs    = explode( ',', $ids );
			if ( is_array( $ids_arrs ) && count( $ids_arrs ) > 2 ) {
				echo '<ul><span>Please use the Premium Version to add more than 3 products to the bundle & get the premium support. Click <a href="https://wpclever.net/downloads/woocommerce-product-bundle" target="_blank">here</a> to buy, just $29!</span></ul>';
			} else {
				$woosb_query_args = array(
					'is_woosb'       => true,
					'post_type'      => 'product',
					'post_status'    => 'publish',
					's'              => $keyword,
					'posts_per_page' => get_option( '_woosb_search_limit', '5' ),
					'tax_query'      => array(
						array(
							'taxonomy' => 'product_type',
							'field'    => 'slug',
							'terms'    => array( 'woosb' ),
							'operator' => 'NOT IN',
						)
					)
				);
				if ( get_option( '_woosb_search_same', 'no' ) != 'yes' ) {
					if ( is_array( $ids_arrs ) && count( $ids_arrs ) > 0 ) {
						foreach ( $ids_arrs as $ids_arr ) {
							$ids_arr_new   = explode( '/', $ids_arr );
							$exclude_ids[] = absint( $ids_arr_new[0] ? $ids_arr_new[0] : 0 );
						}
					}
					$woosb_query_args['post__not_in'] = $exclude_ids;
				}
				$woosb_query = new WP_Query( $woosb_query_args );
				if ( $woosb_query->have_posts() ) {
					echo '<ul>';
					while ( $woosb_query->have_posts() ) {
						$woosb_query->the_post();
						$product = wc_get_product( get_the_ID() );
						if ( ! $product || $product->is_type( 'woosb' ) ) {
							continue;
						}
						if ( $product->is_type( 'variable' ) ) {
							echo '<li ' . ( ! $product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $product->get_id() . '" data-price="' . $product->get_variation_price( 'min' ) . '" data-price-max="' . $product->get_variation_price( 'max' ) . '"><span class="move"></span><span class="qty"></span> <span class="name">' . $product->get_name() . '</span> (#' . $product->get_id() . ' - ' . $product->get_price_html() . ') <span class="remove">+</span></li>';
							// show all childs
							$childs = $product->get_children();
							if ( is_array( $childs ) && count( $childs ) > 0 ) {
								foreach ( $childs as $child ) {
									$product_child = wc_get_product( $child );
									echo '<li ' . ( ! $product_child->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $child . '" data-price="' . $product_child->get_price() . '" data-price-max="' . $product_child->get_price() . '"><span class="move"></span><span class="qty"></span> <span class="name">' . $product_child->get_name() . '</span> (#' . $product_child->get_id() . ' - ' . $product_child->get_price_html() . ') <span class="remove">+</span></li>';
								}
							}
						} else {
							echo '<li ' . ( ! $product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $product->get_id() . '" data-price="' . $product->get_price() . '" data-price-max="' . $product->get_price() . '"><span class="move"></span><span class="qty"></span> <span class="name">' . $product->get_name() . '</span> (#' . $product->get_id() . ' - ' . $product->get_price_html() . ') <span class="remove">+</span></li>';
						}
					}
					echo '</ul>';
					wp_reset_postdata();
				} else {
					echo '<ul><span>' . sprintf( esc_html__( 'No results found for "%s"', 'woosb' ), $keyword ) . '</span></ul>';
				}
			}
			die();
		}

		function woosb_search_sku( $query ) {
			if ( $query->is_search && isset( $query->query['is_woosb'] ) ) {
				global $wpdb;
				$sku = $query->query['s'];
				$ids = $wpdb->get_col( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value = %s;", $sku ) );
				if ( ! $ids ) {
					return;
				}
				unset( $query->query['s'] );
				unset( $query->query_vars['s'] );
				$query->query['post__in'] = array();
				foreach ( $ids as $id ) {
					$post = get_post( $id );
					if ( $post->post_type == 'product_variation' ) {
						$query->query['post__in'][]      = $post->post_parent;
						$query->query_vars['post__in'][] = $post->post_parent;
					} else {
						$query->query_vars['post__in'][] = $post->ID;
					}
				}
			}
		}

		function woosb_search_exact( $query ) {
			if ( $query->is_search && isset( $query->query['is_woosb'] ) ) {
				$query->set( 'exact', true );
			}
		}

		function woosb_search_sentence( $query ) {
			if ( $query->is_search && isset( $query->query['is_woosb'] ) ) {
				$query->set( 'sentence', true );
			}
		}

		function woosb_product_type_selector( $types ) {
			$types['woosb'] = esc_html__( 'Smart Bundle', 'woosb' );

			return $types;
		}

		function woosb_product_data_tabs( $tabs ) {
			$tabs['woosb'] = array(
				'label'  => esc_html__( 'Smart Bundle', 'woosb' ),
				'target' => 'woosb_settings',
				'class'  => array( 'show_if_woosb' ),
			);

			return $tabs;
		}

		function woosb_product_filters( $filters ) {
			$filters = str_replace( 'Woosb', esc_html__( 'Smart Bundle', 'woosb' ), $filters );

			return $filters;
		}

		function woosb_product_data_panels() {
			global $post;
			$post_id = $post->ID;
			?>
			<div id='woosb_settings' class='panel woocommerce_options_panel woosb_table'>
				<table>
					<tr>
						<th><?php esc_html_e( 'Search', 'woosb' ); ?> (<a
								href="<?php echo admin_url( 'admin.php?page=wpclever-woosb&tab=settings#search' ); ?>"
								target="_blank"><?php esc_html_e( 'settings', 'woosb' ); ?></a>)
						</th>
						<td>
							<div class="w100">
								<span class="loading"
								      id="woosb_loading"><?php esc_html_e( 'searching...', 'woosb' ); ?></span>
								<input type="search" id="woosb_keyword"
								       placeholder="<?php esc_html_e( 'Type any keyword to search', 'woosb' ); ?>"/>
								<div id="woosb_results" class="woosb_results"></div>
							</div>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th><?php esc_html_e( 'Selected', 'woosb' ); ?></th>
						<td>
							<div class="w100">
								<input type="hidden" id="woosb_ids" class="woosb_ids" name="woosb_ids"
								       value="<?php echo get_post_meta( $post_id, 'woosb_ids', true ); ?>"
								       readonly/>
								<div id="woosb_selected" class="woosb_selected">
									<ul>
										<?php
										$woosb_price = 0;
										if ( get_post_meta( $post_id, 'woosb_ids', true ) ) {
											$woosb_items = explode( ',', get_post_meta( $post_id, 'woosb_ids', true ) );
											if ( is_array( $woosb_items ) && count( $woosb_items ) > 0 ) {
												foreach ( $woosb_items as $woosb_item ) {
													$woosb_item_arr = explode( '/', $woosb_item );
													$woosb_item_id  = absint( $woosb_item_arr[0] ? $woosb_item_arr[0] : 0 );
													$woosb_item_qty = absint( $woosb_item_arr[1] ? $woosb_item_arr[1] : 1 );
													$woosb_product  = wc_get_product( $woosb_item_id );
													if ( ! $woosb_product || $woosb_product->is_type( 'woosb' ) ) {
														continue;
													}
													$woosb_price += $woosb_product->get_price() * $woosb_item_qty;
													if ( $woosb_product->is_type( 'variable' ) ) {
														echo '<li ' . ( ! $woosb_product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $woosb_item_id . '" data-price="' . $woosb_product->get_variation_price( 'min' ) . '" data-price-max="' . $woosb_product->get_variation_price( 'max' ) . '"><span class="move"></span><span class="qty"><input type="number" value="' . $woosb_item_qty . '" min="1"/></span> <span class="name">' . $woosb_product->get_name() . '</span> (#' . $woosb_product->get_id() . ' - ' . $woosb_product->get_price_html() . ')<span class="remove">×</span></li>';
													} else {
														echo '<li ' . ( ! $woosb_product->is_in_stock() ? 'class="out-of-stock"' : '' ) . ' data-id="' . $woosb_item_id . '" data-price="' . $woosb_product->get_price() . '" data-price-max="' . $woosb_product->get_price() . '"><span class="move"></span><span class="qty"><input type="number" value="' . $woosb_item_qty . '" min="1"/></span> <span class="name">' . $woosb_product->get_name() . '</span> (#' . $woosb_product->get_id() . ' - ' . $woosb_product->get_price_html() . ')<span class="remove">×</span></li>';
													}
												}
											}
										}
										?>
									</ul>
								</div>
							</div>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th><?php echo esc_html__( 'Regular price', 'woosb' ) . ' (' . get_woocommerce_currency_symbol() . ')'; ?></th>
						<td>
							<span id="woosb_regular_price"><?php echo $woosb_price; ?></span>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th></th>
						<td style="font-style: italic">
							<input id="woosb_disable_auto_price" name="woosb_disable_auto_price"
							       type="checkbox" <?php echo( get_post_meta( $post_id, 'woosb_disable_auto_price', true ) == 'on' ? 'checked' : '' ); ?>/> <?php echo sprintf( esc_html__( 'Disable auto calculate regular price? If yes, %s click here to set regular price %s', 'woosb' ), '<a id="woosb_set_regular_price">', '</a>' ); ?>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th><?php esc_html_e( 'Sale price', 'woosb' ); ?></th>
						<td style="vertical-align: middle; line-height: 30px; font-style: italic">
							<input id="woosb_price_percent" name="woosb_price_percent" type="number" min="1" max="99"
							       value="<?php echo( get_post_meta( $post_id, 'woosb_price_percent', true ) ? get_post_meta( $post_id, 'woosb_price_percent', true ) : '' ); ?>"
							       style="width: 60px"/>% <?php echo sprintf( esc_html__( 'of Regular price or %s click here to set sale price %s', 'woosb' ), '<a id="woosb_set_sale_price">', '</a>' ); ?>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th><?php esc_html_e( 'Before text', 'woosb' ); ?></th>
						<td>
							<div class="w100">
								<textarea name="woosb_before_text"
								          placeholder="<?php esc_html_e( 'The text before bundled products', 'woosb' ); ?>"><?php echo stripslashes( get_post_meta( $post_id, 'woosb_before_text', true ) ); ?></textarea>
							</div>
						</td>
					</tr>
					<tr class="woosb_tr_space">
						<th><?php esc_html_e( 'After text', 'woosb' ); ?></th>
						<td>
							<div class="w100">
								<textarea name="woosb_after_text"
								          placeholder="<?php esc_html_e( 'The text after bundled products', 'woosb' ); ?>"><?php echo stripslashes( get_post_meta( $post_id, 'woosb_after_text', true ) ); ?></textarea>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<?php
		}

		function woosb_save_option_field( $post_id ) {
			if ( isset( $_POST['woosb_ids'] ) ) {
				update_post_meta( $post_id, 'woosb_ids', self::woosb_clean_ids( $_POST['woosb_ids'] ) );
			}
			if ( isset( $_POST['woosb_disable_auto_price'] ) ) {
				update_post_meta( $post_id, 'woosb_disable_auto_price', 'on' );
			} else {
				update_post_meta( $post_id, 'woosb_disable_auto_price', 'off' );
			}
			if ( isset( $_POST['woosb_price_percent'] ) ) {
				update_post_meta( $post_id, 'woosb_price_percent', sanitize_text_field( $_POST['woosb_price_percent'] ) );
			}
			if ( isset( $_POST['woosb_before_text'] ) && ( $_POST['woosb_before_text'] != '' ) ) {
				update_post_meta( $post_id, 'woosb_before_text', addslashes( $_POST['woosb_before_text'] ) );
			} else {
				delete_post_meta( $post_id, 'woosb_before_text' );
			}
			if ( isset( $_POST['woosb_after_text'] ) && ( $_POST['woosb_after_text'] != '' ) ) {
				update_post_meta( $post_id, 'woosb_after_text', addslashes( $_POST['woosb_after_text'] ) );
			} else {
				delete_post_meta( $post_id, 'woosb_after_text' );
			}
		}

		function woosb_add_to_cart_form() {
			global $product;
			if ( $product->has_variables() ) {
				wp_enqueue_script( 'wc-add-to-cart-variation' );
			}
			self::woosb_show_items();
			wc_get_template( 'single-product/add-to-cart/simple.php' );
		}

		function woosb_add_to_cart_button() {
			global $product;
			if ( $product->is_type( 'woosb' ) ) {
				echo '<input name="woosb_ids" id="woosb_ids" type="hidden" value="' . get_post_meta( $product->get_id(), 'woosb_ids', true ) . '"/>';
			}
		}

		function woosb_loop_add_to_cart_link( $link, $product ) {
			if ( $product->is_type( 'woosb' ) && $product->has_variables() ) {
				$link = str_replace( 'ajax_add_to_cart', '', $link );
			}

			return $link;
		}

		function woosb_before_calculate_totals( $cart_object ) {
			//  This is necessary for WC 3.0+
			if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
				return;
			}

			foreach ( $cart_object->cart_contents as $cart_item_key => $cart_item ) {
				// child product price
				if ( isset( $cart_item['woosb_parent_id'] ) && ( $cart_item['woosb_parent_id'] != '' ) ) {
					$cart_item['data']->set_price( 0 );
				}
				// main product price
				if ( isset( $cart_item['woosb_ids'] ) && ( $cart_item['woosb_ids'] != '' ) ) {
					$woosb_items = explode( ',', $cart_item['woosb_ids'] );
					$product_id  = $cart_item['product_id'];
					$woosb_price = 0;
					if ( get_post_meta( $product_id, 'woosb_disable_auto_price', true ) != 'on' ) {
						if ( is_array( $woosb_items ) && count( $woosb_items ) > 0 ) {
							foreach ( $woosb_items as $woosb_item ) {
								$woosb_item_arr     = explode( '/', $woosb_item );
								$woosb_item_id      = absint( $woosb_item_arr[0] ? $woosb_item_arr[0] : 0 );
								$woosb_item_qty     = absint( $woosb_item_arr[1] ? $woosb_item_arr[1] : 1 );
								$woosb_item_product = wc_get_product( $woosb_item_id );
								if ( ! $woosb_item_product || $woosb_item_product->is_type( 'woosb' ) ) {
									continue;
								}
								$woosb_price += $woosb_item_product->get_price() * $woosb_item_qty;
							}
						}
					} else {
						$woosb_price = get_post_meta( $product_id, '_regular_price', true );
					}
					if ( ( $woosb_price_percent = get_post_meta( $product_id, 'woosb_price_percent', true ) ) && is_numeric( $woosb_price_percent ) && ( intval( $woosb_price_percent ) < 100 ) && ( intval( $woosb_price_percent ) > 0 ) ) {
						$woosb_price = intval( $woosb_price_percent ) * $woosb_price / 100;
					} elseif ( ( $woosb_sale_price = get_post_meta( $product_id, '_sale_price', true ) ) != '' ) {
						$woosb_price = $woosb_sale_price;
					}
					$cart_item['data']->set_price( floatval( $woosb_price ) );
				}
			}
		}

		function woosb_cart_shipping_packages( $packages ) {
			if ( ! empty( $packages ) ) {
				foreach ( $packages as $package_key => $package ) {
					if ( ! empty( $package['contents'] ) ) {
						foreach ( $package['contents'] as $cart_item_key => $cart_item ) {
							if ( isset( $cart_item['woosb_parent_id'] ) && ( $cart_item['woosb_parent_id'] != '' ) ) {
								unset( $packages[ $package_key ]['contents'][ $cart_item_key ] );
							}
						}
					}
				}
			}

			return $packages;
		}

		function woosb_show_items() {
			global $product;
			$woosb_count = 0;
			$product_id  = $product->get_id();
			if ( $woosb_items = $product->get_items() ) {
				echo '<div id="woosb_wrap" class="woosb-wrap">';
				if ( $woosb_before_text = apply_filters( 'woosb_before_text', get_post_meta( $product_id, 'woosb_before_text', true ), $product_id ) ) {
					echo '<div id="woosb_before_text" class="woosb-before-text woosb-text">' . do_shortcode( stripslashes( $woosb_before_text ) ) . '</div>';
				}
				do_action( 'woosb_before_table', $product );
				?>
				<table id="woosb_products" cellspacing="0" class="woosb-table woosb-products"
				       data-percent="<?php echo esc_attr( get_post_meta( $product_id, 'woosb_price_percent', true ) ); ?>"
				       data-regular="<?php echo esc_attr( get_post_meta( $product_id, '_regular_price', true ) ); ?>"
				       data-sale="<?php echo esc_attr( get_post_meta( $product_id, '_sale_price', true ) ); ?>"
				       data-variables="<?php echo( $product->has_variables() ? 'yes' : 'no' ); ?>">
					<tbody>
					<?php foreach ( $woosb_items as $woosb_item ) {
						$woosb_product = wc_get_product( $woosb_item['id'] );
						if ( ! $woosb_product || ( $woosb_count > 2 ) ) {
							continue;
						}
						?>
						<tr class="woosb-product"
						    data-id="<?php echo esc_attr( $woosb_product->is_type( 'variable' ) ? 0 : $woosb_item['id'] ); ?>"
						    data-price="<?php echo esc_attr( $woosb_product->get_price() ); ?>"
						    data-qty="<?php echo esc_attr( $woosb_item['qty'] ); ?>">
							<?php if ( get_option( '_woosb_bundled_thumb', 'yes' ) != 'no' ) { ?>
								<td class="woosb-thumb">
									<div class="woosb-thumb-ori">
										<?php echo apply_filters( 'woosb_item_thumbnail', get_the_post_thumbnail( $woosb_item['id'], array(
											40,
											40
										) ), $woosb_product ); ?>
									</div>
									<div class="woosb-thumb-new"></div>
								</td>
							<?php } ?>
							<td class="woosb-title">
								<?php
								do_action( 'woosb_before_item_name', $woosb_product );
								echo '<div class="woosb-title-inner">';
								if ( get_option( '_woosb_bundled_qty', 'yes' ) == 'yes' ) {
									echo apply_filters( 'woosb_item_qty', $woosb_item['qty'] . ' × ', $woosb_item['qty'], $woosb_product );
								}
								if ( $woosb_product->is_in_stock() ) {
									$woosb_item_name = '<a href="' . get_permalink( $woosb_item['id'] ) . '">' . $woosb_product->get_name() . '</a>';
								} else {
									$woosb_item_name = '<a href="' . get_permalink( $woosb_item['id'] ) . '"><s>' . $woosb_product->get_name() . '</s></a>';
								}
								echo apply_filters( 'woosb_item_name', $woosb_item_name, $woosb_product );
								echo '</div>';
								do_action( 'woosb_after_item_name', $woosb_product );
								if ( get_option( '_woosb_bundled_description', 'no' ) == 'yes' ) {
									echo '<div class="woosb-description">' . apply_filters( 'woosb_item_description', $woosb_product->get_description(), $woosb_product ) . '</div>';
								}
								if ( $woosb_product->is_type( 'variable' ) ) {
									$attributes           = $woosb_product->get_variation_attributes();
									$available_variations = $woosb_product->get_available_variations();
									if ( is_array( $attributes ) && ( count( $attributes ) > 0 ) ) {
										echo '<form class="variations_form cart" data-product_id="' . absint( $woosb_product->get_id() ) . '" data-product_variations="' . htmlspecialchars( wp_json_encode( $available_variations ) ) . '">';
										echo '<div class="variations">';
										foreach ( $attributes as $attribute_name => $options ) { ?>
											<div class="variation">
												<div
													class="label"><?php echo wc_attribute_label( $attribute_name ); ?></div>
												<div class="select">
													<?php
													$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $woosb_product->get_variation_default_attribute( $attribute_name );
													wc_dropdown_variation_attribute_options( array(
														'options'   => $options,
														'attribute' => $attribute_name,
														'product'   => $woosb_product,
														'selected'  => $selected
													) );
													?>
												</div>
											</div>
										<?php }
										echo '<div class="reset">' . apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woosb' ) . '</a>' ) . '</div>';
										echo '</div>';
										echo '</form>';
										if ( get_option( '_woosb_bundled_description', 'no' ) == 'yes' ) {
											echo '<div class="woosb-variation-description"></div>';
										}
									}
									do_action( 'woosb_after_item_variations', $woosb_product );
								}
								?>
							</td>
							<?php if ( get_option( '_woosb_bundled_price', 'html' ) != 'no' ) { ?>
								<td class="woosb-price">
									<div class="woosb-price-ori">
										<?php
										$woosb_price = '';
										switch ( get_option( '_woosb_bundled_price', 'html' ) ) {
											case 'price':
												$woosb_price = wc_price( $woosb_product->get_price() );
												break;
											case 'html':
												$woosb_price = $woosb_product->get_price_html();
												break;
											case 'subtotal':
												$woosb_price = wc_price( $woosb_product->get_price() * $woosb_item['qty'] );
												break;
										}
										echo apply_filters( 'woosb_item_price', $woosb_price, $woosb_product );
										?>
									</div>
									<div class="woosb-price-new"></div>
								</td>
							<?php } ?>
						</tr>
						<?php
						$woosb_count ++;
					} ?>
					</tbody>
				</table>
				<div id="woosb_total" class="woosb-total woosb-text"></div>
				<?php
				do_action( 'woosb_after_table', $product );
				if ( $woosb_after_text = apply_filters( 'woosb_after_text', get_post_meta( $product_id, 'woosb_after_text', true ), $product_id ) ) {
					echo '<div id="woosb_after_text" class="woosb-after-text woosb-text">' . do_shortcode( stripslashes( $woosb_after_text ) ) . '</div>';
				}
				echo '</div>';
			}
		}

		function woosb_clean_ids( $ids ) {
			$ids = preg_replace( '/[^,\/0-9]/', '', $ids );

			return $ids;
		}
	}

	new WPcleverWoosb();
}