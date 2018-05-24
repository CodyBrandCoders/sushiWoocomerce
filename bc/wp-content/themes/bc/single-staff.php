<?php

/*
* Default Single Staff Page Template
*/

?>

<?php get_header(); ?>

<?php
  $location = get_field('location');
  $title = get_field('title');
  $email = get_field('email');
  $phone = get_field('phone');
  $photo = get_field('photo');
  $name_array = explode(" ", get_the_title());
?>
<?php if(get_field('read_more')) : ?>
  <?php echo do_shortcode('[page_banner title="' . 'Staff' . '"]'); ?>
  <section class="section">
  	<div class="container">
  		<div class="row">

  			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          <img src="<?php echo $photo;?>" class="img-responsive" />
  			</div>

  			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

          <?php if($title) : ?>
            <h3 class="h2 text-color-1 mbn lh1">About <?php echo get_the_title(); ?></h3>
            <p class="mbm"><i class="text-color-2"><?php echo $title; ?></i></p>
          <?php else: ?>
            <h3 class="h2 text-color-1">About <?php echo get_the_title(); ?></h3>
          <?php endif; ?>

          <?php if($title) : ?>
            <p><i></i></p>
          <?php endif; ?>
          <?php
  					if ( have_posts() ) :
  						while (have_posts()) : the_post();
  					  the_content();
  					  endwhile;
  					endif;
  				?>
          <h3 class="text-color-1 mtm mbxs">Contact <?php echo $name_array[0]; ?></h3>
          <?php if($phone) : ?>
            <p class="mbn hidden-phone">Phone: <a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
            <p class="visible-phone"><a class="btn btn-sm btn-color-2" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
          <?php endif; ?>
          <?php if($email) : ?>
            <p class="hidden-phone">Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            <p class="visible-phone"><a class="btn btn-sm btn-color-2" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
          <?php endif; ?>
  			</div>

  		</div>
  	</div>
  </section>
<?php else: ?>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 text-center">
          <h1>Page Not Found</h1>
          <p>The page you are looking for might have been removed, had its name changes, or is temporarily unavailable.</p>
          <p><a href="#" onclick="window.history.go(-1)"><i class="fa fa-angle-double-left"></i> Back To Previous Page</a></p>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php get_footer(); ?>
