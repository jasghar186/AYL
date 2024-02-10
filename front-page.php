<?php get_header(); ?>

<!-- Hero Section -->
<section class="container-fluid hero-section border-bottom border-dark">
    <div class="row h-100">
        <div class="col-12 col-lg-7 position-relative d-flex flex-column justify-content-center mt-5 mt-lg-0 mb-5">
            <p class="text-primary-user m-0 text-capitalize">Hello I'm Marty Spargo</p>
            <h1 class="fw-semibold">Smart Homes <br><span class="text-primary-user">Expert</span></h1>
            <p class="fs-4 text-capitalize m-0">Freelance web designer and developer</p>

            <!-- Lead Form -->
            <div class="frontpage-lead-form">
                <?php echo automate_life_email_recaptcha('dark', 'lead-email'); ?>
            </div>
            <!-- Lead Form -->
        </div>
        <div class="col-12 col-lg-5 bg-primary position-relative hero-image-column">
            <img data-src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/home_hero_man.webp" alt="Automate life"
            loading="lazy" width="438" height="500" class="bottom-0 object-fit-contain position-absolute pe-none user-select-none">
        </div>
    </div>
</section>

<!------------- Mobile Form Section ----------------->
<section class="container-fluid my-5 d-lg-none">
    <?php echo automate_life_email_recaptcha('dark', 'lead-email-mobile'); ?>
</section>

<!------------- Welcome Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <img
    data-src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/welcome-banner-automate-life.webp"
    alt="Welcome To Automate Life"
    title="Welcome To Automate Life"
    loading="lazy"
    class="img-fluid rounded-3 w-100"
    width="1193" height="745">
</section>

<!------------- As Seen On Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">As Seen On</h2>
    <div class="row as-seen-on-row">
    <?php
        $asSeenOn = array(
            array(
                'url' => 'As_seen_on_(1)',
                'title' => 'Boston 25',
            ),
            array(
                'url' => 'As_seen_on_(2)',
                'title' => 'Fixya',
            ),
            array(
                'url' => 'As_seen_on_(3)',
                'title' => 'Ifixit',
            ),
            array(
                'url' => 'As_seen_on_(4)',
                'title' => 'MSN',
            ),
            array(
                'url' => 'As_seen_on_(5)',
                'title' => 'The Spruce',
            ),
            array(
                'url' => 'As_seen_on_(6)',
                'title' => 'Wiki How',
            ),
            array(
                'url' => 'As_seen_on_(7)',
                'title' => 'Wusa 90',
            ),
            array(
                'url' => 'As_seen_on_(8)',
                'title' => 'Yahoo News',
            ),
        );
        foreach($asSeenOn as $image) {
            echo '<div class="col mb-3 mb-lg-0">'.
            '<div class="circular-image rounded-circle p-4 p-md-3">'.
            '<img data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$image['url'].'.webp"
            width="128" height="128" loading="lazy" title="'.$image['title'].'" alt="'.$image['title'].'" class="img-fluid object-fit-contain" />'.
            '</div>'.
            '</div>';
        }
    ?>
    </div>
</section>

<!------------- Our Smart Homes Experts Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-4 mb-lg-5 text-center">our smart homes experts</h2>
    <div class="row">
        <?php
        $expertsArray = array(
            array(
                'image' => 'expert-team-1',
                'name' => 'natsuki',
                'description' => 'I have been developing wordpress websites for like an year now',
            ),
            array(
                'image' => 'expert-team-2',
                'name' => 'natsuki',
                'description' => 'I have been developing wordpress websites for like an year now',
            ),
            array(
                'image' => 'expert-team-3',
                'name' => 'natsuki',
                'description' => 'I have been developing wordpress websites for like an year now',
            ),
        );

        foreach($expertsArray as $index => $experts) {
            echo '<div class="col-12 col-md-4 d-flex flex-column align-items-center '. ($index !== count($expertsArray) - 1 ? 'mb-5 pb-3' : '') .' mb-lg-0 pb-lg-0">'.
            '<div class="rounded-image-wrapper">'.
            '<img
            data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$experts['image'].'.webp"
            alt="'.$experts['name'].'"
            title="'.$experts['name'].'"
            loading="lazy"
            width="382"
            height="395" />'.
            '</div>'.
            '<div class="experts-card-content mt-3">'.
            '<p class="text-center">Hey there! <br /> 
            I\'m '.$experts['name'] .' ' . $experts['description'].' </p>'.
            '<div class="d-flex align-items-center justify-content-center">'.
            '<a href="#" type="button" class="py-2 px-4 text-decoration-none bg-primary text-capitalize text-center rounded-circle-px">View More</a>'.
            '</div>'.
            '</div>'.
            '</div>';
        }
        ?>
    </div>
</section>

