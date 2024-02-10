<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package automate_life
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Canonical URLS -->
	<?php
		if( is_front_page() ) {
			echo '<link rel="canonical" href="'. site_url() .'" />';
			echo '<meta name="robots" content="index, follow">';
			echo '<title>'.wp_get_document_title().'</title>';
		}
	?>
	<link rel="icon" href="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/automatelife-32.jpeg" sizes="32x32" />
	<link rel="icon" href="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/automatelife-192.jpeg" sizes="192x192" />
	<link rel="apple-touch-icon" href="<?php echo site_url(); ?>/wp-content/themes/automate-life/assets/images/automatelife-180.jpeg" />
	<?php
	$meta_description = get_post_meta(get_the_ID(), '_custom_meta_description', true);

	if (!empty($meta_description)) {
		echo '<meta name="description" content="' . esc_attr($meta_description) . '" />' . "\n";
	} elseif (has_excerpt()) {
		echo '<meta name="description" content="' . esc_attr(get_the_excerpt()) . '" />' . "\n";
	} else {
		echo '<meta name="description" content="' . esc_attr(wp_kses(wp_trim_words(get_the_content(), 20), 'post')) . '" />' . "\n";
	}

	
	?>
	<!-- Add schema code -->
	<script type="application/ld+json">
	{
	"@context": "https://schema.org",
	"@type": "Article",
	"mainEntityOfPage": {
		"@type": "Article",
		"@id": "https://hirejunaid.com/"
	},
	"headline": "Website developer from future",
	"description": "fsdnksd",
	"image": [
		"https://www.google.com",
		"https://www.google.com"
	],  
	"author": {
		"@type": "Person",
		"name": "Junaid Asghar",
		"url": "hirejunaid.com"
	},  
	"publisher": {
		"@type": "Organization",
		"name": "hirejunaid",
		"logo": {
		"@type": "ImageObject",
		"url": ""
		}
	},
	"datePublished": "2024-02-09",
	"dateModified": "2024-02-10"
	}
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php 
// Define Some Global Variables to easily change the breakpoints of elements
$GLOBALS['desktop-flex-breakpoint'] = 'd-lg-flex';
$GLOBALS['desktop-hidden-breakpoint'] = 'd-lg-none';
$GLOBALS['desktop-block-breakpoint'] = 'd-lg-block';
$desktopBreakpoint = 'lg';

?>


<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'automate-life' ); ?></a>

	<header id="masthead" class="site-header container-fluid">
		<div class="row header-main pt-3 pt-<?php echo $desktopBreakpoint; ?>-0">
			<div class="site-branding col-5">
				<?php the_custom_logo(); ?>
			</div>
			<div class="header-ctas col-7 d-none <?php echo $GLOBALS['desktop-flex-breakpoint'] ?> align-items-center justify-content-end">
				<div class="d-flex align-items-center justify-content-between me-5 pe-3">
				<?php
					foreach (COMPANY_SOCIALS_URLS as $index => $icon) {
						if(trim(get_option($icon)) !== false && !empty(trim(get_option($icon)))) {
							if(strpos($icon, 'twitter') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-twitter">
								</a>';
							}else if(strpos($icon, 'facebook') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-facebook">
								</a>';
							}else if(strpos($icon, 'tiktok') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-tiktok">
								</a>';
							}else if(strpos($icon, 'youtube') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-youtube">
								</a>';
							}else if(strpos($icon, 'pinterest') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-pinterest">
								</a>';
							}else if(strpos($icon, 'instagram') !== false) {
								echo '<a href="'.esc_url(trim(get_option($icon))).'" target="_blank" class="bg-primary rounded-circle text-white text-center text-decoration-none d-flex align-items-center justify-content-center company-social-icons bi bi-instagram">
								</a>';
							}
						}
					}
				?>
				</div>
				<a type="button"
				class="header-cta-button text-decoration-none text-uppercase bg-primary py-1 px-3 text-white text-center fw-bold"
				target="_blank">shop <img src="<?php echo esc_url(site_url()); ?>/wp-content/themes/automate-life/assets/images/header-shop-icon.svg"
				width="14" height="14" loading="lazy" alt="Shop" class="img-fluid ms-1" /></a>
			</div>
			<!-- Header Menu Toggler Icon -->
			<div class="header-toggle-icon col-7 d-flex <?php echo $GLOBALS['desktop-hidden-breakpoint'] ?> align-items-center justify-content-end">
				<a type="button"
				class="header-cta-button text-decoration-none text-uppercase bg-primary py-1 px-3 text-white text-center fw-bold me-3">shop
				<img src="<?php echo esc_url(site_url()); ?>/wp-content/themes/automate-life/assets/images/header-shop-icon.svg"
				width="14" height="14" />
				</a>
				<i class="bi bi-list"></i>
			</div>
		</div>

		<div class="header-bottom d-none <?php echo $GLOBALS['desktop-flex-breakpoint']; ?> align-items-center mt-3 pb-3 gap-4 border-bottom border-dark">
			<nav id="site-navigation" class="main-navigation flex-grow-1">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'automate-life' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary_menu',
						'menu_id'        => 'primary_menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->		
			<!-- Get the search form -->
			<?php 
				if(get_option('enable_search_bar_option') !== false && intval(get_option('enable_search_bar_option')) === 1) {
					echo '<div class="header-search-form position-relative">';
					get_search_form();
					echo '<i class="bi bi-search position-absolute end-0 top-50 translate-middle-y rounded-circle
					d-flex align-items-center justify-content-center fs-4 text-white bg-primary cursor-pointer"></i>';
					echo '</div>';
				}
				?>
		</div>

	</header><!-- #masthead -->



	

