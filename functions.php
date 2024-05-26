<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage RSUD Ciawi
 * @since RSUD Ciawi 1.0
 */

require_once(get_template_directory() . '/includes/hooks.php');
require_once(get_template_directory() . '/includes/filters.php');
require_once(get_template_directory() . '/includes/functions.php');

if ( ! function_exists( 'rsc_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since RSUD Ciawi 1.0
	 *
	 * @return void
	 */
	function rsc_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on RSUD Ciawi, use a find and replace
		 * to change 'rsc' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'rsc', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

    /**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1366, 768 );

		register_nav_menus(
			array(
				'topbar' => esc_html__( 'Topbar menu', 'rsc' ),
				'primary' => esc_html__( 'Primary menu', 'rsc' ),
				'footer_1' => esc_html__( 'Footer 1 menu', 'rsc' ),
				'footer_2' => esc_html__( 'Footer 2 menu', 'rsc' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 354;
		$logo_height = 81;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

	    // Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'rsc_setup' );

/**
 * Enqueue scripts and styles.
 *
 * @since RSUD Ciawi 1.0
 *
 * @return void
 */
function rsc_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	
	// Theme style
  wp_enqueue_style( 'rsc-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

	// Single post
	if(is_singular('post') || is_singular('page')) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Frontpage
		if(is_front_page()) {
			// Owl
			wp_enqueue_style('rsc-owl-carousel-style', get_template_directory_uri() . '/dist/owl/assets/owl.carousel.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.carousel.min.css'), 'all');
			wp_enqueue_style('rsc-owl-theme-style', get_template_directory_uri() . '/dist/owl/assets/owl.theme.default.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.theme.default.min.css'), 'all');
			
			// Animate.css
			// wp_enqueue_style('rsc-animate-style', get_template_directory_uri() . '/dist/owl/extend/animate.min.css', array(), filemtime(get_template_directory() . '/dist/owl/extend/animate.min.css'), 'all');

			// Frontpage CSS
			wp_enqueue_style('rsc-frontpage-style', get_template_directory_uri() . '/dist/css/frontpage.css', array(), filemtime(get_template_directory() . '/dist/css/frontpage.css'), 'all');

			// JS

			// Owl
			wp_enqueue_script( 'rsc-owl-carousel-js', get_template_directory_uri() . '/dist/owl/owl.carousel.min.js', array('rsc-jquery-js'), filemtime(get_template_directory() . '/dist/owl/owl.carousel.min.js'), true );

			// Frontpage JS
			wp_enqueue_script( 'rsc-frontpage-js', get_template_directory_uri() . '/dist/js/frontpage.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/frontpage.js'), true );
		} else if(is_page_template('pages/dokter.php')) {
			// Dokter CSS
			wp_enqueue_style('rsc-dokter-style', get_template_directory_uri() . '/dist/css/dokter.css', array(), filemtime(get_template_directory() . '/dist/css/dokter.css'), 'all');

			// JS

			// Dokter JS
			wp_enqueue_script( 'rsc-dokter-js', get_template_directory_uri() . '/dist/js/dokter.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/dokter.js'), true );
		} else if(is_page_template('pages/promo.php')) {
			// Promo CSS
			wp_enqueue_style('rsc-promo-style', get_template_directory_uri() . '/dist/css/promo.css', array(), filemtime(get_template_directory() . '/dist/css/promo.css'), 'all');

			// JS

			// Promo JS
			wp_enqueue_script( 'rsc-promo-js', get_template_directory_uri() . '/dist/js/promo.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/promo.js'), true );
		} else if(is_page_template('pages/pkrs.php')) {
			// Owl
			wp_enqueue_style('rsc-owl-carousel-style', get_template_directory_uri() . '/dist/owl/assets/owl.carousel.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.carousel.min.css'), 'all');
			wp_enqueue_style('rsc-owl-theme-style', get_template_directory_uri() . '/dist/owl/assets/owl.theme.default.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.theme.default.min.css'), 'all');
			
			// PKRS CSS
			wp_enqueue_style('rsc-pkrs-style', get_template_directory_uri() . '/dist/css/pkrs.css', array(), filemtime(get_template_directory() . '/dist/css/pkrs.css'), 'all');

			// JS

			// Owl
			wp_enqueue_script( 'rsc-owl-carousel-js', get_template_directory_uri() . '/dist/owl/owl.carousel.min.js', array('rsc-jquery-js'), filemtime(get_template_directory() . '/dist/owl/owl.carousel.min.js'), true );

			// PKRS JS
			wp_enqueue_script( 'rsc-pkrs-js', get_template_directory_uri() . '/dist/js/pkrs.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/pkrs.js'), true );
		} else if(is_singular('page')) {
			// Page CSS
			wp_enqueue_style('rsc-page-style', get_template_directory_uri() . '/dist/css/page.css', array(), filemtime(get_template_directory() . '/dist/css/page.css'), 'all');

			// JS

			// Page JS
			wp_enqueue_script( 'rsc-page-js', get_template_directory_uri() . '/dist/js/page.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/page.js'), true );
		} else if(is_singular('post')) {
			// Single CSS
			wp_enqueue_style('rsc-single-style', get_template_directory_uri() . '/dist/css/single.css', array(), filemtime(get_template_directory() . '/dist/css/single.css'), 'all');

			// JS

			// Single JS
			wp_enqueue_script( 'rsc-single-js', get_template_directory_uri() . '/dist/js/single.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/single.js'), true );
		}
	}

	// Single Dokter
	if(is_singular('dokter')) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Single Dokter CSS
		wp_enqueue_style('rsc-single-dokter-style', get_template_directory_uri() . '/dist/css/single-dokter.css', array(), filemtime(get_template_directory() . '/dist/css/single-dokter.css'), 'all');

		// JS

		// Single Dokter JS
		wp_enqueue_script( 'rsc-single-dokter-js', get_template_directory_uri() . '/dist/js/single-dokter.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/single-dokter.js'), true );
	}

	// Single Layanan
	if(is_singular('layanan')) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Single Layanan CSS
		wp_enqueue_style('rsc-single-layanan-style', get_template_directory_uri() . '/dist/css/single-layanan.css', array(), filemtime(get_template_directory() . '/dist/css/single-layanan.css'), 'all');

		// JS

		// Single Layanan JS
		wp_enqueue_script( 'rsc-single-layanan-js', get_template_directory_uri() . '/dist/js/single-layanan.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/single-layanan.js'), true );
	}

	// Single Promo
	if(is_singular('promo')) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Single Promo CSS
		wp_enqueue_style('rsc-single-promo-style', get_template_directory_uri() . '/dist/css/single-promo.css', array(), filemtime(get_template_directory() . '/dist/css/single-promo.css'), 'all');

		// JS

		// Single Promo JS
		wp_enqueue_script( 'rsc-single-promo-js', get_template_directory_uri() . '/dist/js/single-promo.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/single-promo.js'), true );
	}

	// Home
	if(is_home() || is_search() || is_archive()) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Owl
		wp_enqueue_style('rsc-owl-carousel-style', get_template_directory_uri() . '/dist/owl/assets/owl.carousel.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.carousel.min.css'), 'all');
		wp_enqueue_style('rsc-owl-theme-style', get_template_directory_uri() . '/dist/owl/assets/owl.theme.default.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.theme.default.min.css'), 'all');

		// Home CSS
		wp_enqueue_style('rsc-home-style', get_template_directory_uri() . '/dist/css/home.css', array(), filemtime(get_template_directory() . '/dist/css/home.css'), 'all');

		// JS

		// Owl
		wp_enqueue_script( 'rsc-owl-carousel-js', get_template_directory_uri() . '/dist/owl/owl.carousel.min.js', array('rsc-jquery-js'), filemtime(get_template_directory() . '/dist/owl/owl.carousel.min.js'), true );

		// Home JS
		wp_enqueue_script( 'rsc-home-js', get_template_directory_uri() . '/dist/js/home.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/home.js'), true );
	}

	// Single Kegiatan
	if(is_singular('kegiatan')) {
		// CSS

		// Reset WP Styles
		wp_deregister_style('wp-block-library');
		wp_deregister_style('wp-block-library-theme-inline'); // no effect
		wp_deregister_style('classic-theme-styles');
		wp_deregister_style('global-styles-inline'); // no effect

		// Font Awesome
		wp_enqueue_style('rsc-fa-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/fontawesome.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/fontawesome.min.css'), 'all');
		wp_enqueue_style('rsc-fa-brands-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/brands.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/brands.min.css'), 'all');
		wp_enqueue_style('rsc-fa-solid-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/solid.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/solid.min.css'), 'all');
		wp_enqueue_style('rsc-fa-regular-style', get_template_directory_uri() . '/dist/fonts/fontawesome/css/regular.min.css', array(), filemtime(get_template_directory() . '/dist/fonts/fontawesome/css/regular.min.css'), 'all');

		// Owl
		wp_enqueue_style('rsc-owl-carousel-style', get_template_directory_uri() . '/dist/owl/assets/owl.carousel.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.carousel.min.css'), 'all');
		wp_enqueue_style('rsc-owl-theme-style', get_template_directory_uri() . '/dist/owl/assets/owl.theme.default.min.css', array(), filemtime(get_template_directory() . '/dist/owl/assets/owl.theme.default.min.css'), 'all');

		// Single Kegiatan CSS
		wp_enqueue_style('rsc-single-kegiatan-style', get_template_directory_uri() . '/dist/css/single-kegiatan.css', array(), filemtime(get_template_directory() . '/dist/css/single-kegiatan.css'), 'all');

		// JS

		// Owl
		wp_enqueue_script( 'rsc-owl-carousel-js', get_template_directory_uri() . '/dist/owl/owl.carousel.min.js', array('rsc-jquery-js'), filemtime(get_template_directory() . '/dist/owl/owl.carousel.min.js'), true );

		// Single Kegiatan JS
		wp_enqueue_script( 'rsc-single-kegiatan-js', get_template_directory_uri() . '/dist/js/single-kegiatan.js', array('rsc-jquery-js', 'rsc-main-js'), filemtime(get_template_directory() . '/dist/js/single-kegiatan.js'), true );
	}

	// Scripts
	if(!is_admin()) {
		wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');

		wp_enqueue_script( 'rsc-jquery-js', get_template_directory_uri() . '/dist/js/jquery-3.7.1.min.js', array(), '3.7.1', true );
	}

  // Main JS
	wp_enqueue_script( 'rsc-main-js', get_template_directory_uri() . '/dist/js/main.js', array('rsc-jquery-js'), filemtime(get_template_directory() . '/dist/js/main.js'), true );
}
add_action( 'wp_enqueue_scripts', 'rsc_scripts' );