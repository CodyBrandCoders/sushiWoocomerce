<?php
//------------------------------
// SHORTCODE: BLOCK GRID
//------------------------------

function Block_Grid($atts, $content = null){
  extract(shortcode_atts(array(
      "gutter"   => null,
      "gutter_bottom"   => null,
      "animate"  => null,
      "class"    => null,
      "style"    => null,
      "xxs"      => '',
      "xs"       => '',
      "sm"       => '',
      "md"       => '',
      "lg"       => ''
  ), $atts));
  $animate = $animate ? ' block-grid-' . $animate . ' ': '';
  $gutter = $gutter ? ' block-grid-gutter-' . $gutter . ' ' : '';
  $gutter_bottom = $gutter_bottom ? ' block-grid-lower-gutter-' . $gutter_bottom . ' ' : '';
  $output = '<div class="block-grid ' . $gutter . $animate . '' . $gutter_bottom . 'block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' .$lg . ' ';
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
add_shortcode("block_grid", "Block_Grid");

?>