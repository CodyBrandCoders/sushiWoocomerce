<?php
//--------------------------------------
// SHORTCODE: TAB PANEL GROUP
//--------------------------------------

function BC_Panel($atts, $content = null){
  extract(shortcode_atts(array(
    "controlled_by"  => '',
    "active"    => false
  ), $atts));
  $style = $active ? 'class="bc-panel panel-active"' : 'class="bc-panel" style="display: none"';
  $output = '<div ' . $style . ' data-tab="' . $controlled_by . '">';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_panel", "BC_Panel");

?>