<?php

/**
 * @author: VLThemes
 * @version: 1.0
 */

define( 'RAMSAY_THEME_DIRECTORY', trailingslashit( get_template_directory_uri() ) );
define( 'RAMSAY_REQUIRE_DIRECTORY', trailingslashit( get_template_directory() ) );
define( 'RAMSAY_DEVELOPMENT', false );

/**
 * After setup theme
 */
if ( ! function_exists( 'ramsay_setup' ) ) {
	function ramsay_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Ducky, use a find and replace
		 * to change 'ramsay' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ramsay', get_template_directory() . '/languages' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1920, 9999 );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array(
			'gallery',
			'link',
			'quote',
			'video',
			'audio'
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		add_theme_support( 'dark-editor-style' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name' => esc_html__( 'Small', 'ramsay' ),
					'shortName' => esc_html__( 'S', 'ramsay' ),
					'size' => 12,
					'slug' => 'small',
				),
				array(
					'name' => esc_html__( 'Normal', 'ramsay' ),
					'shortName' => esc_html__( 'M', 'ramsay' ),
					'size' => 14,
					'slug' => 'normal',
				),
				array(
					'name' => esc_html__( 'Large', 'ramsay' ),
					'shortName' => esc_html__( 'L', 'ramsay' ),
					'size' => 28,
					'slug' => 'large',
				),
				array(
					'name' => esc_html__( 'Huge', 'ramsay' ),
					'shortName' => esc_html__( 'XL', 'ramsay' ),
					'size' => 38,
					'slug' => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'First', 'ramsay' ),
				'slug' => 'first',
				'color' => ramsay_get_theme_mod( 'accent_colors' )['first'],
			),
			array(
				'name' => esc_html__( 'Second', 'ramsay' ),
				'slug' => 'second',
				'color' => ramsay_get_theme_mod( 'accent_colors' )['second'],
			)
		) );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// register nav menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Menu', 'ramsay' ),
			'onepage-menu' => esc_html__( 'Onepage Menu', 'ramsay' ),
			'navbar-menu' => esc_html__( 'Navbar Menu', 'ramsay' ),
		) );

		// 800x600
		add_image_size( 'ramsay-800x600_crop', 800, 600, true );
		add_image_size( 'ramsay-800x600', 800 );

		// 1280x720
		add_image_size( 'ramsay-1280x720_crop', 1280, 720, true );
		add_image_size( 'ramsay-1280x720', 1280 );

		// 1920x1080
		add_image_size( 'ramsay-1920x1080_crop', 1920, 1080, true );
		add_image_size( 'ramsay-1920x1080', 1920 );

		// 1920x960
		add_image_size( 'ramsay-1920x960_crop', 1920, 960, true );

	}
}
add_action( 'after_setup_theme', 'ramsay_setup' );

/**
 * Content width
 */
if ( ! function_exists( 'ramsay_content_width' ) ) {
	function ramsay_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'ramsay/content_width', 1140 );
	}
}
add_action( 'after_setup_theme', 'ramsay_content_width', 0 );

/**
 * Import ACF fields
 */
if ( ! RAMSAY_DEVELOPMENT ) {
	function ramsay_acf_show_admin_panel() {
		return apply_filters( 'ramsay/acf_show_admin_panel', false );
	}
	add_filter( 'acf/settings/show_admin', 'ramsay_acf_show_admin_panel' );
}

if ( ! RAMSAY_DEVELOPMENT ) {
	require_once RAMSAY_REQUIRE_DIRECTORY . 'inc/helper/custom-fields/custom-fields.php';
}

if ( ! function_exists( 'ramsay_acf_save_json' ) ) {
	function ramsay_acf_save_json( $path ) {
		$path = RAMSAY_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
		return $path;
	}
}
add_filter( 'acf/settings/save_json', 'ramsay_acf_save_json' );

if ( RAMSAY_DEVELOPMENT ) {
	if ( ! function_exists( 'ramsay_acf_load_json' ) ) {
		function ramsay_acf_load_json( $paths ) {
			unset( $paths[0] );
			$paths[] = RAMSAY_REQUIRE_DIRECTORY . 'inc/helper/custom-fields';
			return $paths;
		}
	}
	add_filter( 'acf/settings/load_json', 'ramsay_acf_load_json' );
}

/**
 * Include Kirki fields
 */
require_once RAMSAY_REQUIRE_DIRECTORY . 'inc/framework/customizer-helper.php';
require_once RAMSAY_REQUIRE_DIRECTORY . 'inc/framework/customizer.php';

/**
 * Required files
 */
$ramsay_theme_includes = array(
	'required-plugins',
	'enqueue',
	'includes',
	'merlin-config',
	'functions',
	'actions',
	'filters',
	'menus',
);

foreach ( $ramsay_theme_includes as $file ) {
	require_once RAMSAY_REQUIRE_DIRECTORY . 'inc/theme-' . $file . '.php';
}

// Unset the global variable.
unset( $ramsay_theme_includes );