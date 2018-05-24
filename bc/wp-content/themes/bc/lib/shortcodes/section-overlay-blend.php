<?php
//--------------------------------------
// SHORTCODE: SECTION OVERLAY BLEND
//--------------------------------------

function Section_Overlay_Blend($atts, $content = null){
  extract(shortcode_atts(array(
    "align"      => 'right',
    "background" => null,
    "id" => null,
    "overlay" => null,
    "class" => null,
    "style" => null,
  ), $atts));
  $id = $id ? ' id="' . $id . '"' : '';
  $output = '<div' . $id . ' class="bc-hero-overlay-' . $align . '">';
  $output .= '<div class="bc-hero-multiply-overflow">';
  $output .= '<img src="' . $overlay . '" alt="Section Overlay Blend Effect">';
  $output .= '</div>';
  $output .= '<img class="bc-hero-normal-bck" src="' . $background . '" alt="Background Image">';
  $output .= '<div class="container">';
  $output .= '<div class="inner">';
  $output .= '<div class="hero-content">';
  $output .= do_shortcode($content);
  $output .= '</div>';
  $output .= '<div class="clear"></div>';
  $output .= '</div>';
  $output .= '<div class="clear"></div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("section_overlay_blend", "Section_Overlay_Blend");

?>