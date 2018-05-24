<?php
//------------------------------
// SHORTCODE: PAGE BANNER FLEX
//------------------------------

function Page_Banner_Flex($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "style"       => null,
      "background"  => null
  ), $atts));
  $classes = $class ? ' ' . $class : '';
  $background = $background ? ' style="background-image:url(\'' . $background .  '\')"' : ' style="' . $style . '"';
  $output = '<div class="page-banner-flex nav-clear-point' . $classes . '"' . $background . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;
}
add_shortcode("page_banner_flex", "Page_Banner_Flex");

?>