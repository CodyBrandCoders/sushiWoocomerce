<?php
//--------------------------------------
// SHORTCODE: EVENT SYSTEM UPCOMING
//--------------------------------------

function eventLoop(){
  $currentdate = date("Y-m-d", strtotime("-1 day"));
  $args = array (
    'post_type'              => array( 'event' ),
    'post_status'            => array( 'publish' ),
    'meta_query'=> array(
        array(
          'key' => 'start_date',
          'compare' => '>',
          'value' => $currentdate,
          'type' => 'DATE',
        )),
    'meta_key'               => 'start_date',
    'orderby'                => 'meta_value_num',
    'order'                  => 'ASC',
    'posts_per_page'         => -1
  );
  $output;
  $query = new WP_Query( $args );
  if($query->have_posts()) :
    $output = '<div class="block-grid block-grid-all-pop block-grid-xxs-1 block-grid-xs-1 block-grid-sm-2 block-grid-md-3 block-grid-lg-3">';
    while ($query->have_posts()) : $query->the_post();
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
      $long_excerpt = get_the_excerpt($post->ID);
      $short_excerpt = substr($long_excerpt, 0, 120);
      $start_date = get_field('start_date');
      $start_time = get_field('start_time');
      $output .= '<div class="block-grid-item">';
      $output .= '<div class="event-card">';
      $output .= '<a class="figure" href="' . get_the_permalink($post->ID) . '" style="background-image:url(\'' . $image[0] . '\')">';
      $output .= '<div class="event-start"><div class="col-inner"><span>' . my_format_date('M j', $start_date) . '</span> <span>' .my_format_date('g:iA', $start_time) . '</span></div></div>';
      $output .= '</a>';
      $output .= '<div class="event-details">';
      $output .= '<a href="' . get_the_permalink($post->ID) . '"><h3 class="text-color-1 mbm">' . get_the_title($post->ID) . '</h3></a>';
      $output .= '<p class="text-color-1">' . $short_excerpt . '...</p>';
      $output .= '<a href="' . get_the_permalink($post->ID) . '" class="btn btn-md btn-color-2 mtm">View Event Details <i class="fa fa-angle-double-right"></i></a>';
      $output .= '</div>';
      $output .= build_event_schema($post->ID);
      $output .= '</div>';
      $output .= '</div>';
    endwhile;
    $output .= '</div>';
    wp_reset_query();
  else:
    $output = '<h2 class="text-color-1 text-center h1">No Events Currently Scheduled</h2>';
  endif;
  return $output;
}
add_shortcode("event_loop", "eventLoop");

?>