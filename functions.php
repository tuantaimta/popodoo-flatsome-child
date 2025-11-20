<?php
// Flatsome Child - Enhanced (modular functions)
// Auto-load all php files in /inc/
$inc_path = get_stylesheet_directory() . '/inc/';
if (file_exists($inc_path)) {
    foreach (glob($inc_path . '*.php') as $file) {
        require_once $file;
    }
    foreach (glob($inc_path . '*/' . '*.php') as $file) {
        require_once $file;
    }
}
add_action('wp_enqueue_scripts', function() {
	wp_dequeue_style('flatsome-style');
	wp_enqueue_style('flatsome-style');
}, 999);
add_action('wp_enqueue_scripts', 'my_flatsome_custom_css', PHP_INT_MAX);
function my_flatsome_custom_css() {
	wp_enqueue_style(
		'my-flatsome-custom',
		get_stylesheet_directory_uri() . '/assets/css/main.min.css',
		array( 'flatsome-style' ), // phụ thuộc, nên tự động load sau
		'1.0.0'
	);
}

// Enqueue theme assets (built assets expected in /assets/)
add_action('wp_enqueue_scripts', function() {
    // Main stylesheet (built by gulp)

	// Preload common webfonts if present
    $fonts = [
        'fonts/Inter-Variable.woff2',
        'fonts/Inter-Regular.woff2'
    ];
    foreach ($fonts as $font) {
        $path = get_stylesheet_directory() . '/' . $font;
        if (file_exists($path)) {
            $url = get_stylesheet_directory_uri() . '/' . $font;
            printf('<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url($url));
        }
    }

    // Defer main JS (lazyload + helpers)
    wp_enqueue_script('flatsome-child-enhanced-scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js', [], file_exists(get_stylesheet_directory() . '/assets/js/scripts.min.js') ? filemtime(get_stylesheet_directory() . '/assets/js/scripts.min.js') : false, true);

    // Add critical inline CSS if available (critical.css)
    $critical = get_stylesheet_directory() . '/assets/css/critical.css';
    if (file_exists($critical)) {
        $css = file_get_contents($critical);
        wp_add_inline_style('flatsome-child-enhanced-main', $css);
    }
}, 20);


add_filter('script_loader_tag', function($tag, $handle) {
	if ($handle === 'child-module') {
		return str_replace('<script ', '<script type="module" ', $tag);
	}
	return $tag;
}, 10, 2);
// Add JSON-LD sitewide schema (Organization + WebSite)
add_action('wp_head', function(){
    $schema = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'url' => get_home_url(),
            ],
            [
                '@type' => 'WebSite',
                'name' => get_bloginfo('name'),
                'url' => get_home_url(),
                'potentialAction' => [
                    '@type' => 'SearchAction',
                    'target' => get_home_url() . '/?s={search_term_string}',
                    'query-input' => 'required name=search_term_string'
                ]
            ]
        ]
    ];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) . '</script>' . "\n";
});

// Handy helper: register components directory for template parts
function flatsome_child_enhanced_get_component($slug, $args = []) {
    $file = get_stylesheet_directory() . '/components/' . $slug . '.php';
    if (file_exists($file)) {
        extract($args);
        include $file;
    } else {
        echo "<!-- Component not found: $slug -->";
    }
}
