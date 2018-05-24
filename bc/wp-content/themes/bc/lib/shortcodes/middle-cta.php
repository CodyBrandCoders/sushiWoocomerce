<?php
//------------------------------
// SHORTCODE: MIDDLE CTA
//------------------------------

function Middle_CTA($atts, $content = null){
      extract(shortcode_atts(array(
        "class"             => null,
        "buttons"           => null,
        "onebuttonicon"       => null,
        "onebuttontext"       => null,
        "onebuttonlink"       => null,
        "onebuttontracking"   => null,
        "onebuttontarget"     => null,
        "twobuttons1icon"     => null,
        "twobuttons1text"     => null,
        "twobuttons1link"     => null,
        "twobuttons1tracking" => null,
        "twobuttons1target"   => null,
        "twobuttons2icon"     => null,
        "twobuttons2text"     => null,
        "twobuttons2link"     => null,
        "twobuttons2tracking" => null,
        "twobuttons2target"   => null,
      ), $atts));
      // One Button
      // [middle_cta buttons="1" onebuttonicon="fa-phone" onebuttontext="(407) 992-8877" onebuttonlink="tel:+14079928877" onebuttontracking="/testing/,Call Tracking - 4079928877 - Middle CTA - Mobile" onebuttontarget="_blank"]
      // Two Button
      // [middle_cta buttons="2" twobuttons1icon="fa-phone" twobuttons1text="(407) 992-8877" twobuttons1link="tel:+14079928877" twobuttons1tracking="/testing/,Call Tracking - 4079928877 - Middle CTA - Mobile" twobuttons1target="_blank" twobuttons2icon="fa-envelope" twobuttons2text="Info@BrandCoders.com" twobuttons2link="mailto:Info@BrandCoders.com" twobuttons2tracking="/testing/,Email Tracking - Info@BrandCoders.com - Middle CTA - Mobile" twobuttons2target="_blank"]
      $number_of_buttons = $buttons ? $buttons : get_field('buttons');
      $button_icon = $onebuttonicon ? $onebuttonicon : get_field('1_button_icon');
      $button_text = $onebuttontext ? $onebuttontext : get_field('1_button_text' , false, false);
      $button_link = $onebuttonlink ? $onebuttonlink : get_field('1_button_link' , false, false);
      $button_tracking = $onebuttontracking ? $onebuttontracking : get_field('1_button_tracking');
      $button_target = $onebuttontarget ? $onebuttontarget : get_field('button_target');
      $button_1_icon = $twobuttons1icon ? $twobuttons1icon : get_field('2_buttons_button_1_icon');
      $button_1_text = $twobuttons1text ? $twobuttons1text : get_field('2_buttons_button_1_text' , false, false);
      $button_1_link = $twobuttons1link ? $twobuttons1link : get_field('2_buttons_button_1_link' , false, false);
      $button_1_tracking = $twobuttons1tracking ? $twobuttons1tracking : get_field('2_buttons_button_1_tracking');
      $button_2_icon = $twobuttons2icon ? $twobuttons2icon : get_field('2_buttons_button_2_icon');
      $button_2_text = $twobuttons2text ? $twobuttons2text : get_field('2_buttons_button_2_text' , false, false);
      $button_2_link = $twobuttons2link ? $twobuttons2link : get_field('2_buttons_button_2_link' , false, false);
      $button_2_tracking = $twobuttons2tracking ? $twobuttons2tracking : get_field('2_buttons_button_2_tracking');
    if ($number_of_buttons == '1') :
      $output .= '<section class="middle-cta">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';
      $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pr15 pl15">';
      $output .= '[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_link .'" icon_before="' . $button_icon . '" tracking="' . $button_tracking . '" target="' . $button_target . '"]' . $button_text . '[/bc_btn]';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</section>';
    endif;
    if ($number_of_buttons == '2') :
      $output .= '<section class="middle-cta">';
      $output .= '<div class="container">';
      $output .= '<div class="row">';
      $output .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pr15 pl15">';
      $output .= '<div class="col-inner">';
      $output .= '[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_1_link .'" icon_before="' . $button_1_icon . '" tracking="' . $button_1_tracking . '" target="' . $button_1_target . '"]' . $button_1_text . '[/bc_btn]';
      $output .= '</div><!----><div class="col-inner">';
      $output .= '[bc_btn class="btn-color-1 text-white" size="sm" block="true" href="' . $button_2_link .'" icon_before="' . $button_2_icon . '" tracking="' . $button_2_tracking . '" target="' . $button_2_target . '"]' . $button_2_text . '[/bc_btn]';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</div>';
      $output .= '</section>';
    endif;
  return do_shortcode($output);
  }
add_shortcode("middle_cta", "Middle_CTA");

?>