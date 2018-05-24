<?php
//--------------------------------------
// SHORTCODE: ADDRESS ATTRIBUTE
//--------------------------------------

function AddressAttr($atts, $content = null){
  extract(shortcode_atts(array(
      "num"     => '',
      "attr"    => '',
      "concat"  => false,
      "link"    => false,
  ), $atts));
  $output = '';
  if(!$link){
    if($concat){
      $output = str_replace(' ', '', constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num));
    }else{
      $output = constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num);
    }
  }else{
    if($attr == 'email'){
      $output = '<a href="mailto:' . constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num) . '">' . constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num) . '</a>';
    }if($attr == 'phone'){
      $output = '<a href="tel:+1' . sanatize_phone(constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num)) . '">' . constant("MAIN_ADDRESS_" . strtoupper($attr) . "_" . $num) . '</a>';
    }
  }
  return $output;
}
add_shortcode("address_attr", "AddressAttr");

?>