<!------------- Our Latest Videos Experts Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">our latest videos</h2>
    <div class="latest-videos-container row">
    <?php
        $latestVideos = get_option('our_latest_youtube_videos_option') !== false ? unserialize(get_option('our_latest_youtube_videos_option')) : array();
        
        echo '<div class="col-12 col-md-6 mb-5 mb-lg-0 latest-videos-iframe">'.
        '<iframe width="560" height="315" data-src="' . (isset($latestVideos[0]) ? $latestVideos[0] : '') . '"
        title="Automated Home" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
        encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"
        class="w-100 rounded-3 rounded-lg-0 flex-grow-1"></iframe>'.
        '</div>';

        echo '<div class="col-12 col-md-6 d-flex flex-column">'.
        '<iframe width="560" height="315" data-src="' . (isset($latestVideos[1]) ? $latestVideos[1] : '') . '"
        title="Automated Home" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
        encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"
        class="w-100 mb-5 mb-lg-3 rounded-3 rounded-lg-0 flex-grow-1"></iframe>'.
        '<iframe width="560" height="315" data-src="' . (isset($latestVideos[2]) ? $latestVideos[2] : '') . '"
        title="Automated Home" frameborder="0" allow="accelerometer; autoplay; clipboard-write;
        encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"
        class="w-100 rounded-3 rounded-lg-0 flex-grow-1"></iframe>'.
        '</div>';
    ?>

    </div>
</section>

<!------------- Smart Products In Stock Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">smart products in stock</h2>
    <div class="row">

    <?php 
    $smartProducts = get_option('shopify_products_option') !== false ? unserialize(get_option('shopify_products_option')) : array();
    $content = '';

    foreach($smartProducts as $index => $product) {
        $attachment_id = $product['image'];
        $image_url = wp_get_attachment_url($attachment_id);

        $img_url = wp_get_attachment_image_src($attachment_id, 'full');
        $img_url = $img_url[0];
        $img_title = get_the_title($attachment_id);
        $img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

        $content .= '<div class="col-12 col-md-4">'.
        '<div class="affiliated-products-card pt-3 pb-5 rounded-4">'.
        '<a class="d-inline-block product-image-wrapper d-flex justify-content-center"
        href="'. esc_attr($product['id']) .'"
        target="_blank">';
        if( $image_url ) {
            $attachment_metadata = wp_get_attachment_metadata($attachment_id);
            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
            $attachment_title = get_the_title($attachment_id);
            $image_width = isset($attachment_metadata['width']) ? $attachment_metadata['width'] : '';
            $image_height = isset($attachment_metadata['height']) ? $attachment_metadata['height'] : '';

            $content .= '<img data-src="'. esc_url($image_url) .'"
            alt="'.esc_attr($alt_text).'"
            title="'.esc_attr($attachment_title).'"
            width="'.esc_attr($image_width).'"
            height="'.esc_attr($image_height).'"
            class="img-fluid affiliated-product-thumbnail object-fit-contain w-100 h-100"
            loading="lazy" />';
        }else {
            $content .= '<img data-src="'. site_url() .'/wp-content/themes/automate-life/assets/images/dummy_product.webp"
            alt="Dummy Product"
            title="Dummy Product"
            width="185"
            height="185"
            class="img-fluid affiliated-product-thumbnail object-fit-contain w-100 h-100"
            loading="lazy" />';
        }
        $content .= '</a>'.
        '<div class="affiliated-product-content mt-30 px-2">'.
        '<h4 
        class="mb-5 pb-1 text-center">
        <a
        href="'.esc_url($product['url']).'"
        class="text-dark text-capitalize text-left text-decoration-none font-30 fw-light"
        target="_blank">'. wp_trim_words(esc_html($product['title']), 15) .'</a></h3>'.
        '<div class="d-flex align-items-center justify-content-center">'.
        '<a type="button"
        class="py-2 px-5 text-decoration-none bg-primary text-capitalize text-center rounded-circle-px mx-auto"
        href="'.esc_attr($product['url']).'"
        target="_blank">Shop now</a>'.
        '</div>'.
        '</div>'.
        '</div>'.
        '</div>';
    }

    echo $content;
    ?>
    </div>
</section>


