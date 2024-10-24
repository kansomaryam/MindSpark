<?php
// Hero block PHP template
$header = get_field('header');
$sub_header = get_field('sub_header');
$content = get_field('content');
$link = get_field('link');
$image = get_field('image');
$gradient_type = get_field('gradient_background_type');
$background_color = get_field('background_color');
$sub_header_color = get_field('sub_header_color');
$header_color = get_field('header_color');
$content_color = get_field('content_color');
$is_podcast = get_field('is_podcast');

// Podcast URLs and Images
$google_podcast_url = get_field('google_podcast_url');
$google_podcast_image = get_field('google_podcast_image');
$apple_podcast_url = get_field('apple_podcast_url');
$apple_podcast_image = get_field('apple_podcast_image');
$spotify_podcast_url = get_field('spotify_podcast_url');
$spotify_podcast_image = get_field('spotify_podcast_image');
?>

<div class="hero-block <?php echo esc_attr($gradient_type); ?>" style="background-color: <?php echo esc_attr($background_color); ?>">
    <div class="hero-content">
        <?php if ($sub_header): ?>
            <h3 class="hero-sub-header" style="color: <?php echo esc_attr($sub_header_color); ?>"><?php echo esc_html($sub_header); ?></h3>
        <?php endif; ?>
        
        <?php if ($header): ?>
            <h1 class="hero-header" style="color: <?php echo esc_attr($header_color); ?>"><?php echo esc_html($header); ?></h1>
        <?php endif; ?>
        
        <?php if ($content): ?>
            <div class="hero-description" style="color: <?php echo esc_attr($content_color); ?>">
                <?php echo $content; ?>
            </div>
        <?php endif; ?>

        <?php if ($link): ?>
            <a href="<?php echo esc_url($link); ?>" class="hero-button">Schedule a Demo</a>
        <?php endif; ?>
        
        <?php if ($is_podcast): ?>
            <div class="hero-podcast-links">
                <?php if ($google_podcast_url && $google_podcast_image): ?>
                    <a href="<?php echo esc_url($google_podcast_url); ?>">
                        <img src="<?php echo esc_url($google_podcast_image['url']); ?>" alt="Google Podcast">
                    </a>
                <?php endif; ?>
                <?php if ($apple_podcast_url && $apple_podcast_image): ?>
                    <a href="<?php echo esc_url($apple_podcast_url); ?>">
                        <img src="<?php echo esc_url($apple_podcast_image['url']); ?>" alt="Apple Podcast">
                    </a>
                <?php endif; ?>
                <?php if ($spotify_podcast_url && $spotify_podcast_image): ?>
                    <a href="<?php echo esc_url($spotify_podcast_url); ?>">
                        <img src="<?php echo esc_url($spotify_podcast_image['url']); ?>" alt="Spotify Podcast">
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if ($image): ?>
        <div class="hero-image">
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
        </div>
    <?php endif; ?>
</div>
