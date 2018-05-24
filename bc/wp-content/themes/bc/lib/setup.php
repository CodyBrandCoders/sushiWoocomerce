<?php
//-----------------------
// Setup
//----------------------

// Changing the_excerpt() and get_the_excerpt() 'read more'
function bc_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'bc_excerpt_more' );

// Changing the # of characters in the_excerpt() and get_the_excerpt()
function bc_custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'bc_custom_excerpt_length', 999 );

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Disable Auto <p> tags
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

// Disable Visual Editor For ALL Users
add_filter( 'user_can_richedit' , '__return_false', 50 );

// Registering Menus
if(!function_exists('register_theme_menus')):
  function register_theme_menus(){
    register_nav_menus(array(
      'primary' => 'Primary Menu',
      'mobile' => 'Mobile Menu',
    ));
  }
  add_action('after_setup_theme', 'register_theme_menus');
endif;

// Regiestering Global Options Page
if (function_exists('acf_add_options_page')) :
  acf_add_options_page(array(
      'page_title' => 'Global Content Settings',
      'position'   => '4',
      'menu_title' => 'Global Content',
      'menu_slug'  => 'global-content',
      'capability' => 'edit_posts',
      'redirect'   => false,
      'icon_url'   => 'dashicons-admin-site'
  ));
endif;

/* Changes The Image On The Login Page */
function my_login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url('/bc/wp-content/uploads/brandcoders-logo-red.png');
            padding-bottom: 30px;
            background-size: contain;
            background-position: center center;
            width: 100%;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

/* Takes You To Brandcoders.com If Logo On Login Page Is Clicked  */
function my_login_logo_url() {
    return 'http://brandcoders.com';
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

//-----------------------------
// Hide Editor For Sub Page Template
//-----------------------------

add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
	// Get the Post ID.
	$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	if( !isset( $post_id ) ) return;

	// Get the name of the Page Template file.
	$template_file = get_post_meta($post_id, '_wp_page_template', true);

    if($template_file == 'template-sub-page.php' || $template_file == 'template-featured-menu.php'){ // edit the template name
    	remove_post_type_support('page', 'editor');
    }
}
?>
