<?php
//------------------------------
// SHORTCODE: IMAGE FLEX
//------------------------------

function Img_Flex($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "src"         => null,
      "x"           => null,
      "y"           => null
  ), $atts));
  $styles = $x && $y ? 'style="background-image:url(\'' . $src . '\');background-position:' . $x . ' ' . $y . ';'. $style .'"' : 'style="background-image:url(\'' . $src . '\');' . $stlye . '';
  $output = '<div class="img-flex ' . $class . '" ' . $styles . '>';
  if($content) {
    $output .= do_shortcode($content);
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("img_flex", "Img_Flex");

?>