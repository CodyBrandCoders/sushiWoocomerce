<?php
// Parameters for the funciton: 
// add_image_size($name, $width, $height, $crop_from)

if (!function_exists('add_theme_image_sizes')):

    function add_theme_image_sizes() {
       add_image_size('{ NAME_THE_THUMBNAIL }', 400, 400, array('center', 'center'));
    }

    add_action('after_setup_theme', 'add_theme_image_sizes');

endif;
?>