<!------------- Smart Products In Stock Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">Explore Popular Brands</h2>
    <div class="popular_brands_slider row">
        <?php
            $popular_brands_arr = array(
                array(
                    'url' => 'ADT_explore_popular_brand_1',
                    'title' => 'ADT',
                ),
                array(
                    'url' => 'apple_explore_popular_brand_2',
                    'title' => 'Apple',
                ),
                array(
                    'url' => 'aqara_explore_popular_brand_3',
                    'title' => 'Aqara',
                ),
                array(
                    'url' => 'arlo_explore_popular_brand_4',
                    'title' => 'ARLO',
                ),
                array(
                    'url' => 'blink_explore_popular_brand_5',
                    'title' => 'Blink',
                ),
                array(
                    'url' => 'dell_explore_popular_brand_6',
                    'title' => 'Dell',
                ),
                array(
                    'url' => 'disnep_explore_popular_brand_7',
                    'title' => 'Disney',
                ),
                array(
                    'url' => 'directv_explore_popular_brand_8',
                    'title' => 'Directv',
                ),
                array(
                    'url' => 'eufy_explore_popular_brand_9',
                    'title' => 'EUFY',
                ),
                array(
                    'url' => 'govee_explore_popular_brand_10',
                    'title' => 'Govee',
                ),
                array(
                    'url' => 'hisense_explore_popular_brand_11',
                    'title' => 'Hisense',
                ),
                array(
                    'url' => 'hulu_explore_popular_brand_12',
                    'title' => 'Hulu',
                ),
                
                array(
                    'url' => 'LG_explore_popular_brand_13',
                    'title' => 'LG',
                ),
                array(
                    'url' => 'FOX_explore_popular_brand_14',
                    'title' => 'FOX 5',
                ),
                array(
                    'url' => 'FOX_13_explore_popular_brand_15',
                    'title' => 'FOX 13',
                ),
                array(
                    'url' => 'meross_explore_popular_brand_16',
                    'title' => 'Meross',
                ),
                array(
                    'url' => 'netflix_explore_popular_brand_18',
                    'title' => 'Netflix',
                ),
                array(
                    'url' => 'roku_explore_popular_brand_19',
                    'title' => 'Roku',
                ),
                array(
                    'url' => 'samsung_explore_popular_brand_20',
                    'title' => 'Samsung',
                ),
                array(
                    'url' => 'sony_explore_popular_brand_21',
                    'title' => 'Sony',
                ),
                array(
                    'url' => 'swann_explore_popular_brand_22',
                    'title' => 'Swann',
                ),
                array(
                    'url' => 'swittchbot_explore_popular_brand_23',
                    'title' => 'Switch bot',
                ),
                array(
                    'url' => 'technopedia_explore_popular_brand_24',
                    'title' => 'Technopedia',
                ),
                array(
                    'url' => 'verison_explore_popular_brand_25',
                    'title' => 'Verison',
                ),
                array(
                    'url' => 'vizo_explore_popular_brand_26',
                    'title' => 'VIZO',
                ),
                array(
                    'url' => 'xfinity_explore_popular_brand_27',
                    'title' => 'Xfinity',
                ),
                array(
                    'url' => 'yolink_explore_popular_brand_28',
                    'title' => 'Yolink',
                ),                
            );
            foreach($popular_brands_arr as $brand) {
                echo '<div class="popular_brands_slide col-2">'.
                '<div class="circular-image rounded-circle p-3 d-flex align-items-center justify-content-center">'.
                '<img
                data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$brand['url'].'.webp"
                alt="'.$brand['title'].'"
                title="'.$brand['title'].'"
                loading="lazy"
                width="128"
                height="128"
                class="img-fluid" />'.
                '</div>'.
                '</div>';
            }
        ?>
    </div>
</section>

<!------------- Recent Articles Section ----------------->
<?php automate_life_recent_articles(); ?>
<!------------- Featured Cateogries Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">Featured Categories</h2>
    <div class="row">
    <?php
    $selected_category_slugs = array('compare', 'faq', 'troubleshoot', 'review');
    $included_categories = array();

    for($i = 0; $i < count($selected_category_slugs); $i++) {
        $cat = get_term_by('slug', $selected_category_slugs[$i], 'category');

        if($cat) {
            $included_categories[] = $cat->term_id;
        }
    }

    $categories = get_terms(array(
        'taxonomy'   => 'category',
        'orderby'    => 'name',
        'order'      => 'ASC',
        'hide_empty' => false,
        'include'    => $included_categories,
    ));

    if(!empty($categories)) {
        foreach($categories as $category) {
            $image = '';
            $categoryName = strtolower( trim( esc_html($category->name) ) );

            if($categoryName === 'compare') {
                $image = 'compare-category';
            }else if($categoryName === 'faq') {
                $image = 'faq-category';
            }else if($categoryName === 'troubleshoot') {
                $image = 'troubleshoot-category';
            }else if($categoryName === 'review') {
                $image = 'review-category';
            }else {
                $image = 'welcome-banner-automate-life';
            }

            echo  '<div class="col-12 col-md-6 mb-4 category-card">'.
            '<div class="post-thumbnail position-relative">'.
            '<img
            data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$image.'.webp"
            alt="'.esc_attr($category->name).'"
            title="'.esc_attr($category->name).'"
            loading="lazy"
            class="img-fluid"
            width="581"
            height="540" />'.
            '<div class="d-flex align-items-center justify-content-center position-absolute translate-middle-x start-50">'.
            '<a type="button" href="'.esc_url(get_category_link($category->term_id)).'"
            class="py-2 px-4 text-decoration-none bg-primary text-capitalize text-center rounded-circle-px">Read More</a>'.
            '</div>'.
            '</div>'.
            '</div>';
        }
    }else {
        echo '<p class="text-danger">Sorry, no categories found</p>';
    }
    ?>
    </div>
</section>

<?php get_footer(); ?>