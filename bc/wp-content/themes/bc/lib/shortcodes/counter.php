<?php
//------------------------------
// SHORTCODE: COUNTER
//------------------------------

function BC_Counter($atts, $content = null){
  extract(shortcode_atts(array(
    "class" => null,
    "number" => null,
    "before" => null,
    "after"  => null
  ), $atts));
  $output .= '<div class="bc-counter ' . $class . '" data-number="' . $number . '">';
  if($before){
    $output .= $before . '<span></span>';
  }else if($after){
    $output .= '<span></span>' . $after;
  }else{
    $output .= '<span></span>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_counter", "BC_Counter");

?>