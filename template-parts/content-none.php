<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'automate-life' ); ?></h1>
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

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'automate-life' ); ?></p>
			<?php
			get_search_form();

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
