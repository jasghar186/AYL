<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package automate_life
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="404-error not-found py-3 container-fluid">
			<div class="row">
				<div class="col-12 col-md-6 col-lg-5">
					<img src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/404-not-found.webp"
					alt="404 Not Found" title="404 Not Found" loading="lazy" width="524" height="385"
					class="img-fluid object-fit-contain notfound-svg-image">
				</div>
				<div class="col-12 col-md-6 col-lg-7 pt-3">
					<p class="text-center fw-bold font-xl text-dark">Page not found</p>
					<p class="text-center font-xxl text-dark">Oops the page you requested could not be found.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-12 col-md-6 col-lg-5"></div>
				<div class="col-12 col-md-6 col-lg-7">
					<p class="text-dark text-center text-lg-left fs-6">Please search for what you are looking for</p>
					<?php 
					echo '<div class="header-search-form position-relative">';
					get_search_form();
					echo '<i class="bi bi-search position-absolute end-0 top-50 translate-middle-y rounded-circle
					d-flex align-items-center justify-content-center fs-4 text-white bg-primary cursor-pointer"></i>';
					echo '</div>';
					?>
					<p class="text-grey mt-3 text-center mt-lg-1 text-lg-left">Or explore our categories below</p>
				</div>
			</div>

		</section>

		<section class="<?php echo SITE_LAYOUT_SPACE; ?> container-fluid">
			<div class="row">
				<?php
					$parent_categories = get_categories(
						array(
							'parent' => 0, // Get Only Parent Categories
							'number' => 4,
							'exclude' => get_category_by_slug('uncategorized')->term_id,
						)
					);
					foreach($parent_categories as $category) {
						echo '<div class="col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">'.
						'<h3 class="text-left fw-normal mb-4 text-uppercase ps-5 font-xxl">'.esc_html($category->name).'</h3>';

						$child_cats = get_categories(
							array(
								'parent' => $category->term_id,
							)
						);

						if(count($child_cats) > 0) {
							echo '<div class="notfound-categories-card rounded-4 ps-5 pe-4 pt-4">';
							foreach($child_cats as $child_cat) {
								echo '<a href="'.esc_url(get_term_link($child_cat->term_id,'category')).'"
								class="text-decoration-none text-uppercase mb-4 d-inline-block child-category-item fw-normal">'.esc_html($child_cat->name).'</a>';
							}
							echo '</div>';
						}
						echo '</div>';
					}
				?>
			</div>
		</section>

		<?php automate_life_recent_articles(); ?>
	</main><!-- #main -->

<?php
get_footer();
