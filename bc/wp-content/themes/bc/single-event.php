<?php
 // Single Event Page
?>

<?php get_header(); ?>
<?php
  // Featured Image
  $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
  // Start & End DateTime
  $sdate = new DateTime(get_field('start_date'));
  $start_date = $sdate->format('M d, Y');
  $stime = new DateTime(get_field('start_time'));
  $start_time = $stime->format('g:i A');
  $edate = new DateTime(get_field('end_date'));
  $end_date = $edate->format('M d, Y');
  $etime = new DateTime(get_field('end_time'));
  $end_time = $etime->format('g:i A');
  // Admission Price & Title
  $price = get_field('price');
  $price_description = get_field('price_description');
  // Custom Butttons Links & Text
  $button_1_text = get_field('button_one_text');
  $button_1_link = get_field('button_one_link');
  $button_2_text = get_field('button_two_text');
  $button_2_link = get_field('button_two_link');
  // Event Gallery
  $event_gallery = get_field('event_gallery');
  // Event Location
  $street_address = get_field('street_address');
  $city = get_field('city');
  $state = get_field('state');
  $zip = get_field('zip');
  $location_name = get_field('location_name');
  // Global
  $permalink = get_the_permalink();
  $title = get_the_title();
  $full_address = $street_address . $city . $state . $zip;
  $directions_href = 'http://maps.google.com/maps/place/' . ($street_address . ', ' . $city . ', ' . $state . ', ' . $zip);
?>
<?php
 echo build_event_schema($post->ID);
?>

<?php
  $iso_start = new DateTime( $start_date . ' ' . $start_time );
  $iso_end = new DateTime( $end_date . ' ' . $end_time );
  echo do_shortcode('[page_banner title="' . get_the_title() . '" class="bg-color-2"]');
?>

<section class="section single-event-details no-stack-fix">
	<div class="container">
		<div class="row">

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="event-float">
          <img src="<?php echo $image[0]; ?>" class="img-responsive"/>
          <?php
            if( $event_gallery ) :
              echo '<div class="mtm page-gallery block-grid block-grid-gutter-none block-grid-xxs-2 block-grid-xs-2 block-grid-sm-4 block-grid-md-4 block-grid-lg-4">';
              foreach( $event_gallery as $event_image ) :
                echo '<div class="block-grid-item">';
                echo '<a href="' . $event_image['url'] . '" data-lightbox="services-photo" data-title="Review Us On Manta">';
                echo '<img class="img-responsive" src="' . $event_image['url'] . '">';
                echo '</a>';
                echo '</div>';
              endforeach;
              echo '</div>';
            endif;
          ?>
        </div>
        <h1 class="text-color-1 h2 mbn lh1"><?php echo $title; ?></h1>
        <div class="time-address">
          <?php if($start_date == $end_date ): ?>
            <h4 class="text-color-2 mbn"><?php echo $start_date . ' @ ' . $start_time; ?> - <?php echo $end_time; ?></h4>
          <?php else: ?>
            <h4 class="text-color-2 mbn"><?php echo $start_date . ' @ ' . $start_time; ?> - <?php echo $end_date . ' @ ' . $end_time; ?></h4>
          <?php endif; ?>
        </div>

        <?php if ($location_name != '') : ?>
          <h5 class="mtxs mbn"><a class="link-blend" href="<?php echo $directions_href;?>" target="_blank"><i><?php echo $location_name; ?> - <?php echo $street_address; ?> <?php echo $city;?>, <?php echo $state;?>. <?php echo $zip;?></i></a></h5>
        <?php endif; ?>

        <?php if ($price != '') : ?>
          <h5 class="text-color-1 mbn"><?php echo $price_description; ?> - <?php echo $price; ?></h5>
        <?php endif; ?>


        <div class="mtm">
          <?php echo do_shortcode(get_the_content()); ?>
        </div>


        <?php if($button_1_text || $button_2_text) : ?>
            <div class="mts mbm">
              <?php if($button_1_text): ?>
                <a target="_blank" href="<?php echo $button_1_link; ?>" class="btn btn-sm btn-color-2-ghost"><?php echo $button_1_text; ?> <i class="fa fa-angle-double-right"></i></a>
              <?php endif; ?>
              <?php if($button_2_text): ?>
                <a target="_blank" href="<?php echo $button_2_link; ?>" class="btn btn-sm btn-color-2-ghost mlm m-mln m-mtm"><?php echo $button_2_text; ?> <i class="fa fa-angle-double-right"></i></a>
              <?php endif; ?>
            </div>
        <?php endif; ?>

        <h4 class="mb5 mt20">Share This Event</h4>
        <?php echo do_shortcode('[share_links size="md"]'); ?>

      </div>

      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 visible-mobile">
        <img src="<?php echo $image[0]; ?>" class="img-responsive"/>
        <?php
          if( $event_gallery ) :
            echo '<div class="mtm page-gallery block-grid block-grid-gutter-none block-grid-xxs-4 block-grid-xs-4 block-grid-sm-4 block-grid-md-4 block-grid-lg-4">';
            foreach( $event_gallery as $event_image ) :
              echo '<div class="block-grid-item">';
              echo '<a href="' . $event_image['url'] . '" data-lightbox="services-photo" data-title="Review Us On Manta">';
              echo '<img class="img-responsive" src="' . $event_image['url'] . '">';
              echo '</a>';
              echo '</div>';
            endforeach;
            echo '</div>';
          endif;
        ?>
      </div>


    </div>
  </div>
</section>

<section class="section-event-map">
    <?php echo '<iframe src="https://www.google.com/maps?q=' . str_replace(' ', '', $full_address) . '&output=embed" width="' . '100%' . '"></iframe>'; ?>
</section>

<?php get_footer(); ?>
