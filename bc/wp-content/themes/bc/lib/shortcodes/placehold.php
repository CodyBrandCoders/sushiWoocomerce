<?php
//--------------------------------------
// SHORTCODE: PLACEHOLD
//--------------------------------------

function Placehold($atts){
  extract(shortcode_atts(array(
    'lines' =>  null,
    'style' =>  null,
    'class' =>  null,
  ), $atts));
  $output;
  $lorem = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. ';
  $styles = $style ? 'style="' . $style . '"' : '';
  $classes = $class ? 'class="' . $class . '"'  : '';
  $output = '<p ' . $classes . ' ' . $styles . '>' . str_repeat($lorem, $lines) . '</p>';
  return $output;
}
add_shortcode("placehold", "Placehold");

?>