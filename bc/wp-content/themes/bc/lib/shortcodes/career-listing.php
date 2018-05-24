<?php
//------------------------------
// SHORTCODE: CAREER LISTING
//------------------------------

function Career_Listing(){
  extract(shortcode_atts(array(
    "class" => null,
    "style" => null,
  ), $atts));
  if( have_rows('career_listing', $post->ID) ):
    $count = 1;   
    $output .= '[block_grid xxs="1" xs="1" sm="3" md="3" lg="3" animate="all-pop"]';
  while ( have_rows('career_listing', $post->ID) ) : the_row();
      $title = get_sub_field('title' , false, false);
      $description = get_sub_field('description' , false, false);
      $output .= '[block_grid_item]';
      $output .= '<div class="available-position m-mb10 ' . $class . '" style="' . $style . '">';
      $output .= '<h3 class="mbs">' . $title . '</h3>';
      $output .= '<p><strong>Description:</strong></p>';
      $output .= '<p>' . $description . '</p>';
      $output .= '[bc_btn href="/contact/careers/#application" class="btn-color-1 mtxs" size="sm" icon_after="fa-angle-right"]Apply Now[/bc_btn]';
      $output .= '</div>';
      $output .= '[/block_grid_item]';
      $count++;
    endwhile;  
    $output .= '[/block_grid]'; 
  endif;   
  return do_shortcode($output);
  }
add_shortcode("career_listing", "Career_Listing");

?>