<?php
//--------------------------------------
// SHORTCODE: LINE HORIZONTAL
//--------------------------------------

function HR($atts){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => null,
    "type"   => ''
  ), $atts));
  $output = '<hr class="bc-hr ' . $type . ' ' . $class . '">';
  return $output;
}
add_shortcode("hr", "HR");

?>