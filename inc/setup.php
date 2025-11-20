<?php
// setup.php - base theme supports
add_action('after_setup_theme', function() {
    add_theme_support('flatsome'); // keep UX Builder available
    remove_theme_support('woocommerce'); // remove WC if present
    add_theme_support('responsive-embeds');
    // Image sizes
    add_image_size('enhanced-thumb', 600, 400, true);
});
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script(
		'flickity',
		'https://cdnjs.cloudflare.com/ajax/libs/flickity/2.3.0/flickity.pkgd.min.js',
		[],
		null,
		true
	);
});
