<?php

//	Template Name: Sub Page Template

?>
<?php get_header(); ?>

<?php
  $banner_title = get_field('banner_title') ? get_field('banner_title') : get_the_title();
  $banner_bg = get_field('banner_background');
  $page_content = get_field('page_content', false, false);
?>

<?php echo do_shortcode('[page_banner title="' . $banner_title . '" background="' . $banner_bg['url'] . '"]'); ?>

<section class="section">
  <div class="container">
    <div class="row">

      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <?php echo do_shortcode($page_content); ?>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <?php echo do_shortcode('[contact-form-7 id="1221" title="Sidebar Contact Form"]'); ?>
      </div>

    </div>
  </div>
</section>


<?php get_footer(); ?>
