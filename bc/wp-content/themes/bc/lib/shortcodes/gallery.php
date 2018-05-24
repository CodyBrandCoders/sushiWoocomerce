<?php
//--------------------------------------
// SHORTCODE: GALLERY
//--------------------------------------

function Gallery($atts, $content = null){
  extract(shortcode_atts(array(
    "class"           =>null,
    "style"           => null,
    "xxs"             => '',
    "xs"              => '',
    "sm"              => '',
    "md"              => '',
    "lg"              => '',
    "thumbnail"       => 'thumbnail',
    "lightbox"        => 'gallery-lightbox',
    "caption"         => null,
    "gutter"          => null,
    "gutter_bottom"   => null,
  ), $atts));
  $output;
  $page_gallery = get_field('page_gallery');
  if($page_gallery):
    $gutter = $gutter ? ' block-grid-gutter-' . $gutter . ' ' : '';
    $gutter_bottom = $gutter_bottom ? ' block-grid-lower-gutter-' . $gutter_bottom . ' ' : '';
    $classes = $class ? 'page-gallery block-grid' . $gutter . $gutter_bottom . ' block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' . $lg . ' ' . $class : 'page-gallery block-grid'  . $gutter . $gutter_bottom .  ' block-grid-xxs-' . $xxs . ' block-grid-xs-' . $xs . ' block-grid-sm-' . $sm . ' block-grid-md-' . $md . ' block-grid-lg-' . $lg;
    $styles = $style ? ' style="' . $style . '"' : '';
    $output .= '<div class="' . $classes . '"' . $styles . ">";
    foreach($page_gallery as $image) :
      $caption_data = $caption ? ' data-title="' . $image['caption'] . '"' : '';
      $output .= '<li class="block-grid-item">';
      $output .= '<a href="' . $image['url'] . '" data-lightbox="' . $lightbox . '"' . $caption_data . '>';
      $altoutput = $image['alt'] != '' ? $image['alt'] : 'Gallery Photo';
      $output .= '<img class="img-responsive" src="' . $image['sizes'][$thumbnail] . '" alt="' .  $altoutput . '"/>';
      if($caption) :
        $output .= '<p class="caption">' . $image['caption'] . '</p>';
      endif;
      $output .= '</a>';
      $output .= '</li>';
    endforeach;
    $output .= '</div>';
  endif;
  return $output;
}
add_shortcode("gallery", "Gallery");

?>