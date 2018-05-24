<?php
//--------------------------------------
// SHORTCODE: ICON LIST
//--------------------------------------

function IconList($atts, $content = null){
  extract(shortcode_atts(array(
      "class"   => null,
      "style"   => null
  ), $atts));
  $classes = $class ? $class : '';
  $styles = $style ? 'style="'.$style.'"' : '';
  $output = '<ul class="fa-ul icon-list ' . $classes . '" ' . $styles . '>';
  $output .= do_shortcode($content);
  $output .= '</ul>';
  return $output;
}
add_shortcode("icon_list", "IconList");

?>