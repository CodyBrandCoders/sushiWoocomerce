<?php
//--------------------------------------
// SHORTCODE: BREADCRUMBS
//--------------------------------------

function Breadcrumbs(){
  global $post;
  $output = '';
  if(!is_front_page()) :
    $counter = 1;
    $output .= '<div class="breadcrumb-wrap">';
    $output .= '<div class="container">';
    $output .= '<div class="row">';
    $output .= '<div class="breadcrumbs col-xs-12" itemscope itemtype="http://schema.org/BreadcrumbList">';
    $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_home_url() . '"><span itemprop="name"><i class="fa fa-home"></i></span></a></span>';
    if(is_page()){
      if($post->post_parent){
          $anc = get_post_ancestors( $post->ID );
          $anc_link = get_page_link( $post->post_parent );
          foreach ( $anc as $ancestor ) {
              $output .= " <span class='spacer'><i class='fa fa-angle-right'></i></span> <span itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem'><a itemprop='item' href='".$anc_link."'><span itemprop='name'>".get_the_title($ancestor)."</span></a></span> <span class='spacer'> <i class='fa fa-angle-right'></i> </span>";
          }
        $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_the_permalink() . '"><span class="current"><span itemprop="name">'. get_the_title() . '</span></span></a></span>';
      } else {
          $output .= ' <span class="spacer"><i class="fa fa-angle-right"></i></span> ';
          $output .= '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_the_permalink() . '"><span class="current"><span itemprop="name">'. get_the_title() . '</span></span></a></span>';
      }
    }
  endif;
  $output .= "</div></div></div></div>";
  return $output;
}
add_shortcode("breadcrumbs", "Breadcrumbs");

?>