<?php
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

$id = $_GET["id"];
$modal = $_GET["modal"];

$staff_post = get_post($id);
if(!$modal) :
  echo '<div class="row">';
  echo '<div class="col-xs-12 col-sm-6 col-md-offset-0 col-md-5 col-lg-5 pln">';
  echo '<div class="col-inner-img">';
  echo '<img src="' . get_field('photo', $staff_post->ID) . '" class="img-responsive" />';
  echo '</div>';
  echo '</div>';
  echo '<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">';
  echo '<div class="col-inner-content">';
  echo '<h2 class="h1 staff-name mbxs text-white">' . $staff_post->post_title . '</h2>';
  echo '<p class="location mbn text-white">' . get_field('location', $staff_post->ID) .  '</p>';
  echo '<p class="position text-white">' . get_field('title', $staff_post->ID) . '</p>';
  if(get_field('phone', $staff_post->ID) || get_field('email', $staff_post->ID)):
    echo '<p class="contact"><a href="tel:+1' . sanatize_phone(get_field('phone', $staff_post->ID)) . '"><i class="fa fa-phone"></i> ' . get_field('phone', $staff_post->ID) . get_field('extension', $staff_post->ID) . '</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:' . get_field('email', $staff_post->ID) .'"><i class="fa fa-envelope"></i> ' . get_field('email', $staff_post->ID) .  '</a></p>';
  endif;
  echo '<p class="excerpt text-white">' . get_field('excerpt', $staff_post->ID) . '</p>';
  if(get_field('contact_about', $staff_post->ID)) :
    echo '<p class="text-white"><i>Contact About: ' . get_field('contact_about', $staff_post->ID) . '</i></p>';
  endif;
  echo '<div class="links">';
  if(get_field('read_more', $staff_post->ID)) :
    echo '<a class="btn btn-md btn-color-2" href="' . get_the_permalink($staff_post->ID)  . '">Read More <i class="fa fa-angle-double-right"></i></a>';
  endif;
  echo '</div>';
  echo '</div>';
  echo '</div>';
  echo '</div>';
endif;

if($modal) :
  echo '<div class="modal-content">';
  echo '<div class="modal-body text-white">';
  echo '<img src="' . get_field('photo', $staff_post->ID) . '" class="img-responsive" />';
  echo '<h3 class="title mbxs text-white">' . $staff_post->post_title . '</h3>';
  echo '<p class="mbn text-white" style="line-height: 1;"><small><i>' . get_field('title', $staff_post->ID) . '</i></p>';
  echo '<p class="mbn" style="line-height: 1;"><i>' . get_field('location', $staff_post->ID) . '</i></small></p>';
  echo '<div class="white-line zero-auto mtm mbm"></div>';
  echo get_field('excerpt', $staff_post->ID);
  echo '<div class="modal-links mtxl">';
  if(get_field('read_more', $staff_post->ID)) :
  echo '<div class="block-grid-xxs-2 block-grid-xs-2 block-grid-sm-2 block-grid-md-2 block-grid-lg-2">';
  echo '<div class="block-grid-item">';
  echo '<a href="' . get_the_permalink($staff_post->ID) .'" class="close btn btn-color-1 btn-sm">More</a>';
  echo '</div>';
  echo '<div class="block-grid-item">';
  echo '<button type="button" class="close btn btn-color-1 btn-sm" data-dismiss="modal" aria-label="Close">Close</button>';
  echo '</div>';
  echo '</div>';
  else:
  echo '<button type="button" class="close btn btn-color-1 btn-sm" data-dismiss="modal" aria-label="Close">Close</button>';
  endif;
  echo '</div>';
  echo '</div>';
  echo '</div>';
endif;
 ?>
