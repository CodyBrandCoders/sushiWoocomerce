<?php
//--------------------------------------
// SHORTCODE: ACCORDION
//--------------------------------------

function Accordion($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null
  ), $atts));
  $output = '<div class="accordion ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("accordion", "Accordion");

?>