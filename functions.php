<?php
/**
 * underscores functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Helpers
 */
require get_template_directory() . '/inc/helpers.php';

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Ensure compatible version of PHP is used
 */
if ( version_compare('7.4', phpversion(), '>=') ) {
  underscores_error( __('You must be using PHP 7.4 or greater.', 'underscores'), __('Invalid PHP version', 'underscores') );
}

/**
* Ensure compatible version of WordPress is used
*/
if ( version_compare('5.0.0', get_bloginfo('version'), '>=') ) {
  underscores_error( __( 'You must be using WordPress 5.0.0 or greater.', 'underscores' ), __( 'Invalid WordPress version', 'underscores' ) );
}

/**
 * Setup
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function underscores_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'underscores_content_width', 640 );
}
add_action( 'after_setup_theme', 'underscores_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function underscores_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'underscores' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'underscores' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'underscores_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue-assets.php';

/**
 * unctions which enhance the theme by hooking into WordPress
 */
require get_template_directory() . '/inc/template-hooks.php';

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Functions which enhance/effect the admin area.
 */
require get_template_directory() . '/inc/admin-functions.php';

/**
 * Functions which expand and enable ACF features
 */
if ( class_exists('ACF') ) {
  require get_template_directory() . '/inc/acf.php';
}