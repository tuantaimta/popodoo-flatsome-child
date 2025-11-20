<?php
if (!function_exists('ux_builder_add_element')) return;

/* ============================
   ENHANCED PRODUCT CARD ELEMENT
================================ */
ux_builder_add_element('enh_product_card', array(
    'name' => __('Enhanced Product Card','popodoo'),
    'category' => __('Custom','popodoo'),
    'priority' => 1,
    'options' => array(
        'image' => array(
            'type' => 'image',
            'heading' => __('Product Image','popodoo'),
        ),
        'title' => array(
            'type' => 'textfield',
            'heading' => __('Title','popodoo'),
            'default' => 'Product title'
        ),
        'price' => array(
            'type' => 'textfield',
            'heading' => __('Price','popodoo')
        ),
        'url' => array(
            'type' => 'textfield',
            'heading' => __('Link URL','popodoo'),
            'default' => '#'
        ),
        'style' => array(
            'type' => 'select',
            'heading' => __('Style','popodoo'),
            'options' => array(
                'default' => __('Default','popodoo'),
                'shadow' => __('Shadow','popodoo'),
                'border' => __('Bordered','popodoo')
            ),
            'default' => 'default'
        )
    ),
    'render' => function ($data) {
        $shortcode = '[enh_product_card';
        foreach ($data as $key => $value) {
            if (!empty($value)) {
                $shortcode .= sprintf(' %s="%s"', $key, esc_attr($value));
            }
        }
        $shortcode .= ']';
        return do_shortcode($shortcode);
    },
));


