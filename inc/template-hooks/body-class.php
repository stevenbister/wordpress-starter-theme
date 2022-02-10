<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_acf_link' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function underscores_body_classes( $classes ) {
	// Adds a class of no-sidebar when there is no sidebar present.
	// if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	// 	$classes[] = 'no-sidebar';
	// }

	return $classes;
}

add_filter( 'body_class', 'underscores_body_classes' );
endif;