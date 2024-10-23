<?php
/**
 * Content Page template
 *
 * @package Aquila
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! is_home() ) : ?>

		
	<?php endif; ?>

	<div class="entry-content">
		<?php
		// Display the content from the Gutenberg editor
		the_content();

		// Display pagination links if there are multiple pages
		if ( ! is_home() ) {
			wp_link_pages(
				[
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'aquila' ),
					'after'  => '</div>',
				]
			);
		}
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'aquila' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
