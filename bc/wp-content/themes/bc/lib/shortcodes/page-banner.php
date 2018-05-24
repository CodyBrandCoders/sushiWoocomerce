<?php
//------------------------------
// SHORTCODE: PAGE BANNER
//------------------------------

function Page_Banner($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null,
      // "parallax"    => NULL,
      "title"       => ''
  ), $atts));
  $output = '<div class="page-banner nav-clear-point ';
  if($class){
    $output .= $class . '"';
  }else{
    $output .= '"';
  }
  if($parallax){
    $parallax_data = ' data-parallax="scroll" data-image-src="' . $background . '"';
    $background = NULL;
  }
  if($background && $style){
    $output .= ' style="background-image: url(\'' . $background  . '\');' . $style . '"';
  }else if($background && !$style){
    $output .= ' style="background-image: url(\'' . $background  . '\');"';
  }else if(!$background && $style){
    $output .= ' style="' . $style . '"';
  }
  $output .= '' . $parallax_data .  '>';
  $output .= '<div class="container">';
  $output .= '<div class="row">';
  $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $output .= '<h1 class="mbn fw-700 font-size-32">' . $title . '</h1>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner", "Page_Banner");

?>