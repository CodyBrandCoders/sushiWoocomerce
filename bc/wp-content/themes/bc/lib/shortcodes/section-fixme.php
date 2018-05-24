<?php
//------------------------------
// SHORTCODE: SECTION
//------------------------------

function Section($atts, $content = null){
  extract(shortcode_atts(array(
      "id"         => false,
      "class"      => false,
      "style"      => false,
      "container"  => false,
      "container_fluid"  => false,
      "row"        => false,
      "background" => false,
      "full_col"   => false,
      // "parallax"   => false,
      "underlay"   => false,
      "mp4"        => false,
      "ogv"        => false
  ), $atts));
  $video = $mp4 && $ogv && !wp_is_mobile() ? ' data-vide-bg="mp4:' . $mp4 . ', ogv:' . $ogv . '"' : '';
  if($parallax){
    $parallax_data = ' data-parallax="scroll" data-image-src="' . $background . '"';
    $background = NULL;
  }
  $underlay = $underlay ? '<div class="section-underlay" style="background-color:' . $underlay . ';"></div>' : '';
  $classes = $class ? ' class="section ' . $class . '"' : ' class="section"' . $parallax_class;
  $id = $id ? 'id="' . $id . '"' : '';
  $background = $background ? 'style="background-image: url(' . $background . ');' . $style .'"'  : 'style="' . $style . '"';
  $output = '<section ' . $id . ' ' . $classes . ' ' . $background  . ' ' . $video . '' . $parallax_data . '>';
  $output .= $underlay;
  if($container){ $output.= '<div class="container">'; };
  if($container_fluid){ $output.= '<div class="container-fluid">'; };
  if($row){ $output.= '<div class="row">'; };
  if($full_col){ $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'; }
  $output .= do_shortcode($content);
  if($full_col){ $output .= '</div>'; }
  if($row){ $output.= '</div>'; };
  if($container_fluid){ $output.= '</div>'; };
  if($container){ $output.= '</div>'; };
  $output .= '</section>';
  return $output;
}
add_shortcode("section", "Section");

?>