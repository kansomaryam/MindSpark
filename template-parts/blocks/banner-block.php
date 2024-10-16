<?php
// Check if ACF is active and fields are set.
if( function_exists('get_field') ):
    $subheading = get_field('subheading');
    $headline = get_field('headline');
    $description = get_field('description');
    $button_text = get_field('button_text');
    $button_url = get_field('button_url');
endif;
?>

<section class="banner-block">
    <div class="banner-content">
        <span class="banner-subheading"><?php echo esc_html($subheading); ?></span>
        <h1 class="banner-headline"><?php echo esc_html($headline); ?></h1>
        <p class="banner-description"><?php echo esc_html($description); ?></p>
        <a href="<?php echo esc_url($button_url); ?>" class="banner-button">
            <?php echo esc_html($button_text); ?>
        </a>
    </div>
</section>
