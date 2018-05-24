<?php
//------------------------------
// SHORTCODE: IMAGE SLIDER
//------------------------------

function Image_Slider($atts, $content = null){
  extract(shortcode_atts(array(
    "class"   => null,
    "style"   => null,
    "images"  => null,
    "caption" => null,
  ), $atts));
  $output = '';
  $images = explode(',', $images);
  if($images) :
    if($caption) : $output .= '<div class="caption-container">'; endif;
    $class = $class ? ' ' . $class : '';
    $style = $style ? ' style="' . $style . '"' : '';
    $output .= '<div class="bc-image-slider' . $class . '"' . $style . '>';
    foreach( $images as $image ) :
      $output .= '<div style="background-image: url(\'' . $image . '\');">';
      $output .= '</div>';
    endforeach;
    $output .= '</div>';
    if($caption) : $output .= '<h1 class="h2 caption mbn">' . $caption . '</h1>'; endif;
    if($caption) : $output .= '</div>'; endif;
  endif;
  return $output;
}
add_shortcode("image_slider", "Image_Slider");

?>