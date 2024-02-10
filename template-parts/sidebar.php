<?php
/**
 * Template part for displaying a right sidebar in single blog page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */
?>
<article aria-label="sidebar" class="shadow-sm">
    <div class="d-flex justify-content-between gap-2">
        <span class="cursor-pointer recommended-tab flex-grow-1 text-center blog-sidebar-toggle px-1 py-0 bg-primary text-light fs-6" data-target="#recommended-blogs-tab">
            Recommended
        </span>
        <span class="cursor-pointer recommended-tab flex-grow-1 text-center blog-sidebar-toggle px-1 py-0 bg-secondary fs-6" data-target="#recently-viewed-tab">
            Recently Viewed
        </span>
        <span class="cursor-pointer liked-tab flex-grow-1 text-center blog-sidebar-toggle px-1 py-0 bg-secondary fs-6" data-target="#liked-blogs-tab">
            Liked
        </span>
        
    </div>

    <div class="mt-4 px-2 pb-3 blog-sidebar-tab" id="recommended-blogs-tab" aria-label="Recommended Blogs">
        <?php
            $post_args = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'post__not_in' => array(get_the_ID()),
            );
            automate_life_cards_layout_1($post_args);
        ?>
    </div>

    <div class="mt-4 px-2 pb-3 blog-sidebar-tab d-none" id="recently-viewed-tab" aria-label="Recently Viewed Blogs">
        <?php
            if( isset($_COOKIE['post-recently-viewed']) ) {
                $ids = json_decode($_COOKIE['post-recently-viewed']);
                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'post__in' => $ids,
                );
                automate_life_cards_layout_1($post_args);
            }else {
                echo '<p class="lead text-danger text-capitalize text-center m-0">Sorry, no recently viewed posts found</p>';
            }

        ?>
    </div>

    <div class="mt-4 px-2 pb-3 blog-sidebar-tab d-none" id="liked-blogs-tab" aria-label="liked-blogs">
        <?php
            if( isset($_COOKIE['liked-posts']) ) {
                $ids = json_decode($_COOKIE['liked-posts']);
                $post_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                    'post__in' => $ids,
                );
                automate_life_cards_layout_1($post_args);
            }else {
                echo '<p class="lead text-danger text-capitalize text-center m-0">Sorry, no recently liked found</p>';
            }

        ?>
    </div>

  
</article>

<?php

/**
 * @param array $ids array of post ids
 */

function automate_life_cards_layout_1($array) {

    $posts = get_posts($array);

    $html = '';
    $cat = get_the_category();

    if(!empty($posts)) {
        foreach($posts as $post) {
            $html .= '<div '.$post->ID.' class="d-flex align-items-start justify-content-start mb-4 gap-3">'.
            '<a href="'.get_the_permalink($post->ID).'" class="post-card-thumbnail d-inline-block w-50">';
            if(has_post_thumbnail()) {
                $html .= get_the_post_thumbnail();
            }
            $html .= '</a>'.
            '<div class="card-content w-50">'.
            '<a href="'.get_the_permalink($post->ID).'" class="text-decoration-none
            d-inline-block related-post-title fs-5 mb-2">'.get_the_title($post->ID).'</a>';
            foreach($cat as $index => $c) {
                if(!is_null($cat)) {
                    $html .= '<a href="'.esc_url(get_category_link($c->term_id)).'"
                    class="text-dark text-capitalize text-decoration-none fs-6">'.esc_html($c->name).'</a>';
                    if(count($cat) > 0 && $index !== count($cat) - 1) {
                        $html .= ',';
                    }
                }
            }
            $html .= '</div>'.
            '</div>';
        }
    }

    echo $html;
}