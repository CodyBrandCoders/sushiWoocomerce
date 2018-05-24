<?php

 if (!function_exists('register_event_post_type')):

 	//Registering Post Type

     function register_event_post_type() {
         $labels = array(
             'name'                => __('Events'),
             'singular_name'       => __('Event'),
             'menu_name'           => __('Events'),
             'parent_item_colon'   => __('Parent Event:'),
             'all_items'           => __('All Events'),
             'view_item'           => __('View Event'),
             'add_new_item'        => __('Add New Event'),
             'add_new'             => __('Add New Event'),
             'edit_item'           => __('Edit Event'),
             'update_item'         => __('Update Event'),
             'search_items'        => __('Search Events'),
             'not_found'           => __('No Events found.'),
             'not_found_in_trash'  => __('No Events found in trash.')
         );

         $rewrite = array(
             'slug'                => 'event',
             'with_front'          => false,
             'pages'               => true,
             'feeds'               => true,
         );

         $args = array(
             'label'               => __('Event'),
             'description'         => __('Events'),
             'labels'              => $labels,
             'supports'            => array('title', 'thumbnail', 'editor'),
             'hierarchical'        => true,
             'public'              => true,
             'show_ui'             => true,
             'show_in_menu'        => true,
             'show_in_nav_menus'   => false,
             'show_in_admin_bar'   => true,
             'menu_position'       => 5,
             'menu_icon'           => 'dashicons-tickets-alt',
             'can_export'          => true,
             'has_archive'         => false,
             'exclude_from_search' => false,
             'publicly_queryable'  => true, //If Disabled, it will not let you edit the slug or permalink
             'rewrite'             => $rewrite,
             'capability_type'     => 'post'
         );

        register_post_type('event', $args);
        flush_rewrite_rules();
     }
     add_action('init', 'register_event_post_type');

 endif;


// if (!function_exists('register_staff_post_type')):
//
// 	//Registering Post Type
//
//     function register_staff_post_type() {
//         $labels = array(
//             'name'                => __('Staff'),
//             'singular_name'       => __('Staff'),
//             'menu_name'           => __('Staff'),
//             'parent_item_colon'   => __('Parent Staff:'),
//             'all_items'           => __('All Staff'),
//             'view_item'           => __('View Staff'),
//             'add_new_item'        => __('Add New Staff'),
//             'add_new'             => __('Add New'),
//             'edit_item'           => __('Edit Staff'),
//             'update_item'         => __('Update Staff'),
//             'search_items'        => __('Search Staff'),
//             'not_found'           => __('No Staff found.'),
//             'not_found_in_trash'  => __('No Staff found in trash.')
//         );
//
//         $rewrite = array(
//             'slug'                => 'staff',
//             'with_front'          => false,
//             'pages'               => true,
//             'feeds'               => true,
//         );
//
//         $args = array(
//             'label'               => __('Staff'),
//             'description'         => __('Staff'),
//             'labels'              => $labels,
//             'taxonomies'          => array(''),
//             'supports'            => array('editor','title'),
//             'hierarchical'        => true,
//             'public'              => true,
//             'show_ui'             => true,
//             'show_in_menu'        => true,
//             'show_in_nav_menus'   => false,
//             'show_in_admin_bar'   => true,
//             'menu_position'       => 5,
//             'menu_icon'           => 'dashicons-businessman',
//             'can_export'          => true,
//             'has_archive'         => false,
//             'exclude_from_search' => false,
//             'publicly_queryable'  => true, //If Disabled, it will not let you edit the slug or permalink
//             'rewrite'             => $rewrite,
//             'capability_type'     => 'post'
//         );
//         flush_rewrite_rules();
//        register_post_type('staff', $args);
//
//     }
//
//     add_action('init', 'register_staff_post_type');
//
// endif;

// if (!function_exists('register_board_of_director_post_type')):
//
// 	//Registering Post Type
//
//     function register_board_of_director_post_type() {
//         $labels = array(
//             'name'                => __('Board Of Directors'),
//             'singular_name'       => __('Board Of Director'),
//             'menu_name'           => __('Board Of Directors'),
//             'parent_item_colon'   => __('Parent Board Of Director:'),
//             'all_items'           => __('All Board Of Directors'),
//             'view_item'           => __('View Board Of Director'),
//             'add_new_item'        => __('Add New Board Of Director'),
//             'add_new'             => __('Add New'),
//             'edit_item'           => __('Edit Board Of Director'),
//             'update_item'         => __('Update Board Of Director'),
//             'search_items'        => __('Search Board Of Directors'),
//             'not_found'           => __('No Board Of Directors found.'),
//             'not_found_in_trash'  => __('No Board Of Directors found in trash.')
//         );
//
//         $rewrite = array(
//             'slug'                => 'board-of-directors',
//             'with_front'          => false,
//             'pages'               => true,
//             'feeds'               => true,
//         );
//
//         $args = array(
//             'label'               => __('Board Of Director'),
//             'description'         => __('Board Of Directors'),
//             'labels'              => $labels,
//             'taxonomies'          => array(''),
//             'supports'            => array('title'),
//             'hierarchical'        => true,
//             'public'              => true,
//             'show_ui'             => true,
//             'show_in_menu'        => true,
//             'show_in_nav_menus'   => false,
//             'show_in_admin_bar'   => true,
//             'menu_position'       => 5,
//             'menu_icon'           => 'dashicons-groups',
//             'can_export'          => true,
//             'has_archive'         => false,
//             'exclude_from_search' => false,
//             'publicly_queryable'  => true, //If Disabled, it will not let you edit the slug or permalink
//             'rewrite'             => $rewrite,
//             'capability_type'     => 'post'
//         );
//
//        register_post_type('board_of_director', $args);
//
//     }
//
//     add_action('init', 'register_board_of_director_post_type');
//
// endif;


?>
