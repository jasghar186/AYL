<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

?>

<section class="no-results not-found py-5">
	<header class="page-header">
		<h1 class="page-title text-center fw-bold fs-1 mb-4"><?php esc_html_e( 'Nothing Found', 'automate-life' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'automate-life' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>

			<p class="text-center fs-5 mb-4"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'automate-life' ); ?></p>
			<?php
			echo '<div class="container mt-4">';
			echo '<div class="header-search-form position-relative">';
			get_search_form();
			echo '<i class="bi bi-search position-absolute end-0 top-50 translate-middle-y rounded-circle
			d-flex align-items-center justify-content-center fs-4 text-white bg-primary cursor-pointer"></i>';
			echo '</div>';
			echo '</div>';

		else :

			ob_start();
			$error_page_url = home_url('/404/');
			?>
			<script>
				jQuery(document).ready(function($) {
					window.location.href = '<?php echo $error_page_url; ?>';
				})
			</script>
			<?php
			$error_clean = ob_get_clean();
			echo $error_clean;

			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
