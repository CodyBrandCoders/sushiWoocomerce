<?php

//-----------------------
// VERSION
//-----------------------

define('BC_TEMPLATE_VERSION', '1.12.0');

//-----------------------
// Toggle Admin Bar
//-----------------------

// show_admin_bar( false );

//-----------------------
// REQUIRED `lib/` files
//-----------------------

/* WARNING: Removing the following two lines will break the theme */
include 'lib/setup.php';
include 'lib/enqueue-scripts-stylesheets.php';
include 'lib/shortcodes.php';

//-----------------------
// Optional `lib/` files
//-----------------------

include 'lib/custom-roles.php';
include 'lib/post-types.php';
// include 'lib/thumbnails.php';
// include 'lib/custom-taxonomies.php';

//-----------------------
// Helper Functions
//-----------------------

// function to take a phone number and make it compatble with an href attr
function sanatize_phone($number){
  $safe = str_replace(array(' ', '-', '(', ')', '.'), '', $number);
  return $safe;
}

// Get the img alt via the URL
function image_alt_by_url( $image_url ) {
    global $wpdb;
    if( empty( $image_url ) ) {
        return false;
    }
    $query_arr  = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE guid='%s';", strtolower( $image_url ) ) );
    $image_id   = ( ! empty( $query_arr ) ) ? $query_arr[0] : 0;
    return get_post_meta( $image_id, '_wp_attachment_image_alt', true );
}

function my_format_date($format, $date){
  $my_date = date($format, strtotime($date));
  return $my_date;
}

function build_event_schema($id){
  $args = array(
    'link'        => get_the_permalink($id),
    'image'       => wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' )[0],
    'start'       => my_format_date('Y-m-d', get_field('start_date', $id)) . 'T' . get_field('start_time', $id),
    'end'         => my_format_date('Y-m-d', get_field('end_date', $id)) . 'T' . get_field('end_time', $id),
    'description' => get_the_content($id),
    'location'    => get_field('location_name', $id),
    'name'        => get_the_title($id),
    'street'      => get_field('street_address', $id),
    'city'        => get_field('city', $id),
    'state'       => get_field('state', $id),
    'zip'         => get_field('zip', $id),
    'price'       => get_field('price', $id),
  );
  if($id) :
    $output = '<div itemscope itemtype="http://schema.org/Event" style="display: none">';
    $output .=   '<meta itemprop="name" content="' . $args['name'] . '">';
    $output .=   '<meta itemprop="url" content="' . $args['link'] . '" >';
    $output .=   '<meta itemprop="image" content="' . $args['image'] . '" >';
    $output .=   '<meta itemprop="startDate" content="' . $args['start'] . '" >';
    $output .=   '<meta itemprop="endDate" content="' . $args['end'] . '" >';
    $output .=   '<meta itemprop="description" content="' . $args['description'] . '">';
    $output .=   '<meta itemprop="eventStatus" content="EventScheduled">';
    /* PLACE SCHEMA */
    $output .=   '<div itemprop="location" itemscope itemtype="http://schema.org/Place">';
    $output .=     '<meta itemprop="name" content="' . $args['location'] . '">';
    /* POSTAL ADDRESS SCHEMA */
    $output .=     '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
    $output .=       '<meta itemprop="addressLocality" content="' . $args['city'] . '">';
    $output .=       '<meta itemprop="addressRegion" content="' . $args['state'] . '.">';
    $output .=       '<meta itemprop="postalCode" content="' . $args['zip'] . '">';
    $output .=       '<meta itemprop="streetAddress" content="' . $args['street'] . '">';
    $output .=     '</div>';
    /* END POSTAL ADDRESS SCHEMA */
    $output .=   '</div>';
    /* END PLACE SCHEMA */
    /* OFFERS SCHEMA */
    $output .=   '<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">';
    $clean_price = preg_replace("/[^0-9\.]/", "",$args['price']);
    $output .=     '<meta itemprop="price" content="' . $clean_price . '">';
    $output .=     '<meta itemprop="url" content="' . $args['link'] . '" >';
    $output .=     '<meta itemprop="priceCurrency" content="USD">';
    $output .=   '</div>';
    /* OFFERS SCHEMA */
    $output .= '</div>';
    return $output;
  endif;
}

