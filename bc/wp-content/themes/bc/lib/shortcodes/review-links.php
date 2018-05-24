<?php
//--------------------------------------
// SHORTCODE: REVIEW LINKS
//--------------------------------------

function ReviewLinks($atts){
  extract(shortcode_atts(array(
    'yelp' => false,
    'manta' => false,
    'yellow_pages' => false,
    'google' => false,
    'home_advisor' => false,
    'facebook' => false,
    'angies_list' => false,
    'bbb' => false,
    'class' => false,
    'style' => false,
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $output = '<div class="block-grid-xxs-2 block-grid-xs-3 block-grid-sm-4 block-grid-md-4 block-grid-lg-4 review-link-grid ' . $class . '"' . $style . '>';
  if($yelp){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $yelp . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Yelp.png" alt="Review Us On Yelp" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($manta){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $manta . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Manta.png" alt="Review Us On Manta" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($yellow_pages){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $yellow_pages . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Yellow-Pages.png" alt="Review Us On Yellow Pages" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($google){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $google . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Google.png" alt="Review Us On Google" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($home_advisor){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $home_advisor . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Home-Advisor.png" alt="Review Us On Home Advisor" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($facebook){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $facebook . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Facebook.png" alt="Review Us On Facebook" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($angies_list){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $angies_list . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-Angies-List.png" alt="Review Us On Angie\'s List" class="img-responsive"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  if($bbb){
    $output .= '<div class="block-grid-item">';
    $output .= '<a href="' . $bbb . '" target="_blank">';
    $output .= '<img src="/bc/wp-content/uploads/Review-Us-On-BBB.png" alt="Review Us On Better Business Bureau (BBB)" class="img-responsive" target="_blank"/>';
    $output .= '</a>';
    $output .= '</div>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("review_links", "ReviewLinks");

?>