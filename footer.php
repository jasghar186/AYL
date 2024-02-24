<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package automate_life
 */

?>

	<!-- Scroll back to top -->

	<?php
		if( get_option('scroll_back_to_top_option') &&
		intval(get_option('scroll_back_to_top_option')) === 1 ) {
			?>
				<div class="scroll-back-to-top position-fixed">
					<button class="text-light fs-6 bg-primary py-2 px-3 rounded">
						<i class="bi bi-arrow-up me-2"></i>
						<span>Back to Top</span>
					</button>
				</div>
			<?php
		}
	?>

	<footer id="colophon" class="site-footer bg-secondary p-3">
		<div class="row">
			<div class="col-12 col-lg-6">
				<div class="site-branding mb-3 mb-lg-5 pb-lg-3">
					<?php the_custom_logo(); ?>
				</div>

				<!-- Footer Menu Items -->
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_menu',
							'menu_id'        => 'footer_menu',
							'container'		 => 'nav',
							'container_class'=> 'footer-menu-items-wrapper',
						)
					);
				?>
			</div>
			<div class="col-12 col-lg-6 mt-4 mt-lg-0">
				<p class="mb-4">Join thousands of subscribers and learn about smart homes in 5 minutes per week</p>
				
				<div class="mb-5">
					<?php echo automate_life_email_recaptcha('light', 'footer-lead-email'); ?>
				</div>

				<div class="d-flex align-items-center justify-content-between justify-content-lg-start mb-5">
				<?php
					foreach (COMPANY_SOCIALS_URLS as $index => $icon) {
						if(trim(get_option($icon)) !== false && !empty(trim(get_option($icon)))) {
							if(strpos($icon, 'twitter') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-twitter-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-twitter">
								</a>';
							}else if(strpos($icon, 'youtube') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-youtube-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-youtube">
								</a>';
							}else if(strpos($icon, 'facebook_group') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-facebook-group-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-facebook">
								</a>';
							}else if(strpos($icon, 'facebook') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-facebook-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-facebook">
								</a>';
							}else if(strpos($icon, 'pinterest') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-pinterest-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-pinterest">
								</a>';
							}else if(strpos($icon, 'instagram') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="company-instagram-icon rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-instagram">
								</a>';
							}
						}
					}
				?>
				</div>

				<!-- Address and Contact number -->
				<p class="mb-2">Address: <a class="text-black text-decoration-none" href="https://maps.app.goo.gl/au5gYeqN8tZQCAkJA" target="_blank">2443 Filmore St #380-6097 San Francisco CA 94115</a></p>
				<p class="mb-2">Phone: <a class="text-black text-decoration-none" href="tel:16282286254">(628) 228-6254</a></p>
			</div>
		</div>
		<div class="d-flex align-items-center justify-content-start justify-content-md-center pt-4">
			<p class="text-dark text-capitalize p-0 m-0 text-left text-lg-center">
			<?php echo str_replace('{current_year}', Date('Y'), trim(get_option('footer_copyright_text_option'))); ?></p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
