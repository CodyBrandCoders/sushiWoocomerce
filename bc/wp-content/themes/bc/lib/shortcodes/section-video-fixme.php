<?php
//------------------------------
// SHORTCODE: SECTION VIDEO
//------------------------------

function Section_Video($atts, $content = null){
  extract(shortcode_atts(array(
      "id"         => false,
      "class"      => false,
      "style"      => false,
      "container"  => false,
      "row"        => false,
      "background" => false,
      "mp4"        => false,
      "ogv"        => false,
      "overlay"    => false,
  ), $atts));
  $classes = $class ? ' class="section section-video-bg ' . $class . '"' : ' class="section section-video-bg"';
  $id = $id ? 'id="' . $id . '"' : '';
  $overlay = $overlay ? 'background-color:' . $overlay . ';' : '';
  $background = wp_is_mobile() ? 'background-image: url(' . $background . ');' : '';
  $output = '<section ' . $id . ' ' . $classes . ' style="' . $overlay . $background . $style . '">';
  if($mp4 || $ogv && !wp_is_mobile()){
    $output .= '<video class="video-bg" loop><source src="' . $mp4 . '" type="video/mp4"><source src="' . $ogv . '" type="video/ogv"></video>';
  }
  if($container){ $output.= '<div class="container">'; };
  if($row){ $output.= '<div class="row">'; };
  $output .= do_shortcode($content);
  if($row){ $output.= '</div>'; };
  if($container){ $output.= '</div>'; };
  $output .= '</section>';
  return $output;
}
add_shortcode("section_video", "Section_Video");

?>