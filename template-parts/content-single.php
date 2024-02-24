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

<article id="post-<?php the_ID(); ?>" <?php post_class('container-fluid mb-0 mb-lg-4'); ?>>

	<div class="row position-relative">
		<div class="col-3 position-sticky top-0 table-of-content-column d-none d-lg-block pt-5">
			<div class="rounded-3 shadow p-2 position-sticky" style="top:2rem;">
				<h3 class="text-capitalize fw-bold">
					Table of Contents
				</h3>
				<ul class="toc p-0 m-0"></ul>
			</div>
		</div>
		
		<div class="col-12 col-lg-6 shadow-sm pb-4 flex-grow-1">
			<div class="d-flex align-items-center justify-content-between">
				<?php get_template_part('template-parts/breadcrumbs');  ?>

				<!-- Post CTA -->
				<div class="post-cta d-none d-lg-flex align-items-center justify-content-end gap-3">
					<div class="post-like-dislike d-flex align-items-center justify-content-end">
						<span class="me-2 font-sm text-dark text-capitalize">Was this helpful?</span>
						<div class="d-flex align-items-center">
							<span class="me-2 cursor-pointer user-post-liked" data-liked="1" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_liked_posts)) { echo 'custom-text-info'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-up.svg" alt="" srcset=""></span>
							<span class="cursor-pointer user-post-disliked " data-liked="0" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_disliked_posts)) { echo 'custom-text-danger'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-down.svg" alt="" srcset=""></span>
						</div>
					</div>
					<button class="send-feedback-trigger font-sm rounded-1 border p-1 send-feedback-trigger">Send Feedback</button>
				</div>
			</div>

			<!-- Post Header -->
			<header class="entry-header single-blog-header mb-2 mb-lg-4">
				<?php
					if( is_singular() ) {
						the_title( '<h1 class="entry-title my-2 my-lg-5">', '</h1>' );
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
								$author_avatar_size = wp_is_mobile() ? 35 : 50;
								$author_avatar = get_avatar(get_the_author_meta('user_email'), $author_avatar_size, '', '', array('class' => 'rounded-circle'));

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
								echo '<span>Fact checked by <span class="fact-checker-author text-capitalize">' . esc_html($factCheckerUser->display_name) . '</span></span>';
							}
						?>

						<div class="d-flex align-items-center justify-content-start my-2 my-lg-4 gap-2 gap-lg-3 posted-date">
							<div class="d-flex align-items-center">
								<i class="bi bi-clock fs-3" style="color:green;"></i>
							</div>
							<?php automate_life_last_revised(); ?>
							<span class="meta-separator" style="color:grey;">|</span>
							<?php estimate_reading_time(); ?>
						</div>

						<p class="post-disclaimer p-1 p-lg-3 font-sm lh-sm text-dark mb-2 mb-lg-3">
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

			<!-- Table of content mobile view -->
			<div class="toc-mobile mt-20 mb-3 py-2 d-lg-none">
				<div class="toc-mobile-container d-flex align-items-center justify-content-between px-3">
					<span class="text-dark">Table of Contents</span>
					<span class="cursor-pointer text-primary toggle-toc-mobile text-capitalize">
						<span class="toggle-toc-mobile-text">Show More</span>
						<i class="bi bi-caret-down-fill"></i>
					</span>
				</div>
				<div class="px-3 toc-mobile-wrapper pt-3" style="display:none;">
					<ul class="toc m-0 p-0"></ul>
				</div>
			</div>

			<div class="entry-content blog-content mt-0 mt-lg-4">
				<!-- Exclusive content -->

				<?php
				$is_subscriber = isset($_COOKIE['user_is_subscribed']) ? $_COOKIE['user_is_subscribed'] : null;

				$exclusive_content_author = unserialize(get_option('authorized_users_for_exclusive_content_option'));
				$exclusive_content_category = unserialize(get_option('exclusive_content_categories_option'));
				$post_author_login = get_the_author_meta( 'user_login', get_post_field( 'post_author', get_the_ID() ) ); // Get current post author
				$current_post_categories = [];
				foreach(get_the_category() as $category) {
					if(in_array($category->slug, $exclusive_content_category)) {
						$current_post_categories[] = $category->slug;
					}
				}

				if( in_array($post_author_login, $exclusive_content_author) &&
				count($current_post_categories) > 0 && $is_subscriber !== 'true' ) {

					$blog_content = get_the_content();
					$paragraphs = explode('</p>', $blog_content);

					$word_limit = get_option('number_of_words_to_show_option');

					$blog_content_truncated = '';
					$word_count = 0;
					foreach ($paragraphs as $paragraph) {
						// Count words in the paragraph
						$paragraph_words = str_word_count(strip_tags($paragraph), 1);

						// Check if adding this paragraph exceeds the word limit
						if ($word_count + count($paragraph_words) <= $word_limit) {
							$blog_content_truncated .= $paragraph . '</p>';
							$word_count += count($paragraph_words);
						} else {
							// Calculate how many words to take from this paragraph
							$words_to_take = $word_limit - $word_count;
							$first_words = implode(' ', array_slice($paragraph_words, 0, $words_to_take));
							$blog_content_truncated .= '<p>' . $first_words . '</p>';
							break; // Stop processing further paragraphs
						}
					}

					echo $blog_content_truncated;

					?>

					<div class="exclusive-content-wrapper">
						<div class="py-30 px-2 px-lg-4 bg-white">
							<p class="mb-4 text-center">Enter your email to continue reading all of our articles 100% for free</p>
							<?php 
								echo automate_life_email_recaptcha_layout_2('exclusive-content-lead-popup');
							?>
							<p class="mt-4 text-center">
								No spam, Unsubscribe at any time.
							</p>
							<div class="exclusive-content-logo d-flex justify-content-center align-items-center">
								<?php 
									echo '<img data-src="'.wp_get_attachment_image_url(get_option('site_logo')).'"
									alt="Exclusive Content" title="'.get_the_title().'"
									width="260" height="350" loading="lazy" class="img-fluid object-fit-contain"/>';
								?>
							</div>
					</div>
				</div>

				<?php
				}else {
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
				}

				?>
			</div>

			<!-- Post like dislike -->
			<div class="post-like-dislike d-flex align-items-center justify-content-center mt-2 mt-lg-4
			flex-column flex-lg-row">
				<span class="m-0 me-lg-3 font-md text-dark text-capitalize">Was this helpful?</span>
				<div class="d-flex align-items-center mt-2 mt-lg-0">
					<span class="me-2 cursor-pointer user-post-liked" data-liked="1" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_liked_posts)) { echo 'custom-text-info'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-up.svg" alt="" srcset=""></span>

					<span class="cursor-pointer user-post-disliked " data-liked="0" data-post="<?php echo get_the_ID(); ?>"><img class="<?php if (in_array($pstid, $all_disliked_posts)) { echo 'custom-text-danger'; } ?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/icons-thumbs-down.svg" alt="" srcset=""></span>
				</div>
			</div>

			<button class="send-feedback-trigger fs-6 rounded-1 border py-1 px-3 d-block mx-auto my-3">Send Feedback</button>

			<!-- Share on social sites -->
			<h4 class="text-dark text-capitalize mb-3 text-center d-lg-none">Share this post</h4>
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
					echo '<div class="col">'.
					'<a class="d-flex align-items-center justify-content-center
					rounded-2 p-1 w-100 text-white text-uppercase font-md
					blog-social-share blog-social-share-'.$social['name'].'"
					'.($social['name'] !== 'copy' && $social['name'] !== 'share' ? 'target="_blank"' : '').'
					href="'.$social['url'].'">'.
					'<i class="bi '.$social['icon'].' d-inline-block font-xl"></i>'.
					'</a>'.
					'</div>';
				}
				?>
			</div>

			<!-- AYL Google News Feed -->
			<a href="https://news.google.com/publications/CAAqBwgKMOLgnwww2IewBA?hl=en-MY&gl=MY&ceid=MY:en"
			target="_blank" class="d-flex align-items-center
			justify-content-around google-news-feed text-decoration-none px-2 mt-30">
				<span class="text-dark font-md">Add AYL to your Google news feed.</span>
				<img data-src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/google-news-feed.webp"
				alt="Add AYL to your Google news feed" title="Add AYL to your Google news feed"
				loading="lazy" width="120" height="70" class="ayl-google-news-image">
			</a>

			<!-- Recommended posts -->
			<?php
				if( wp_is_mobile() ) {
					?>
						<h3 class="text-dark my-4 text-center">Recommended For You</h3>
						<?php
							$recommended_posts_args = array(
								'post_type' => 'post',
								'posts_per_page' => 3,
								'paged' => 1,
							);
							echo automate_life_cards_layout($recommended_posts_args, 'list');
							
						?>
					<?php
				}
			?>
		</div> <!-- *column closing div  -->
		
		<div class="col-3 blog-sidebar-column d-none d-lg-block">
			<?php
				echo automate_life_sidebar_layout('list');
			?>
		</div>
	</div>

		<?php
		if( ! wp_is_mobile() ) {
			?>
			<div class="row mt-5">
				<div class="col-3 table-of-content-column"></div>
				<div class="col-6 shadow-sm flex-grow-1">
						<?php echo automate_life_sidebar_layout('grid'); ?>
				</div>
				<div class="col-3 blog-sidebar-column"></div>
			</div>
			<?php
		}
		?>

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