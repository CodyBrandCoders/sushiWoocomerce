<?php
//--------------------------------------
// SHORTCODE: IMAGE OVERLAY
//--------------------------------------

function Img_Overlay($atts, $content = null){
  extract(shortcode_atts(array(
      "src"        => null,
      "href"       => '#',
      "class"      => null,
      "style"      => null
  ), $atts));
  $output = '<figure class="bc-img-overlay ' . $class . '">';
  $output .= '<img src="' . $src . '" class="img-responsive" alt="Image Overlay" />';
  if($content) :
    $output .= '<a href="' . $href . '" class="overlay">';
    $output .= '<div class="content">';
    $output .= do_shortcode($content);
    $output .= '</div>';
    $output .= '</a>';
  endif;
  $output .= '</figure>';
  return $output;
}
add_shortcode("img_overlay", "Img_Overlay");

?>