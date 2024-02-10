<?php
/**
 * Template part for displaying breadcrumbs in single blog pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package automate_life
 */

 ?>
<div class="automate-life-breadcrumbs">
    <nav class="automate-life-breadcrumb" aria-label="breadcrumb">
        <a href="<?php echo esc_url( site_url() ); ?>"
        class="text-dark text-decoration-none font-sm me-2 d-inline-block">Home</a>
        <?php
            // Get category associated with blog
            $categories = get_the_category();
            $parent_categories = [];
            $categoryLen = count($categories);

            if ($categories && !is_wp_error($categories)) {

                // Get only the parent categories
                foreach( $categories as $index => $category ) {
                    if( $category->parent === 0 ) {
                        $category = trim($category->term_id );
                        if( ! in_array($category, $parent_categories) ) {
                            $parent_categories[] = $category;
                        }
                    }
                }
                $parent_categories_count = count($parent_categories);
                $separator = '<span class="separator me-2 text-dark font-sm d-inline-block">&gt;</span>';
                
                foreach ($parent_categories as $index => $category_id) {
                    $category = get_category($category_id);
            
                    if ($index === $parent_categories_count - 1) {
                        echo $separator;
                        echo '<a class="text-dark text-decoration-none font-sm text-capitalize me-2 d-inline-block" href="' . esc_url(get_category_link($category->term_id)) . '">';
                        echo esc_html($category->name);
                        echo '</a>';
            
                        // Check if the last parent category has child categories
                        $child_categories = get_categories(array('parent' => $category->term_id));
                        if ($child_categories) {
                            foreach ($child_categories as $child_category) {
                                echo $separator;
                                echo '<a class="text-dark text-decoration-none font-sm text-capitalize me-2 d-inline-block" href="' . esc_url(get_category_link($child_category->term_id)) . '">';
                                echo esc_html($child_category->name);
                                echo '</a>';
                            }
                        }
                    }
                }
            }

        ?>
    </nav>
</div>