<?php get_header(); ?>

<main id="main" class="site-main">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/search-results.css">

    <?php if ( have_posts() ) : ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php printf( esc_html__( 'Search Results for: %s', 'your-theme-text-domain' ), '<span>' . get_search_query() . '</span>' ); ?>
            </h1>
        </header><!-- .page-header -->

        <div class="search-results-wrapper">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <!-- Pagination -->
            <div class="pagination">
                <?php the_posts_pagination(); ?>
            </div>
        </div>

    <?php else : ?>
        <div class="no-results">
            <h2><?php esc_html_e( 'Nothing Found', 'your-theme-text-domain' ); ?></h2>
            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'your-theme-text-domain' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
