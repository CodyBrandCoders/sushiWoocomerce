<?php
//--------------------------------------
// SHORTCODE: IMAGES
//--------------------------------------

function Bc_Img($atts, $content = null){
  $output ='';
  extract(shortcode_atts(array(
      "class"     => null,
      "alt"       => null,
      "target"    => null,
      "style"     => null,
      "dummy"     => null,
      "src"       => null,
      "align"     => null,
      "lightbox"  => null,
      "href"      => null,
  ), $atts));
  if($alt) {
    $alt = $alt;
  }else{
    $full_url = get_bloginfo('url') . $src;
    $alt = image_alt_by_url($full_url);
  }
  $full_url = get_bloginfo('url') . $src;
  if(!$lightbox && $href){
    $output .= '<a href="' . $href . '" class="ilb" target="' . $target . '">';
  }
  if($lightbox && !$href){
    $output .= '<a href="' . $src . '" data-lightbox="' . $lightbox . '" target="' . $target . '">';
  }
  $output .= '<img class="img-responsive ';
  if($class && $style){
    $output .= $class . '" style="' . $style . '"';
  }else if($class && !$style){
    $output .= $class . '"';
  }else if($style && !$class){
    $output .= '" style="' . $style . '"';
  }else{
    $output .= '"';
  }
  if($dummy){
    $src = 'http://placehold.it/' . $dummy;
  }
  $output .= ' src="' . $src . '" alt="' . $alt . '"';
  if($align){
    $output .= ' align="' . $align . '" />';
  }else{
    $output .= ' />';
  }
  if($lightbox){
    $output .= '</a>';
  }
  if(!$lightbox && $href){
    $output .= '</a>';
  }
  return $output;
}
add_shortcode("bc_img", "Bc_Img");

?>