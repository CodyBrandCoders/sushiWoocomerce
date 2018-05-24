<?php
//--------------------------------------
// SHORTCODE: SERVICE CARD
//--------------------------------------

function BC_Card($atts, $content = null){
  extract(shortcode_atts(array(
    'img' => '',
    'title' => '',
    'btn_text' => '',
    'href' => '',
    'class' => false,
    'style' => false,
  ), $atts));
  $output = '<div class="bc-card">';
  $output .= '<img src="' . $img . '" class="img-responsive" alt="' . $title . '" />';
  $output .= '<div class="content">';
  $output .= '<div class="title-bg">';
  $output .= '<h3 class="title text-white">' . $title . '</h3>';
  $output .= '</div>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}
add_shortcode("bc_card", "BC_Card");

?>