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
					<section>
						<?php echo do_shortcode( '[product_category category="bookable"]' ); ?>
					</section>
					<h3>Add-Ons</h3>
					<section>
						<div class="col-lg-10">
							<?php echo do_shortcode( '[product_category category="addon"]' ); ?>
						</div>
						<div class="col-lg-2">
							<a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?> - <?php echo WC()->cart->get_cart_total(); ?></a>
							<a class="button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>?empty-cart"><?php _e( 'Empty Cart', 'woocommerce' ); ?></a>
							<?php echo do_shortcode('[woocommerce_cart]');?>
						</div>
					</section>
					<h3>Event Information</h3>
					<section>
						<?php echo do_shortcode( '[product_page id="2951"]' ); ?>
					</section>
					<h3>Payment Information</h3>
					<section>
						<p>The next and previous buttons help you to navigate through your content.</p>
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
						autoFocus: true
					});
				</script>

		</div>
	</div>
</section>
<?php echo do_shortcode('[text-blocks id="bottom-cta"]'); ?>


<?php get_footer(); ?>