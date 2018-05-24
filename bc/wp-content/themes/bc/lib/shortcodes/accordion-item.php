<?php
//--------------------------------------
// SHORTCODE: ACCORDION ITEM
//--------------------------------------

function Accordion_Item($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null,
      "title"    => null,
      "active"   => false
  ), $atts));
  $output = '<div class="accordion-block ';
  if($active){
    $output .= 'active-accordion ';
  }
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  $output .= '<div class="accordion-header">';
  $output .= '<a href="#">' . $title . '</a>';
  $output .= '</div>';
  $output .= '<div class="accordion-content"';
  if($active){
    $output .= '>';
  }else{
    $output .= 'style= "display: none">';
  }
  $output .= do_shortcode($content);
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("accordion_item", "Accordion_Item");

?>