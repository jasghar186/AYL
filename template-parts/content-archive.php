<?php
/**
 * Template part for displaying archive posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container-fluid'); ?>>			
            <!-- Post Header -->
            <header class="entry-header single-blog-header mb-4">
                <?php
                    if( is_singular() ) {
                        the_title( '<h1 class="entry-title my-5">', '</h1>' );
                    }else {
                        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                    }
                ?>
            </header>

            <div class="entry-content blog-content">
                <?php
                    echo get_the_title();
                    echo '<br />';
                // the_content(
                //     sprintf(
                //         wp_kses(
                //             /* translators: %s: Name of current post. Only visible to screen readers */
                //             __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'automate-life' ),
                //             array(
                //                 'span' => array(
                //                     'class' => array(),
                //                 ),
                //             )
                //         ),
                //         wp_kses_post( get_the_title() )
                //     )
                // );
                ?>
            </div>


	<footer class="entry-footer">
		<?php // automate_life_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->