<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package automate_life
 */

if ( ! function_exists( 'automate_life_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function automate_life_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'automate-life' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'automate_life_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function automate_life_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'automate-life' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'automate_life_last_revised' ) ):
	/**
	 * Prints HTML with meta information for the last revision of the post
	 */
	function automate_life_last_revised() {
		$revised_byline = sprintf(
			'Last updated %1$s',
			'<span class="revision-date">' . date_i18n( 'M j, Y', strtotime( get_the_modified_date( 'Y-m-d H:i:s' ) ) ) . '</span>'
		);
	
		echo '<span class="byline d-inline-block font-md text-dark fw-normal"> ' . $revised_byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped	
	}
endif;

if ( ! function_exists( 'automate_life_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function automate_life_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'automate-life' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'automate-life' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'automate-life' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'automate-life' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'automate-life' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'automate-life' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'automate_life_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function automate_life_post_thumbnail() {
		if ( post_password_required() || is_attachment() ) {
			return;
		}

		if( ! has_post_thumbnail() && ( is_singular( 'post' ) || get_post_type() === 'post' ) ){
			// If is singular post page and post does not have a featured thumbnail
			?>
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tab-index="-1"
			class="post-thumbnail">
				<img
				src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/welcome-banner-automate-life.jpeg"
				alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>"
				loading="lazy" width="850" height="900"
				class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-fluid"/> 
			</a>
			<?php
		}else if( has_post_thumbnail() ) {
			// If post or page have a featured thumbnail
			?>
			<a href="<?php the_permalink(); ?>" aria-hidden="true" tab-index="-1"
			class="post-thumbnail w-100">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a><!-- .post-thumbnail -->
			<?php
		}else if( ! has_post_thumbnail() && ! is_singular() ) {
			?>
			<a class="post-thumbnail w-100" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>
			<?php
		}

	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'automate_life_email_recaptcha' ) ):
	/**
	 * Show an email captcha form on page
	 * @param string $theme color theme for captcha box
	 * @param string $placement placement of lead form to be used on
	 * @return string The generated email captcha form
	 */
	function automate_life_email_recaptcha($theme = 'light', $placement = '') {

		if( $theme !== 'light' && $theme !== 'dark' ) {
			return;
		}

		$form = '<form
		action="#"
		method="post"
		class="lead-form w-100 position-relative">
		<label for="'.$placement.'" class="w-100 d-block">
		<input type="email" name="'.$placement.'" id="'.$placement.'" required
		placeholder="Enter Your Email Address"
		class="p-3 rounded-3 w-100 border-0 '.($theme === 'dark' ? 'bg-primary text-light placeholder-white' : 'bg-white text-dark placeholder-black').'">
		</label>
		<label for="lead-form-prevent-submission" class="form-hidden-field">
		<input type="text" class="lead-form-prevent-submission form-hidden-field" name="lead-form-prevent-submission"/>
		</label>
		<input type="submit" value="subscribe"
		class="text-capitalize text-center position-absolute top-50 border-0
		translate-middle-y rounded-2 '.($theme === 'dark' ? 'bg-white text-dark' : 'bg-primary text-light').'">
		<p class="lead-form-response p-0 m-0 position-absolute start-0 d-none" style="bottom:-2rem;"></p>
		</form>';

		return $form;
	}
endif;


/**
 * Email lead capture form layout 2
 */
if ( ! function_exists( 'automate_life_email_recaptcha_layout_2' ) ):
	/**
	 * Show an email captcha form on page
	 * @param string $theme color theme for captcha box
	 * @param string $placement placement of lead form to be used on
	 * @return string The generated email captcha form
	 */
	function automate_life_email_recaptcha_layout_2($placement = '') {

		$form = '<form
		action="#"
		method="post"
		class="lead-form w-100 position-relative">
		<label for="'.$placement.'" class="w-100 d-block">
		<input type="email" name="'.$placement.'" id="'.$placement.'" required
		placeholder="Enter Your Email"
		class="p-3 rounded-3 w-100 border">
		</label>
		<input type="submit" value="subscribe"
		class="text-uppercase bg-primary text-center w-100 d-block fs-3 rounded-2 text-white mt-3">
		<p class="lead-form-response p-0 m-0 position-absolute start-0 d-none" style="bottom:-2rem;"></p>
		</form>';

		return $form;
	}
endif;