<?php
if (empty($args['bedding']) || empty($args['bedding']['components'])) {
    return;
}

$bedding    = $args['bedding'];
$title      = $bedding['title'] ?? '';
$subtitle   = $bedding['subtitle'] ?? '';
$components = $bedding['components'];
?>
<div class="bedding-builder">
    <?php if ($title || $subtitle): ?>
        <div class="bedding-builder__intro">
            <?php if ($title): ?>
                <p class="bedding-builder__title"><?php echo esc_html($title); ?></p>
            <?php endif; ?>
            <?php if ($subtitle): ?>
                <p class="bedding-builder__subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php foreach ($components as $index => $component):
        $sizes         = $component['sizes'] ?? [];
        $colors        = $component['colors'] ?? [];
        $default_size  = $sizes[0] ?? '';
        $default_color = $colors[0]['label'] ?? '';
        ?>
        <div class="bedding-component" data-component-index="<?php echo esc_attr($index); ?>">
            <div class="bedding-component__header">
                <div class="bedding-component__titles">
                    <span class="bedding-component__name"><?php echo esc_html($component['title'] ?? ''); ?></span>
                    <?php if (!empty($component['subtitle'])): ?>
                        <span class="bedding-component__note"><?php echo esc_html($component['subtitle']); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ($sizes): ?>
                    <div class="bedding-component__size-current">
                        <span>Размер:</span>
                        <span class="bedding-component__size-value"><?php echo esc_html($default_size); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($sizes): ?>
                <div class="bedding-component__sizes" role="group">
                    <?php foreach ($sizes as $size): ?>
                        <button type="button"
                                class="bedding-component__size-option<?php echo $size === $default_size ? ' is-active' : ''; ?>"
                                data-size="<?php echo esc_attr($size); ?>">
                            <?php echo esc_html($size); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($colors): ?>
                <div class="bedding-component__colors">
                    <div class="bedding-component__colors-header">
                        <span>Цвет:</span>
                        <span class="bedding-component__color-value"><?php echo esc_html($default_color); ?></span>
                    </div>
                    <div class="bedding-component__color-options">
                        <?php foreach ($colors as $color):
                            $hex = $color['hex'] ?? '#d9d9d9';
                            ?>
                            <button type="button"
                                    class="bedding-component__color-option<?php echo $color['label'] === $default_color ? ' is-active' : ''; ?>"
                                    data-color="<?php echo esc_attr($color['label']); ?>">
                                <span class="dot" style="background: <?php echo esc_attr($hex); ?>"></span>
                                <span class="name"><?php echo esc_html($color['label']); ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <input type="hidden"
                   name="snov_bedding_components[<?php echo esc_attr($index); ?>][title]"
                   value="<?php echo esc_attr($component['title'] ?? ''); ?>">
            <input type="hidden"
                   class="js-bedding-component-size"
                   name="snov_bedding_components[<?php echo esc_attr($index); ?>][size]"
                   value="<?php echo esc_attr($default_size); ?>">
            <input type="hidden"
                   class="js-bedding-component-color"
                   name="snov_bedding_components[<?php echo esc_attr($index); ?>][color]"
                   value="<?php echo esc_attr($default_color); ?>">
        </div>
    <?php endforeach; ?>
</div>