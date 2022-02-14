<?php
/**
 * A set of custom helpers for this theme
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Helper function for prettying up errors
 *
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
function underscores_error( $message, $subtitle = '', $title = '' ) {
  $title = $title ?: __('Error', 'underscores');
  $footer = '';
  $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
  wp_die( $message, $title );
};

/**
 * Helper function for determining if we're on the live site or not
 * Checks for the wp_get_environment_type first, if that doesn't exist
 * then fallback to our local/staging urls to determine what env we're on.
 *
 * @return string 'local', 'staging' or 'live'
 */
function underscores_site_env() {
  $siteURL = get_site_url();
  $local = '.local';
  $staging = 'dev.blinkseo.co.uk/';

  // Default our settings
  $is_local = false;
  $is_staging = false;
  $is_production = true;

  // Default wp_get_environment_type is production
  // Check for wp_get_environment_type and fallback to our url settings above if it's not available
  if ( wp_get_environment_type() !== 'production' ) {
    switch ( wp_get_environment_type() ) {
      case 'local' :
      case 'development' :
        $is_local = true;
        $is_production = false;
        break;
      case 'staging' :
        $is_staging = true;
        $is_production = false;
        break;
    }

  } else {
    if ( strpos( $siteURL, $local ) !== false ) {
      $is_local = true;
      $is_production = false;
    }

    if ( strpos( $siteURL, $staging ) !== false ) {
      $is_staging = true;
      $is_production = false;
    }
  }

  if ( $is_production === true ) {
    return 'production';
  }

  if ( $is_staging === true ) {
    return 'staging';
  }

  if ( $is_local === true ) {
    return 'local';
  }
}