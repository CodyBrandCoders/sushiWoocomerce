<?php
//------------------------------
// SHORTCODE: SLIDER CONTENT
//------------------------------

function Slide($atts, $content = null){
  extract(shortcode_atts(array(
    "container"    => false,
    "background"    => false,
    "row"          => false,
    "style"        => false,
    "class"        => false,
  ), $atts));
  $background = $background ? ' style="background-image: url(\'' . $background . '\');'. $style . '"' : ' style="' . $style . '"';
  $class = $class ? ' class="' . $class . '"' : '';
  $output = '<div' . $class . $background . '>';
  if($container) : $output .= '<div class="container">'; endif;
  if($row) : $output .= '<div class="row">'; endif;
  $output .= do_shortcode($content);
  if($row) : $output .= '</div>'; endif;
  if($container) : $output .= '</div>'; endif;
  $output .= '</div>';
  return $output;
}
add_shortcode("slide", "Slide");

function Navbar_Search($atts, $content = null){
  extract(shortcode_atts(array(

  ), $atts));
  $output = '<a href="#" class="primary-nav-search-toggle"><i class="fa fa-search"></i></a>';
  $output .= '<div class="primary-nav-search-form" style="display: none">';
  $output .= '<form style="" role="search" method="get" id="searchform" class="navbar-search-form" action="' . get_home_url() .'" _lpchecked="1"><p class="text-white mbs">Search Keyword or Phrase</p><input type="text" value="" name="s" id="s"><button type="submit" id="searchsubmit"><i class="fa fa fa-search"></i></button></form>';
  $output .= '</div>';
  return $output;
}
add_shortcode("navbar_search", "Navbar_Search");

?>