<?php
/*
======================================================================
CUSTOM-ROLES.PHP - CREATE ROLES AND EDIT PERMISSIONS FOR THOSE ROLES
======================================================================
*/

/*================================================================
/* Block specific user roles from getting to WP Dashboard/Backend
=================================================================*/
function block_users_from_wp_dashboard() {
  //Allow ajax calls - make sure you keep this line so non-logged-in users are not blocked from accessing /wp-admin/admin-ajax.php
  if( defined('DOING_AJAX') && DOING_AJAX ) {
    return; //allow access
  }
  //Get current logged-in user info
  $user = wp_get_current_user();
  //Set roles that are allowed to see dashboard/backend
  $allowed_roles = array(
    'administrator', //Copy and paste additional roles that are allowed to access the dashboard
    'manager',
  );
  //Check to see if any of the current user's role does not match with any of the $allowed_roles above
  if( !array_intersect($allowed_roles, $user->roles) ) {
    //Redirect to main page if role doesn't match any $allowed_roles above
    wp_redirect( get_home_url( ) );
    exit();
  }
}
add_action( 'admin_init', 'block_users_from_wp_dashboard', 1 );

/*================================================================
/* Hide admin bar for all users EXCEPT administrator and manager
=================================================================*/
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  //Get current logged-in user info
  $user = wp_get_current_user();
  //Set roles that are allowed to see dashboard/backend
  $allowed_roles = array(
    'administrator', //Copy and paste additional roles that are allowed to have an admin bar
    'manager',
  );
  if( !array_intersect($allowed_roles, $user->roles) ) {
    //Redirect to main page if role doesn't match any $allowed_roles above
    show_admin_bar(false);
  }
}

/*================================================================
/* Prevent deletion of an Admin if your role is not "Administrator"
=================================================================*/
add_filter(
  'user_row_actions',
  function($actions, $user_object) {
    if (1 >= count($user_object->roles) && 'administrator' == $user_object->roles[0]) {
      if (!current_user_can('administrator')) {
        unset($actions['delete']);
      }
    }
    return $actions;
  },
  1,2
);
add_action( 'wp_loaded', 'removeUsersDeleteDropdown' );
function removeUsersDeleteDropdown() {
    if ( !current_user_can( 'administrator' ) ) {
      add_filter( 'bulk_actions-users', '__return_empty_array' );
    }
}

/*======================
  MANAGER ROLE - CAPABILITIES (PERMISSIONS) AND VIEW CONTROL
  All capabilities can be found @ https://codex.wordpress.org/Roles_and_Capabilities
=======================*/