//-----------------------
// Attribute Setups
//-----------------------

// Social Media Links
$social_array= array(
  'facebook'  => 'https://www.facebook.com/thesushiexperience/',
  'google'    => 'https://www.google.com/',
  'twitter'   => 'https://twitter.com/thesushiexp',
  'youtube'   => 'https://www.google.com/',
  'linkedin'  => 'https://www.google.com/',
  'instagram' => 'https://www.instagram.com/thesushiexperience',
  'yelp'      => 'https://www.google.com/',
  'pinterest' => 'https://www.google.com/',
);

//-----------------------
// Constants
//-----------------------

// Address of Company
if(have_rows('global_address', 'option')) :
  $i = 1;
  while(have_rows('global_address', 'option')) : the_row();
    $company_name = get_sub_field('company_name', 'option');
    $street = get_sub_field('street', 'option');
    $city = get_sub_field('city', 'option');
    $state = get_sub_field('state', 'option');
    $zip = get_sub_field('zip', 'option');
    $phone = get_sub_field('phone', 'option');
    $email = get_sub_field('email', 'option');
    $fax = get_sub_field('fax', 'option');
    $directions = get_sub_field('directions', 'option');
    $thumbnail = get_sub_field('location_thumbnail', 'option');
    define('MAIN_ADDRESS_NAME_' . $i, $company_name);
    define('MAIN_ADDRESS_STREET_' . $i, $street);
    define('MAIN_ADDRESS_CITY_' . $i, $city);
    define('MAIN_ADDRESS_STATE_' . $i, $state);
    define('MAIN_ADDRESS_ZIP_' . $i, $zip);
    define('MAIN_ADDRESS_PHONE_' . $i, $phone);
    define('MAIN_ADDRESS_EMAIL_' . $i, $email);
    define('MAIN_ADDRESS_FAX_' . $i, $fax);
    define('MAIN_ADDRESS_DIRECTIONS_' . $i, $directions);
    define('MAIN_ADDRESS_THUMBNAIL_' . $i, $thumbnail);
    $i++;
  endwhile;
endif;

/* ENABLE FLAMINGO FOR ALL ROLES */
remove_filter( 'map_meta_cap', 'flamingo_map_meta_cap' );
add_filter( 'map_meta_cap', 'brandcoders_flamingo_map_meta_cap', 9, 4 );
function brandcoders_flamingo_map_meta_cap( $caps, $cap, $user_id, $args ) {
  $meta_caps = array(
      'flamingo_edit_contact' => 'publish_posts',
      'flamingo_edit_contacts' => 'publish_posts',
      'flamingo_delete_contact' => 'publish_posts',
      'flamingo_edit_inbound_message' => 'publish_posts',
      'flamingo_edit_inbound_messages' => 'publish_posts',
      'flamingo_delete_inbound_message' => 'publish_posts',
      'flamingo_delete_inbound_messages' => 'publish_posts',
      'flamingo_spam_inbound_message' => 'publish_posts',
      'flamingo_unspam_inbound_message' => 'publish_posts',
      'flamingo_edit_outbound_message' => 'publish_posts',
      'flamingo_edit_outbound_messages' => 'publish_posts',
      'flamingo_delete_outbound_message' => 'publish_posts',
  );

  $caps = array_diff( $caps, array_keys( $meta_caps ) );

  if ( isset( $meta_caps[$cap] ) )
      $caps[] = $meta_caps[$cap];

  return $caps;
}

function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
 }
 add_filter('upload_mimes', 'cc_mime_types');

 