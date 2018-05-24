<?php
//--------------------------------------
// SHORTCODE: TAB PANEL
//--------------------------------------

function BC_Tab_Panels($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => '',
    "style"   => false
  ), $atts));
  $styles = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="bc-tab-panels ' . $class . '"' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_tab_panels", "BC_Tab_Panels");

?>