<?php
// optimize.php - performance & security tweaks

// Remove query strings from static resources
add_filter('script_loader_src', 'flatsome_child_remove_ver', 15, 1);
add_filter('style_loader_src', 'flatsome_child_remove_ver', 15, 1);
function flatsome_child_remove_ver($src) {
    return remove_query_arg('ver', $src);
}

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

// Remove WP version
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rest_output_link_wp_head');

// Dashicons only for admins
add_action('wp_enqueue_scripts', function(){
    if (!is_user_logged_in()) {
        wp_dequeue_style('dashicons');
    }
});

// Defer JS except jQuery (safe guard)
add_filter('script_loader_tag', function($tag, $handle) {
    if (strpos($handle, 'jquery') !== false) return $tag;
    if (strpos($tag, ' defer') !== false) return $tag;
    return str_replace(' src', ' defer src', $tag);
}, 10, 2);

// Reduce jpeg quality
add_filter('jpeg_quality', function(){ return 80; });

// Disable Heartbeat on front-end
add_action('init', function() {
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
});
