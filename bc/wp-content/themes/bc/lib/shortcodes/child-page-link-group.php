<?php
//--------------------------------------
// SHORTCODE: CHILD PAGE LINK GROUP
//--------------------------------------

function childPageLinkGroup($atts, $content = null){
  extract(shortcode_atts(array(
      "parent_page" => '',
      "exclude" => '',
      "style"   => '',
      "class"   => ''
  ), $atts));
  $args = array(
    'sort_order' => 'asc',
    'exclude' => $exclude,
    'hierarchical' => 1,
    'child_of' => $parent_page,
    'depth' => 1,
    'post_status' => 'publish',
    'parent' => $parent_page
  );
  $pages = get_pages($args);
  $output = '<div class="link-group ' . $class . '" style="' . $style . '">';
  foreach($pages as $page){
      $output .= "<a href='" . get_the_permalink($page->ID) . "'";
      if(get_the_permalink($page->ID) == get_the_permalink()){
        $output .= " class='active-page'>";
      }else{
        $output .= ">";
      }
      $output .= get_the_title($page->ID) . "</a>";
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("child_page_link_group", "childPageLinkGroup");

?>