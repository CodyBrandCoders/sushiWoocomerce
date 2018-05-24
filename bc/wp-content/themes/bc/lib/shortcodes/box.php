<?php
//--------------------------------------
// SHORTCODE: BOX
//--------------------------------------

function BC_Box($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => null,
    "style"   => null,
    "title"   => '',
  ), $atts));
  $class = $class ? ' ' . $class : '';
  $style = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-box' . $class . '"' . $style . '>';
  $output .= '<h3 class="mbn">' . $title . '</h3>';
  $output .= '<div class="content">';
  $output .= do_shortcode($content);
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_box", "BC_Box");

?>