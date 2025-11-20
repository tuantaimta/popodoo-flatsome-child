<?php
// components.php - register shortcodes and template components

// Product Card shortcode [enh_product_card image="..." title="..." price="..."]
add_shortcode('enh_product_card', function($atts){
    $a = shortcode_atts([
        'image' => '',
        'title' => 'Product title',
        'price' => '',
        'url' => '#'
    ], $atts);
    ob_start();
    include get_stylesheet_directory() . '/components/product-card.php';
    return ob_get_clean();
});

// Banner shortcode [enh_banner image="..." title="..." subtitle="..."]
add_shortcode('enh_banner', function($atts){
    $a = shortcode_atts([
        'image' => '',
        'title' => '',
        'subtitle' => '',
        'url' => '#'
    ], $atts);
    ob_start();
    include get_stylesheet_directory() . '/components/banner.php';
    return ob_get_clean();
});

// Utility: register a tiny block of JSON-LD for single posts (article)
add_action('wp_head', function() {
    if (is_singular('post')) {
        global $post;
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title($post),
            'datePublished' => get_the_date('c', $post),
            'author' => [
                '@type' => 'Person',
                'name' => get_the_author_meta('display_name', $post->post_author)
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => get_bloginfo('name')
            ]
        ];
        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
});