// Add Manager Role
$capabilities_manager = array(
  //---------------------------------------//
  // MANAGER ROLE - STANDARD CAPABILITIES
  //---------------------------------------//
  //Dashboard
  'edit_dashboard' => false,
  //Posts
  'publish_posts' => true,
  'edit_posts' => true,
  'delete_posts' => true,
  'edit_others_posts' => true,
  'delete_others_posts' => true,
  'read_private_posts' => true,
  'edit_private_posts' => true,
  'delete_private_posts' => true,
  'edit_published_posts' => true,
  'delete_published_posts' => true,
  //Post Categories
  'manage_categories' => true,
  //Pages
  'read' => true,
  'publish_pages' => true,
  'edit_pages' => true,
  'delete_pages' => true,
  'edit_others_pages' => true,
  'delete_others_pages' => true,
  'read_private_pages' => true,
  'edit_private_pages' => true,
  'delete_private_pages' => true,
  'edit_published_pages' => true,
  'delete_published_pages' => true,
  //Taxonomies
  'manage_links' => true,
  //Comments
  'moderate_comments' => true,
  //---------------------------------------//
  //  MANAGER ROLE - ADMINISTRATOR LEVEL CAPABILITIES
  //---------------------------------------//
  //ADMIN - WordPress Global Settings and Actions (Sensitive)
  'manage_options' => false, //Removes "Settings" Link along with all Plugin links like "SEO" (Yoast), etc. on Dashboard Menu
  'upload_files' => true,
  'edit_files' => true,
  'delete_site' => true,
  'update_core' => false, //Removes "Updates" Submenu Link under "Dashboard" on Dashboard Menu
  'unfiltered_html' => true,
  'export' => true,
  'import' => true,
  //ADMIN - Plugins // Removes "Plugins" Link on Dashboard Menu If all 6 = false
  'activate_plugins' => false, //Not ADMIN level, but moved here for ease
  'upload_plugins' => false,
  'install_plugins' => false,
  'update_plugins' => false,
  'edit_plugins' => false,
  'delete_plugins' => false,
  //ADMIN - Themes // Removes "Appearance" Link on Dashboard Menu If all 8 = false
  'edit_theme_options' => false, //Not ADMIN level, but moved here for ease, controls appearance of "Menus" and "Customize" links
  'customize' => false, //Not ADMIN level, but moved here for ease
  'switch_themes' => false, //Not ADMIN level, but moved here for ease
  'upload_themes' => false,
  'install_themes' => false,
  'update_themes' => false,
  'edit_themes' => false,
  'delete_themes' => false,
  //ADMIN - User Management // Removes "Users" Link on Dashboard Menu If all 6 = false
  'list_users' => false,
  'edit_users' => true, // Shows "Profile" instead of "Users" If all other 5 are false and this is true
  'promote_users' => false,
  'create_users' => false,
  'delete_users' => false,
  'remove_users' => false, //Multi-Site only - removes from site, but keeps user globally. Use ADMIN privelage "delete_users" if you would like to give ability to delete a user.
);
// Safeguard to make sure roles get correct capabilities
remove_role('manager');
// Add Role
add_role('manager', 'Manager', $capabilities_manager);

//---------------------------------------//
// MANAGER ROLE - REMOVE DASHBOARD PAGES
//---------------------------------------//
function remove_dashboard_pages() {
  // Grab current user id
  global $user_ID;
  // Check current user role, look for grocery and remove dashboard menu pages
  if ( current_user_can( 'manager' ) ) {
    remove_menu_page( 'index.php' );                              //Remove "Dashboard" Link
    // remove_menu_page( 'edit.php?post_type=staff' );               //Remove Staff System Link (Staff System must be enabled for page to show)
    // remove_menu_page( 'edit.php?post_type=board_of_director' );   //Remove Board of Directors System Link (Board of Directors System must be enabled for page to show)
    // remove_menu_page( 'global-content' );                         //Remove Global Content Link
    remove_menu_page( 'edit.php?post_type=event' );               //Remove Event System Link (Event System must be enabled for page to show)
    // remove_menu_page( 'edit.php' );                               //Remove "Posts" Link
    // remove_menu_page( 'edit.php?post_type=page' );                //Remove "Pages" Link
    // remove_menu_page( 'upload.php' );                             //Remove "Media" Link
    // remove_menu_page( 'edit.php?post_type=text-blocks' );         //Remove "Text Blocks" Link
    remove_menu_page( 'tools.php' );                              //Remove "Tools" Link
    remove_menu_page( 'edit-comments.php' );                      //Remove "Comments" Link
    remove_menu_page( 'wpcf7' );                                  //Remove "Contact Form 7" Link
    // remove_menu_page( 'profile.php' );                            //Remove "Profile" Link if showing - "Users" Link can be controlled through capabilities manager above.
    remove_menu_page( 'edit.php?post_type=acf-field-group' );     //Remove "Custom Fields" ACF Link
  }
}
add_action( 'admin_init', 'remove_dashboard_pages');

