<?php
//--------------------------------------
// SHORTCODE: SHARE LINKS
//--------------------------------------

function Share_Links($atts, $content = null){
  extract(shortcode_atts(array(
    "class" => null,
    "style" => null,
    "facebook" => null,
    "twitter" => null,
    "google" => null,
    "linkedin" => null,
    "size" => null,
  ), $atts));
  $permalink = get_the_permalink();
  $title = get_the_title();
  $style = $style ? ' style="' . $style . '"' : '';
  $icon_size = $size ? $size : "md";
  $output = '<div class="bc-social-square ' . $class . '" ' . $style . '>';
  if($facebook != "false") {
    $output .= '<a class="facebook-share social-' . $size . '" href="https://www.facebook.com/sharer/sharer.php?u=' . $permalink . '&t=' . $title . '" title="Share on Facebook" target="_blank"></i><i class="fab fa-facebook square" aria-hidden="true"></i></a>';
  }
  if($twitter != "false") {
    $output .= '<a class="twitter-share social-' . $size . '" href="https://twitter.com/intent/tweet?source=' . $permalink . '&text=' . $title . '+:+'. $permalink . '" target="_blank" title="Tweet"><i class="fab fa-twitter square" aria-hidden="true"></i></a>';
  }
  if($google != "false") {
    $output .= '<a class="google-share social-' . $size . '" href="https://plus.google.com/share?url=' . $permalink . '" target="_blank" title="Share on Google+"><i class="fab fa-google square" aria-hidden="true"></i></a>';
  }
  if($linkedin != "false") {
    $output .= '<a class="linkedin-share social-' . $size . '" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $permalink . '&title=' . $title . '&summary=&source=' . $permalink . '" target="_blank" title="Share on LinkedIn"><i class="fab fa-linkedin square" aria-hidden="true"></i></a>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("share_links", "Share_Links");

?>