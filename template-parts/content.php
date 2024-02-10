<?php
/**
 * Template part for displaying posts content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-6 col-lg-4 col-xxl-3 bg-transparent mb-5'); ?>>
	<div class="blog-post-card hadow-sm h-100 bg-white rounded-4 pb-3 position-relative">
		<?php automate_life_post_thumbnail(); ?>

		<div class="entry-content mt-5 px-3 pb-5">
			<header class="entry-header blog-post-title">
				<a href="<?php the_permalink(); ?>"
				class="text-dark text-decoration-none d-inline-block text-capitalize">
					<h3 class="entry-title fw-light lh-sm font-30 m-0">
						<?php
						$post_title = trim( strip_tags( get_the_title() ) );
						// Truncate the title
						if( str_word_count($post_title) > 7 ) {
							$truncated_title = explode(' ', $post_title);
							$truncated_title = array_slice($truncated_title, 0, 7);
							echo implode(' ', $truncated_title) . '...';
						}else {
							echo $post_title;
						} ?>
					</h3>
				</a>
			</header><!-- .entry-header -->

			<div class="blog-post-content mt-0">
				<?php
				$post_content = trim(strip_tags(get_the_content()));

				if (str_word_count($post_content) > 20) {
					$words = preg_split("/\s+/", $post_content);
					$truncated_content = implode(' ', array_slice($words, 0, 20));
					// Now $truncated_content contains the first 20 words of the post content
					echo $truncated_content . '...';
				}else {
					echo $post_content;
				}
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer position-absolute" style="bottom:1rem;">
				<?php
					echo '<span class="text-capitalize font-size-inherit fw-light">By '.get_the_author().'</span>';
				?>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->