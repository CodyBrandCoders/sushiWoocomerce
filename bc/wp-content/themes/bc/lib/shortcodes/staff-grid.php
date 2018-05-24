<?php
//------------------------------
// SHORTCODE: STAFF GRID
//------------------------------

function BC_Staff_Grid($atts, $content = null){
  extract(shortcode_atts(array(
  ), $atts));
  $output = '';
  $args = array (
  'orderby'                => 'menu_order',
  'order'                  => 'ASC',
  'post_type'              => 'staff',
  'post_status'            => 'publish',
  'posts_per_page'         => -1,
  );
  $output = '';
  $query = new WP_Query( $args );
  // Desktop Version
  if(!wp_is_mobile()):
    if($query->have_posts()) :
      $output = '<div class="bc-staff-grid clearfix">';
      $counter = 1;
      while ($query->have_posts()) : $query->the_post();
        $output .= '<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-thumbnail">';
        $output .= '<div class="col-inner">';
        $output .= '<a href="#" class="staff-toggle" data-staff-id="' . get_the_ID() . '">';
        $output .= '<img src="' . get_field('photo') . '" class="img-responsive" alt="' . get_the_title($post->ID)  . '"/>';
        $output .= '<div class="staff-overlay">';
        $output .= '<p class="name mbn">' . get_the_title($post->ID) . '</p>';
        $output .= '<p class="title mbn">' . get_field('title', $post->ID) .  '</p>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= $counter % 4 == 0 || (($counter % 4 != 0) && (($query->current_post +1) == ($query->post_count)) ) ? '<div class="col-xs-12 ajax-staff-data" style="display: none;"></div>' : '';
        $counter++;
      endwhile;
      $output .= '</div>';
    endif;
  endif;
  //Mobile Version
  if(1 == 1):
    if($query->have_posts()) :
      $output .= '<div class="bc-staff-grid-mobile block-grid-xxs-2 block-grid-xs-2 block-grid-sm-2 block-grid-md-2 block-grid-lg-2">';
      while ($query->have_posts()) : $query->the_post();
        $output .= '<div class="block-grid-item">';
        $output .= '<div class="col-inner">';
        $output .= '<a href="#" class="ilb staff-modal-toggle" data-toggle="modal" data-target="#staffModal" data-staff-id="' . get_the_ID() . '">';
        $output .= '<img src="' . get_field('photo') . '" class="img-responsive" alt="' . get_the_title()  . '" />';
        $output .= '<div class="content">';
        $output .= '<p class="staff-name mbxs text-white">' . get_the_title() . '</p>';
        $output .= '<p class="mbn text-white position">' . get_field('title') . '</p>';
        $output .= '</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
      endwhile;
      $output .= '</div>';
      $output .= '<div class="modal fade" id="staffModal" tabindex="-1" role="dialog">';
      $output .= '<div class="modal-dialog" role="document">';
      $output .= '</div>';
      $output .= '</div>';
    endif;
  endif;
  return $output;
}
add_shortcode("bc_staff_gric", "BC_Staff_Grid");

?>