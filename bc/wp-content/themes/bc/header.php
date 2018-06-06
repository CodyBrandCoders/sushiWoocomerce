<?php
  // Logos
  $desktop_logo = '/bc/wp-content/uploads/contact-form-logo-1.png';
  $desktop_logo_alt = 'The Sushi Experience';
  $mobile_logo = '/bc/wp-content/uploads/contact-form-logo-1.png';
  $mobile_logo_alt = 'The Sushi Experience';

  // Left Navbar Cols
  $left_cols_flex = 'col-xs-4 col-sm-4 col-md-3 col-lg-3';

  // Right Navbar Cols
  $right_cols_flex = 'col-xs-8 col-sm-8 col-md-9 col-lg-9';

  // Topbar or No Topbar
  $topbar = false;

  // Shrink Navbar On Scroll
  $navbar_shrink_on_scroll = true;

  // Break Point To Mobile. Use either 768 or 992 (AS A STRING!!!! NO UNITS!!!);
  $mobile_break_point = '992'; //px

  // Mobile Phone Button
  $mobile_phone_button = true;

  // Mobile Location Finder Button
  $mobile_location_button = true;

  // Mobile Search Button
  $mobile_search_button = true;

  // Fixed Nav on Mobile
  $sticky_mobile_nav = true;

  // Bringing In Social Array
  global $social_array;

  // set to true and change styles in navbar.less to change look of
  // navbar after it clears page banner or a slider
  $navbar_style_change_after_banner = true;

  // the class name of element (with the . ) in which you want the style
  // change to take place after it passes that element
  // by default, both [page_banner] and [page_banner_large] have .nav-clear-point
  $navbar_style_change_active_after = '.nav-clear-point';

  // set this to true if you want the page content to start under the navbar
  // Meaning the page banner will sit under the navbar.
  $navbar_sit_over_banner = true;


  // Landing Page Menu

  // Shrink Navbar On Scroll Landing
  $navbar_shrink_on_scroll_landing = true;


  // Bringing In Social Array
  global $social_array;

  // set to true and change styles in navbar.less to change look of
  // navbar after it clears page banner or a slider
  $navbar_style_change_after_banner_landing = true;

  // the class name of element (with the . ) in which you want the style
  // change to take place after it passes that element
  // by default, both [page_banner] and [page_banner_large] have .nav-clear-point
  $navbar_style_change_active_after_landing = '.nav-clear-point';

  // set this to true if you want the page content to start under the navbar
  // Meaning the page banner will sit under the navbar.
  $navbar_sit_over_banner_landing = false;

?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="author" content="BrandCoders LLC | Orlando, Florida Website Design">
    
    <?php //ENABLE PHONE TRACKING SCRIPT IF USING NUMBER CHANGING FROM GOOGLE

    /*** Google Number Changer For PPC Tracking ***/

    /*** ADD UNIQUE PNONE NUMBER REPLACEMENT SCRIPT HERE ***/
    /*** >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ***/
    /*** >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ***/
    /*** >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> ***/
    /*** END ADD UNIQUE PNONE NUMBER REPLACEMENT SCRIPT HERE ***/

    // <script type="text/javascript">
    // var callback = function(formatted_number, mobile_number) {
    //   // formatted_number: number to display, in the same format as the number passed to _googWcmGet(). (EX: '(XXX) XXX-XXXX')
    //   // mobile_number: number formatted for use in a clickable link with tel:-URI (EX: '+1XXXXXXXXXX')
    //   var e = document.getElementById("number_link");
    //   e.href = "tel:" + mobile_number;
    //   e.innerHTML = "";
    //   e.appendChild(document.createTextNode(formatted_number));
    // };
    // </script>
    /*** END Google Number Changer For PPC Tracking ***/ ?>

    <!-- GOOGLE ANALYTICS TRACKING CODE  -->

    <?php //ONLY DISPLAY ANALYTICS IF WEBSITE IS QUICKPLUGINS.COM
    //DELETE THIS ON LIVE SITES
    $host = $_SERVER['SERVER_NAME'];
    if($host == 'quickplugins.com') { ?>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-96999475-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments)};
      gtag('js', new Date());
      gtag('config', 'UA-96999475-1');
    </script>
    <?php } //END ONLY DISPLAY ANALYTICS IF WEBSITE IS QUICKPLUGINS.COM ?>

    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- PASTE GOOGLE TRACKING CODE HERE -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
    <!-- >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

    <!-- END GOOGLE ANALYTICS TRACKING CODE -->
</head>
<body <?php body_class(); ?>>
<?php
  /* Mobile Links */
?>
<div class="mobile-nav-links">
  <?php wp_nav_menu( array( 'theme_location' => 'mobile', 'depth' => 0 ) ); ?>
</div>

