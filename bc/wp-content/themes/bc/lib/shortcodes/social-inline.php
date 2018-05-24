<?php
//--------------------------------------
// SHORTCODE: SOCIAL INLINE
//--------------------------------------

function Social_Inline($atts, $content = null){
  extract(shortcode_atts(array(
    "class" => null,
    "style" => null,
  ), $atts));
  global $social_array;
  $style = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-social-inline ' . $class . '"' . $style . '>';
  foreach($social_array as $key=>$value) :
    if($value){
      $output .= '<a href="' . $value . '" target="_blank">';
      $output .= '<i class="fab fa-' . $key . '"></i>';
      $output .= '</a>';
    }
  endforeach;
  $output .= '</div>';
  return $output;
}
add_shortcode("social_inline", "Social_Inline");

?>