<?php
//------------------------------
// SHORTCODE: TEAM BLOCK
//------------------------------

function Team_Block($atts, $content = null){
  extract(shortcode_atts(array(
      "name"       => null,
      "src"        => null,
      "href"       => null,
      "position"   => null,
      "email"      => null,
      "facebook"   => null,
      "twitter"    => null,
      "linkedin"   => null,
      "google"     => null,
      "class"      => null,
      "style"      => null
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $output = '<div class="team-block ' . $class . '" ' . $style . '>';
  $output .= '<figure>';
  $output .= '<img src="' . $src . '"  class="img-responsive" alt="' . $name . ' - ' . $position . '"/>';
  $output .= '<div class="overlay">';
  $email = $email ? $output .= '<a href="mailto:' . $email .'" target="_blank"><i class="far fa-envelope" aria-hidden="true"></i></a>' : $output .= '';
  $facebook = $facebook ? $output .= '<a href="' . $facebook .'" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a>' : $output .= '';
  $twitter = $twitter ? $output .= '<a href="' . $twitter .'" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>' : $output .= '';
  $linkedin = $linkedin ? $output .= '<a href="' . $linkedin .'" target="_blank"><i class="fab fa-linkedin" aria-hidden="true"></i></a>' : $output .= '';
  $google = $google ? $output .= '<a href="' . $google .'" target="_blank"><i class="fab fa-google-plus" aria-hidden="true"></i></a>' : $output .= '';
  $output .= '</div>';
  $output .= '</figure>';
  if (isset($href)) {
    $output .= '<h3 class="mtm mbxs"><a href="'. $href . '">' . $name . '</a></h3>';
  } else {
    $output .= '<h3 class="mtm mbxs">' . $name . '</h3>';
  }
  $output .= '<h4 class="mbn">' . $position . '</h4>';
  $output .= '</div>';
  return $output;
}
add_shortcode("team_block", "Team_Block");

?>