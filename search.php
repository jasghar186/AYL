<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package automate_life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header bg-primary blog-title-header">
				<h1 class="page-title blog-header-title m-0 pt-5 text-white fw-bold text-center text-uppercase">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'automate-life' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			echo '<div class="container-fluid posts-container-fluid">';
			echo '<div class="row mt-5">';

			while ( have_posts() ) :
				the_post();
				$postIndex = $wp_query->current_post;

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', 'search' );
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			echo '</div>';
			echo '</div>';

			$total_pages = $wp_query->max_num_pages;
			if( $total_pages > 1 ):
				// <!-- Display Pagination -->
				echo '<div class="my-0 my-lg-5 pt-0 pt-lg-3 pb-4 pb-lg-5 container-fluid d-flex justify-content-center gap-3 posts-pagination-wrapper">';
				echo paginate_links(
					array(
						'prev_text' => '&laquo; Previous',
						'next_text' => 'Next &raquo;',
					)
				);
				echo '</div>';
			endif ;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
