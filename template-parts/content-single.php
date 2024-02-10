<?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

 $pstid = get_the_ID();
 $all_disliked_posts = array();
 $all_liked_posts 	 = array();

 global $all_type_posts;
 if(isset($all_type_posts['liked_posts'])){
	$all_liked_posts 	= $all_type_posts['liked_posts'];
 }
if(isset($all_type_posts['disliked_posts'])){
	$all_disliked_posts = $all_type_posts['disliked_posts'];
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container-fluid'); ?>>
		<div class="row position-relative">
			<div class="col-3 position-sticky top-0 table-of-content-column">
				<div class="rounded-3 shadow p-2 position-sticky" style="top:1rem;">
					<h3 class="text-capitalize fw-bold">
						Table of Contents
					</h3>
					<ul class="toc p-0 m-0"></ul>
				</div>
			</div>
			<div class="col-6 shadow-sm pb-4 flex-grow-1">
				<div class="d-flex align-items-center justify-content-between">
					<?php get_template_part('template-parts/breadcrumbs');  ?>

					<!-- Post CTA -->
					<div class="post-cta d-flex align-items-center justify-content-end gap-3">
						<div class="post-like-dislike d-flex align-items-center justify-content-end">
							<span class="me-2 font-sm text-dark text-capitalize">Was this helpful?</span>
							<div class="d-flex align-items-center">
								
								<span class="me-2 cursor-pointer user-post-liked" data-liked="1" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_liked_posts)) { echo 'custom-text-info'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-up.svg" alt="" srcset=""></span>

								<span class="cursor-pointer user-post-disliked " data-liked="0" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_disliked_posts)) { echo 'custom-text-danger'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-down.svg" alt="" srcset=""></span>

							</div>
						</div>
						<button class="text-primary font-sm rounded-1 border p-1">Send Feedback</button>
					</div>
				</div>

				<!-- Post Header -->
				<header class="entry-header single-blog-header mb-4">
					<?php
						if( is_singular() ) {
							the_title( '<h1 class="entry-title my-5">', '</h1>' );
						}else {
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
						}

						if( 'post' === get_post_type() ) {
							?>
								<div class="entry-meta">
									<?php
									// Check if the post has an author
									if (get_the_author_meta('ID')) {
										// Get the author's Gravatar
										$author_avatar = get_avatar(get_the_author_meta('user_email'), 50, '', '', array('class' => 'rounded-circle'));

										// Display the author's Gravatar
										echo '<span class="author-avatar d-inline-block me-3">' . $author_avatar . '</span>';
									}

									// Display the posted by information
									automate_life_posted_by();

									$factCheckerUserId = get_post_meta(get_the_ID(), '_fact_checker_user', true);
									if (get_the_author_meta('ID') && !empty($factCheckerUserId)) {
										$author_avatar = get_avatar(get_the_author_meta('user_email'), 50, '', '', array('class' => 'rounded-circle'));
										$factCheckerUser = get_userdata($factCheckerUserId);
										echo '<span class="author-avatar d-inline-block ms-4 me-3">' . $author_avatar . '</span>';
										echo '<span>Fact checked by <span class="text-primary">' . esc_html($factCheckerUser->display_name) . '</span></span>';
									}
									?>

									<div class="d-flex align-items-center justify-content-start gap-3 my-4 posted-date">
										<div class="d-flex align-items-center">
											<i class="bi bi-clock fs-3"></i>
										</div>
										<?php automate_life_last_revised(); ?>
										<span class="meta-separator">|</span>
										<?php estimate_reading_time(); ?>
									</div>

									<p class="post-disclaimer p-3 font-sm lh-sm text-dark">
										By continuing to use this website you agree to our Terms and Conditions.
										If you don't agree with our Terms and Conditions, you are not permitted to continue
										using this website.
									</p>
								</div>
							<?php
						}
					?>
				</header>

				<?php automate_life_post_thumbnail(); ?>

				<div class="entry-content blog-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'automate-life' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						)
					);
					?>
				</div>

				<!-- Post like dislike -->
				<div class="post-like-dislike d-flex align-items-center justify-content-center mt-4">
					<span class="me-3 font-md text-dark text-capitalize">Was this helpful?</span>
					<div class="d-flex align-items-center">
						<span class="me-2 cursor-pointer user-post-liked" data-liked="1" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_liked_posts)) { echo 'custom-text-info'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-up.svg" alt="" srcset=""></span>

						<span class="cursor-pointer user-post-disliked " data-liked="0" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_disliked_posts)) { echo 'custom-text-danger'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-down.svg" alt="" srcset=""></span>
					</div>
				</div>

				<button class="text-primary fs-6 rounded-1 border p-1 d-block mx-auto my-4">Send Feedback</button>

				<!-- Share on social sites -->
				<div class="row">
					<?php
					// $page_url = site_url() . $_SERVER['REQUEST_URI'];
					$page_url = get_the_permalink();

					$social_share = array(
						array(
							'name' => 'facebook',
							'icon' => 'bi-facebook',
							'url' => 'https://www.facebook.com/sharer/sharer.php?u='.$page_url.'',
						),
						array(
							'name' => 'twitter',
							'icon' => 'bi-twitter',
							'url' => 'https://twitter.com/share?url='.$page_url.'&text='.get_the_title().'&via=automatelife',
						),
						array(
							'name' => 'email',
							'icon' => 'bi-envelope',
							'url' => 'mailto:?subject='.get_the_title().'&body=Check out this link: '.$page_url,
						),						
						array(
							'name' => 'whatsapp',
							'icon' => 'bi-whatsapp',
							'url' => 'https://api.whatsapp.com/send?text='.$page_url.'',
						),
						array(
							'name' => 'copy',
							'icon' => 'bi-copy',
							'url' => 'javascript:void(0)',
						),
					);

					foreach($social_share as $index => $social) {
						echo '<div class="col mb-3 mb-xxl-0">'.
						'<a class="d-inline-block w-100 btn text-white
						btn-lg text-uppercase font-md blog-social-share-'.$social['name'].'"
						'.($social['name'] !== 'copy' && $social['name'] !== 'share' ? 'target="_blank"' : '').'
						href="'.$social['url'].'">'.
						'<i class="bi '.$social['icon'].' d-inline-block font-md"></i>'.
						'</a>'.
						'</div>';
					}

					?>
					
				</div>

			</div>
			<div class="col-3 blog-sidebar-column">
				<?php
					echo automate_life_sidebar_layout('list');
				?>
			</div>
		</div>


		<div class="row mt-5">
			<div class="col-3 table-of-content-column"></div>
			<div class="col-6 shadow-sm flex-grow-1">
					<?php echo automate_life_sidebar_layout('grid'); ?>
			</div>
			<div class="col-3 blog-sidebar-column"></div>
		</div>

	<footer class="entry-footer">
		<?php // automate_life_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->



<?php

/**
 * @param string $layout specifies the layout of the cards in sidebar and in bottom of the page
 */

function automate_life_sidebar_layout($layout) {

	$recommended_args = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'post__not_in' => array(get_the_ID()),
	);


	$sidebar = '<article aria-label="sidebar" class="shadow-sm">'.
	'<div class="d-flex justify-content-between gap-2">'.
	'<span
	class="recommended-tab flex-grow-1 cursor-pointer
	text-center blog-sidebar-toggle px-1 py-0
	font-sm text-light bg-primary"
	data-target="#'.( $layout === 'grid' ? 'recommended-blogs-tab' : 'recommended-blogs-tab-list' ).'">'.
	'Recommended'.
	'</span>'.
	'<span
	class="recommended-tab flex-grow-1 cursor-pointer
	text-center blog-sidebar-toggle px-1 py-0
	bg-secondary font-sm"
	data-target="#'.( $layout === 'grid' ? 'recently-viewed-tab' : 'recently-viewed-tab-list' ).'">'.
	'Recently Viewed'.
	'</span>'.
	'<span
	class="liked-tab flex-grow-1 cursor-pointer
	text-center blog-sidebar-toggle px-1 py-0
	bg-secondary font-sm"
	data-target="#'.( $layout === 'grid' ? 'liked-blogs-tab' : 'liked-blogs-tab-list' ).'">'.
	'Liked'.
	'</span>'.
	'</div>'.

	// Content Part Started
	// Recommended tab
	'<div
	class="mt-4 px-2 pb-3 blog-sidebar-tab '.( $layout === 'grid' ? 'd-flex gap-3' : '' ).'"
	id="'.( $layout === 'grid' ? 'recommended-blogs-tab' : 'recommended-blogs-tab-list' ).'"
	aria-label="Recommended Blogs">'.
	automate_life_cards_layout($recommended_args, $layout).
	'</div>'.

	// Recently viewed tab
	'<div
	class="mt-4 px-2 pb-3 blog-sidebar-tab d-none '.( $layout === 'grid' ? 'd-flex gap-3' : '' ).'"
	id="'.( $layout === 'grid' ? 'recently-viewed-tab' : 'recently-viewed-tab-list' ).'"
	aria-label="Recently Viewed Blogs">'.
	'</div>'.

	// Liked blogs tab
	'<div
	class="mt-4 px-2 pb-3 blog-sidebar-tab d-none '.( $layout === 'grid' ? 'd-flex gap-3' : '' ).'"
	 id="'.( $layout === 'grid' ? 'liked-blogs-tab' : 'liked-blogs-tab-list' ).'"
	 aria-label="liked-blogs">'.
	'</div>'.

	'</article>';

	return $sidebar;
}