<?php
//--------------------------------------
// SHORTCODE: TAB ITEM
//--------------------------------------

function BC_Tab_Item($atts, $content = null){
  extract(shortcode_atts(array(
    "controls"  => '',
    "text"      => '',
    "active"    => false
  ), $atts));
  $classes = $active ? 'bc-tab tab-active' : 'bc-tab';
  $output = '<a href="#" data-toggle="' . $controls . '" class="' . $classes . '">' . $text . '</a>';
  return $output;
}
add_shortcode("bc_tab_item", "BC_Tab_Item");

?>