<?php
//--------------------------------------
// SHORTCODE: MOBILE LOCATION CONVERSION
//--------------------------------------

function Mobile_Location_Conversion($atts, $content = null){
  extract(shortcode_atts(array(
      "class"       => null,
      "hours"       => null
  ), $atts));
  $output = '';
  if(have_rows('global_address', 'option')) :
    while(have_rows('global_address', 'option')) : the_row();
      $company_name = get_sub_field('company_name', 'option');
      $street = get_sub_field('street', 'option');
      $city = get_sub_field('city', 'option');
      $state = get_sub_field('state', 'option');
      $zip = get_sub_field('zip', 'option');
      $phone = get_sub_field('phone', 'option');
      $email = get_sub_field('email', 'option');
      $directions = get_sub_field('directions', 'option');
      $thumbnail = get_sub_field('location_thumbnail', 'option');
      $page = get_sub_field('location_page', 'option');
      $output .= '<div class="location-block-mobile visible-phone ';
      if($class){
        $output .= $class . '">';
      }else{
        $output .= '">';
      }
      $output .= '<div class="col-inner">';
      $output .= '<div itemscope itemtype="http://schema.org/LocalBusiness">';
      $output .= '<span itemprop="name" class="name"><a href="' . $page . '">' . $company_name . '</a></span>';
      $output .= '<div itemprop="address" class="mbm address" itemscope itemtype="http://schema.org/PostalAddress">';
      $output .= '<span itemprop="streetAddress"><a target="_blank" class="dark-blue-link" href="' . $directions . '" onclick="gtag(\'event\', \'Call Tracking\', { \'event_category\':\'/contact/\', \'event_label\':\'Call Tracking - Mobile Location Conversion Box - Mobile\'});">' . $street . ', </span><span itemprop="addressLocality">' . $city . ', </span><span itemprop="addressRegion">' . $state . ' </span><span itemprop="postalCode">' . $zip . '</a></span>';
      if($hours) {
          if(have_rows('business_hours', 'option')) :
            $output .= '<div class="fw-400">';
            while(have_rows('business_hours', 'option')) : the_row();
              $output .= '<time itemprop="openingHours" content="' . get_sub_field('meta_data') . '"><strong>' . get_sub_field('days') . '</strong>: ' . get_sub_field('hours') . '</time> &nbsp;•&nbsp; ';
            endwhile;
            $output .= '</div>';
          endif;
        }
      $output .= '</div>';
      $output .= '<figure><a class="ilb" href="'.$directions.'" target="_blank" onclick="gtag(\'event\', \'Map Tracking\', { \'event_category\':\'/contact/\', \'event_label\':\'Map Tracking - Mobile Location Conversion Box - Mobile\'});"><img src="' . $thumbnail . '" class="img-responsive" alt="Directions" style="border: 1px solid #CCC;" /></a></figure>';
      $output .= '<div class="schema-contact">';
      $output .= '<a class="btn number_link" href="tel:+1' . str_replace(' ', '', $phone) . '" onclick="gtag(\'event\', \'Call Tracking\', { \'event_category\':\'/contact/\', \'event_label\':\'Call Tracking - Mobile Location Conversion Box - Mobile\'});"><i class="fa fa-phone"></i>&nbsp; <span itemprop="telephone" class="number">' . $phone . '</span></a>';
      $output .= '<a class="btn" target="_blank" href="' . $directions . '" onclick="gtag(\'event\', \'Map Tracking\', { \'event_category\':\'/contact/\', \'event_label\':\'Map Tracking - Mobile Location Conversion Box - Mobile\'});"><i class="fa fa-map-marker"></i>&nbsp; <span itemprop="email">Map It!</span></a>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
    endwhile;
  endif;
  return $output;
}
add_shortcode("mobile_location_conversion", "Mobile_Location_Conversion");

?>