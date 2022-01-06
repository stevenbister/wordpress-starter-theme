<?php
/**
 * Functions which enqueue and set up our assets
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_dist_path' ) ) {
  /**
   * Generate the path to the dist file with a fallback if it's not present.
   *
   * It checks if the manifest files exists and pass the hashed version of file to the url.
   */
  function underscores_dist_path( $filename ) {
    // Get the manifest file. This will contain a reference to our hashed files.
    $manifest = get_stylesheet_directory() . '/dist/mix-manifest.json';

    // Check if manifest exists.
    if ( file_exists( $manifest ) ) {
      // Get the contents of manifest.
      $manifest_contents = json_decode( file_get_contents( $manifest ), true );
    } else {
      $manifest_contents = array();
    }

    // If manifest contains the requested filename, return the hashed name.
    if ( array_key_exists( $filename, $manifest_contents ) ) {
      return get_template_directory_uri() . '/dist' . $manifest_contents[ $filename ];
    }

    // Else return original files.
    return get_template_directory_uri() . '/dist' . $filename;
  }
}

function underscores_scripts() {
	wp_enqueue_style( 'underscores-style', underscores_dist_path( '/css/style.css' ), array(), _S_VERSION );
	wp_style_add_data( 'underscores-style', 'rtl', 'replace' );

	wp_enqueue_script( 'underscores-scripts', underscores_dist_path( '/js/scripts.js' ), array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'underscores_scripts' );