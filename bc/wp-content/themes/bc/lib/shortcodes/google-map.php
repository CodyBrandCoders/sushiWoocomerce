<?php
//------------------------------
// SHORTCODE: GOOGLE MAP
//------------------------------

function G_Map($atts, $content = null){
  extract(shortcode_atts(array(
      "num"        =>  1,
      "height"     => '300',
      "width"      => '100%',
      "class"      => null,
      "style"      => null
  ), $atts));
  $address = constant("MAIN_ADDRESS_NAME_" . $num) . '+' . constant("MAIN_ADDRESS_STREET_" . $num) . '+' . constant("MAIN_ADDRESS_CITY_" . $num) . '+' . constant("MAIN_ADDRESS_STATE_" . $num) . '+' . constant("MAIN_ADDRESS_ZIP_" . $num);
  $address = str_replace(' ', '+', $address);
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? 'class="' . $class . '"' : '';
  $output = '<iframe src="https://www.google.com/maps?q=' . $address . '&output=embed" width="' . $width . '" height="' . $height . '" ' . $class . ' ' . $style .'></iframe>';
  return $output;
}
add_shortcode("g_map", "G_Map");

?>