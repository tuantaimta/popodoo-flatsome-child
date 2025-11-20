<?php
// expects $a from shortcode
?>
<section class="enh-banner" aria-label="<?php echo esc_attr($a['title']); ?>">
    <a class="enh-banner__link" href="<?php echo esc_url($a['url']); ?>">
        <div class="enh-banner__bg" data-bg="<?php echo esc_url($a['image']); ?>"></div>
        <div class="enh-banner__content">
            <?php if ($a['title']): ?><h2 class="enh-banner__title"><?php echo esc_html($a['title']); ?></h2><?php endif; ?>
            <?php if ($a['subtitle']): ?><p class="enh-banner__subtitle"><?php echo esc_html($a['subtitle']); ?></p><?php endif; ?>
        </div>
    </a>
</section>
