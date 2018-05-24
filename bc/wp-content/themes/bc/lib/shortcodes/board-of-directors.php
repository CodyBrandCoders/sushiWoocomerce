<?php
//--------------------------------------
// SHORTCODE: BOARD OF DIRECTORS
//--------------------------------------

function Board_Of_Directors_Loop($atts, $content = null){
  extract(shortcode_atts(array(
  ), $atts));
  $output = '';
  $args = array (
  'orderby'                => 'menu_order',
  'order'                  => 'ASC',
  'post_type'              => 'board_of_director',
  'post_status'            => 'publish',
  'posts_per_page'         => -1,
  );
  $output = '';
  $query = new WP_Query( $args );
  if($query->have_posts()) :
    $output .= '<div class="block-grid block-grid-slide block-grid-xxs-2 block-grid-xs-3 block-grid-sm-3 block-grid-md-5 block-grid-lg-6 board-of-directors-grid">';
    while ($query->have_posts()) : $query->the_post();
      $output .= '<div class="block-grid-item">';
      $output .= '<div class="col-inner">';
      $output .= '<img class="img-responsive mbm m-mbn" src="' .  get_field('photo') . '" alt="' . get_the_title()  . '">';
      $output .= '<div class="hidden-mobile">';
      $output .= '<h4 class="text-color-1 mbn">' . get_the_title() . '</h4>';
      $output .= '<p class="mbxs title roboto-condensed" style="font-weight: bold; font-size: 16px; color: #222;">' . get_field('position') .'</p>';
      $output .= '<div class="color-2-line mtxs mbxs zero-auto"></div>';
      $output .= '<p class="company mbxl">' . get_field('company') . '</p>';
      $output .= '</div>';
      $output .= '<div class="visible-mobile mbl">';
      $output .= '<h5 class="text-white mbxs">' . get_the_title() . '</h5>';
      if(get_field('position')) :
        $output .= '<p class="text-color-3 mbn">' . get_field('position') .'</p>';
      endif;
      if(get_field('company')) :
        $output .= '<p class="text-color-2 mbn"><small>' . get_field('company') . '</small></p>';
      endif;
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    endwhile;
    $output .= '</div>';
  endif;
  return $output;
}
add_shortcode("board_of_directors_loop", "Board_Of_Directors_Loop");

?>