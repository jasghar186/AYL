<?php
/**
 * automate life functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package automate_life
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if(!defined('company_socials')) {
	$urls = array(
		'twitter_option', 'facebook_option', 'tiktok_option', 'youtube_option',
		'pinterest_option', 'instagram_option',
	);

	define('COMPANY_SOCIALS_URLS', $urls);
}

if(!defined('SITE_LAYOUT_SPACE')) {
	$spacing = strtolower(get_option('layout_space_option')) === 'comfortable' ? 'my-5' : 'my-4';
	define('SITE_LAYOUT_SPACE', $spacing);
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function automate_life_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on automate life, use a find and replace
		* to change 'automate-life' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'automate-life', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
        array(
            'primary_menu'   => esc_html__('Primary Menu', 'automate-life'),
            'footer_menu'    => esc_html__('Footer Menu', 'automate-life'),
            'off_canvas_menu' => esc_html__('Off Canvas Menu', 'automate-life'),
        )
    );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'automate_life_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	if(get_option('automate_life_theme_activated') !== '1') {
		$shopify_products_arr = array(
			array(
				'id' => 0,
				'image' => 0,
				'title' => 'dummy product 1',
				'price' => '99.00',
				'url'	=> 'https://www.shopify.com',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
			),
			array(
				'id' => 1,
				'image' => 0,
				'title' => 'dummy product 2',
				'price' => '199.00',
				'url'	=> 'https://www.shopify.com',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
			),
			array(
				'id' => 2,
				'image' => 0,
				'title' => 'dummy product 3',
				'price' => '199.00',
				'url'	=> 'https://www.shopify.com',
				'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
			),
		);
		// Set default options
		$default_options = array(
			'change_font_size_option' => '1.125rem',
			'h1_font_size_option' => '36px',
			'apply_h1_font_size_to_all_headings_option' => 0,
			'body_font_option' => 'Arial, sans-serif',
			'heading_font_option' => 'Arial, sans-serif',
			'primary_color_option' => '#F97D03',
			'secondary_color_option' => '#e5e4e4',
			'accent_color_option' => '#ffffff',
			'h1_color_option' => '#111111',
			'apply_h1_color_to_all_headings_option' => 0,
			'post_meta_display_date_option' => 'both',
			
			'change_logo_height_option' => '75px',
			'display_featured_images_option' => 0,
			'hide_featured_images_from_small_screens_option' => 0,
			'footer_copyright_text_option' => '© Copyright Automate Life 2017-' .Date('Y').' All Rights Reserved',
			'enable_search_bar_option' => 0,
			'layout_space_option' => 'Comfortable',
			'display_tag_links_option' => 0,
			'article_navigation_option' => 0,
			'twitter_option' => '',
			'facebook_option' => '',
			'tiktok_option' => '',
			'youtube_option' => '',
			'pinterest_option' => '',
			'instagram_option' => '',
			'our_latest_youtube_videos_option' => serialize(array()),
			'shopify_products_option' => serialize($shopify_products_arr),
			'lead_form_popup_timer_option' => 15000,
		);

		foreach ($default_options as $option_name => $default_value) {
			// If the option does not exist already then create it
            if (get_option($option_name) === false) {
                update_option($option_name, $default_value);
            }
        }

		// Mark the theme as activated
        update_option('automate_life_theme_activated', '1');
	}
}
add_action( 'after_setup_theme', 'automate_life_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function automate_life_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'automate_life_content_width', 640 );
}
add_action( 'after_setup_theme', 'automate_life_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function automate_life_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'automate-life' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'automate-life' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'automate_life_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function automate_life_scripts() {
	wp_enqueue_style( 'automate-life-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'automate-life-style', 'rtl', 'replace' );
	wp_enqueue_style( 'automate-life-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all' );
	wp_enqueue_style( 'automate-life-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css', array(), '1.11.2', 'all' );
	wp_enqueue_style( 'automate-life-slick-slider-style', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), '1.8.1', 'all' );
	wp_enqueue_style( 'automate-life-template-style', get_template_directory_uri() . '/assets/css/style.css?unique='.time(), array(), _S_VERSION, 'all' );
	
	$styleFilePath = get_template_directory() . '/global-options-styles.css';
	if (file_exists($styleFilePath)) {
		// Enqueue the style only if the file exists
		wp_enqueue_style('global-options-styles', get_template_directory_uri() . '/global-options-styles.css', array(), '1.0', 'all');
	} else {
		/*
		 *** Log a warning message in case 
		 *** global options style file is not found */

		echo "Warning: The style file 'global-options-styles.css' was not found.";
	}

	// Enqueue your script

	if (!wp_script_is('jquery', 'queue')) {
		wp_enqueue_style('automate-life-jquery', '//code.jquery.com/jquery-3.7.1.min.js', array(), '3.7.1', true);
	}
	
	wp_enqueue_script( 'automate-life-slick-slider-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true );
	wp_enqueue_script( 'automate-life-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'automate-life-script-js', get_template_directory_uri() . '/assets/js/user_script.js?unique='.time(), array('jquery'), _S_VERSION, true );

	wp_localize_script( 'automate-life-script-js', 'admin_ajax', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'email_popup_timer' => get_option('lead_form_popup_timer_option') ?? 15000,
		'page_scroll_limit' => get_option('page_scroll_limit_option') ?? 30,
	));

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'automate_life_scripts' );

