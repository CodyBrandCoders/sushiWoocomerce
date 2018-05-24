<?php
//--------------------------------------
// SHORTCODE: TEMPLATE VERSION
//--------------------------------------

function Version(){
  return constant('BC_TEMPLATE_VERSION');
}
add_shortcode("version", "Version");

?>