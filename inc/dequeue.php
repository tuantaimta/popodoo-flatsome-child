<?php
// dequeue.php - remove unnecessary Flatsome Woo assets safely
add_action('wp_enqueue_scripts', function() {
    // Try to dequeue some WooCommerce files if they are registered
    wp_dequeue_style('flatsome-woocommerce');
    wp_dequeue_style('flatsome-shop');
    wp_dequeue_style('flatsome-rtl');
    wp_dequeue_script('flatsome-woocommerce-js');

}, 99);
//wp_dequeue_script('flatsome-flickity-js');
//wp_dequeue_script('flatsome-lightbox');