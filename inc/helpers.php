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