<?php
//------------------------------
// SHORTCODE: ADDRESS LOOP
//------------------------------

function Address_Loop($atts, $content = null){
  $output ='';
  extract(shortcode_atts(array(
      "class"       => null,
      "hours"       => false
  ), $atts));
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
      $page = get_sub_field('location_page', 'option');
      $output .= '<div class="address-loop" itemscope itemtype="http://schema.org/LocalBusiness">';
      if($company_name) :
        $output .= '<div class="c-name mb5 font-size-24"><strong itemprop="name">' . $company_name . '</strong></div>';
      endif;
      $output .= '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="fa-ul">';
      if($street || $city || $state || $zip) :
        $output .= '<li itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="addr"><i class="fa-li fa fa-map-marker"></i>';
        $output .= '<a target="_blank" href="' . $directions . '" onclick="gtag(\'event\', \'Map Tracking\', { \'event_category\':\'Shortcode - Address Loop\', \'event_label\':\'Map Tracking - Address Loop Shortcode - All Devices\'});"><span itemprop="streetAddress">' . $street . '</span><br><span itemprop="addressLocality">' . $city . '</span>, <span itemprop="addressRegion">' . $state . '</span> <span itemprop="postalCode">' . $zip . '</span></a>';
        $output .= '</li>';
      endif;
      if($phone) :
        $output .= '<li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1' . str_replace(' ', '', $phone) . '" class="number_link" onclick="gtag(\'event\', \'Call Tracking\', { \'event_category\':\'Shortcode - Address Loop\', \'event_label\':\'Call Tracking - Address Loop Shortcode - All Devices\'});"><span itemprop="telephone" class="number">' . $phone . '</span></a></li>';
      endif;
      if($email) :
        $output .= '<li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:' . $email . '"  onclick="gtag(\'event\', \'Email Tracking\', { \'event_category\':\'Shortcode - Address Loop\', \'event_label\':\'Email Tracking - Address Loop Shortcode - All Devices\'});"><span itemprop="email">' . $email . '</span></a></li>';
      endif;
      $output .= '</ul>';
      if($hours) {
        if(have_rows('business_hours', 'option')) :
          $output .= '<h4 class="mt20 mb5"><strong>Hours of Operation</strong></h4>';
          while(have_rows('business_hours', 'option')) : the_row();
            $output .= '<div class="mbn"><i class="fa fa-clock-o"></i>&nbsp;&nbsp; <time itemprop="openingHours" content="' . get_sub_field('meta_data') . '"><strong>' . get_sub_field('days') . '</strong>: ' . get_sub_field('hours') . '</time></div>';
          endwhile;
        endif;
      }
      $output .= '</div>';
    endwhile;
  endif;
  return $output;
}
add_shortcode("address_loop", "Address_Loop");

?>