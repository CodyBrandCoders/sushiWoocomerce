<?php
//--------------------------------------
// SHORTCODE: CHILD PAGE LIST
//--------------------------------------

function childPageList($atts){
  extract(shortcode_atts(array(
      "parent_page" => '',
      "exclude"    => ''
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
  $output = '<div class="child-page-list">';
  foreach($pages as $page){
    $output .= '<p><a href="' . get_the_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></p>';
  }
  $output .= '</div>';
  return $output;
}
add_shortcode("child_page_list", "childPageList");

?>