<?php
/**
 * Media Block Template
 */

// Load values and assign to variables
$image = get_field('image');
$title = get_field('title');
$content = get_field('content');
$button_text = get_field('button_text');
$button_link = get_field('button_link');
?>
<div class="media-block">
    <div class="media-image">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
    </div>
    <div class="media-content">
        <h2 class="media-title"><?php echo esc_html($title); ?></h2>
        <p class="media-text"><?php echo esc_html($content); ?></p>
        <a href="<?php echo esc_url($button_link); ?>" class="media-button"><?php echo esc_html($button_text); ?></a>
    </div>
</div>
