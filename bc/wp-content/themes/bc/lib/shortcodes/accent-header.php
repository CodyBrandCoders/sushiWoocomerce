<?php
//--------------------------------------
// SHORTCODE: ACCENT HEADER
//--------------------------------------

function AccentHeader($atts, $content = null){
  extract(shortcode_atts(array(
    'style' =>  null,
    'class' =>  null,
    'level' =>  null,
    'accent' => 'single'
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? $class  : '';
  $accent_class = 'accent-' . $accent;
  $output = '<' . $level . ' class="' . $accent_class . ' ' . $class . '" ' . $style . '><span>' . $content . '</span></' . $level . '>';
  return $output;
}
add_shortcode("accent_header", "AccentHeader");

?>