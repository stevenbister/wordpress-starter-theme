<?php
/**
 * Functions which setup our theme
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function underscores_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on underscores, use a find and replace
		 * to change 'underscores' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'underscores', get_template_directory() . '/languages' );

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

    // Adds custom image sizes
    add_image_size( 'card-thumb', 580, 300 );

    /**
     * Init menu functions
     */
		require get_template_directory() . '/inc/menu-functions.php';

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

		/**
     * Remove customizer options.
     *
     * @since 1.0.0
     * @param object $wp_customize The current WordPress customizer object.
     */
    function underscores_remove_customizer_options( $wp_customize ) {
      $wp_customize->remove_panel( 'themes' );
    }
    add_action( 'customize_register', 'underscores_remove_customizer_options', 30 );

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

    /**
     * Disable emoji support for the tinymce
     *
     * @param array $plugins plugin to pass.
     */
    function underscores_disable_emoji_tinymce( $plugins ) {
      if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
      } else {
        return array();
      }
    }

    /**
     * Disables emoji support across the theme
     */
    function underscores_disable_wp_emoji() {

      // all actions related to emojis.
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      remove_action( 'wp_print_styles', 'print_emoji_styles' );
      remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
      remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
      remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

      // filter to remove TinyMCE emojis.
      add_filter( 'tiny_mce_plugins', 'underscores_disable_emoji_tinymce' );

      // filter to remove DNS prefetch.
      add_filter( 'emoji_svg_url', '__return_false' );
    }
    add_action( 'init', 'underscores_disable_wp_emoji' );

    /**
		 * Removes the wp version number from the generated files
		 */
		remove_action( 'wp_head', 'wp_generator' ); // remove version from head.
		add_filter( 'the_generator', '__return_empty_string' ); // remove version from rss.

    // Removes Windows Live Writer manifest
    remove_action('wp_head', 'wlwmanifest_link');

    /**
		 * Removes version from scripts and styles
		 *
		 * @param string $src file path.
		 */
		function lzlabs_remove_version_scripts_styles( $src ) {
			if ( strpos( $src, 'ver=' ) ) {
				$src = remove_query_arg( 'ver', $src );
			}
			return $src;
		}
		add_filter( 'style_loader_src', 'lzlabs_remove_version_scripts_styles', 9999 );
		add_filter( 'script_loader_src', 'lzlabs_remove_version_scripts_styles', 9999 );

    /**
     * Set the length of our exceprts
     */
    function underscores_custom_excerpt_length( $length ) {
      return 22;
    }
    add_filter( 'excerpt_length', 'underscores_custom_excerpt_length', 999 );

    /**
     * Change the excerpt more string
     */
    function underscores_excerpt_more( $more ) {
      return '&hellip;';
    }
    add_filter( 'excerpt_more', 'underscores_excerpt_more' );
  }
endif;
add_action( 'after_setup_theme', 'underscores_setup' );