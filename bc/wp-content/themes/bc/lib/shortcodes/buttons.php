<?php
//------------------------------
// SHORTCODE: BUTTONS
//------------------------------

function BC_BTN($atts, $content = null){
  extract(shortcode_atts(array(
      "href"           => '#',
      "size"           => 'md',
      "class"          => null,
      "style"          => null,
      "block"          => false,
      "icon_before"    => false,
      "icon_after"     => false,
      "target"         => false,
      "data"           => false,
      "tracking"       => false
  ), $atts));
  $tracking_array = null;
  $tracking_data = '';
  if($tracking) {
    $tracking_array = explode( ',',  $tracking);
    $tracking_data = (count($tracking_array) > 1) ? 'onclick="gtag(\'event\', \'Button Tracking\', { \'event_category\':\'' .  $tracking_array[0] .  '\', \'event_label\':\'' .  $tracking_array[1] .  '\'});"' : 'onclick="gtag(\'event\', \'Button Tracking\', { \'event_category\':\'' .  $tracking_array[0] .  '\', \'event_label\':\'' .  $tracking_array[0] .  '\'});"';
  }
  $target = $target ? 'target="' . $target . '"' : '';
  $output = '<a href="' . $href . '"' . $data . ' ' . $tracking_data . ' ' . $target . ' class="btn ';
  switch($size){
    case 'small':
    case 'sm':
      $output .= 'btn-sm ';
      break;
    case 'medium':
    case 'md':
      $output .= 'btn-md ';
      break;
    case 'large':
    case 'lg':
      $output .= 'btn-lg ';
      break;
    case 'xlg':
    case 'x-lg':
    case 'x-large':
      $output .= 'btn-xlg ';
      break;
  }
  if($block){
    $output .= 'btn-block ';
  }
  if($class && $style){
    $output .= $class . '" style="' . $style . '">';
  }else if($class && !$style){
    $output .= $class . '">';
  }else if($style && !$class){
    $output .= '" style="' . $style . '">';
  }else{
    $output .= '">';
  }
  if($icon_before){
    $output .= '<i class="fa ' . $icon_before . '"></i>&nbsp; ';
  }
  $output .= $content;
  if($icon_after){
    $output .= ' &nbsp;<i class="fa ' . $icon_after . '"></i>';
  }
  $output .= '</a>';
  return $output;
}
add_shortcode("bc_btn", "BC_BTN");

?>