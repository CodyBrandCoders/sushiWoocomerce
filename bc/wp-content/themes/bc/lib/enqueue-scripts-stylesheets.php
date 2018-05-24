<?php
//------------------------------
// ENQUEUE STYLESHEETS & SCRIPTS
//------------------------------
function bc_enqueue_scripts() {

//----------------
// ENQUEUE ALL STYLESHEETS 
//----------------

  //Bower Component Styles // Array: key = name of plugin ( any name, just keep it unique ) // value = the path ( from bower_components ) to the plugins CSS //
  global $bower_components_styles;
  $bower_components_styles = array(
    "lightbox"    => "lightbox2/dist/css/lightbox.min.css",
    "slick"       => "slick-carousel/slick/slick.css",
    "slick_theme" => "slick-carousel/slick/slick-theme.css",
    "animate"     => "animate.css/animate.min.css",
    "tipped"      => "tipped/css/tipped/tipped.css",
    "aos"         => "aos-animateonscroll/aos.css",
  );
  foreach( $bower_components_styles as $name=>$path ) :
    wp_enqueue_style( 'bc-style-' . $name, get_template_directory_uri() . '/bower_components/' . $path, array(), '1.0.0' );
  endforeach;

  //Enqueue Custom Theme Font Stylesheet
  wp_enqueue_style('bc-style-fonts', get_template_directory_uri() . '/fonts/customfonts.php', array(), '1.0.0');

//----------------
// ENQUEUE ALL SCRIPTS
//----------------

  //Bower Component Scripts // Array: key = name of plugin ( any name, just keep it unique ) // value = the path ( from bower_components ) to the plugins Javascript //
  global $bower_components_scripts;
  $bower_components_scripts = array(
    //"jquery"        => "jquery/dist/jquery.min.js",
    "slick"         => "slick-carousel/slick/slick.min.js",
    "bootstrap"     => "bootstrap/dist/js/bootstrap.min.js",
    "lightbox"      => "lightbox2/dist/js/lightbox.min.js",
    "waypoints"     => "waypoints/lib/jquery.waypoints.min.js",
    "matchHeight"   => "matchHeight/jquery.matchHeight-min.js",
    "vide"          => "vide/dist/jquery.vide.min.js",
    "countTo"       => "jquery-countTo/jquery.countTo.js",
    "smoothScroll"  => "jquery-smooth-scroll/jquery.smooth-scroll.min.js",
    "tipped"        => 'tipped/js/tipped/tipped.js',
    "aos"           => 'aos-animateonscroll/aos.js',
  );
  foreach( $bower_components_scripts as $name=>$path ) :
    wp_enqueue_script('bc-script-' . $name, get_template_directory_uri() . '/bower_components/' . $path, array(), '1.0.0', true);
  endforeach;

  //Enqueue Built-In Theme Javascript File
  wp_enqueue_script('bc-script-theme-js', get_template_directory_uri() . '/js/theme.js', array(), '1.0.0', true);
  //Enqueue Custom Javascript File
  wp_enqueue_script('bc-script-main-js', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);

}
add_action( 'wp_enqueue_scripts', 'bc_enqueue_scripts' );

//-----------------------------------
// LESS TO CSS COMPILER CONFIGURATION
// This Script Compiles and Injects Our LESS into a new CSS folder and links it in the header
//-----------------------------------
if(!is_admin()) :
  function theme_enqueue_styles() {
      global $bower_components_styles;
      /* Our Themes Less Files Depend on all of our Bower Component Files */
      $deps = array();
      foreach( $bower_components_styles as $name=>$path ) :
        array_push($deps, 'bc-style-' . $name);
      endforeach;
      wp_enqueue_style('theme-main', get_template_directory_uri().'/less/_imports.less', $deps);
  }
  /* ENQUEUE LESS FILES */
  add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
endif;

//-----------------------------------
// TURN ON MINIFY COMPRESSION FOR WP-LESS
//-----------------------------------
add_action('wp-less_compiler_construct_pre', function($compiler) {
  $compiler->setFormatter('compressed');
});

//-----------------------------------
// ASYNCHRONOUS SCRIPT LOADER
// Add "#asyncload" to the end of any enqueued script url above to make it load asynchronously. Increases Google PageSpeed Insights Rating.
//-----------------------------------
function bc_async_script_loader($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
  return str_replace( '#asyncload', '', $url )."' async='async"; 
}
add_filter( 'clean_url', 'bc_async_script_loader', 11, 1 );

?>