<?php
/**
 * Prints the alternate heading with a fallback to the_title() if the field isn't available or empty.
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_heading' ) ) :
  /**
   * Prints the alternate heading with a fallback to the_title() if the field isn't available or empty.
   *
   * @param string $heading Alternate heading text to the_title();
   */
  function underscores_heading( string $heading = '' ) {
    if ( ! is_string( $heading ) ) {
      trigger_error( 'Expects underscores_heading() to receive a string', E_WARNING );
    }

    if ( empty( $heading ) || $heading !== '' && ! is_string( $heading ) ) {
      $heading = get_the_title();
    }

    echo "<h1 class='entry-title'>{$heading}</h1>";
  }
endif;