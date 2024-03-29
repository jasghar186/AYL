<?php get_header(); ?>

<!-- Hero Section -->
<section class="container-fluid hero-section">
    <div class="row h-100">
        <div class="col-12 col-lg-7 position-relative d-flex flex-column justify-content-center mt-5 mt-lg-0 mb-5">
            <h1 class="text-primary-user m-0 text-capitalize font-lg lh-lg">Welcome to Automate Your Life</h1>
            <h2 class="fw-semibold fs-1">Live <!-- <br> --> <span class="text-primary">Smart</span></h2>
            <p class="fs-4 text-capitalize m-0">Helping you save time and money by building the smart home of your dreams</p>

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
<section class="container <?php echo SITE_LAYOUT_SPACE; ?>" style="height: 500px;">
    <a href="<?php echo site_url(); ?>" class="w-100">
        <img
        data-src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/welcome-banner-automate-life.webp"
        alt="Welcome To Automate Life"
        title="Welcome To Automate Life"
        loading="lazy"
        class="img-fluid rounded-3 w-100 h-100 object-fit-contain"
        width="1193" height="745">
    </a>
</section>

<!------------- As Seen On Section ----------------->
<section class="container-fluid <?php echo SITE_LAYOUT_SPACE; ?>">
    <h2 class="fw-semibold text-capitalize mb-5 text-center">As Seen On</h2>
    <div class="as-seen-on-row d-flex flex-wrap">
    <?php
        $asSeenOn = array(
            array(
                'url' => 'fox5',
                'title' => 'Fox',
            ),
            array(
                'url' => 'As_seen_on_(4)',
                'title' => 'MSN',
            ),
            array(
                'url' => 'technopedia_explore_popular_brand_24',
                'title' => 'Technopedia',
            ),
            array(
                'url' => 'As_seen_on_(7)',
                'title' => 'Wusa 90',
            ),
            array(
                'url' => 'As_seen_on_(6)',
                'title' => 'Wiki How',
            ),
            array(
                'url' => 'As_seen_on_(8)',
                'title' => 'Yahoo News',
            ),
            array(
                'url' => 'As_seen_on_(1)',
                'title' => 'Boston 25',
            ),
            array(
                'url' => 'As_seen_on_(5)',
                'title' => 'The Spruce',
            ),
            array(
                'url' => 'As_seen_on_govee',
                'title' => 'Govee',
            ),
            array(
                'url' => 'fox_13_explore_popular_brand_15',
                'title' => 'Fox 13',
            ),
        );
        foreach($asSeenOn as $image) {
            echo '<div class="as_seen_on_column flex-grow-1 mb-3 mb-lg-0">'.
            '<div class="rounded-circle d-flex align-items-center justify-content-center">'.
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
                'name' => 'Brian',
                'description' => 'One of the most popular smart home Youtubers on the internet, Brian started Automate Your Life all the way back in 2017.',
            ),
            array(
                'image' => 'expert-team-2',
                'name' => 'Marty',
                'description' => 'Enthusiastically learning about smart home products and growing the Automate Your Life brand through new channels.',
            ),
            array(
                'image' => 'expert-team-3',
                'name' => 'Natsuki',
                'description' => 'A smart home industry veteran, with over 9 years experience working for some of the biggest companies in the smart home space in the US.',
            ),
        );

        foreach($expertsArray as $index => $experts) {
            echo '<div class="col-12 col-md-4 d-flex flex-column align-items-center '. ($index !== count($expertsArray) - 1 ? 'mb-5 pb-3' : '') .' mb-lg-0 pb-lg-0">'.
            '<div class="expert-team-card bg-white">'.
            '<div class="rounded-image-wrapper">'.
            '<img
            data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$experts['image'].'.webp"
            alt="'.$experts['name'].'"
            title="'.$experts['name'].'"
            loading="lazy"
            width="382"
            height="395"
            class="w-100 h-100 img-fluid" />'.
            '</div>'.
            '<div class="experts-card-content mt-3 px-2 pb-30">'.
            '<p class="text-left">Hey there! <br /> 
            I\'m '.$experts['name'] .', ' . $experts['description'].' </p>'.
            '<div class="d-flex align-items-center justify-content-center">'.
            '<a href="#"
            type="button"
            class="bg-primary btn">View More</a>'.
            '</div>'.
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
                    'url' => 'hisense_explore_popular_brand_11',
                    'title' => 'Hisense',
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
                    'url' => 'eufy_explore_popular_brand_9',
                    'title' => 'EUFY',
                ),
                array(
                    'url' => 'directv_explore_popular_brand_8',
                    'title' => 'Directv',
                ),
                array(
                    'url' => 'disnep_explore_popular_brand_7',
                    'title' => 'Disney',
                ),
                array(
                    'url' => 'arlo_explore_popular_brand_4',
                    'title' => 'ARLO',
                ),
                array(
                    'url' => 'roku_explore_popular_brand_19',
                    'title' => 'Roku',
                ),
                array(
                    'url' => 'LG_explore_popular_brand_13',
                    'title' => 'LG',
                ),
                array(
                    'url' => 'verison_explore_popular_brand_25',
                    'title' => 'Verison',
                ),
                array(
                    'url' => 'yolink_explore_popular_brand_28',
                    'title' => 'Yolink',
                ),  
                array(
                    'url' => 'govee-01-01',
                    'title' => 'Govee',
                ),  
                array(
                    'url' => 'blink_explore_popular_brand_5',
                    'title' => 'Blink',
                ),
                array(
                    'url' => 'samsung_explore_popular_brand_20',
                    'title' => 'Samsung',
                ),
                array(
                    'url' => 'dell_explore_popular_brand_6',
                    'title' => 'Dell',
                ),
                array(
                    'url' => 'netflix_explore_popular_brand_18',
                    'title' => 'Netflix',
                ),
                array(
                    'url' => 'meross_explore_popular_brand_16',
                    'title' => 'Meross',
                ),
                array(
                    'url' => 'xfinity_explore_popular_brand_27',
                    'title' => 'Xfinity',
                ),
                array(
                    'url' => 'vizo_explore_popular_brand_26',
                    'title' => 'VIZO',
                ),
                              
            );
            foreach($popular_brands_arr as $brand) {
                echo '<div class="popular_brands_slide col-2">'.
                '<div class="circular-image rounded-circle p-3 d-flex align-items-center justify-content-center">'.
                '<a href="'.site_url().'/tag' . '/'.str_replace(' ', '', strtolower($brand['title'])).'"
                class="w-100">'.
                '<img
                data-src="'.site_url().'/wp-content/themes/automate-life/assets/images/'.$brand['url'].'.webp"
                alt="'.$brand['title'].'"
                title="'.$brand['title'].'"
                loading="lazy"
                width="128"
                height="128"
                class="img-fluid" />'.
                '</a>'.
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
        'exclude'    => get_cat_ID('uncategorized'),
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

            echo  '<div class="col-12 col-md-6 col-lg-3 mb-4 category-card">'.
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
            class="bg-primary btn">Read More</a>'.
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