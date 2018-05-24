<?php
//--------------------------------------
// SHORTCODE: DOC SHORTCODE
//--------------------------------------

function Doc_Shortcode($atts, $content = null){
  $output = $content;
  $output = str_replace('[', '&#91;', $output);
  $output = str_replace(']', '&#93;', $output);
  $output = str_replace('<', '&lt;', $output);
  $output = str_replace('>', '&gt;', $output);
  return '<pre>' . $output . '</pre>';
}
add_shortcode("doc_shortcode", "Doc_Shortcode");

?>