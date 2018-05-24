<?php
//--------------------------------------
// SHORTCODE: RESTAURANT MENU
//--------------------------------------

function Menu_Output($atts, $content = null){
  extract(shortcode_atts(array(
  ), $atts));
  $margin_counter = 0;
  //USE THIS SHORTCODE TOGETHER WITH [Menu_Sub_Nav_Output]
  //Menu Sections, Descriptions, and Items
  if(have_rows('featured_menu')) :
    $output .= '<section class="section no-stack-fix">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    while(have_rows('featured_menu')) : the_row();
      $margin_top = ($margin_counter > 0) ? ' mt3xl' : '';
      $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
      $output .= '<div class="menu-title' . $margin_top . '" id="target' . sanitize_title_with_dashes(get_sub_field('menu_section')) . '"><h3 class="h1 mbn text-center">' . get_sub_field('menu_section') . '</h3></div>';
      $output .= '<div class="menu-section-description text-center text-italic mb30">' . get_sub_field('menu_section_description') . '</div>';
      $output .= '</div>';
      if(have_rows('menu_items')) :
        while(have_rows('menu_items')) : the_row();
          $output .= '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">';
          $output .= '<div class="menu-block">';
          $output .= '<h3>' . get_sub_field('item') . ' <span class="price">' . get_sub_field('price') . '</span></h3>';
          $output .= '<p>' . get_sub_field('description') .'</p>';
          $output .= '</div>';
          $output .= '</div>';
        endwhile;
      endif;
      $margin_counter++;
    endwhile;
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</section>';
  endif;
  return $output;
}
add_shortcode("menu_output", "Menu_Output");

function Menu_Sub_Nav_Output($atts, $content = null){
  extract(shortcode_atts(array(
  ), $atts));
  $margin_counter = 0;
  //USE THIS SHORTCODE TOGETHER WITH [Menu_Output]
  //Clickable Desktop-Only Menu Bar to complement [Menu_Output] shortcode
  if(have_rows('featured_menu')) :
    $output = '<nav class="affix-page-nav affix-top" data-bc-offset="255">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
    while(have_rows('featured_menu')) : the_row();
      $output .= '<a href="#target' . sanitize_title_with_dashes(get_sub_field('menu_section')) . '">' . get_sub_field('menu_section') . '</a>';
    endwhile;
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</nav>';
  endif;
  return $output;
}
add_shortcode("menu_sub_nav_output", "Menu_Sub_Nav_Output");

?>