<?php if( is_home() || is_front_page() ) { ?>

<?php
  /* Topbar */
?>
<?php if($topbar) : ?>
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <p class="topbar-left">
            <?php foreach($social_array as $social_key => $social_value) : ?>
              <?php if($social_value) : ?>
                <?php
                  switch ($social_key) {
                    case 'facebook':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Facebook - Header - All Devices\'});"><i class="fab fa-facebook-square"></i></a>';
                    break;
                    case 'google':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Google Plus - Header - All Devices\'});"><i class="fab fa-google-plus-square"></i></a>';
                    break;
                    case 'twitter':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Twitter - Header - All Devices\'});"><i class="fab fa-twitter-square"></i></a>';
                    break;
                    case 'youtube':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - YouTube - Header - All Devices\'});"><i class="fab fa-youtube-play"></i></a>';
                    break;
                    case 'linkedin':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - LinkedIn - Header - All Devices\'});"><i class="fab fa-linkedin"></i></a>';
                    break;
                    case 'instagram':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Instagram - Header - All Devices\'});"><i class="fab fa-instagram"></i></a>';
                    break;
                    case 'yelp':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Yelp - Header - All Devices\'});"><i class="fab fa-yelp"></i></a>';
                    break;
                    case 'pinterest':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Pinterest - Header - All Devices\'});"><i class="fab fa-pinterest-square"></i></a>';
                    break;
                  }
                ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </p>
          <p class="topbar-right">
            <a href="mailto:<?php echo MAIN_ADDRESS_EMAIL_1; ?>" onclick="gtag('event', 'Email Tracking', { 'event_category':'Header', 'event_label':'Email Tracking - <?php echo MAIN_ADDRESS_EMAIL_1; ?> - Top Bar - Desktop'});"><i class="fa fa-envelope" style="color: #FFF;"></i>&nbsp; <?php echo MAIN_ADDRESS_EMAIL_1; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="tel:<?php echo sanatize_phone(MAIN_ADDRESS_PHONE_1); ?>" class="number_link" onclick="gtag('event', 'Call Tracking', { 'event_category':'Header', 'event_label':'Call Tracking - <?php echo MAIN_ADDRESS_PHONE_1; ?> - Top Bar - Desktop'});"><i class="fa fa-phone" style="color: #FFF;"></i>&nbsp; <span class="number"><?php echo MAIN_ADDRESS_PHONE_1; ?></span></a>
          </p>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php
  /* Desktop - Tablet Menu */
  $nav_break = 'nav-break-' .   $mobile_break_point;
?>
<?php if(!$navbar_sit_over_banner){ echo '<div class="desktop-nav-wrap ' . $nav_break .  '" >'; }; ?>
 <div <?php if(is_user_logged_in() && !$topbar) { echo 'style="margin-top: 32px;background-color:" '; } ?> class="primary-nav <?php echo $nav_break . ' '; if($topbar){ echo 'topbar-active';}else{ echo 'fixed-top'; }; if($navbar_shrink_on_scroll){ echo ' primary-nav-shrink';};if($navbar_style_change_after_banner){ echo ' navbar-style-change';};if($navbar_sit_over_banner){ echo ' navbar-sit-over-banner';}; ?>" <?php if($navbar_style_change_after_banner){ echo 'data-change="' . $navbar_style_change_active_after . '"';}; ?>>
    <div class="container">
      <div class="header-social-icons">
        <?php foreach($social_array as $social_key => $social_value) : ?>
              <?php if($social_value) : ?>
                <?php
                  switch ($social_key) {
                    case 'facebook':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Facebook - Header - All Devices\'});"><i class="fab fa-facebook-square text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'google':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Google Plus - Header - All Devices\'});"><i class="fab fa-google-plus-square"></i></a>';
                    // break;
                    case 'twitter':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Twitter - Header - All Devices\'});"><i class="fab fa-twitter-square text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'youtube':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - YouTube - Header - All Devices\'});"><i class="fab fa-youtube-play"></i></a>';
                    // break;
                    // case 'linkedin':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - LinkedIn - Header - All Devices\'});"><i class="fab fa-linkedin"></i></a>';
                    // break;
                    case 'instagram':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Instagram - Header - All Devices\'});"><i class="fab fa-instagram text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'yelp':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Yelp - Header - All Devices\'});"><i class="fab fa-yelp"></i></a>';
                    // break;
                    // case 'pinterest':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Pinterest - Header - All Devices\'});"><i class="fab fa-pinterest-square"></i></a>';
                    // break;
                  }
                ?>
              <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <div class="row">
        <div class="<?php echo $left_cols_flex; ?> nav-logo prn">
          <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $desktop_logo; ?>" alt="<?php echo $desktop_logo_alt; ?>" /></a>
        </div>
        <div class="<?php echo $right_cols_flex; ?> pln">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 0 ) ); ?>
        </div>
      </div>
    </div>
  </div>
<?php if(!$navbar_sit_over_banner){ echo '</div>'; }; ?>