//---------------------------------------//
// MANAGER ROLE - ADD DASHBOARD PAGES
//---------------------------------------//
function add_dashboard_pages() {
    // Grab current user id
    global $user_ID;
    // Check current user role, look for role name and add custom dashboard pages to that role
    if ( current_user_can( 'manager' ) ) {
    // add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
       add_menu_page( 'Edit Menu', 'Edit Menu', 'edit_posts', 'post.php?post=1345&action=edit', '', 'dashicons-layout', 6 );
    }
}
add_action( 'admin_menu', 'add_dashboard_pages');

//---------------------------------------//
// MANAGER ROLE - REMOVE ITEMS FROM CONTENT MENU
//---------------------------------------//
function remove_new_content_menu( $wp_admin_bar ) {
  $user = wp_get_current_user();
  if ( in_array( 'manager', (array) $user->roles ) ) {
        $wp_admin_bar->remove_node( 'new-content' );
        $wp_admin_bar->remove_node( 'comments' );
        $wp_admin_bar->remove_node( 'wpseo-menu' );
        $wp_admin_bar->remove_node( 'wp-logo' );
    }
}
add_action( 'admin_bar_menu', 'remove_new_content_menu', 999 );

//---------------------------------------//
// MANAGER ROLE - RESTRICT WHICH ROLES MANAGER CAN CREATE AND EDIT
//---------------------------------------//

// // Helper function get getting roles that the user is allowed to create/edit/delete.
// function wpse_188863_get_allowed_roles( $user ) {
//     $allowed = array();

//     if ( in_array( 'administrator', $user->roles ) ) { // Admin can edit all roles
//         $allowed = array_keys( $GLOBALS['wp_roles']->roles );
//     } elseif ( in_array( 'manager', $user->roles ) ) {
//         $allowed[] = 'fob';
//         $allowed[] = 'delivered';
//         $allowed[] = 'delivered_west';
//         $allowed[] = 'fedex';
//         $allowed[] = 'canada';
//     } 

//     return $allowed;
// }

// //Remove roles from user creation that MANAGER should not be able to edit.
// function wpse_188863_editable_roles( $roles ) {
//     if ( $user = wp_get_current_user() ) {
//         $allowed = wpse_188863_get_allowed_roles( $user );

//         foreach ( $roles as $role => $caps ) {
//             if ( ! in_array( $role, $allowed ) )
//                 unset( $roles[ $role ] );
//         }
//     }

//     return $roles;
// }
// add_filter( 'editable_roles', 'wpse_188863_editable_roles' );

// //Prevent users deleting/editing users with a role outside their allowance.
// function wpse_188863_map_meta_cap( $caps, $cap, $user_ID, $args ) {
//     if ( ( $cap === 'edit_user' || $cap === 'delete_user' ) && $args ) {
//         $the_user = get_userdata( $user_ID ); // The user performing the task
//         $user     = get_userdata( $args[0] ); // The user being edited/deleted

//         if ( $the_user && $user && $the_user->ID != $user->ID /* User can always edit self */ ) {
//             $allowed = wpse_188863_get_allowed_roles( $the_user );

//             if ( array_diff( $user->roles, $allowed ) ) {
//                 // Target user has roles outside of our limits
//                 $caps[] = 'not_allowed';
//             }
//         }
//     }

//     return $caps;
// }
// add_filter( 'map_meta_cap', 'wpse_188863_map_meta_cap', 10, 4 );

//---------------------------------------//
// MANAGER ROLE - REDIRECT ON ROLE RESTRICTED PAGES
//---------------------------------------//

// function redirect_on_restricted_role() {
//     $user = wp_get_current_user();
//     $current_screen = get_current_screen();
//     if( isset( $user->roles[0] ) ){
//          $current_role = $user->roles[0];
//     }
//     if ( $current_role == 'manager') {
//       //User can directly access the add new page so you can redirect the user
//       if( "add" === $current_screen->action && "page" == $current_screen->post_type ) {
//         wp_redirect('htpp://www.url.com');  //SET URL
//       }
//     }
// }
// add_action( 'current_screen','redirect_on_restricted_role' );
