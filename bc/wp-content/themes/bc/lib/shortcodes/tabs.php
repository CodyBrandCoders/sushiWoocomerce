<?php
//--------------------------------------
// SHORTCODE: TABS
//--------------------------------------

function BC_Tabs($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => false
  ), $atts));
  $styles = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-tabs ' .$class . '"' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_tabs", "BC_Tabs");

?>