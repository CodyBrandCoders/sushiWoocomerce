<?php
//--------------------------------------
// SHORTCODE: AFFIX NAV
//--------------------------------------

function AffixNav($atts){
  extract(shortcode_atts(array(
    "links"   => '',
    "offset"  => '',
    "class"   => '',
    "style"   => null
  ), $atts));
  $links = json_decode($links, true);
  $style = $style ? 'style="' . $style . '"' : '';
  if($links){
    $output = '<nav class="affix-page-nav ' . $class . '" data-bc-offset="' . $offset . '" ' . $style . '>';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
    foreach($links as $key=>$value) :
      $output .= '<a href="' . $key . '">' . $value . '</a>';
    endforeach;
  };
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</div>';
  $output .= '</nav>';
  return $output;
}
add_shortcode("affix_nav", "AffixNav");

?>