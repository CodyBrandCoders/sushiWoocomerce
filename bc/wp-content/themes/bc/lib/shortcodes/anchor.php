<?php
//--------------------------------------
// SHORTCODE: ANCHOR
//--------------------------------------

function Anchor($atts){
  extract(shortcode_atts(array(
    'href' => null,
    'mail' => null,
    'phone' => null,
    'content' => null,
    'style' => null,
    'class' => null,
    'target' => null,
    'btn_switch'  => false,
    'icon_before' => false,
    'icon_after' => false,
    'btn_class' => 'btn-md btn-color-1',
    'tracking' => false
  ), $atts));
  $tracking_array = null;
  $tracking_data = '';
  if($tracking) {
    $tracking_array = explode( ',',  $tracking);
    $tracking_data = (count($tracking_array) > 1) ? 'onclick="gtag(\'event\', \'Button Tracking\', { \'event_category\':\'' .  $tracking_array[0] .  '\', \'event_label\':\'' .  $tracking_array[1] .  '\'});"' : 'onclick="gtag(\'event\', \'Button Tracking\', { \'event_category\':\'' .  $tracking_array[0] .  '\', \'event_label\':\'' .  $tracking_array[0] .  '\'});"';
  }
  $output;
  $link;
  if($href){
    $link = $href;
  }else if($mail){
    $link = 'mailto:' . $mail;
  }else if($phone){
    $link = 'tel:+1' . $phone;
  }
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? 'class="' . $class . '"' : '';
  $target = $target ? 'target="' . $target . '"' : '';
  if($icon_before){
    $displayIconBefore = '<i class="fa ' . $icon_before . '"></i>&nbsp; ';
  } else {
    $displayIconBefore = "";
  }
  if($icon_after){
    $displayIconAfter = ' &nbsp;<i class="fa ' . $icon_after . '"></i>';
  } else {
    $displayIconAfter = "";
  }
  if($btn_switch){
    $output = '<span class="hidden-mobile">' . '<a href="' . $link . '" ' . $class . ' ' . $style . ' ' . $target . ' ' . $tracking_data . '>' . $displayIconBefore . $content . $displayIconAfter . '</a>' . '</span>';
    $output .= '<span class="visible-mobile">' . '<a href="' . $link . '" class="btn ' . $btn_class . '" ' . $style . ' ' . $target . ' ' . $tracking_data . '>' . $displayIconBefore . $content . $displayIconAfter . '</a>' . '</span>';
  }else{
    $output = '<a href="' . $link . '" ' . $class . ' ' . $style . ' ' . $target . ' ' . $tracking_data . '>' . $displayIconBefore . $content . $displayIconAfter . '</a>';
  }
  return $output;
}
add_shortcode("anchor", "Anchor");

?>