<?php

//  Template Name: Professional Service Template

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
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <?php
          /* Page Content */
          echo do_shortcode(get_the_content($post->ID));
        ?>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="mb30 hidden-mobile">
          <?php echo do_shortcode('[address_loop]'); ?>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="1221" title="Sidebar Contact Form"]'); ?>
      </div>

    </div>
  </div>
</section>
<?php echo do_shortcode('[text-blocks id="bottom-cta"]'); ?>


<?php get_footer(); ?>