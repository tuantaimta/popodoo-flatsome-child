Flatsome Child - Enhanced
========================

This package contains an enhanced Flatsome child theme with:

- Modular PHP (inc/)
- Reusable components as shortcodes + template parts (components/)
  - [enh_product_card image="..." title="..." price="..."]
  - [enh_banner image="..." title="..." subtitle="..."]
- Simple UX Builder element registration if Flatsome UX Builder exists (inc/ux-elements.php)
- Lazy-loading backgrounds using data-bg and IntersectionObserver (src/js/lazy-bg.js)
- Preload fonts logic in functions.php (place font files in /fonts/)
- JSON-LD: site organization + per-post Article schema
- Gulp config + package.json for building CSS/JS (see gulpfile.js)
- Critical CSS support (assets/css/critical.css)

How to use:
1. Copy this folder into wp-content/themes/
2. Install dev dependencies and run `npm run build` to compile assets (or use gulp directly).
3. Place webfonts under /fonts/ and update functions.php if different names.
4. Use shortcodes in content or call template parts via
   <?php flatsome_child_enhanced_get_component('product-card', ['image'=>'/wp-content/uploads/..','title'=>'..','price'=>'..']); ?>

Notes:
- UX Builder element registration is done only if the function `ux_builder_add_element` exists to avoid fatal errors.
- For full performance: generate a real critical.css, optimize images, enable server-level caching and Brotli/Gzip.