/**
 * Enqueue scripts and styles in admin dashboard.
 */
function automate_life_admin_scripts() {
	
	if ( isset( $_GET['page'] ) && $_GET['page'] === 'automate-life-settings' ) {
        wp_enqueue_style( 'automate-life-bootstrap-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2', 'all' );
		wp_enqueue_script('automate-life-bootstrap-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);
    }
	
	wp_enqueue_style( 'automate-life-template-style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'automate-life-bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css', array(), '1.11.2', 'all' );
	wp_enqueue_script('automate-life-script', get_template_directory_uri() . '/assets/js/script.js?unique='.time(), array(), _S_VERSION, true);
	// Enqueue WordPress Media Script
	if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }
	// Localize the script for Ajax
	wp_localize_script('automate-life-script', 'admin_ajax', array('ajax_url' => admin_url('admin-ajax.php')));

}
add_action( 'admin_enqueue_scripts', 'automate_life_admin_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Add options page in WordPress dashboard
 */
function automate_life_add_options_page() {
	add_theme_page(
        'Automate Life',
        'Automate Life', 
        'manage_options',
        'automate-life-settings', 
        'custom_theme_page_content'
    );
}

// Callback function to display the content of the custom page
function custom_theme_page_content() {
	require_once get_template_directory() . '/template-parts/options-page.php';
	echo automate_life_options_page();
}

// Hook to add the options page to the "Appearance" menu
add_action('admin_menu', 'automate_life_add_options_page');


// AJAX callback
function automate_life_create_css_callback() {
    $options = isset($_POST['optionsArr']) ? $_POST['optionsArr'] : array();
	$response = array(
		'response' => 'Records Updated',
		'status'   => 1,
	);

    // Access values like this
    $optionsArr = array(
        'change_font_size_option' 		=> sanitize_text_field($options['change_font_size_option']),
        'h1_font_size_option' 			=> sanitize_text_field($options['h1_font_size_option']),
        'body_font_option' 				=> sanitize_text_field($options['body_font_option']),
        'heading_font_option' 			=> sanitize_text_field($options['heading_font_option']),
        'change_logo_height_option' 	=> sanitize_text_field($options['change_logo_height_option']),
		'apply_h1_font_size_to_all_headings_option' 	=> sanitize_text_field($options['apply_h1_font_size_to_all_headings_option']),
		'primary_color_option' 			=> sanitize_text_field($options['primary_color_option']),
		'secondary_color_option' 			=> sanitize_text_field($options['secondary_color_option']),
		'accent_color_option' 			=> sanitize_text_field($options['accent_color_option']),
		'h1_color_option' 				=> sanitize_text_field($options['h1_color_option']),
		'apply_h1_color_to_all_headings_option' => sanitize_text_field($options['apply_h1_color_to_all_headings_option']),
		'hide_featured_images_from_small_screens_option' => sanitize_text_field($options['hide_featured_images_from_small_screens_option']),
    );

  	// Iterate through options and create CSS rules
	$cssContent = '';

	foreach ($optionsArr as $selector => $value) {
    if ($selector === 'change_font_size_option') {
        $cssContent .= "body {\n" .
            "    font-size: $value;\n" .
            "}\n";
    } else if ($selector === 'body_font_option') {
		$decodedFontFamily = preg_replace('/[\\\\]/', '', $value);
        $cssContent .= "body {\n" .
            "    font-family: $decodedFontFamily;\n" .
            "}\n";
    } else if ($selector === 'h1_font_size_option') {
        $cssContent .= "h1 {\n" .
            "    font-size: $value;\n" .
            "}\n";
    } else if ($selector === 'heading_font_option') {
        $decodedHeadingFontFamily = preg_replace('/[\\\\]/', '', $value);
        $cssContent .= "h1, h2, h3, h4, h5, h6 {\n" .
            "    font-family: $decodedHeadingFontFamily;\n" .
            "}\n";
    } else if ($selector === 'change_logo_height_option') {
        $cssContent .= ".site-logo img, .site-branding img {\n" .
            "    height: $value;\n" .
			"    object-fit: contain;\n".
            "}\n";
    } else if ($selector === 'apply_h1_font_size_to_all_headings_option' && intval($value) === 1) {
		$h1FontSize = $optionsArr['h1_font_size_option'];
		$cssContent .= "h1, h2, h3, h4, h5, h6 {\n" .
			"    font-size: $h1FontSize;\n" .
			"}\n";
	}else if($selector === 'primary_color_option') {
		$cssContent .= ".bg-primary, button {\n" .
            "    background-color: $value !important;\n" .
            "}\n";
			$cssContent .= ".border-primary {\n" .
				"    border-color: $value !important;\n" .
				"}\n";
			$cssContent .= ".text-primary {\n" .
			"    color: $value !important;\n" .
			"}\n";
	}else if($selector === 'secondary_color_option') {
		$cssContent .= ".bg-secondary, button {\n" .
            "    background-color: $value !important;\n" .
            "}\n";
			$cssContent .= ".border-secondary {\n" .
				"    border-color: $value !important;\n" .
				"}\n";
			$cssContent .= ".text-secondary {\n" .
			"    color: $value !important;\n" .
			"}\n";
	}else if($selector === 'accent_color_option') {
		$cssContent .= ".bg-accent, button {\n" .
            "    background-color: $value !important;\n" .
            "}\n";
			$cssContent .= ".text-accent,a, a[href], .text-link {\n" .
			"    color: $value;\n" .
			"}\n";
	}else if($selector === 'h1_color_option') {
		$cssContent .= ".bg-headings-color {\n" .
            "    background-color: $value !important;\n" .
            "}\n";
			$cssContent .= ".text-headings-color, h1 {\n" .
			"    color: $value;\n" .
			"}\n";
	}else if($selector === 'apply_h1_color_to_all_headings_option' && intval($value) === 1) {
		$colorValue = $optionsArr['h1_color_option'];
		$cssContent .= "h1, h2, h3, h4, h5, h6 {\n" .
            "    color: $colorValue !important;\n" .
            "}\n";
	}else if($selector === 'hide_featured_images_from_small_screens_option') {
		$cssContent .= "@media (max-width: 575px) {\n".
			"    .thumbnail-mobile-hidden {\n".
			"        display: none !important;\n".
			"    }\n".
			"}\n";
	}
}

    // Path to the CSS file
    $cssFilePath = get_template_directory() . '/global-options-styles.css';

    // Save the CSS content to the file
    file_put_contents($cssFilePath, $cssContent);

	// Save options in database

	foreach($options as $optionName => $value) {
		// Add validation for URLS
		if( in_array($optionName, array('twitter_option', 'facebook_option','tiktok_option',
		'youtube_option', 'pinterest_option', 'instagram_option') ) ) {

			$validatedUrl = filter_var($value, FILTER_VALIDATE_URL);
			if($validatedUrl === false) {
				$response = array(
					'response' => 'One of the entered URL is not valid. Fix Your URLS and try again',
					'status'   => 0,
				);
				break;
			}
		}

		// Validate URLS in Youtube Latest Videos Option Field
		if($optionName === 'our_latest_youtube_videos_option' && !empty($value)) {
			foreach($value as $video) {
				$validate_youtube_url = filter_var($video, FILTER_VALIDATE_URL);
				if($validate_youtube_url === false || is_null($validate_youtube_url)) {
					$response = array(
						'response' => 'Please Correct Your Youtube Videos URLs',
						'status'   => 0,
					);
					break;
				}
			}
		}

		if($optionName === 'shopify_products_option' && !empty($value)) {
			foreach($value as $url) {
				$validate_shopify_url = filter_var($url['url'], FILTER_VALIDATE_URL);
				if($validate_shopify_url === false || is_null($validate_shopify_url)) {
					$response = array(
						'response' => 'Please Correct Your Shopify Products URLs',
						'status'   => 0,
					);
					break;
				}
			}
		}
	}
	
	foreach($options as $optionName => $value) {
		if($response['status'] === 1) {
			if($optionName === 'our_latest_youtube_videos_option' && !empty($value)) {
				$value = serialize($value);
			}else if($optionName === 'shopify_products_option' && !empty($value)) {
				$value = serialize($value);
			}

			update_option($optionName, $value);
		}
	}
	echo json_encode($response);
	// echo json_encode($optionsArr);

    wp_die();
}

// Hook the AJAX callback function
add_action('wp_ajax_automate_life_create_css', 'automate_life_create_css_callback');
add_action('wp_ajax_nopriv_automate_life_create_css', 'automate_life_create_css_callback');

// Update site logo in response to update site logo option in control panel
add_action('wp_ajax_automate_life_update_site_logo', 'automate_life_update_site_logo_callback');
add_action('wp_ajax_nopriv_automate_life_update_site_logo', 'automate_life_update_site_logo_callback');
function automate_life_update_site_logo_callback() {
    $id = isset($_REQUEST['LogoId']) ? $_REQUEST['LogoId'] : null;
    $removeAction = isset($_REQUEST['removeAction']) ? $_REQUEST['removeAction'] : 'false'; // Default to 'false' if not set

	
    // Convert 'null' string to null
	$id = (strtolower($id) === 'null' || empty(trim($id))) ? null : trim($id);
    // Convert 'true' or 'false' strings to actual booleans
    $removeAction = filter_var($removeAction, FILTER_VALIDATE_BOOLEAN);

    if(is_null($id) && $removeAction === true) {
		delete_option('site_logo');
		$response = array(
			'response' => 'Site Logo Removed',
			'status' => 3,
		);

	}else if(!is_null($id) && $removeAction === false) {
		update_option('site_logo', $id);
		$response = array(
			'response' => 'Site Logo Updated',
			'status' => 1,
		);
	}

	echo json_encode($response);

    wp_die();
}


// Remove Products Thumbnail image on remove icon click
add_action('wp_ajax_remove_product_image', 'remove_product_image_callback');
add_action('wp_ajax_nopriv_remove_product_image', 'remove_product_image_callback');
function remove_product_image_callback() {
	$id = isset($_POST['id']) ? absint($_POST['id']) : 0;
	$productsData = (!empty(get_option('shopify-products-data')) ?
	unserialize(get_option('shopify-products-data')) :
	array());

	foreach ($productsData as $key => $product) {
		if ($id === absint($product['id'])) {
            unset($productsData[$key]);
        }
    }

	update_option('shopify-products-data', serialize($productsData));

	// Return website url to show the dummy image
	echo site_url();

	wp_die();
}



/**
 * Recent Articles Section Template
 */


 function automate_life_recent_articles() {
	$articles = '<section class="container-fluid '.SITE_LAYOUT_SPACE.'">'.
    '<h2 class="fw-semibold text-capitalize mb-5 text-center">Recent Articles</h2>'.
    '<div class="row recent-articles">';
	$articlesArgs = array(
		'post_type' => 'post',
		'posts_per_page' => 3,
	);
	$articlesPosts = new WP_Query($articlesArgs);
	
	if($articlesPosts->have_posts()) {
		while($articlesPosts->have_posts()) {
			$articlesPosts->the_post();

			$articles .= '<div class="col-12 col-md-4 mb-4 mb-lg-0">'.
			'<div class="post-card">'.
			'<a href="'.get_the_permalink().'" class="post-thumbnail d-flex justify-content-center mb-30">';
			
			if (has_post_thumbnail()) {
				$thumbnail_url = get_the_post_thumbnail_url();
				$articles .= '<img
				data-src="' . esc_url($thumbnail_url) . '"
				alt="' . get_the_title() . '"
				title="'. get_the_title() .'"
				loading="lazy"
				class="img-fluid rounded-4"
				width="382"
				height="238"
				/>';
			} else {
				$dummy_image_url = esc_url(site_url('/wp-content/themes/automate-life/assets/images/dummy-post-thumbnail.webp'));
				$articles .= '<img
				data-src="' . $dummy_image_url . '"
				alt="' . get_the_title() . '"
				loading="lazy"
				class="img-fluid rounded-4"
				width="382"
				height="238"
				/>';
			}
			
			$articles .= '</a>'.
			'<div class="post-content px-3">'.
			'<h3 class="text-center text-capitalize recent-articles-title overflow-hidden">'.
			'<a href="'.get_the_permalink().'"
			class="text-decoration-none fw-semibol fs-3 text-dark">'.wp_trim_words(get_the_title(), 7).'</a>'.
            '</h3>'.
			'<p class="text-center recent-articles-description overflow-hidden">'. trim( wp_trim_words(strip_tags(get_the_content()), 20) ) .'</p>'.
            '<div class="d-flex align-items-center justify-content-center">'.
            '<a type="button"
			href="'.get_the_permalink().'"
			class="py-2 px-5 text-decoration-none bg-primary text-capitalize text-center rounded-circle-px">Read More</a>'.
            '</div>'.
            '</div>'.
            '</div>'. 
            '</div>';
		}
		wp_reset_postdata();
	}else {
		$articles .= '<p class="lead text-capitalize">Sorry No posts found</p>';
	}
    
	$articles .= '<div>'.
	'</section>';

	echo $articles;
 }


 function estimate_reading_time() {
    // Get the post content
    $content = get_post_field('post_content', get_the_ID());

    // Count the words in the content
    $word_count = str_word_count(strip_tags($content));

    // Average reading speed (adjust as needed)
    $words_per_minute = 200;

    // Calculate estimated reading time in minutes
	$reading_time_minutes = max(1, ceil($word_count / $words_per_minute));

    // Output the estimated reading time
    echo '<p class="reading-time m-0 font-md fw-semibold">' . $reading_time_minutes . ' min read</p>';
}

/**
 * Load recently viewed post and liked post
 */
add_action('wp_ajax_automate_life_recent_and_liked_posts', 'automate_life_recent_and_liked_posts_callback');
add_action('wp_ajax_nopriv_automate_life_recent_and_liked_posts', 'automate_life_recent_and_liked_posts_callback');
function automate_life_recent_and_liked_posts_callback() {
	$layout = isset($_POST['contentLayout']) ? $_POST['contentLayout'] : 'list';

	$recent_blogs_array = array(0);
	$liked_post_array = array(
		'post_type' => 'post',
		'posts_per_page' => -1,
		'post__in' => array(0),
	);

	if( isset($_COOKIE['post-recently-viewed']) ) {
		$id = json_decode($_COOKIE['post-recently-viewed']);
		$recent_blogs_array = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'post__in' => $id,
		);
	}
	if( isset($_COOKIE['liked_posts']) ) {
		$liked_ids = json_decode($_COOKIE['liked_posts']);
		// var_dump($liked_ids);
		$liked_post_array = array(
			'post_type' => 'post',
			'posts_per_page' => -1,
			'post__in' => $liked_ids,
		);
	}

	$recent_viewed_html = '';
	$liked_posts_html = '';

	$recent_viewed_html .= automate_life_cards_layout($recent_blogs_array, $layout);

	$liked_posts_html = automate_life_cards_layout($liked_post_array, $layout);

	echo json_encode(
		array(
			'recently_viewed' => $recent_viewed_html,
			'liked_posts' 	  => $liked_posts_html,
		)
	);

	wp_die();
}


/**
 * @param array $array array of post ids
 */

 function automate_life_cards_layout($array, $layout) {

    $posts = get_posts($array);

    $html = '';

    if(!empty($posts)) {
		foreach ($posts as $post) {
			$cat = get_the_category($post->ID);
			$html .= '<div class="'.( $layout !== 'grid' ? 'd-flex align-items-start justify-content-start mb-4' : 'grid-view-card' ).' gap-3">' .
				'<a href="' . get_the_permalink($post->ID) . '"
				class="post-card-thumbnail d-inline-block '.( $layout === 'grid' ? 'w-100' : 'w-50' ).'">';
		
			// Check if the post has a thumbnail
			if (has_post_thumbnail($post->ID)) {
				$thumbnail_url = get_the_post_thumbnail_url($post->ID);
				$html .= '<img
				data-src="' . esc_url($thumbnail_url) . '"
				alt="' . get_the_title($post->ID) . '"
				title="'.get_the_title($post->ID).'"
				loading="lazy"
				class="img-fluid"/>';
			}else {
				$dummy_image_url = esc_url(site_url('/wp-content/themes/automate-life/assets/images/dummy-post-thumbnail.webp'));
				$html .= '<img
				data-src="' . $dummy_image_url . '"
				alt="' . get_the_title($post->ID) . '"
				loading="lazy"
				class="img-fluid w-100" width="309" height="193"/>';
			}
		
			$html .= '</a>' .
				'<div class="card-content '.($layout === 'grid' ? 'w-100 mt-3' : 'w-50').'">' .
				'<a
				href="' . get_the_permalink($post->ID) . '"
				class="text-decoration-none related-post-title mb-2 d-block lh-sm '.( $layout === 'grid' ? 'text-center fs-5' : 'font-md' ).' ">' . get_the_title($post->ID) . '</a>';
			$html .= '</div>' .
				'</div>';
		}		
    }

    return $html;
}

// Add Fact checker custom field in post edit screen
function add_fact_checker_meta_box() {
    add_meta_box(
        'fact_checker_meta_box',
        'Fact Checker',
        'fact_checker_meta_box_callback',
        'post', // Change this to the post type you want to add the meta box to
        'side', // Change this to the context where you want the meta box to appear
        'default'
    );
}
add_action('add_meta_boxes', 'add_fact_checker_meta_box');

// Callback function to display the meta box content
function fact_checker_meta_box_callback($post) {
    // Get the saved fact checker user ID
    $selected_user_id = get_post_meta($post->ID, '_fact_checker_user', true);

    // Get all user names and IDs
    $users = get_users();
    ?>
    <select name="fact_checker_user" id="fact_checker_user">
        <option value="">Select a user</option>
        <?php foreach ($users as $user) : ?>
			<?php if ($user->display_name !== '') : ?>
				<option value="<?php echo esc_attr($user->ID); ?>" <?php selected($selected_user_id, $user->ID); ?>>
					<?php echo esc_html($user->display_name); ?>
				</option>
			<?php endif; ?>
		<?php endforeach; ?>
    </select>
    <?php
    wp_nonce_field('save_fact_checker_meta', 'fact_checker_nonce');
}

// Save the custom field data when the post is saved
function save_fact_checker_meta($post_id) {
    // Check if the current user has permission to save the data
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Verify the nonce
    if (!isset($_POST['fact_checker_nonce']) || !wp_verify_nonce($_POST['fact_checker_nonce'], 'save_fact_checker_meta')) {
        return;
    }

    // Save the fact checker user ID
    if (isset($_POST['fact_checker_user'])) {
        update_post_meta($post_id, '_fact_checker_user', sanitize_text_field($_POST['fact_checker_user']));
    }
}
add_action('save_post', 'save_fact_checker_meta');



function savepostlikeddislikedstatus(){

 if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_status = $_POST['current_status'];
    $post_id = $_POST['post_id'];
	$decrement_flag = $_POST['decrement_flag'];

    if ($post_status === 'remove_liked' && $decrement_flag == 0) {
        // Update liked count in post meta 
        $liked_count = get_post_meta($post_id, 'liked_count', true);
        $liked_count = $liked_count - 1;
        update_post_meta($post_id, 'liked_count', $liked_count);	
		
    } elseif ($post_status === 'liked' && $decrement_flag == 1) {
		
		// Update liked count in post meta 
		$liked_count = 0;
		if (metadata_exists('post', $post_id, 'liked_count')) {
			$liked_count = get_post_meta($post_id, 'liked_count', true);
		}
        $liked_count = $liked_count + 1;
        update_post_meta($post_id, 'liked_count', $liked_count);
		
        // Update disliked count in post meta 
        $disliked_count = get_post_meta($post_id, 'disliked_count', true);
        $disliked_count = $disliked_count - 1;
        update_post_meta($post_id, 'disliked_count', $disliked_count);
		
    } elseif ($post_status === 'liked' && $decrement_flag == 0) {
		
		// Update liked count in post meta 
		$liked_count = 0;
		if (metadata_exists('post', $post_id, 'liked_count')) {
			$liked_count = get_post_meta($post_id, 'liked_count', true);
		}
        $liked_count = $liked_count + 1;
        update_post_meta($post_id, 'liked_count', $liked_count);
	
	
	} elseif ($post_status === 'remove_disliked' && $decrement_flag == 0) {
        // Update liked count in post meta 
        $disliked_count = get_post_meta($post_id, 'disliked_count', true);
        $disliked_count = $disliked_count - 1;
        update_post_meta($post_id, 'disliked_count', $disliked_count);	
		
    } elseif ($post_status === 'disliked' && $decrement_flag == 1) {
		
		// Update disliked count in post meta 
		$disliked_count = 0;
		if (metadata_exists('post', $post_id, 'disliked_count')) {
			$disliked_count = get_post_meta($post_id, 'disliked_count', true);
		}
        $disliked_count = $disliked_count + 1;
        update_post_meta($post_id, 'disliked_count', $disliked_count);
		
        // Update liked count in post meta 
        $liked_count = get_post_meta($post_id, 'liked_count', true);
        $liked_count = $liked_count - 1;
        update_post_meta($post_id, 'liked_count', $liked_count);
    } elseif ($post_status === 'disliked' && $decrement_flag == 0) {
		// Update disliked count in post meta 
		$disliked_count = 0;
		if (metadata_exists('post', $post_id, 'disliked_count')) {
			$disliked_count = get_post_meta($post_id, 'disliked_count', true);
		}
        $disliked_count = $disliked_count + 1;
        update_post_meta($post_id, 'disliked_count', $disliked_count);
		
	} else{
		// do nothing
	}
 }
 die;
}
add_action('wp_ajax_post_liked_disliked', 'savepostlikeddislikedstatus');
add_action('wp_ajax_nopriv_post_liked_disliked', 'savepostlikeddislikedstatus');



