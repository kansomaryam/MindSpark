<?php
/**
 * Custom template tags for the theme.
 *
 * @package Aquila
 */

/** --------------------------------------------------------
 * Post Thumbnails & Excerpts 
 * -------------------------------------------------------- */

/**
 * Gets the thumbnail with Lazy Load.
 * Should be called in the WordPress Loop.
 */
function get_the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	$custom_thumbnail = '';

	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		$default_attributes = [ 'loading' => 'lazy' ];
		$attributes = array_merge( $additional_attributes, $default_attributes );

		$custom_thumbnail = wp_get_attachment_image(
			get_post_thumbnail_id( $post_id ),
			$size,
			false,
			$attributes
		);
	}

	return $custom_thumbnail;
}

/**
 * Renders Custom Thumbnail with Lazy Load.
 */
function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}

/**
 * Get the trimmed version of post excerpt.
 */
function aquila_the_excerpt( $trim_character_count = 0 ) {
	$post_ID = get_the_ID();

	if ( empty( $post_ID ) ) {
		return null;
	}

	if ( has_excerpt() || 0 === $trim_character_count ) {
		the_excerpt();
	}

	$excerpt = wp_html_excerpt( get_the_excerpt( $post_ID ), $trim_character_count, '[...]' );

	return $excerpt;
}

/**
 * Filter the "read more" excerpt string link to the post.
 */
function aquila_excerpt_more( $more = '' ) {
	if ( ! is_single() ) {
		$more = sprintf(
			'<a class="aquila-read-more text-white mt-3 btn btn-info" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read more', 'aquila' )
		);
	}

	return $more;
}

/** --------------------------------------------------------
 * Post Metadata (Author, Date)
 * -------------------------------------------------------- */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function aquila_posted_on() {
	$year = get_the_date( 'Y' );
	$month = get_the_date( 'n' );
	$day = get_the_date( 'j' );
	$post_date_archive_permalink = get_day_link( $year, $month, $day );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_attr( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_attr( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'aquila' ),
		'<a href="' . esc_url( $post_date_archive_permalink ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}

/**
 * Prints HTML with meta information for the current author.
 */
function aquila_posted_by() {
	$byline = sprintf(
		esc_html_x( ' by %s', 'post author', 'aquila' ),
		'<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline text-secondary">' . $byline . '</span>';
}

/** --------------------------------------------------------
 * Pagination
 * -------------------------------------------------------- */

/**
 * Aquila Pagination.
 */
function aquila_pagination() {
	$allowed_tags = [
		'span' => [ 'class' => [] ],
		'a'    => [ 'class' => [], 'href' => [] ],
	];

	$args = [
		'before_page_number' => '<span class="btn border border-secondary mr-2 mb-2">',
		'after_page_number'  => '</span>',
	];

	printf( '<nav class="aquila-pagination clearfix">%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ) );
}

/**
 * Display Post pagination with prev, next, first, last.
 */
function aquila_the_post_pagination( $current_page_no, $posts_per_page, $article_query, $first_page_url, $last_page_url, bool $is_query_param_structure = true ) {
	$prev_posts = ( $current_page_no - 1 ) * $posts_per_page;
	$from = 1 + $prev_posts;
	$to = count( $article_query->posts ) + $prev_posts;
	$of = $article_query->found_posts;
	$total_pages = $article_query->max_num_pages;

	$base = ! empty( $is_query_param_structure ) ? add_query_arg( 'page', '%#%' ) : get_pagenum_link( 1 ) . '%_%';
	$format = ! empty( $is_query_param_structure ) ? '?page=%#%' : 'page/%#%';

	?>
	<div class="mt-0 md:mt-10 mb-10 lg:my-5 flex items-center justify-end posts-navigation">
		<?php
		if ( 1 < $total_pages && ! empty( $first_page_url ) ) {
			printf(
				'<span class="mr-2">Showing %1$s - %2$s Of %3$s</span>',
				$from,
				$to,
				$of
			);
		}

		// First Page
		if ( 1 !== $current_page_no && ! empty( $first_page_url ) ) {
			printf( '<a class="first-pagination-link btn border border-secondary mr-2" href="%1$s" title="first-pagination-link">%2$s</a>', esc_url( $first_page_url ), __( 'First', 'aquila' ) );
		}

		echo paginate_links( [
			'base'      => $base,
			'format'    => $format,
			'current'   => $current_page_no,
			'total'     => $total_pages,
			'prev_text' => __( 'Prev', 'aquila' ),
			'next_text' => __( 'Next', 'aquila' ),
		] );

		// Last Page
		if ( $current_page_no < $total_pages && !empty( $last_page_url ) ) {
			printf( '<a class="last-pagination-link btn border border-secondary ml-2" href="%1$s" title="last-pagination-link">%2$s</a>', esc_url( $last_page_url ), __( 'Last', 'aquila' ) );
		}
		?>
	</div>
	<?php
}

/** --------------------------------------------------------
 * Gravatar Handling
 * -------------------------------------------------------- */

/**
 * Checks if the specified user has uploaded the image via wp_admin.
 */
function aquila_is_uploaded_via_wp_admin( $gravatar_url ) {
	$parsed_url = wp_parse_url( $gravatar_url );
	$query_args = ! empty( $parsed_url['query'] ) ? $parsed_url['query'] : '';
	return empty( $query_args ); // True if uploaded via wp_admin.
}

/**
 * Check if the gravatar is uploaded (either via WP Dashboard or Gravatar site).
 */
function aquila_has_gravatar( $user_email ) {
	$gravatar_url = get_avatar_url( $user_email );

	if ( aquila_is_uploaded_via_wp_admin( $gravatar_url ) ) {
		return true;
	}

	$gravatar_url = sprintf( '%s&d=404', $gravatar_url );
	$headers = @get_headers( $gravatar_url );
	return preg_match( "|200|", $headers[0] ); // True if gravatar is uploaded.
}

/** --------------------------------------------------------
 * Taxonomy and Terms
 * -------------------------------------------------------- */

/**
 * Get hierarchical term items.
 */
function get_hierarchical_term_items( string $taxonomy = '', int $parent_id = 0 ) : array {
	$query_args = [
		'post_type'              => 'post',
		'post_status'            => 'publish',
		'fields'                 => 'ids',
		'posts_per_page'         => 1,
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	];

	$items = [];
	$the_terms = get_terms( [ 'taxonomy' => $taxonomy, 'hide_empty' => true, 'parent' => $parent_id ] );
	$the_terms = ! is_wp_error( $the_terms ) && ! empty( $the_terms ) ? $the_terms : [];

	foreach ( $the_terms as $term ) {
		$query_args['tax_query'] = [ //phpcs:ignore
			[
				'taxonomy'         => $taxonomy,
				'field'            => 'term_id',
				'terms'            => $term->term_id,
				'include_children' => false,
			],
		];

		$posts = new WP_Query( $query_args );
		$count = isset( $posts->found_posts ) ? $posts->found_posts : 0;

		$items[ $term->term_id ] = [
			'name'  => $term->name,
			'count' => $count,
		];
	}

	return $items;
}
