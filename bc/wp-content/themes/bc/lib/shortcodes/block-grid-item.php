<?php
//------------------------------
// SHORTCODE: BLOCK GRID ITEM
//------------------------------

function Block_Grid_Item($atts, $content = null){
  extract(shortcode_atts(array(
      "class"    => null,
      "style"    => null
  ), $atts));
  $output = '<div class="block-grid-item ';
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
add_shortcode("block_grid_item", "Block_Grid_Item");

?>