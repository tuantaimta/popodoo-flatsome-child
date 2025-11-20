<?php
// expects $a from shortcode
?>
<div class="enh-card enh-card--product">
    <a class="enh-card__link" href="<?php echo esc_url($a['url']); ?>">
        <div class="enh-card__media" data-bg="<?php echo esc_url($a['image']); ?>" role="img" aria-label="<?php echo esc_attr($a['title']); ?>"></div>
        <div class="enh-card__body">
            <h3 class="enh-card__title"><?php echo esc_html($a['title']); ?></h3>
            <?php if ($a['price']): ?>
                <div class="enh-card__price"><?php echo wp_kses_post($a['price']); ?></div>
            <?php endif; ?>
        </div>
    </a>
</div>
