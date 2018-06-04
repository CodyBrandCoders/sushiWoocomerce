<?php

//  Template Name: Shop/Checkout Template

?>
<?php get_header(); ?>

<?php
// 1 Button //
	$buttons = get_field('buttons');
	$button_icon = get_field('1_button_icon');
	$button_text = get_field('1_button_text' , false, false);
	$button_link = get_field('1_button_link' , false, false);
	$button_tracking = get_field('1_button_tracking');
	$button_target = get_field('1_button_target');
// 2 Buttons //
	$button_1_icon = get_field('2_buttons_button_1_icon');
	$button_1_text = get_field('2_buttons_button_1_text' , false, false);
	$button_1_link = get_field('2_buttons_button_1_link' , false, false);
	$button_1_tracking = get_field('2_buttons_button_1_tracking');
	$button_1_target = get_field('2_buttons_button_1_target');
	$button_2_icon = get_field('2_buttons_button_2_icon');
	$button_2_text = get_field('2_buttons_button_2_text' , false, false);
	$button_2_link = get_field('2_buttons_button_2_link' , false, false);
	$button_2_tracking = get_field('2_buttons_button_2_tracking');
	$button_2_target = get_field('2_buttons_button_2_target');
	?>

<?php echo do_shortcode('[page_banner title="' . get_the_title($post->ID) . '"]'); ?>

<?php if ($buttons == '1') : ?>
<section class="mobile-top-cta">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php echo do_shortcode('[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_link .'" icon_before="' . $button_icon . '" tracking="' . $button_tracking . '" target="' . $button_target . '"]' . $button_text . '[/bc_btn]'); ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<?php if ($buttons == '2') : ?>
<section class="mobile-top-cta">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-inner">
					<?php echo do_shortcode('[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_1_link .'" icon_before="' . $button_1_icon . '" tracking="' . $button_1_tracking . '" target="' . $button_1_target . '"]' . $button_1_text . '[/bc_btn]'); ?>
				</div><!----><div class="col-inner">
					<?php echo do_shortcode('[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_2_link .'" icon_before="' . $button_2_icon . '" tracking="' . $button_2_tracking . '" target="' . $button_2_target . '"]' . $button_2_text . '[/bc_btn]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section">
	<div class="container">
		<div class="row">
			
				<div id="wizard">
					<h3>Select your package</h3>
					<section class="section section-package">
						<?php echo do_shortcode( '[product_category category="bookable"]' ); ?>

							<?php

							$args = array(
								'post_type' => 'product',
								'post_status' => 'publish',
								'tax_query' => array(
									array(
										'taxonomy'         => 'product_cat',
										'terms'            => 'bookable',
										'field'            => 'slug',
									)
								)
							);

							$query = new WP_Query( $args );

								// The Loop
							if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
							$query->the_post(); ?>


							<?php echo do_shortcode( '[product_page id="'. get_the_ID().'"]') ?>
							<?php }
							} else {
							// no posts found
							}

							// Restore original Post Data
							wp_reset_postdata(); ?>


					</section>
					<h3>Add-Ons</h3>
					<section class="section section-addons">
						<div class="col col-lg-9">
							<?php echo do_shortcode( '[product_category category="addon"]' ); ?>
							<a href="#" class="next-step">Continue</a>
						</div>
						<div class="col col-flex col-lg-3">
							<div class="cart-ajax-wrapper">
								<h2>My Sushi Experience</h2>
								<div class="inner-cart">
									<h3>Package: </h3>
									<span class="package-title"></span>
									<span class="package-price" data-id=""></span>

									<h3>Add-Ons: </h3>
									<div class="cart-addons">
										<?php
											global $woocommerce;
											$items = $woocommerce->cart->get_cart();

											foreach($items as $item => $values) { 
												$_product =  wc_get_product( $values['data']->get_id()); 
												$price = get_post_meta($values['product_id'] , '_price', true);
										
												echo '<div class="addon-item product-'. $_product->get_type() .'" data-id="'.$price.'">';
													echo '<a class="cart-remove-addon" href="#" data-id="' .$_product->id. '">X</a>';
													echo '<span class="package-title">'.$_product->get_title().'</span>';
													echo '<span class="package-price">$<span class="package-price-insert">'.$price.'</span></span>';
												echo '</div>';
											}   
										?>

										<?php //echo do_shortcode('[woocommerce_cart]'); ?>
									</div>
								</div>
								<div class="sushi-party-size">
									<span>Party Size: </span>
									<input class="sushi-value sushi-value-input" onClick="this.select();" type="number" name="pnumber" placeholder="0">
								</div>
								<h3 class="cart-subtotal">Subtotal: $<span class="sushie-value-total">0</span>.00</h3>
							</div>
						</div>
					</section>
					<h3>Event Information</h3>
					<section class="section section-package-details">
						<div class="col col-lg-9">
							<div class="product-ajax-wrapper"></div>

							<!-- THIS LOADS THE CORRECT JS FILES NEEDS TO BE HERE -->
							<div style="display:none"><?php echo do_shortcode( '[product_page id="2951"]') ?></div>
							<a href="#" class="next-step">Continue</a>
						</div>
						<div class="col col-flex col-lg-3">
							<div class="cart-ajax-wrapper">
								<h2>My Sushi Experience</h2>
								<div class="inner-cart">
									<h3>Package: </h3>
									<span class="package-title"></span>
									<span class="package-price" data-id=""></span>

									<h3>Add-Ons: </h3>
									<div class="cart-addons">
										<?php
											global $woocommerce;
											$items = $woocommerce->cart->get_cart();

											foreach($items as $item => $values) { 
												$_product =  wc_get_product( $values['data']->get_id()); 
												$price = get_post_meta($values['product_id'] , '_price', true);
										
												echo '<div class="addon-item product-'. $_product->get_type() .'" data-id="'.$price.'">';
													echo '<a class="cart-remove-addon" href="#" data-id="' .$_product->id. '">X</a>';
													echo '<span class="package-title">'.$_product->get_title().'</span>';
													echo '<span class="package-price">$<span class="package-price-insert">'.$price.'</span></span>';
												echo '</div>';
											}   
										?>

										<?php //echo do_shortcode('[woocommerce_cart]'); ?>
									</div>
								</div>
								<div class="sushi-party-size">
									<span>Party Size: </span>
									<input class="sushi-value sushi-value-input" onClick="this.select();" type="number" name="pnumber" placeholder="0">
								</div>
								<h3 class="cart-subtotal">Subtotal: $<span class="sushie-value-total">0</span>.00</h3>
							</div>
						</div>
					</section>
					<h3>Payment Information</h3>
					<section class="section section-payment">
						<div class="checkout-ajax-wrapper"><?php echo do_shortcode('[woocommerce_checkout]'); ?></div>

						
					</section>
					<h3>Complete Booking</h3>
					<section>
						<p>The next and previous buttons help you to navigate through your content.</p>
					</section>
				</div>

				<!-- SCRIPT OFR CART FLOW -->
				<script>
					jQuery("#wizard").steps({
						headerTag: "h3",
						bodyTag: "section",
						transitionEffect: "fade",
						enableAllSteps: false,
						transitionEffectSpeed: 800,
						enableContentCache: true,
						saveState: true
					});
				</script>

		</div>
	</div>
</section>
<?php echo do_shortcode('[text-blocks id="bottom-cta"]'); ?>


<?php get_footer(); ?>