<?php
// Load ACF fields
$title = get_field('banner_title') ?: 'Welcome to Our Site';
$subtitle = get_field('banner_subtitle') ?: 'Your Success Starts Here';
$background_image = get_field('banner_background_image');
$button_text = get_field('banner_button_text') ?: 'Learn More';
$button_link = get_field('banner_button_link') ?: '#';

?>

<section class="full-banner" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
    <div class="banner-content">
        <h1><?php echo esc_html($title); ?></h1>
        <p><?php echo esc_html($subtitle); ?></p>
        <?php if ($button_text && $button_link): ?>
            <a class="banner-button" href="<?php echo esc_url($button_link); ?>"><?php echo esc_html($button_text); ?></a>
        <?php endif; ?>
    </div>
</section>
