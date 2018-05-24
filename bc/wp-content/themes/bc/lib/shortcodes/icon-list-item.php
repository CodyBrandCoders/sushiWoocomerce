<?php
//--------------------------------------
// SHORTCODE: ICON LIST ITEM
//--------------------------------------

function Li($atts, $content = null){
  extract(shortcode_atts(array(
    "icon"    => null,
    "class"   => null,
    "style"   => null
  ), $atts));
  $classes = $class ? 'class="' . $class . '"' : '';
  $styles = $style ? 'style="' . $style . '"' : '';
  $output = '<li ' . $class . ' ' . $style .'>';
  if($icon){
    $output .= '<i class="fa-li fa ' . $icon . '"></i> ';
  }
  $output .= do_shortcode($content);
  $output .= '</li>';
  return $output;
}
add_shortcode("li", "Li");

?>