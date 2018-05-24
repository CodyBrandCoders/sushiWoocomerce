<?php
//--------------------------------------
// SHORTCODE: COLUMNS
//--------------------------------------

function Col($atts, $content = null){
  extract(shortcode_atts(array(
    'flex' => null,
    'style' => null,
    'class' => null,
  ), $atts));
  $style = $style ? 'style="' . $style . '"' : '';
  $class = $class ? $class  : '';
  $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $flex, FILTER_SANITIZE_STRING ) );
  $flex_array = explode( ',', $no_whitespaces );
  $col_array = array('col-xs-', 'col-sm-', 'col-md-', 'col-lg-');
  $output = '<div class="';
  foreach($flex_array as $index => $flex){
    $output .= $col_array[$index] . $flex . ' ';
  }
  $output .= $class  . '" ' . $style . '>';
  $output .= do_shortcode($content);
  $output .= '</div>';
  return $output;

}
add_shortcode("col", "Col");
add_shortcode("col_nest", "Col");

?>