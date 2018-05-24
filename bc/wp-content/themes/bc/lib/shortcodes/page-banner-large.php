<?php
//------------------------------
// SHORTCODE: PAGE BANNER LARGE
//------------------------------

function Page_Banner_Large($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null,
      "title"       => '',
      "sub_title"   => null,
      "button_text" => null,
      "button_link" => null
  ), $atts));
  $id = $id ? 'id="' . $id . '"' : '';
  if($parallax){
    $parallax_data = ' data-parallax="scroll" data-image-src="' . $background . '"';
    $background = NULL;
  }
  $background = $background ? 'style="background-image: url(' . $background . ');' . $style .'"'  : 'style="' . $style . '"';
  $output = '<div ' . $id . ' class="page-banner-large nav-clear-point ' . $class . '" ' . $background . ' ' . $parallax_data . '>';
  $output .= '<div class="container">';
  $output .= '<div class="row">';
  $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
  $output .= '<h1 class="mbn text-white">' . $title . '</h1>';
  if($sub_title){
    $output .= '<h2 class="text-white">' . $sub_title . '</h2>';
  }
  if($button_link && $button_text){
    $output .= '<a href="' . $button_link . '" class="btn btn-lg btn-color-1">' . $button_text . ' <i class="fa fa-angle-double-right"></i></a>';
  }
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner_large", "Page_Banner_Large");

?>