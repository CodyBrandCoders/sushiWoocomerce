<?php
//------------------------------
// SHORTCODE: SLIDER
//------------------------------

function BC_Slider($atts, $content = null){
  extract(shortcode_atts(array(
    "style"        =>  false,
    "class"        =>  false,
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $class = $class ? ' ' . $class : '';
  $output = '<div class="bc-slideshow' . $class . '"' . $style . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_slider", "BC_Slider");

?>