<?php }else{ ?>

<?php
  /* Desktop - Tablet Menu */
  $nav_break = 'nav-break-' .   $mobile_break_point;
?>

<?php if(!$navbar_sit_over_banner_landing){ echo '<div class="desktop-nav-wrap ' . $nav_break .  '" >'; }; ?>
 <div <?php if(is_user_logged_in() && !$topbar_landing) { echo 'style="margin-top: 32px;" '; } ?> class="primary-nav primary-nav-landing bg-color-3 <?php echo $nav_break_landing . ' '; if($topbar){ echo 'topbar-active';}else{ echo 'fixed-top'; }; if($navbar_shrink_on_scroll_landing){ echo ' primary-nav-shrink';};if($navbar_style_change_after_banner_landing){ echo ' navbar-style-change';};if($navbar_sit_over_banner_landing){ echo ' navbar-sit-over-banner';}; ?>" <?php if($navbar_style_change_after_banner_landing){ echo 'data-change="' . $navbar_style_change_active_after_landing . '"';}; ?>>
    <div class="container">
      <div class="header-social-icons">
          <?php foreach($social_array as $social_key => $social_value) : ?>
              <?php if($social_value) : ?>
                <?php
                  switch ($social_key) {
                    case 'facebook':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Facebook - Header - All Devices\'});"><i class="fab fa-facebook-square text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'google':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Google Plus - Header - All Devices\'});"><i class="fab fa-google-plus-square"></i></a>';
                    // break;
                    case 'twitter':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Twitter - Header - All Devices\'});"><i class="fab fa-twitter-square text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'youtube':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - YouTube - Header - All Devices\'});"><i class="fab fa-youtube-play"></i></a>';
                    // break;
                    // case 'linkedin':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - LinkedIn - Header - All Devices\'});"><i class="fab fa-linkedin"></i></a>';
                    // break;
                    case 'instagram':
                      echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Instagram - Header - All Devices\'});"><i class="fab fa-instagram text-white font-size-24 mr10"></i></a>';
                    break;
                    // case 'yelp':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Yelp - Header - All Devices\'});"><i class="fab fa-yelp"></i></a>';
                    // break;
                    // case 'pinterest':
                    //   echo '<a target="_blank" href="' . $social_value . '" onclick="gtag(\'event\', \'Social Tracking\', { \'event_category\':\'Header\', \'event_label\':\'Social Tracking - Pinterest - Header - All Devices\'});"><i class="fab fa-pinterest-square"></i></a>';
                    // break;
                  }
                ?>
              <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <div class="row">
        <div class="<?php echo $left_cols_flex; ?> nav-logo-landing prn">
          <a href="<?php echo get_home_url(); ?>"><img src="<?php echo $desktop_logo; ?>" alt="<?php echo $desktop_logo_alt; ?>" /></a>
        </div>
        <div class="<?php echo $right_cols_flex; ?> pln">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 0 ) ); ?>
        </div>
      </div>
    </div>
  </div>
<?php if(!$navbar_sit_over_banner_landing){ echo '</div>'; }; ?>

<?php } ?>

<?php
  /* Mobile Menu */
?>
<?php if($sticky_mobile_nav){ echo '<div class="mobile-nav-wrap ' . $nav_break . '">';} ?>
  <div class="mobile-nav <?php echo $nav_break . ' '; if($sticky_mobile_nav){ echo 'mobile-nav-fixed' ;}; ?>">
    <div class="container">
      <div class="row row-first">
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pls prn nav-col-left">
          <a href="#" class="mobile-nav-toggle nav-button"><i class="fa fa-bars"></i></a>
          <?php if($mobile_search_button) : ?>
            <a href="#" target="_blank" class="mobile-nav-search nav-button"><i class="fa fa-search"></i></a>
          <?php endif; ?>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pln prn text-center">
          <a class="nav-logo" href="<?php echo get_home_url(); ?>"><img src="<?php echo $mobile_logo; ?>" alt="<?php echo $mobile_logo_alt; ?>" /></a>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pln prs nav-col-right">
          <?php if($mobile_phone_button) : ?>
            <a href="tel:<?php echo sanatize_phone(MAIN_ADDRESS_PHONE_1);?>" class="mobile-nav-phone nav-button" onclick="gtag('event', 'Call Tracking', { 'event_category':'Header', 'event_label':'Call Tracking - <?php echo MAIN_ADDRESS_PHONE_1; ?> - Header - Mobile'});"><i class="fa fa-phone"></i></a>
          <?php endif; ?>
          <?php if($mobile_location_button) : ?>
            <a href="<?php echo MAIN_ADDRESS_DIRECTIONS_1;?>" target="_blank" class="mobile-nav-location nav-button" onclick="gtag('event', 'Map Tracking', { 'event_category':'Header', 'event_label':'Map Tracking - Header - Mobile'});"><i class="fa fa-map-marker-alt"></i></a>
          <?php endif; ?>
        </div>
        <?php if($mobile_search_button) : ?>
          <div class="mobile-nav-search-form" style="display: none;">
            <form style="" role="search" method="get" id="searchform" class="navbar-search-form" action="<?php echo get_home_url(); ?>" _lpchecked="1"><input type="text" value="" name="s" id="s"><button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button></form>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php if($sticky_mobile_nav){ echo '</div>';}; ?>
