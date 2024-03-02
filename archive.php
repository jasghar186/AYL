<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header bg-primary blog-title-header">
				<h1 class="page-title blog-header-title m-0 pt-5 text-white fw-bold text-center text-uppercase"><?php single_term_title(); ?></h1>
			</header> <!-- .page-header -->

			<?php
			/* Start the Loop */
			echo '<div class="container-fluid posts-container-fluid">';
			echo '<div class="row mt-5">';

			while ( have_posts() ) :
				the_post();

				// Show captcha box if at the half of posts
				$postIndex = $wp_query->current_post;
				$posts_per_page = get_option('posts_per_page');

				if( $postIndex === $posts_per_page / 2 ) {
					echo '<div class="px-3 mb-5 blog-newletter-container">'.
					'<div class="bg-primary pt-3 pb-3 pt-lg-5 pb-lg-5 rounded-3">'.
					'<div class="pt-lg-5 pb-lg-3">'.
					'<p class="text-white text-center mb-2 mb-lg-0">Join Over 100,000 People Like You!</p>'.
					'<h3 class="text-center text-white fw-bold blog-newsletter-title m-0">Start learning about <br /> smart homes</h3>'.
					'<div class="blog-newsletter-form-container my-3 my-lg-4 mx-auto px-2 px-lg-0">'.
					automate_life_email_recaptcha('light', 'blog-newsletter-form').
					'</div>'.
					'<small class="text-center text-white fs-7 d-block">No spam, unsubscribe at any time.</small>'.
					'</div>'.
					'</div>'.
					'</div>';
				}

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
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
// get_sidebar();
get_footer(); ?>
<script>
	jQuery(document).ready(function($) {
		$('.posts-pagination-wrapper .page-numbers.current').addClass('bg-primary')
		$('.posts-pagination-wrapper .page-numbers:not(.current)').addClass('border-primary').addClass('border')
	})
</script>
