<?php
//--------------------------------------
// SHORTCODE: SCHEMA
//--------------------------------------

function Schema($atts, $content = null){
  extract(shortcode_atts(array(
      "icons"        =>  false,
      "linkcolor"    =>  false,
      "num"          =>  1,
      "name"         =>  false,
      "namefontsize" =>  false,
      "address"      =>  false,
      "phone"        =>  false,
      "email"        =>  false,
      "fax"          =>  false,
      "style"        =>  false,
      "class"        =>  false,
      "hours"        =>  false
  ), $atts));
  $style = $style ? ' style="' . $style . '"' : '';
  $class = $class ? ' ' . $class : '';
  if($icons) :
    $output = '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="schema-list fa-ul' . $class . '"' . $style .'>';
    $name = $name ? $output .= '<li class="c-name"><i class="fa fa-li fa-home"></i> <span itemprop="name" style="font-size: ' . $namefontsize . '">' . constant("MAIN_ADDRESS_NAME_" . $num)  . '</span></li>' : '';
    $address = $address ? $output .= '<li itemprop="address" class="addr" itemscope itemtype="http://schema.org/PostalAddress"><i class="fa-li fa fa-map-marker"></i> <a href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $num) . '" target="_blank" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Map Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Map Tracking - Schema Shortcode - Desktop\'});"><span itemprop="streetAddress">' . constant("MAIN_ADDRESS_STREET_" . $num) . '</span><br><span itemprop="addressLocality">' . constant("MAIN_ADDRESS_CITY_" . $num) . ', </span><span itemprop="addressRegion">' . constant("MAIN_ADDRESS_STATE_" . $num) . ' </span><span itemprop="postalCode">' . constant("MAIN_ADDRESS_ZIP_" . $num) . '</span></a></li>'  : '';
    $phone = $phone ? $output .= '<li class="phone"><i class="fa-li fa fa-phone"></i> <a href="tel:+1' . sanatize_phone(constant("MAIN_ADDRESS_PHONE_" . $num)) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Call Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Call Tracking - Schema Shortcode - Desktop\'});"><span itemprop="telephone" class="number">' . constant("MAIN_ADDRESS_PHONE_" . $num) . '</span></a></li>' : '';
    $email = $email ? $output .= '<li class="email"><i class="fa-li fa fa-envelope"></i> <a href="mailto:' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Email Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Email Tracking - Schema Shortcode - Desktop\'});"><span itemprop="email">' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '</span></a></li>' : '';
    $fax = $fax ? $output .= '<li class="fax"><i class="fa-li fa fa-fax"></i> <a href="fax:' . sanatize_phone(constant("MAIN_ADDRESS_FAX_" . $num)) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Fax Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Fax Tracking - Schema Shortcode - Desktop\'});"><span itemprop="faxNumber">' . constant("MAIN_ADDRESS_FAX_" . $num) . '</span></a></li>' : '';
    if($hours) :
      $output .= '<li><i class="fa-li fa fa-clock-o"></i> Hours</li>';
      $schema_counter = 0;
      if(have_rows('global_address', 'option')) :
        while(have_rows('global_address', 'option')) : the_row();
          $schema_counter++;
          if($schema_counter == $num){
            if(have_rows('business_hours', 'option')) :
              while(have_rows('business_hours', 'option')) : the_row();
                $output .= '<li><time itemprop="openingHours" content="' . get_sub_field('meta_data') . '">' . get_sub_field('days') . ' : ' . get_sub_field('hours') . '</time></li>';
              endwhile;
            endif;
          }
        endwhile;
      endif;
    endif;
    $output .= '</ul>';
  else:
    $output = '<ul itemscope itemtype="http://schema.org/LocalBusiness" class="schema-list list-unstyled' . $class . '"' . $style . '>';
    $name = $name ? $output .= '<li class="c-name"><span itemprop="name" style="font-size: ' . $namefontsize . '">' . constant("MAIN_ADDRESS_NAME_" . $num)  . '</span></li>' : '';
    $address = $address ? $output .= '<li itemprop="address" class="addr" itemscope itemtype="http://schema.org/PostalAddress"><a href="' . constant("MAIN_ADDRESS_DIRECTIONS_" . $num) . '" style="color: ' . $linkcolor . '" target="_blank" onclick="gtag(\'event\', \'Map Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Map Tracking - Schema Shortcode - All Devices\'});"><span itemprop="streetAddress">' . constant("MAIN_ADDRESS_STREET_" . $num) . '</span><br><span itemprop="addressLocality">' . constant("MAIN_ADDRESS_CITY_" . $num) . ', </span><span itemprop="addressRegion">' . constant("MAIN_ADDRESS_STATE_" . $num) . ' </span><span itemprop="postalCode">' . constant("MAIN_ADDRESS_ZIP_" . $num) . '</span></a></li>'  : '';
    $phone = $phone ? $output .= '<li class="phone"><a href="tel:+1' . sanatize_phone(constant("MAIN_ADDRESS_PHONE_" . $num)) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Call Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Call Tracking - Schema Shortcode - All Devices\'});"><span itemprop="telephone" class="number">' . constant("MAIN_ADDRESS_PHONE_" . $num) . '</span></a></li>' : '';
    $email = $email ? $output .= '<li class="email"><a href="mailto:' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Email Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Email Tracking - Schema Shortcode - All Devices\'});"><span itemprop="email">' . constant("MAIN_ADDRESS_EMAIL_" . $num) . '</span></a></li>' : '';
    $fax = $fax ? $output .= '<li class="fax"><a href="fax:' . sanatize_phone(constant("MAIN_ADDRESS_FAX_" . $num)) . '" style="color: ' . $linkcolor . '" onclick="gtag(\'event\', \'Fax Tracking\', { \'event_category\':\'Shortcode - Schema\', \'event_label\':\'Fax Tracking - Schema Shortcode - All Devices\'});"><span itemprop="faxNumber">' . constant("MAIN_ADDRESS_FAX_" . $num) . '</span></a></li>' : '';
    if($hours) :
      $output .= '<li>Hours</li>';
      $schema_counter = 0;
      if(have_rows('global_address', 'option')) :
        while(have_rows('global_address', 'option')) : the_row();
          $schema_counter++;
          if($schema_counter == $num){
            if(have_rows('business_hours', 'option')) :
              while(have_rows('business_hours', 'option')) : the_row();
                $output .= '<li><time itemprop="openingHours" content="' . get_sub_field('meta_data') . '">' . get_sub_field('days') . ' : ' . get_sub_field('hours') . '</time></li>';
              endwhile;
            endif;
          }
        endwhile;
      endif;
    endif;
    $output .= '</ul>';
  endif;
  return $output;
}
add_shortcode("schema", "Schema");

?>