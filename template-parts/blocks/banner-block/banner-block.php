<?php
// ACF Fields
$background_image = get_field('background_image');
$main_header = get_field('main_header');
$sub_header = get_field('sub_header');
$financial_data = get_field('financial_data');
$button_text = get_field('button_text');
$button_link = get_field('button_link');
?>

<div class="financial-banner" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
    <div class="container">
        <div class="banner-content">
            <h1 class="main-header"><?php echo esc_html($main_header); ?></h1>
            <p class="sub-header"><?php echo esc_html($sub_header); ?></p>
            
            <div class="financial-stats">
                <?php if ($financial_data): ?>
                    <ul class="stats-list">
                        <?php foreach ($financial_data as $data): ?>
                            <li class="stat-item">
                                <span class="stat-title"><?php echo esc_html($data['title']); ?></span>
                                <span class="stat-value"><?php echo esc_html($data['value']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <?php if ($button_text && $button_link): ?>
                <a href="<?php echo esc_url($button_link); ?>" class="banner-button"><?php echo esc_html($button_text); ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>
