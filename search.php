<?php
get_header();

?>

<main id="main" class="site-main">
    <h1>Search Results for: <?php echo esc_html(get_search_query()); ?></h1>
    <div class="search-results">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-summary"><?php the_excerpt(); ?></div>
                </article>
            <?php endwhile; ?>
            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>