/**
 * Email Lead Popup
 */
function automate_life_email_lead_popup() {
	$popup = ob_start(); ?>
	<div class="email-popup-wrapper position-fixed top-0 start-0 vw-100 vh-100 d-none">
		<div class="email-popup-overlay position-absolute top-0 start-0 bg-secondary z-1 w-100 h-100"></div>
		<div class="container d-flex align-items-center h-auto position-relative z-3">
			<div class="bg-white w-100 flex-grow-1 lead-form-image">

				<button type="button" data-bs-dismiss="modal"
				aria-label="Close"
				class="btn btn-close position-absolute top-0 end-0 cursor-pointer
				email-popup-close"></button>

			<div class="d-flex email-popup-content-container h-100">
				<div class="w-25">
					<img class="img-fluid h-100 object-fit-cover w-100"
					data-src="<?php echo get_template_directory_uri() ?>/assets/images/left-side-popup-img.jpeg"
					alt="Subscribe to our monthly newsletter"
					title="Subscribe to our monthly newsletter"
					loading="lazy"
					width="454"
					height="800">
				</div>

				<div class="w-75 position-relative p-4">
					<!-- Overlay image -->
					<img src="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/right-sidebg-img.jpeg"
					alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover opacity-50 z-0 pe-none user-select-none">
					<!-- Content -->
					<div class="z-1 position-relative d-flex flex-column justify-content-center h-100">
						<!-- Get site logo -->
						<div class="email-popup-site-logo mx-auto mb-3 d-flex w-100 justify-content-center d-none">
							<?php the_custom_logo(); ?>
						</div>
						<h3 class="font-30 mb-0 text-center fw-normal">In our monthly newsletter you'll receive</h3>
						<h2 class="email-popup-heading fw-bold mb-1 pb-10 lh-sm text-center">START LEARNING ABOUT <br> SMART HOMES</h2>
						<ul class="list-unstyled text-center ms-0 mb-3 p-0">
							<li class="text-capitalize font-lg fw-bold">News & Announcements</li>
							<li class="text-capitalize font-lg fw-bold">New Articles</li>
							<li class="text-capitalize font-lg fw-bold">New Releases</li>
						</ul>

						<!-- Lead capture form -->
						<?php echo automate_life_email_recaptcha_layout_2(); ?>
						<p class="font-md p-0 mb-0 mt-2 text-center">No spam, Unsubscribe any time</p>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>

	<?php 
	$popup = ob_get_clean();
	echo $popup;
}

add_action('wp_footer', 'automate_life_email_lead_popup');